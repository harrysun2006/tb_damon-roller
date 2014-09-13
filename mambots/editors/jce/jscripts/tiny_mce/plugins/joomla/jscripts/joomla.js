function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function insertPageBreak() {
    var formObj = document.forms[0];
    var title = formObj.title.value;
    var heading = formObj.heading.value;
    var html = '{mospagebreak';
    if(title != '' || heading != '')
        html += ' ';
    if(title != '')
        html += 'title='+ title +'';
    if(title != '' && heading != '')
        html += '&';
    if(heading != '')
        html += 'heading='+ heading +'';
        html += '}';

	tinyMCEPopup.execCommand("mceInsertContent", true, html);
	tinyMCEPopup.close();
}
