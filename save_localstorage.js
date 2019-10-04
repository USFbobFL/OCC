/*
local_storage_prefix should be defined as a global variable in any app that includes this js
*/
function saveLocalStorage(key, value, debug=false){
	if (typeof(Storage) !== "undefined") {
		var full_key = local_storage_prefix+key;
		localStorage.setItem(full_key, value);
		if (debug){
			 console.log("saveLocalStorage: key ["+full_key+"]"+", value ["+value+"]");
		}
	} 
}  
function getLocalStorage(key, defalut_val = "", debug=false){
	
	var retVal = "";
	if (typeof(Storage) !== "undefined") {
		var full_key = local_storage_prefix+key;
		var getType = typeof(localStorage.getItem(full_key));
		//debugger;
		if(getType=='undefined'){
			retVal = defalut_val;
		} else {
			retVal = localStorage.getItem(full_key);
			if (retVal==null){
				retVal = defalut_val;
			}
		}
	} 
	if (debug){
		 console.log("getLocalStorage: key ["+full_key+"]"+", value ["+retVal+"]");
	}			
	return retVal; 
}