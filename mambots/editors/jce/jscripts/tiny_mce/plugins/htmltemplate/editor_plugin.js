/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('htmltemplate', tinyMCE.getParam('lang_list'));

var TinyMCE_HTMLTemplatePlugin = {
	getInfo : function() {
		return {
			longname : 'JCE HTML Template Plugin',
			author : 'Ryan Demmer',
			authorurl : 'http://www.cellardoor.za.net/jce',
			infourl : '',
			version : '1.0.0'
		};
	},

	getControlHTML : function(cn) {
		switch (cn) {
			case "htmltemplate":
				return tinyMCE.getButtonHTML(cn, 'lang_htmltemplate_desc', '{$pluginurl}/images/htmltemplate.gif', 'mceHTMLTemplate');
            case "savehtmltemplate":
				return tinyMCE.getButtonHTML(cn, 'lang_savehtmltemplate_desc', '{$pluginurl}/images/savehtmltemplate.gif', 'mceSaveHTMLTemplate');
        }

		return "";
	},
	
	execCommand : function(editor_id, element, command, user_interface, value) {
		switch (command) {
			case "mceHTMLTemplate":
					var template = new Array();
					template['file']	= tinyMCE.getParam('jbase')+'/index2.php?option=com_jce&no_html=1&task=plugin&plugin=htmltemplate&file=htmltemplate.php';
					template['width']  = 450;
					template['height'] = 400;
					var plain_text = "";
					tinyMCE.openWindow(template, {editor_id : editor_id, plain_text: plain_text, resizable : "yes", scrollbars : "no", inline : "yes", mceDo : 'insert'});
			return true;
            case "mceSaveHTMLTemplate":
					var template = new Array();
					template['file']	= tinyMCE.getParam('jbase')+'/index2.php?option=com_jce&no_html=1&task=plugin&plugin=htmltemplate&file=savehtmltemplate.php';
					template['width']  = 350;
					template['height'] = 250;
					tinyMCE.openWindow(template, {editor_id : editor_id, resizable : "yes", scrollbars : "no", inline : "yes", mceDo : 'insert'});
		 	return true;
		}

		return false;
	}
};
tinyMCE.addPlugin("htmltemplate", TinyMCE_HTMLTemplatePlugin)

