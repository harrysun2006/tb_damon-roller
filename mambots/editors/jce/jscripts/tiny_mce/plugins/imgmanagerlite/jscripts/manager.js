function preinit() {
	// Initialize
	tinyMCE.setWindowArg('mce_windowresize', false);
	tinyMCE.setWindowArg('mce_replacevariables', false);
}

function convertURL(url, node, on_save) {
	return eval("tinyMCEPopup.windowOpener." + tinyMCE.settings['urlconverter_callback'] + "(url, node, on_save);");
}

function getImageSrc(str) {
	var pos = -1;

	if (!str)
		return "";

	if ((pos = str.indexOf('this.src=')) != -1) {
		var src = str.substring(pos + 10);

		src = src.substring(0, src.indexOf('\''));

		if (tinyMCE.getParam('convert_urls'))
			src = convertURL(src, null, true);

		return src;
	}

	return "";
}

function init() {
	tinyMCEPopup.resizeToInnerSize();

	var formObj = document.forms[0];
	var inst = tinyMCE.getInstanceById(tinyMCE.getWindowArg('editor_id'));
	var elm = inst.getFocusElement();
	var action = "insert";
	var html = "";
	
	var uploadForm = document.getElementById('uploadForm');
    if(uploadForm) uploadForm.target = 'imgManager';

	// Check action
	if (elm != null && elm.nodeName == "IMG")
		action = "update";
		
	formObj.insert.value = tinyMCE.getLang('lang_' + action, 'Insert', true);
    var path = '';
    var file = '';
    
    formObj.hspace.value = def_hspace;
    formObj.vspace.value = def_vspace;
    formObj.border.value = def_border;
    selectByValue(formObj, 'align', def_align);
    
	if (action == "update") {
		var src = tinyMCE.getAttrib(elm, 'src');
		var onmouseoversrc = getImageSrc(tinyMCE.cleanupEventStr(tinyMCE.getAttrib(elm, 'onmouseover')));
		var onmouseoutsrc = getImageSrc(tinyMCE.cleanupEventStr(tinyMCE.getAttrib(elm, 'onmouseout')));

		src = convertURL(src, elm, true);

		// Use mce_src if found
		var mceRealSrc = tinyMCE.getAttrib(elm, 'mce_src');
		if (mceRealSrc != "") {
			src = mceRealSrc;

			if (tinyMCE.getParam('convert_urls'))
				src = convertURL(src, elm, true);
		}
		if (onmouseoversrc != "" && tinyMCE.getParam('convert_urls'))
			onmouseoversrc = convertURL(onmouseoversrc, elm, true);

		if (onmouseoutsrc != "" && tinyMCE.getParam('convert_urls'))
			onmouseoutsrc = convertURL(onmouseoutsrc, elm, true);

		// Setup form data
		var style = tinyMCE.parseStyle(tinyMCE.getAttrib(elm, "style"));

		formObj.src.value    = src;
		formObj.alt.value    = tinyMCE.getAttrib(elm, 'alt');
		formObj.title.value  = tinyMCE.getAttrib(elm, 'title');
		formObj.border.value = trimSize(getStyle(elm, 'border', 'borderWidth'));
		formObj.vspace.value = tinyMCE.getAttrib(elm, 'vspace');
		formObj.hspace.value = tinyMCE.getAttrib(elm, 'hspace');
		formObj.width.value  = trimSize(getStyle(elm, 'width'));
		formObj.height.value = trimSize(getStyle(elm, 'height'));
		formObj.tmp_width.value  = trimSize(getStyle(elm, 'width'));
		formObj.tmp_height.value = trimSize(getStyle(elm, 'height'));
		formObj.onmouseoversrc.value = onmouseoversrc;
		formObj.onmouseoutsrc.value  = onmouseoutsrc;
		formObj.id.value  = tinyMCE.getAttrib(elm, 'id');
		formObj.dir.value  = tinyMCE.getAttrib(elm, 'dir');
		formObj.lang.value  = tinyMCE.getAttrib(elm, 'lang');
		formObj.longdesc.value  = tinyMCE.getAttrib(elm, 'longdesc');
		formObj.usemap.value  = tinyMCE.getAttrib(elm, 'usemap');
        var style_val = tinyMCE.serializeStyle(style);
		
		// Select by the values
		if (tinyMCE.isMSIE)
			selectByValue(formObj, 'align', getStyle(elm, 'align', 'styleFloat'));
		else
			selectByValue(formObj, 'align', getStyle(elm, 'align', 'cssFloat'));

		addClassesToList('classlist', 'advimage_styles');

		selectByValue(formObj, 'classlist', tinyMCE.getAttrib(elm, 'class'));

		updateStyle();

		var dir = src.replace( base_url, '', 'g' );
        var path_parts = dir.split('/');
        path_parts.pop();
        path = path_parts.join('/');
        file = dir.replace( path, '', 'g' );

		window.focus();
	} else
		addClassesToList('classlist', 'advimage_styles');

	// Check swap image if valid data
	if (formObj.onmouseoversrc.value != "" || formObj.onmouseoutsrc.value != "")
		setSwapImageDisabled(false);
	else
		setSwapImageDisabled(true);
		
    window.setTimeout('createFileIFrame("' + path + '","' + file + '");', 10);
}
function getOption(opts, name) {
	return typeof(opts[name]) == "undefined" ? "" : opts[name];
}
function parseOptions(opts) {
	if (opts == null || opts == "")
		return new Array();

	// Cleanup the options
	opts = opts.toLowerCase();
	opts = opts.replace(/;/g, ",");
	opts = opts.replace(/[^0-9a-z=,]/g, "");

	var optionChunks = opts.split(',');
	var options = new Array();

	for (var i=0; i<optionChunks.length; i++) {
		var parts = optionChunks[i].split('=');

		if (parts.length == 2)
			options[parts[0]] = parts[1];
	}

	return options;
}
function setSwapImageDisabled(state) {
	var formObj = document.forms[0];

	formObj.onmousemovecheck.checked = !state;

	formObj.onmouseoversrc.disabled = state;
	formObj.onmouseoutsrc.disabled  = state;
}

