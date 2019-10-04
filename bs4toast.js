/*
bs4toast.js

has a dependency of getTimeFromJSdate function
*/

function bs4_toast_info(message){
    bs4toast("toast_info", "Information", message, true, 3000, textClass = "info", "fas fa-info-circle");
}
toast_container_parent_id = "page_container";
toast_container_div_id = "toast_container";
function bs4toast(id, header, body, showtime = false, delayMS = 2000, textClass = "primary", fasicon = "fas fa-exclamation-triangle"){
    /*
    A container is used in the event that we'll have multiple toasts appearing simultaneously
    */
    if (!$('#'+toast_container_div_id).length){
        var toast_container_create = ''+
         '<div id="'+toast_container_div_id+'" style="position: absolute; top: 70; right: 10;min-height:200px;z-index:999;"></div>';
        /* for now, we'll just append this to the body.. later, may consider the page container */
        $("#"+toast_container_parent_id).prepend(toast_container_create);
    }
    /*
    create the toast message div, then append it to the toast_container_div_id
    */
    var the_time = (showtime) ? getTimeFromJSdate(new Date()) : ""; // later, we'll get the current time instead of hard-coding
    var new_toast_div = ''+
    '<div id="'+ id + '" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="'+delayMS+'">'+
      '<div class="toast-header bg-'+textClass+' text-white">'+
        '<i class="' + fasicon + '"></i> '+
        '<strong class="mr-auto">' + header + '</strong>'+
        '<small>' + the_time + '</small>'+
        '<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">'+
         ' <span aria-hidden="true">&times;</span>'+
        '</button>'+
      '</div>'+
      '<div class="toast-body">'+ body + '</div>'+
    '</div>';
    $('#'+toast_container_div_id).append(new_toast_div);
    $('#'+id).toast("show");
    $('#'+id).on('hidden.bs.toast', function () {
        var thisid = $(this).attr("id");
       $('#'+thisid).toast('dispose'); // remove it from the DOM
       //console.log("toast id "+thisid+" dispose event");
    })  
}