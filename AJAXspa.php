<?php
/*
This program will  provide AJAX services for spa (single page app)  (index.php)

http://localhost/imo/rgb.rgbgeek.org/bs4/occ/AJAXspa.php?fct=checkLoginStatus
http://localhost/imo/rgb.rgbgeek.org/bs4/occ/AJAXspa.php?fct=attemptLogin&emailaddr=foo&password=foo
http://localhost/imo/rgb.rgbgeek.org/bs4/occ/AJAXspa.php?fct=Logout


see http://localhost/imo/rgb.rgbgeek.org/bs4/pal/AJAXpal.php for examples

*/
require("../incl0_PHPinit_bs4.php");
$incl_nav = false;
$debug = true;
$pgm_title = "AJAXpal";
$bs4_path = "../"; 
require_once($bs4_path."incl0_DayTimeInit.php");
require_once($bs4_path."incl0_PHPfcts.php");
$myDBname = "globby";
$usePDOdbObj = true;
require($bs4_path."../inclMySQLdb.php");
require($bs4_path."incl0_BS4_functions.php");
$retCode = "ERROR";
$retMsg = "Undefined error";
$retData = "";
$retLastScoreUpdated = "";
$fctCallErrMsg = "";
if (!isset($_SESSION['SPA_logged_in_YN'])) {
    initializeSPAsessionVariables();
}

$SPA_user_id_logged_in = ($_SESSION['SPA_logged_in_YN'] == "Y");
$SPA_is_admin = ($_SESSION['SPA_is_admin'] == "Y"); 
$webadmin_local_override = ($local_access_ok || $SPA_is_admin);
$request_method_valid =  (($reqMethod == "POST") || $webadmin_local_override); // this is cool

if ((isset($_REQUEST["fct"])) && ($request_method_valid)) {
	$fct = $_REQUEST["fct"]; 
	switch ($fct) {
		case "GetSessionVariables":
            if ($webadmin_local_override) {
                $retCode = "OK";
                $retMsg = "Session Variables table returned";
				$fltrsection ='<form class="form-inline">'.
				                 '<div class="form-row">'.
									'<div class="col"><span id="btn_refresh_sessvars" class="btn btn-sm btn-outline-success">Refresh</span></div> '.
								    '<div class="col"><input id="sessvalfltr" maxwidth="10" class="form-control-sm" placeholder="filter on PAL"></div>'.
								  '</div>'.
								'</form>';
                $aColHeads = ['key/value'];
                $aTableRows = [['current_date_time<br><b>'. $curr_date_time.'</b>']];
                foreach ($_SESSION as $key=>$val){
                    $aTableRows[] = [$key.'<br><b>'.$val.'</b>'];
                }
                $retData = $fltrsection . getDivOverFlowCode(getTableCodeFromArray($aColHeads, $aTableRows, 'sessvars', ''),300);                    
            } else {
                $retMsg = "reserved for webmaster only";
            }        
            break;

		case "Logout":
			$retMsg = "Not logged in";	
            if ($SPA_user_id_logged_in) {
                $retMsg = "Logout successful.";	
                $_SESSION['SPA_logged_in_YN'] = "N";
                $retCode = "OK"; 
                if (UpdateUserLastActivity("Logout")) {
                   $retMsg .= "  UpdateUserLastActivity OK";
                }  
                initializeSPAsessionVariables();
            }
			break;		
		case "checkLoginStatus":
			$retCode = "OK";
            $retMsg = ($SPA_user_id_logged_in) ? "LoggedIn" : "";
            if ($SPA_user_id_logged_in) {
                //UpdateUserLastActivity("LoginStatus");        
            }
			break;
		case "attemptLogin":
			// this will vary by app.. see AJAXpal.php for example
			break;
		default :
			$retMsg = "unexpected function " . $fct;
	}
} else {
	$retMsg = "Undefined function or ".$reqMethod." not allowed in this context";
}
$colVals = array ();
$colVals["retCode"] = $retCode;
$colVals["retMsg"]  = $retMsg;
$colVals["retData"] = $retData;
$colVals["retAdmin"] = $_SESSION['SPA_is_admin'];
$retJSON = json_encode($colVals);
echo $retJSON;	
/*
PHP functions used by this AJAX application that serves the base app via jquery ajax calls
*/
function initializeSPAsessionVariables(){
	$_SESSION['SPA_logged_in_YN'] = "N";
    $_SESSION['SPA_logged_in_id'] = 0;  
    $_SESSION['SPA_active_game_ids'] = "";
    $_SESSION['SPA_active_team_ids'] = "";
    $_SESSION['SPA_active_team_names'] = "";    
    $_SESSION['SPA_is_admin'] = "";     
    $_SESSION['SPA_sql_GetUserTeamsGames'] = "";     
    $_SESSION['SPA_sql_GetUserGames'] = "";     
    $_SESSION['SPA_sql_issue'] = "";     
}

?>
