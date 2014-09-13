function preinit() {
	// Initialize
	tinyMCE.setWindowArg('mce_windowresize', false);
	tinyMCE.setWindowArg('mce_replacevariables', false);
}

function changeClass() {
	var formObj = document.forms[0];
	formObj.classes.value = getSelectValue(formObj, 'classlist');
}

function init() {
	tinyMCEPopup.resizeToInnerSize();

	var formObj = document.forms[0];
	var inst = tinyMCE.getInstanceById(tinyMCE.getWindowArg('editor_id'));
	var elm = inst.getFocusElement();
	var action = "insert";
	var html;
	
	var uploadForm = document.getElementById('uploadForm');
    if(uploadForm) uploadForm.target = 'fileManager';

	elm = tinyMCE.getParentElement(elm, "a");
	if (elm != null && elm.nodeName == "A")
		action = "update";

	formObj.insert.value = tinyMCE.getLang('lang_' + action, 'Insert', true);
	
    var path = '';
    var file = '';

	if (action == "update") {
		var href = tinyMCE.getAttrib(elm, 'href');
		
		var child = ( elm.childNodes );
		for ( var i = 0; i < child.length; i++ ) {
            if ( child[i].tagName == 'IMG' ) {
                formObj.icon.checked = true;
            }
            if ( child[i].tagName == 'SPAN' && child[i].id == 'fm_date' ) {
                    formObj.date.checked = true;
            }
            if ( child[i].tagName == 'SPAN' && child[i].id == 'fm_size' ) {
                    formObj.size.checked = true;
            }
        }
		// Fix for drag-drop/copy paste bug in Mozilla
		mceRealHref = tinyMCE.getAttrib(elm, 'mce_real_href');
		if (mceRealHref != "")
			href = mceRealHref;

		href = convertURL(href, elm, true);

        var dir = href.replace( base_url, '', 'g' );
        var path_parts = dir.split('/');
        path_parts.pop();
        path = path_parts.join('/');
        file = dir.replace( path, '', 'g' );

        // Setup form data
		formObj.href.value = href;
        formObj.title.value = tinyMCE.getAttrib(elm, 'title');
        formObj.target.value = tinyMCE.getAttrib(elm, 'target');

		selectByValue(formObj, 'targetlist', tinyMCE.getAttrib(elm, 'target'), true);
	}
	window.setTimeout('createFileIFrame("' + path + '","' + file + '");', 10);
	window.focus();
}
function convertURL(url, node, on_save) {
	return eval("tinyMCEPopup.windowOpener." + tinyMCE.settings['urlconverter_callback'] + "(url, node, on_save);");
}

function parseFunction(onclick) {
	var formObj = document.forms[0];
	var onClickData = parseLink(onclick);

	// TODO: Add stuff here
}

function getOption(opts, name) {
	return typeof(opts[name]) == "undefined" ? "" : opts[name];
}

function setAttrib(elm, attrib, value) {
	var formObj = document.forms[0];
	var valueElm = formObj.elements[attrib.toLowerCase()];

	if (typeof(value) == "undefined" || value == null) {
		value = "";

		if (valueElm)
			value = valueElm.value;
	}

	if (value != "") {
		elm.setAttribute(attrib.toLowerCase(), value);

		if (attrib == "href")
			elm.setAttribute("mce_real_href", value);

		if (attrib.substring(0, 2) == 'on')
			value = 'return true;' + value;

		eval('elm.' + attrib + "=value;");
	} else
		elm.removeAttribute(attrib);
}

