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
    document.getElementById('viewMode').value = frame_mode;

    switch(frame_mode){
        case 'images' :
            document.getElementById('modeImg').src = im_url+"/images/list.gif";
            document.getElementById('modeImg').alt = lang['toggle_list'];
            document.getElementById('modeImg').title = lang['toggle_list'];
        break;
        case 'list' :
            document.getElementById('modeImg').src = im_url+"/images/images.gif";
            document.getElementById('modeImg').alt = lang['toggle_image'];
            document.getElementById('modeImg').title = lang['toggle_image'];
        break;
    }

	// Check action
	var linkelm = tinyMCE.getParentElement(elm, "a");
	if (elm != null && elm.nodeName == "IMG")
		action = "update";
		
    if(tinyMCE.getAttrib(linkelm, 'href') != hostUrl+'/index2.php?option=com_jce&task=popup'){
        var oldpop = true;
    }

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
		if(oldpop){
            var onclick = tinyMCE.getAttrib(linkelm, 'href');
        }else{
            var onclick = tinyMCE.cleanupEventStr(tinyMCE.getAttrib(linkelm, 'onclick'));
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
		
        // Parse onclick data
        if(oldpop){
            if (onclick != null && onclick.indexOf('javascript:void%20window.open') != -1)
                parseOldWindowOpen(onclick);
        }else{
            if (onclick != null && onclick.indexOf('window.open') != -1)
                parseWindowOpen(onclick);
        }

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
function parseWindowOpen(onclick) {
	var formObj = document.forms[0];
	
	var opt = onclick.split("&");
	var items = new Array();
	for(var i=0; i<opt.length; i++)
	{
        items[i] = opt[i].substring( opt[i].indexOf( '=' ) +1, opt[i].length );
    }

	if (onclick != null) {
		formObj.popup_check.checked = true;

		formObj.popup_title.value = items[2].replace('_', ' ', 'gi');
		var popup_src = items[1];
		formObj.popup_width.value = items[3];
		formObj.popup_height.value = items[4];
		formObj.popup_tmp_width.value = items[3];
		formObj.popup_tmp_height.value = items[4];

		if( popup_src.indexOf('http') != 0 ){
            popup_src = hostUrl+'/'+popup_src;
        }
        formObj.popup_src.value = popup_src;
		selectByValue(formObj, 'popup_mode', items[5], '');
		formObj.popup_print.checked = ( parseInt(items[6]) == 1 ) ? true : false;
        formObj.popup_right_click.checked = ( parseInt(items[7].charAt(0)) == 1 ) ? true : false;
	}
}
function parseOldWindowOpen(onclick) {
	var formObj = document.forms[0];

	if (onclick != null) {
		formObj.popup_check.checked = true;

		var opt = onclick.split(',');
        if (opt[0]!='') // link , url

        leftstr = opt[0].replace("'","","gi");
        leftstr = leftstr.substring( leftstr.indexOf( '?' ) +1);
        leftstr = leftstr.substring( leftstr.indexOf( '=' ) +1, leftstr.length );
        rightstr = leftstr.split('&');

        printstr = rightstr[5].replace('print=', '', 'g');
        
		formObj.popup_title.value = rightstr[1].replace('title=', '', 'g');
		var popup_src = rightstr[0];
		formObj.popup_width.value = rightstr[3].replace('imgwidth=', '', 'g');
		formObj.popup_height.value = rightstr[4].replace('imgheight=', '', 'g');
		formObj.popup_tmp_width.value = rightstr[3].replace('imgwidth=', '', 'g');
		formObj.popup_tmp_height.value = rightstr[4].replace('imgheight=', '', 'g');

		if( popup_src.indexOf('http://') != 0 || popup_src.indexOf('https://') != 0 ) popup_src = hostUrl+'/'+popup_src;
		formObj.popup_src.value = popup_src;
		var mode = rightstr[2].replace('mode=', '', 'g');

        selectByValue(formObj, 'popup_mode', mode, '');
		formObj.popup_print.checked = ( printstr == '1' ) ? true : false;
	}
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
		
    //Build onclick
    var popup_image         = formObj.popup_src.value;
    var popup_title         = formObj.popup_title.value;
    var popup_mode          = getSelectValue(formObj, 'popup_mode');
    var popup_width         = formObj.popup_width.value;
    var popup_height        = formObj.popup_height.value;
    var popup_print         = (formObj.popup_print.checked) ? '1' : '0';
    var popup_right_click   = (formObj.popup_right_click.checked) ? '1' : '0';

    if( popup_image.indexOf(hostUrl) == 0 ){
        popup_image = popup_image.replace( hostUrl+'/', '', 'g' );
    }

    popup_title = popup_title.replace(' ', '_', 'gi');

    var winl = (screen.width - popup_width) / 2;
    var wint = (screen.height - popup_height) / 2;
    var winprops = 'height='+popup_height+',width='+popup_width+',top='+wint+',left='+winl+',scrollbars=no,resizable=no';

    var popup_features = '&mode=' + popup_mode + '&print=' + popup_print + '&click=' + popup_right_click;
    
    var popup_url = '&img=' + popup_image + '&title=' + popup_title + '&w=' + popup_width + '&h=' + popup_height + popup_features;
    win = 'window.open(this.href+\'' + popup_url + '\',\'' + popup_title + '\',\'' + winprops + '\');return false;';
    var href = 'index2.php?option=com_jce&task=popup';

    //Popup image
    if(elm != null && elm.nodeName == "IMG" && elm.parentNode.nodeName == "A") {
        if(!formObj.popup_check.checked){
            tinyMCEPopup.execCommand("unlink", false);
        }
        if(formObj.popup_check.checked){
            var linkelm = elm.parentNode;
            tinyMCEPopup.execCommand("unlink", false);
            if(formObj.popup_check.checked){
                if (tinyMCE.isSafari)
                    tinyMCEPopup.execCommand("mceInsertContent", false, '<a href="' + href + '">' + inst.getSelectedHTML() + '</a>');
                else
                    tinyMCEPopup.execCommand("createlink", false, href);

                setAttrib(linkelm, 'onclick', win);
                setAttrib(linkelm, 'target', 'PopupImage');
            }
        }
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
			
        if(formObj.popup_check.checked){
            if (tinyMCE.isSafari)
                tinyMCEPopup.execCommand("mceInsertContent", false, '<a href="' + href + '">' + inst.getSelectedHTML() + '</a>');
            else
                tinyMCEPopup.execCommand("createlink", false, href);

            // Move cursor behind the new anchor
            var linkelm = elm.parentNode;
            if (tinyMCE.isGecko) {
                var sp = inst.getDoc().createTextNode(" ");

                if (linkelm.nextSibling)
                    linkelm.parentNode.insertBefore(sp, linkelm.nextSibling);
                else
                    linkelm.parentNode.appendChild(sp);

                // Set range after link
                var rng = inst.getDoc().createRange();
                rng.setStartAfter(linkelm);
                rng.setEndAfter(linkelm);

                // Update selection
                var sel = inst.getSel();
                sel.removeAllRanges();
                sel.addRange(rng);
            }
                setAttrib(linkelm, 'onclick', win);
        }
	} else {
        var html = "";
        var onclick = '';
        if(formObj.popup_check.checked)
        {
            onclick += 'onclick="' + win + '"';
            html += '<a href="' + href + '" target="PopupImage" '+ onclick + '>';
        }
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
		html += onclick;
		html += " />";
		
		if(formObj.popup_check.checked){
            html += '</a>';
        }

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

function changePopupHeight() {
	var formObj = document.forms[0];

    if( !formObj.popup_constrain.checked )
        return;

    if (formObj.popup_width.value == "" || formObj.popup_height.value == "")
		return;

	var temp = (formObj.popup_width.value / formObj.popup_tmp_width.value) *formObj.popup_tmp_height.value;
	formObj.popup_height.value = temp.toFixed(0);
}

function changePopupWidth() {
	var formObj = document.forms[0];

    if( !formObj.popup_constrain.checked )
        return;

    if (formObj.popup_width.value == "" || formObj.popup_height.value == "")
		return;

	var temp = (formObj.popup_height.value / formObj.popup_tmp_height.value) * formObj.popup_tmp_width.value;
	formObj.popup_width.value = temp.toFixed(0);
}

function resetImageData() {
	var formObj = document.forms[0];
	formObj.width.value = formObj.height.value = "";
}
function createFileIFrame(dir, file) {
    dir = ( dir != '' ) ? '&dir='+dir : '';
    file = ( file != '' ) ? '&ret_file='+file : '';

    document.getElementById('fileContainer').innerHTML = '<iframe class="fileFrame" id="imgManager" name="imgManager" src="index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php' + dir + file + '&mode=' + frame_mode + '" frameborder="0"></iframe>';
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
    var url = hostUrl+'/index2.php?option=com_jce&task=help&plugin=imgmanager&file=help.php';
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
    var url = hostUrl+'/index2.php?option=com_jce&task=plugin&plugin=imgmanager&file=view.php&img=' + img + '&a=' + name + '&w=' + width + '&h=' + height;
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
function switchMode() {
    var mode = document.getElementById('viewMode').value;
    switch(mode){
        case 'images' :
            var newmode = 'list';
            document.getElementById('modeImg').src = im_url+"/images/images.gif";
            document.getElementById('modeImg').alt = lang['toggle_image'];
            document.getElementById('modeImg').title = lang['toggle_image'];
        break;
        case 'list' :
            var newmode = 'images';
            document.getElementById('modeImg').src = im_url+"/images/list.gif";
            document.getElementById('modeImg').alt = lang['toggle_list'];
            document.getElementById('modeImg').title = lang['toggle_list'];
        break;
    }
    var uploadForm = document.getElementById('uploadForm');
    var formObj = document.forms[0];
    var dir = getSelectValue(formObj, 'dirPath');
    if(typeof imgManager != 'undefined')
        imgManager.switchMode(dir, newmode);
    document.getElementById('viewMode').value = newmode;
    uploadForm.action = 'index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php';
}
function createThumb(size, quality)
{
    var name = document.getElementById('info1Val').value;
    var relative = document.getElementById('imgList').value;
    if(typeof imgManager != 'undefined')
        imgManager.thumbAction(relative, name, 'create', size, quality);
}
function confirmAction(action) {
    if(confirm(action)) {
        return true;
    }
    return false;
}
// While loading
preinit();
