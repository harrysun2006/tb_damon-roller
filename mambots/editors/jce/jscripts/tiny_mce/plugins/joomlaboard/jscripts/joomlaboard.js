function init() {
	//tinyMCEPopup.resizeToInnerSize();
}

function insertAction() {
    var formObj = document.forms[0];
    var catid = getSelectValue(document.forms[0], 'catid');
	if(catid == ''){
		alert(tinyMCE.getLang('lang_joomlaboard_alert', '', false));
	}else{
    	var html = '{mos_sb_discuss:'+ catid +'}';
		tinyMCEPopup.execCommand("mceInsertContent", true, html);
		tinyMCEPopup.close();
	}
}
function cancelAction(){
	tinyMCEPopup.close();
}