function insertAction() {
    var inst = tinyMCE.getInstanceById(tinyMCE.getWindowArg('editor_id'));
	var elm = inst.getFocusElement();

	elm = tinyMCE.getParentElement(elm, "a");

	tinyMCEPopup.execCommand("mceBeginUndoLevel");
	
	var formObj = document.forms[0];
	var href = formObj.href.value;
	var title = formObj.title.value;
	var target = getSelectValue(formObj, 'targetlist');

	// Create new anchor elements
	if (elm == null) {
        var ext = getExtension( href );
        ext = ext.toLowerCase();
        
        var i_src = 'mambots/editors/jce/jscripts/tiny_mce/plugins/filemanager/images/ext/'+ext+'_small.gif';

        var size_span = '&nbsp;<span id="fm_size" style="font-size:80%">' + formObj.file_size.value + '</span>';
        var date_span = '&nbsp;<span id="fm_date" style="font-size:80%">' + formObj.file_date.value + '</span>';
        
                html = '';
                html += '<a href="'+href+'" id="fm_file" title="'+title+'" target="'+target+'">';
                if (formObj.icon.checked){
                    html += '<img src="' +i_src+ '" border="0" width="16" height="16" alt="'+ext+'" title="'+ext+'" />&nbsp;';
                }
                html +=''+title+'';
                if (formObj.date.checked){
                    html += date_span;
                }
                if (formObj.size.checked){
                  html += size_span;
                }
                html += '</a>';

                tinyMCE.execCommand("mceInsertContent",false,html);
	} else
		//setAllAttribs(elm);
        var ext = getExtension( href );
        ext = ext.toLowerCase();

        var i_src = 'mambots/editors/jce/jscripts/tiny_mce/plugins/filemanager/images/ext/'+ext+'_small.gif';

        var size_span = '&nbsp;<span id="fm_size" style="font-size:80%">' + formObj.file_size.value + '</span>';
        var date_span = '&nbsp;<span id="fm_date" style="font-size:80%">' + formObj.file_date.value + '</span>';

                html = '';
                html += '<a href="'+href+'" id="fm_file" title="'+title+'" target="'+target+'">';
                if (formObj.icon.checked){
                    html += '<img src="' +i_src+ '" border="0" width="16" height="16" alt="'+ext+'" title="'+ext+'" />&nbsp;';
                }
                html +=''+title+'';
                if (formObj.date.checked){
                    html += date_span;
                }
                if (formObj.size.checked){
                  html += size_span;
                }
                html += '</a>';
                
    tinyMCE.execCommand("mceReplaceContent",false,html);

	tinyMCEPopup.execCommand("mceEndUndoLevel");
	tinyMCEPopup.close();
}

function cancelAction()
{
    tinyMCEPopup.close();
}

function setAllAttribs(elm) {
	var formObj = document.forms[0];
	var href = formObj.href.value;
	var target = getSelectValue(formObj, 'targetlist');

	href = convertURL(href, elm);

	setAttrib(elm, 'href', href);
	setAttrib(elm, 'title');
	setAttrib(elm, 'target', target == '_self' ? '' : target);

	// Refresh in old MSIE
	if (tinyMCE.isMSIE5)
		elm.outerHTML = elm.outerHTML;
}

function getSelectValue(form_obj, field_name) {
	var elm = form_obj.elements[field_name];

	if (elm == null || elm.options == null)
		return "";

	return elm.options[elm.selectedIndex].value;
}

function createFileIFrame(dir, file) {
    dir = ( dir != '' ) ? '&dir='+dir : '';
    file = ( file != '' ) ? '&ret_file='+file : '';

    document.getElementById('fileContainer').innerHTML = '<iframe class="fileFrame" id="fileManager" name="fileManager" src="index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=files.php' + dir + file + '" frameborder="0"></iframe>';
}
function getSelectValue(form_obj, field_name) {
	var elm = form_obj.elements[field_name];

	if (elm == null || elm.options == null)
		return "";

	return elm.options[elm.selectedIndex].value;
}
function updateDir(selection)
{
    var formObj = document.forms[0];
    var newDir = getSelectValue(formObj, 'dirPath');
    if(typeof fileManager != 'undefined')
        fileManager.refreshDir(newDir);
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
    if(typeof fileManager != 'undefined')
        fileManager.changeDir(newDir);
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
    if (folder && folder != '' && typeof fileManager != 'undefined')
        fileManager.newFolder(dir, encodeURI(folder));
    hide( document, 'folderdlg' );
    document.getElementById('folder').value = '';
}
function openHelp() {
    var url = hostUrl+'/index2.php?option=com_jce&task=help&plugin=filemanager&file=help.php';
    w = 600;
    h = 500;

    openWin(url, w, h, 'yes', 'yes');
}
function viewFile()
{
    var formObj = document.forms[0];
    var dir = getSelectValue(formObj, 'dirPath')
    var file = document.getElementById('imgList').value;

    var url = base_url+file;
    w = 600;
    h = 500;
    openWin(url, w, h, 'yes', 'yes');
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
    fileManager.moveFile(file, dir, pasteAction);
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
                    fileManager.delFile(dir, file);
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
                        fileManager.delDir(dir, path);
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
        fileManager.renFile(dir, file, name);
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
        fileManager.renDir(dir, name, relative);
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
