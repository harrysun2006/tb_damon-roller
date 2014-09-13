/* Import plugin specific language pack */
tinyMCE.importPluginLanguagePack('filemanager', 'en,de');

var TinyMCE_FileManagerPlugin = {
	getInfo : function() {
		return {
			longname : 'JCE FileManager',
			author : 'Ryan Demmer',
			authorurl : 'http://www.cellardoor.za.net/jce',
			infourl : '',
			version : '1.0.0'
		};
	},

    getControlHTML : function(cn) {
		switch (cn) {
			case "filemanager":
				return tinyMCE.getButtonHTML(cn, 'lang_filemanager_desc', '{$pluginurl}/images/filemanager.gif', 'mceFileManager');
		}

		return "";
	},
    execCommand : function(editor_id, element, command, user_interface, value) {
		// Handle commands
		switch (command) {
			case "mceFileManager":
                var template = new Array();
                template['file']   = tinyMCE.getParam('site')+'/index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=manager.php';
			    template['width']  = 560;
		        template['height'] = 500;

			tinyMCE.openWindow(template, {editor_id : editor_id, inline : "yes"});
			return true;
	   }
        return false;
    },
    
    handleNodeChange : function(editor_id, node, undo_index, undo_levels, visual_aid, any_selection) {
		if (node == null)
			return;

		do {
			if (node.nodeName == "A" && tinyMCE.getAttrib(node, 'id') == "fm_file") {
				tinyMCE.switchClass(editor_id + '_filemanager', 'mceButtonSelected');
				return true;
			}
		} while ((node = node.parentNode));

		tinyMCE.switchClass(editor_id + '_filemanager', 'mceButtonNormal');

		return true;
	}
};

tinyMCE.addPlugin("filemanager", TinyMCE_FileManagerPlugin);
