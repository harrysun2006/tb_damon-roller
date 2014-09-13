function saveContent() {
    var tmplname = document.getElementById('tmplname').value;
    var msgObj = document.getElementById('message');
    var msgIcon = document.getElementById('msgicon');
    var msg = 'Saving...';
	if (tmplname == ''){
        alert('Please enter a name for the template.');
        return false;
    }else{
        msgObj.className = 'normal';
        createInfo(msgObj, msg);
        msgIcon.src = lib_path+'/images/load.gif';
        msgIcon.width = '16';
        msgIcon.height = '16';
        var html = tinyMCE.getContent();
    	if (html == ''){
    		tinyMCEPopup.close();
    		return false;
    	}
    	document.getElementById('tmplcontent').value = html;
        document.forms[0].submit();
    }
}
function removeInfo(obj)
{
    if(obj.firstChild)
        obj.removeChild(obj.firstChild);
}
function createInfo(obj, txt)
{
    removeInfo(obj);
        obj.appendChild(document.createTextNode(txt));
}

