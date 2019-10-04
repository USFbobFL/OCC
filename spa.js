/*
spa.js was cloned from pal.js and is meant to be a starting place for new app template
*/
local_storage_prefix = "PAL";
debug = false;
checking_login = false;
AJAXisActive = false;
AJAXfct = "";
AJAXobj = "";
timerMS = 5 * 1000;
isLoggedIn = false;
login_status_checks = 0;
aAJAXqueue = [];

$( document ).ready(function() {
    document_loading = true;
	writeConsole("debug is active in pal.js", "info");
	$('#login_modal').on('hidden.bs.modal', function (e) {
		if (!checking_login) {
			checkLoginStatus();
		}
	})	

	$("#btn_logout").click(function(){
		callAJAX("Logout");
	});
	checkLoginStatus();
	timerEvent();
	startInterval();
	document_loading = false;
	//bs4_toast_info("Welcome to the SPA!");
});
function resetCheckboxes(cbid_class){
	/*
	Every list of checkboxes created with the bootstrap function getCheckListCode will have the same class 
	as the checkbox id, so we can easily reset all of the checkboxes with a single jquery command.  
	I should probably consider adding an option that the bs4 function to render a reset button in the 
	table header.  In fact, I'm thinking about making this default behavior if the table header is left 
	blank... to make the header default to a check icon and a warning-color outlined reset button.
	*/
	$("."+cbid_class).prop("checked", false);
}
function checkLoginStatus(){
	callAJAX("checkLoginStatus");
}
email_address = "";
password = "";
remember_me = false;
function attemptLogin(){
	checking_login = true;
	email_address = $("#pal_email_address").val();
	password = $("#pal_password").val();
	remember_me = $("#cb_remember").prop("checked");
	if ((email_address > "") &&  (password > "")) {
		callAJAX("attemptLogin", "&emailaddr="+email_address+"&password="+password);	
	} else {
		showLoginControl();
	}

}
function onAJAXcompleted(success, errorMsg = ""){
	AJAXisActive = false;
	setAJAXindicatorOn(false);
	writeConsole("onAJAXcompleted: " + AJAXfct)
	if (success) {
		switch (AJAXfct) {
            case "GetSessionVariables":
                if (AJAXobj.retAdmin == "Y") {
                    $("#sessvardiv").html(AJAXobj.retData);
                    $(".admin-only").removeClass("d-none");
                    $("#btn_refresh_sessvars").click(function(){
                        callAJAX("GetSessionVariables");
                    });  

				$("#sessvalfltr").on("keyup", function() {
					var value = $(this).val().toLowerCase();
					$("#sessvars tr").filter(function() {
					  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
					});
				  });

                } 
                break;
			case "Logout":
				$(".logged-in-only, .admin-only").addClass("d-none");
				checkLoginStatus();
				break;
			case "attemptLogin":
				$(".logged-in-only").removeClass("d-none");
				if (remember_me) {
					saveLocalStorage("email_address", email_address, debug);			
					saveLocalStorage("password", password, debug);			
									
				}
				emulateSuccessfulLogin();	
				break;
			case "checkLoginStatus":
				isLoggedIn = (AJAXobj.retMsg == "LoggedIn");
				if (isLoggedIn) {
					$(".logged-in-only").removeClass("d-none");
				} else {
					email_address = getLocalStorage("email_address", "", debug);
					if (email_address > ""){
						password = getLocalStorage("password", "", debug);
						$("#pal_email_address").val(email_address);
						$("#pal_password").val(password);
					}
					showLoginControl();

				}
                if (login_status_checks < 1) {
                    if (isLoggedIn) {
                        emulateSuccessfulLogin();
                    }
                }
                login_status_checks ++;
				break;
			
		}
	} else {
		

		switch(AJAXfct){
			case "attemptLogin":
			case "Logout":
				showLoginControl();
				break;
			default:
				var showMsg = (errorMsg > "") ? errorMsg : AJAXobj.retMsg;
				showModalDialog("AJAX "+AJAXfct+" failed", showMsg);
		}
	}
    if (aAJAXqueue.length > 0) {
        dequeueAJAX(); // execute next AJAX from the queue
    }
	
}
function showLoginControl(){
	if (!isLoginCtrlVisible()) {
		$('#login_modal').modal('show');
	}	
}
function isLoginCtrlVisible(){
	return $('#login_modal').hasClass('show');
}