function setAttrib(elm, attrib, value) {
	var formObj = document.forms[0];
	var valueElm = formObj.elements[attrib];

	if (typeof(value) == "undefined" || value == null) {
		value = "";

		if (valueElm)
			value = valueElm.value;
	}

	if (value != "") {
		elm.setAttribute(attrib, value);

		if (attrib == "style")
			attrib = "style.cssText";

		if (attrib == "longdesc")
			attrib = "longDesc";

		if (attrib == "width") {
			attrib = "style.width";
			value = value + "px";
		}

		if (attrib == "height") {
			attrib = "style.height";
			value = value + "px";
		}

		if (attrib == "class")
			attrib = "className";

		eval('elm.' + attrib + "=value;");
	} else
		elm.removeAttribute(attrib);
}

function makeAttrib(attrib, value) {
	var formObj = document.forms[0];
	var valueElm = formObj.elements[attrib];

	if (typeof(value) == "undefined" || value == null) {
		value = "";

		if (valueElm)
			value = valueElm.value;
	}

	if (value == "")
		return "";

	// XML encode it
	value = value.replace(/&/g, '&amp;');
	value = value.replace(/\"/g, '&quot;');
	value = value.replace(/</g, '&lt;');
	value = value.replace(/>/g, '&gr;');
	
	return ' ' + attrib + '="' + value + '"';
}

function insertAction() {
	var inst = tinyMCE.getInstanceById(tinyMCE.getWindowArg('editor_id'));
	var elm = inst.getFocusElement();
	var formObj = document.forms[0];
	var src = formObj.src.value;
	var onmouseoversrc = formObj.onmouseoversrc.value;
	var onmouseoutsrc = formObj.onmouseoutsrc.value;

    if(src == ""){
        alert(lang['no_src']);
        return;
    }

    if (tinyMCE.getParam("accessibility_warnings")) {
		if (formObj.alt.value == "") {
			if (confirm(lang['missing_alt'])) {
				formObj.alt.value = " ";
			}else{
                return;
            }
		}
	}
	
    if( formObj.onmousemovecheck.checked ){
        if (onmouseoversrc && onmouseoversrc != "")
  		    onmouseoversrc = "this.src='" + convertURL(onmouseoversrc, tinyMCE.imgElement) + "';";

    	if (onmouseoutsrc && onmouseoutsrc != "")
    		onmouseoutsrc = "this.src='" + convertURL(onmouseoutsrc, tinyMCE.imgElement) + "';";
    }else{
        onmouseoversrc = '';
        onmouseoutsrc = '';
    }

    if (elm != null && elm.nodeName == "IMG") {
		setAttrib(elm, 'src', convertURL(src, tinyMCE.imgElement));
		setAttrib(elm, 'mce_src', src);
		setAttrib(elm, 'alt');
		setAttrib(elm, 'title');
		setAttrib(elm, 'border');
		setAttrib(elm, 'vspace');
		setAttrib(elm, 'hspace');
		setAttrib(elm, 'width');
		setAttrib(elm, 'height');
		setAttrib(elm, 'onmouseover', onmouseoversrc);
		setAttrib(elm, 'onmouseout', onmouseoutsrc);
		setAttrib(elm, 'id');
		setAttrib(elm, 'dir');
		setAttrib(elm, 'lang');
		setAttrib(elm, 'longdesc');
		setAttrib(elm, 'usemap');
		setAttrib(elm, 'style');
		setAttrib(elm, 'class', getSelectValue(formObj, 'classlist'));
		setAttrib(elm, 'align', getSelectValue(formObj, 'align'));

		// Refresh in old MSIE
		if (tinyMCE.isMSIE5)
			elm.outerHTML = elm.outerHTML;
	} else {
        var html = "";
        html += "<img";
		html += makeAttrib('src', convertURL(src, tinyMCE.imgElement));
		html += makeAttrib('mce_src', src);
		html += makeAttrib('alt');
		html += makeAttrib('title');
		html += makeAttrib('border');
		html += makeAttrib('vspace');
		html += makeAttrib('hspace');
		html += makeAttrib('width');
		html += makeAttrib('height');
		html += makeAttrib('onmouseover', onmouseoversrc);
		html += makeAttrib('onmouseout', onmouseoutsrc);
		html += makeAttrib('id');
		html += makeAttrib('dir');
		html += makeAttrib('lang');
		html += makeAttrib('longdesc');
		html += makeAttrib('usemap');
		html += makeAttrib('style');
		html += makeAttrib('class', getSelectValue(formObj, 'classlist'));
		html += makeAttrib('align', getSelectValue(formObj, 'align'));
		html += " />";

		tinyMCEPopup.execCommand("mceInsertContent", false, html);
	}

	tinyMCE._setEventsEnabled(inst.getBody(), false);
	tinyMCEPopup.close();
}

function cancelAction() {
	tinyMCEPopup.close();
}

function changeMouseMove() {
	var formObj = document.forms[0];

	setSwapImageDisabled(!formObj.onmousemovecheck.checked);
}

function updateStyle() {
	var formObj = document.forms[0];
	var st = tinyMCE.parseStyle(formObj.style.value);

	if (tinyMCE.getParam('inline_styles', false)) {
		st['width'] = formObj.width.value == '' ? '' : formObj.width.value + "px";
		st['height'] = formObj.height.value == '' ? '' : formObj.height.value + "px";
		st['border-width'] = formObj.border.value == '' ? '' : formObj.border.value + "px";
		st['margin-top'] = formObj.vspace.value == '' ? '' : formObj.vspace.value + "px";
		st['margin-bottom'] = formObj.vspace.value == '' ? '' : formObj.vspace.value + "px";
		st['margin-left'] = formObj.hspace.value == '' ? '' : formObj.hspace.value + "px";
		st['margin-right'] = formObj.hspace.value == '' ? '' : formObj.hspace.value + "px";
	} else {
		st['width'] = st['height'] = st['border-width'] = null;

		if (st['margin-top'] == st['margin-bottom'])
			st['margin-top'] = st['margin-bottom'] = null;

		if (st['margin-left'] == st['margin-right'])
			st['margin-left'] = st['margin-right'] = null;
	}

	formObj.style.value = tinyMCE.serializeStyle(st);
}

function styleUpdated() {
	var formObj = document.forms[0];
	var st = tinyMCE.parseStyle(formObj.style.value);

	if (st['width'])
		formObj.width.value = st['width'].replace('px', '');

	if (st['height'])
		formObj.height.value = st['height'].replace('px', '');

	if (st['margin-top'] && st['margin-top'] == st['margin-bottom'])
		formObj.vspace.value = st['margin-top'].replace('px', '');

	if (st['margin-left'] && st['margin-left'] == st['margin-right'])
		formObj.hspace.value = st['margin-left'].replace('px', '');

	if (st['border-width'])
		formObj.border.value = st['border-width'].replace('px', '');
}

function changeHeight() {
	var formObj = document.forms[0];

    if( !formObj.constrain.checked )
        return;

    if (formObj.width.value == "" || formObj.height.value == "")
		return;

	var temp = (formObj.width.value / formObj.tmp_width.value) *formObj.tmp_height.value;
	formObj.height.value = temp.toFixed(0);
}

function changeWidth() {
	var formObj = document.forms[0];

    if( !formObj.constrain.checked )
        return;

    if (formObj.width.value == "" || formObj.height.value == "")
		return;

	var temp = (formObj.height.value / formObj.tmp_height.value) * formObj.tmp_width.value;
	formObj.width.value = temp.toFixed(0);
}

function resetImageData() {
	var formObj = document.forms[0];
	formObj.width.value = formObj.height.value = "";
}
function createFileIFrame(dir, file) {
    dir = ( dir != '' ) ? '&dir='+dir : '';
    file = ( file != '' ) ? '&ret_file='+file : '';

    document.getElementById('fileContainer').innerHTML = '<iframe class="fileFrame" id="imgManager" name="imgManager" src="index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanagerlite&file=images.php' + dir + file + '" frameborder="0"></iframe>';
}
function updateDir(selection)
{
    var formObj = document.forms[0];
    var newDir = getSelectValue(formObj, 'dirPath');
    if(typeof imgManager != 'undefined')
        imgManager.refreshDir(newDir);
}
function goUpDir()
{
    var formObj = document.forms[0];
    var currentDir = getSelectValue(formObj, 'dirPath');
    if(currentDir.length < 2)
        return false;
    var dirs = currentDir.split('%2F');
    var search = '';
    for(var i = 0; i < dirs.length-1; i++)
    {
        search += dirs[i]+'/';
    }
    search = search.substr(0, search.length-1);
    changeDir(search);
}
function changeDir(newDir)
{
    if(typeof imgManager != 'undefined')
        imgManager.changeDir(newDir);
}
function checkUpload(val, other)
{
    var first = document.getElementById(val);
    var second = document.getElementById(other);

    if( first.checked ){
        first.value = true;
        second.checked = false;
        second.value = false;
    }
    if( first.checked == false )
        first.value = false;
    if(second.checked == false)
        second.value = false;
}
function doUpload()
{
    var uploadForm = document.getElementById('uploadForm');
    if(uploadForm){
        showMessage(document, 'Uploading', 'load', 'msg');
        hide( document, 'uploaddlg' );
    }
}
function newFolder()
{
    var formObj = document.forms[0];
    var dir = getSelectValue(formObj, 'dirPath');
    var newfolder = document.getElementById('folderdlg');

    var folder = document.getElementById('folder').value;
    if (folder && folder != '' && typeof imgManager != 'undefined')
        imgManager.newFolder(dir, encodeURI(folder));
    hide( document, 'folderdlg' );
    document.getElementById('folder').value = '';
}
function openHelp() {
    var url = hostUrl+'/index2.php?option=com_jce&task=help&plugin=imgmanagerlite&file=help.php';
    w = 600;
    h = 500;

    openWin(url, w, h, 'no', 'yes');
}
function viewImage()
{
    var img = base_url+document.getElementById('imgList').value;
    var name = document.getElementById('info1Val').value;
    var dim = document.getElementById('info3Val').value;
    dim = dim.split(',');
    var width = dim[0];
    var height = dim[1];
    var size = document.getElementById('info4Val').value;

    var template = new Array();
    var url = hostUrl+'/index2.php?option=com_jce&task=plugin&plugin=imgmanagerlite&file=view.php&img=' + img + '&a=' + name + '&w=' + width + '&h=' + height;
    w = parseInt(width);
    h = parseInt(height);
    openWin(url, w, h, 'yes', 'no');
}
function refreshAction()
{
	var selection = document.getElementById('dirPath');
    updateDir(selection);
}
function showUpload() {
    showDlg(document, 'uploaddlg');
}
function showRenameFile(file, name)
{
    if(document.getElementById('renfiledlg').className == "hide")
    {
        document.getElementById('newfilename').value = '';
        document.getElementById('oldfilename').value = '';
    }else{
        if(document.getElementById('renfiledlg').className == "show"){
            document.getElementById('newfilename').value = name;
            document.getElementById('oldfilename').value = file;
        }
    }
}
function showRenameDir(name, path)
{
    if(document.getElementById('rendirdlg').className == "hide")
    {
        document.getElementById('newdirname').value = '';
        document.getElementById('dirpath').value = '';
    }else{
        if(document.getElementById('rendirdlg').className == "show"){
            document.getElementById('newdirname').value = name;
            document.getElementById('dirpath').value = path;
        }
    }
}
function copyFile()
{
    var formObj = document.forms[0];
    var dir = getSelectValue(formObj, 'dirPath');
    var file = document.getElementById('imgList').value;
    document.getElementById('clipboard').value = file;
    show( document, 'pasteImg' );
    pasteAction = 'copy';
    source_dir = dir;
}
function cutFile()
{
    var formObj = document.forms[0];
    var dir = getSelectValue(formObj, 'dirPath');
    var file = document.getElementById('imgList').value;
    document.getElementById('clipboard').value = file;
    show( document, 'pasteImg' );
    pasteAction = 'cut';
    source_dir = dir;
}
function pasteFile()
{
    var formObj = document.forms[0];
    var dir = getSelectValue(formObj, 'dirPath');
    var file = document.getElementById('clipboard').value;
    imgManager.moveFile(file, dir, pasteAction);
    document.getElementById('clipboard').value = '';
    hide( document, 'pasteImg' );
}
function fileAction(action, opt)
{
    var formObj = document.forms[0];
    var dir = getSelectValue(formObj, 'dirPath');
    var mode = document.getElementById('viewMode').value;
    var file = document.getElementById('imgList').value;
    var path = document.getElementById('dirList').value;
    var pasteAction = 'copy';

    switch (opt){
        case 'file' :
        switch (action){
            case 'delete' :
                if(confirmAction(lang['delete_file_alert'])) {
                    imgManager.delFile(dir, file);
                    return true;
                }
                return false;
            break;
            case 'rename' :
                var name = document.getElementById('info1Val').value;
                showDlg(document, 'renfiledlg');
                showRenameFile(file, name);
            break;
        }
        break;
        case 'folder' :
            switch (action){
                case 'delete' :
                    if(confirmAction(lang['delete_folder_alert'])) {
                        imgManager.delDir(dir, path);
                        return true;
                    }
                    return false;
                break;
                case 'rename' :
                    var name = document.getElementById('info1Val').value;
                    showDlg(document, 'rendirdlg');
                    showRenameDir(name, path);
                break;
            }
        break;
    }
}
function renFile()
{
    var formObj = document.forms[0];
    var dir = getSelectValue(formObj, 'dirPath');
    var file = document.getElementById('oldfilename').value;
    var name = document.getElementById('newfilename').value;

    if(confirmAction(lang['rename_alert'])) {
        imgManager.renFile(dir, file, name);
    }else{
        return false;
    }
}
function renDir()
{
    var formObj = document.forms[0];
    var dir = getSelectValue(formObj, 'dirPath');
    var name = document.getElementById('newdirname').value;
    var relative = document.getElementById('dirpath').value;

    if(confirmAction(lang['rename_alert'])) {
        imgManager.renDir(dir, name, relative);
    }else{
        return false;
    }
}
function confirmAction(action) {
    if(confirm(action)) {
        return true;
    }
    return false;
}
// While loading
preinit();
