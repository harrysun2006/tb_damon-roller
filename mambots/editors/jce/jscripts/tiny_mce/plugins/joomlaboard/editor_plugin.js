/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('joomlaboard', tinyMCE.getParam('lang_list'));

var TinyMCE_JoomlaBoardPlugin = {
	getInfo : function() {
		return {
			longname : 'JCE JoomlaBoard DiscussBot Plugin',
			author : 'Ryan Demmer',
			authorurl : 'http://www.cellardoor.za.net/jce',
			infourl : '',
			version : '1.0.0'
		};
	},

    getControlHTML : function(cn) {
		switch (cn) {
            case "joomlaboard":
				return tinyMCE.getButtonHTML(cn, 'lang_joomlaboard_desc', '{$pluginurl}/images/joomlaboard.gif', 'mceJoomlaBoard', true);
		}

		return "";
	},
	execCommand : function(editor_id, element, command, user_interface, value) {
		// Handle commands
		switch (command) {
			case "mceJoomlaBoard":
   	            var action = "insert";
				var template = new Array();
				var inst = tinyMCE.getInstanceById(editor_id);
				var focusElm = inst.getFocusElement();

				template['file']   = tinyMCE.getParam('site')+'/index2.php?option=com_jce&no_html=1&task=plugin&plugin=joomlaboard&file=joomlaboard.php';
				template['width']  = 320;
				template['height'] = 150;
			    
                tinyMCE.openWindow(template, {editor_id : editor_id, inline : "yes", action : action});
            return true;
      }
      // Pass to next handler in chain
	   return false;
    }
};

tinyMCE.addPlugin("joomlaboard", TinyMCE_JoomlaBoardPlugin);