function emulateSuccessfulLogin(){
    if (AJAXobj.retAdmin == "Y") {
        queueAJAX("GetUserListAdminTable");
        queueAJAX("GetSessionVariables", "");
		$(".admin-only").removeClass("d-none");
    }else {
         $(".admin-only").addClass("d-none");
    }
    
}



function callAJAX(fct, parms = "") {
	if (!AJAXisActive) {
		AJAXisActive = true;
		setAJAXindicatorOn(true);
		AJAXfct = fct;
		aParms = "fct=" + AJAXfct + parms;
		writeConsole("callAJAX: " + aParms)
		$.ajax({
			type: 'POST',
			url: 'AJAXspa.php',
			data: aParms,
			cache: false,
			success: function(data) {
				AJAXobj = $.parseJSON(data);
				if (AJAXobj.retCode == 'OK') {
					onAJAXcompleted(true);
				} else {
					onAJAXcompleted(false);
				}
			},
			error: function(httpReq, txtStatus, errorMsg){
			   onAJAXcompleted(false, txtStatus + "; " + errorMsg);
			}
		});			
	} else {
		//showModalDialog("AJAX already active", "This is an unusual error.  Problem bad coding");
		$(".ajax_indicator").removeClass("text-secondary text-warning").addClass("text-danger");
	}
	
}
function queueAJAX(fct, parms = ""){
	/*
	Only queue it if it is not already queued
	*/
	var fct_sig = fct+"|"+parms;
	if (!aAJAXqueue.includes(fct_sig)) {
		aAJAXqueue.push(fct_sig);
        writeConsole("queueAJAX: " + fct);     
	}
    
}
function dequeueAJAX(){

    if (aAJAXqueue.length > 0) {
        var nextAJAX = aAJAXqueue.shift(); 
        var aJAXsplit = nextAJAX.split("|");
        writeConsole("dequeueAJAX: " + aJAXsplit[0]);   
        callAJAX(aJAXsplit[0], aJAXsplit[1]);
    }
    
}
function writeConsole(msg, type = "log"){
	if (debug) {
		switch(type){
			case "log":
				console.log(msg);
				break;
			case "warn":
				console.warn(msg);
				break;			
			case "info":
				console.info(msg);
				break;
			case "error":
				console.error(msg);
				break;							
		}

		
	}
}

timerIsActive = false;
timerInterval = 0;
timerIntervalMS = 10 * 1000;   // 5 * 1000 is 5 seconds
jsDate = new Date();
prevPollTime = jsDate.getTime();
military_time = false;
function setAJAXindicatorOn(isOn = false) {
	if (isOn) {
		$(".ajax_indicator").removeClass("text-secondary text-danger").addClass("text-warning");
	} else {
		$(".ajax_indicator").removeClass("text-danger text-warning").addClass("text-secondary");
	}
}
function startInterval(){
	timerIsActive = true;
	timerInterval = setInterval(timerEvent, timerIntervalMS); 
}
function stopInterval(){
	timerIsActive = false;
	clearInterval(timerInterval);
}	
function timerEvent(){
	jsDate = new Date();
	var hhmm = getTimeFromJSdate(jsDate, military_time);
	$("#head_time").html(hhmm);
	if ((!document_loading) && (!isLoginCtrlVisible()) ) {
        var cb_autorefresh = $("#cb_autorefresh").prop("checked");
        if (cb_autorefresh) {
            if (lastScoreUpdated > "") {
                 queueAJAX("GetGameInfo", "&updatedsince="+lastScoreUpdated);
                 dequeueAJAX();
            } else {
                checkLoginStatus();		
            }            
        }
	}
}
function getTimeFromJSdate(date, usemilitarytime = false){
    var pollTime = date.getTime();
	var diff = pollTime - prevPollTime;
	var secs = Math.floor(diff / 1000);
	var hour_24 = date.getHours();
	var hour = hour_24;
	var ampm = (hour > 11) ? "PM" : "AM";
	if (!usemilitarytime) {
		hour = (hour > 12) ? hour - 12 : hour;
	}
	var minute = date.getMinutes();
	var hhmm = padZero(hour)+":"+padZero(minute)+" "+ampm;
    return hhmm;
    
}
function padZero(nbr){
	return (nbr < 10) ? "0"+nbr : ""+nbr;
}

function openWin(sURL, nWidth, nHeight, sWinName, nTop, nLeft){
	var win_opts = 'scrollbars=no,menubar=no,height='+nHeight+',width='+nWidth+',left='+nLeft+'px,top='+nTop+'px,resizable=no,toolbar=no,location=no,status=no';
    window.open(sURL,sWinName,win_opts);
}