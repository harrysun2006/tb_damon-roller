/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('joomla', tinyMCE.getParam('lang_list'));

var TinyMCE_JoomlaPlugin = {
	getInfo : function() {
		return {
			longname : 'JCE Joomla Bots Plugin',
			author : 'Ryan Demmer',
			authorurl : 'http://www.cellardoor.za.net/jce',
			infourl : '',
			version : '1.0.0'
		};
	},

    getControlHTML : function(cn) {
		switch (cn) {
			case "mosimage":
				return tinyMCE.getButtonHTML(cn, 'lang_joomla_mosimage_desc', '{$pluginurl}/images/mosimage.gif', 'mceMosImage', true);
            case "mospagebreak":
				return tinyMCE.getButtonHTML(cn, 'lang_joomla_mospagebreak_desc', '{$pluginurl}/images/mospagebreak.gif', 'mceMosPageBreak', true);
		}

		return "";
	},
	execCommand : function(editor_id, element, command, user_interface, value) {
		// Handle commands
		switch (command) {
			case "mceMosPageBreak":
   	            var action = "insert";
				var template = new Array();
				var inst = tinyMCE.getInstanceById(editor_id);
				var focusElm = inst.getFocusElement();

				template['file']   = '../../plugins/joomla/pagebreak.htm'; // Relative to theme
				template['width']  = 400;
				template['height'] = 150;
			    
                tinyMCE.openWindow(template, {editor_id : editor_id, inline : "yes", action : action});
            return true;
            	case "mceMosImage":
                var html = '{mosimage}';
                tinyMCE.execCommand('mceInsertContent', false, html);
            return true;
      }
      // Pass to next handler in chain
	   return false;
    }
};

tinyMCE.addPlugin("joomla", TinyMCE_JoomlaPlugin);
