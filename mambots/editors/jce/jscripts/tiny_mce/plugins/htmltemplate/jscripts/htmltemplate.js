function saveContent() {
	var html = document.getElementById("frmData").contentWindow.document.body.innerHTML;

	if (html == ''){
		tinyMCEPopup.close();
		return false;
	}
    tinyMCEPopup.execCommand('mceInsertContent', false, html);
    tinyMCEPopup.close();
}

function onLoadInit() {
	tinyMCEPopup.resizeToInnerSize();

	// Fix for endless reloading in FF
	window.setTimeout('createIFrame();', 10);
}

function createIFrame() {
	document.getElementById('iframecontainer').innerHTML = '<iframe id="frmData" name="frmData" class="sourceIframe" src="'+html_path+'/blank.htm" height="280" width="400" frameborder="0" style="background-color:#FFFFFF; width:100%;" dir="ltr" wrap="soft"></iframe>';
}

function initIframe(doc) {
	var dir = tinyMCE.selectedInstance.settings['directionality'];
	doc.body.dir = dir;
}
function selectTmpl(option)
{
    var tplsrc = tmpl_path+option;
    document.getElementById('frmData').src = tplsrc;
}
function resizeInputs() {
	if (!tinyMCE.isMSIE) {
		wHeight = self.innerHeight - 80;
		wWidth = self.innerWidth - 18;
	} else {
		wHeight = document.body.clientHeight - 80;
		wWidth = document.body.clientWidth - 18;
	}

	document.getElementById('frmData').style.height = Math.abs(wHeight) + 'px';
	document.getElementById('frmData').style.width  = Math.abs(wWidth) + 'px';
}