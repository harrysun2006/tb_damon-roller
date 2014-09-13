<?php
defined( '_VALID_MOS' ) or die( 'Restricted Access.' );

global $mosConfig_absolute_path, $mosConfig_live_site, $database, $my;
require_once( $mosConfig_absolute_path."/administrator/components/com_jce/plugins/plugins.class.php" );

// load HTML Template info
$query = "SELECT id"
. "\n FROM #__jce_plugins"
. "\n WHERE plugin = 'htmltemplate' LIMIT 1"
;
$database->setQuery( $query );
$id = $database->loadResult();
$plugin = new jcePlugins( $database );
$plugin->load( $id );
$params = new mosParameters( $plugin->params );

$tiny_path = $mosConfig_absolute_path."/mambots/editors/jce/jscripts/tiny_mce";
$tiny_url = $mosConfig_live_site."/mambots/editors/jce/jscripts/tiny_mce";
$html_path = $tiny_path."/plugins/htmltemplate";
$html_url = $tiny_url."/plugins/htmltemplate";

$tmpl_dir = $params->get( 'dir', '/images/stories' );

require_once( $mosConfig_absolute_path."/mambots/editors/jce/jscripts/tiny_mce/libraries/classes/jce.class.php" );
$error = false;

$tmplcontent = mosGetParam( $_POST, 'tmplcontent', '', 4 );
if ( $tmplcontent )
{
    $path = $mosConfig_absolute_path.$tmpl_dir;
    $tmpldir =  mosGetParam( $_POST, 'tmpldir', '');
    if( $tmpldir ) $path .= $tmpldir;

    //Check if the directory exists
    if( is_dir( $path ) ){
        //Get the title
        $name = JFile::makeSafe( mosGetParam( $_POST, 'tmplname', '') );
        $title = mosGetParam( $_POST, 'tmpltitle', '');
        if( !$title && $title == '' ) $title = $name;
        //Format the content a bit
        $tmplcontent = stripslashes( $tmplcontent );

        //Create the basic page data
        $htmdata  =  "";
        $doctype = mosGetParam( $_POST, 'tmpldoctype', '');
        $tmplmetadesc = mosGetParam( $_POST, 'tmplmetadesc', '');
        $tmplmetakey = mosGetParam( $_POST, 'tmplmetakey', '');
        if( $doctype ){
            switch( $doctype )
            {
                case 'transitional' :
                    $htmdata .=  "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\" \"http://www.w3.org/TR/REC-html40/loose.dtd\">\n";
                break;
                case 'strict' :
                    $htmdata .=  "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">\n";
                break;
            }
        }
        $htmdata .=  "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
        $htmdata .=  "<head>\n";
        $htmdata .=  "<title>$title</title>\n";
        $htmdata .=  "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n";
        if( $tmplmetadesc && $tmplmetadesc != '' ){
            $htmdata .=  "<meta http-equiv=\"generator\" content=\"$tmplmetadesc\" />\n";
        }
        if( $tmplmetakey && $tmplmetakey != '' ){
            $htmdata .=  "<meta http-equiv=\"keywords\" content=\"$tmplmetakey\" />\n";
        }
        $htmdata .=  "</head>\n";
        $htmdata .=  "<body>\n";
        $htmdata .=  $tmplcontent;
        $htmdata .= "\n</body>\n";
        $htmdata .= "</html>";
        
        $htmdata = ereg_replace( "<br />","<br />\n", $htmdata );
        $htmdata = ereg_replace( "\n\n","\n", $htmdata );
        $htmdata = ereg_replace( "> ",">\n", $htmdata );

        //Get the template name
        $tmplname = $name.mosGetParam( $_POST, 'tmplext', '');
        //Create the full template file path
        $tmplfile = $path.'/'.$tmplname;
        //Does the file exist already?
        $overwrite = mosGetParam( $_POST, 'overwrite', '');
        if( JFile::exists( $tmplfile ) && !$overwrite ){
            $error = 'File already exists!';
        }else{
            //Open the file, write the data
            if( !JFile::write( $tmplfile, $htmdata ) )
            {
                $error = 'Unable to write to file!';
            }
        }
    }else{
        $error = 'Directory does not exist!';
    }
}
$path = $mosConfig_absolute_path.$tmpl_dir;
$dirlist = JFolder::folders( $path, '.', true, true );

function writeList( $dirlist )
{
    global $path;
    $folders = "<select name=\"tmpldir\" style=\"width:150px\">";
    $folders .= "<option value=\"\">/</option>";

    if( !empty( $dirlist ) ){
        foreach ( $dirlist as $dir ) {
            $dir = str_replace( '\\', '/', $dir );
            $dir = str_replace( $path, '', $dir );
            $folders .= "<option value=\"".$dir."\">".$dir."</option>";
        }
    }
    $folders .= "</select>";

    return $folders;
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$lang_savehtmltemplate_desc}</title>
<script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $html_url;?>/jscripts/savehtmltemplate.js"></script>
<link href="<?php echo $html_url;?>/css/htmltemplate.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var lib_path = "<?php echo $tiny_url;?>/libraries";
    function init()
    {
        var msgObj = document.getElementById('message');
        var msgIcon = document.getElementById('msgicon');
        removeInfo(msgObj);
        msgIcon.src = lib_path+'/images/spacer.gif';
        msgIcon.width = '1';
        msgIcon.height = '16';
        <?php if( $error ){?>
            var error = "<?php echo $error;?>";
            msgObj.className = 'error';
            createInfo(msgObj, error);
            msgIcon.src = lib_path+'/images/warning.gif';
            msgIcon.width = '16';
            msgIcon.height = '16';
        <?php }?>
    }
</script>
</head>
<body scroll="no" onload="init();">
<form method="post" name="savetmpl" onsubmit="saveContent();" action="#">
    <input type="hidden" id="tmplcontent" name="tmplcontent" />
        <div class="tabs">
			<ul>
				<li id="general_tab" class="current"><span><a href="javascript:mcTabs.displayTab('general_tab','general_panel');" onmousedown="return false;">{$lang_savehtmltemplate_tab_general}</a></span></li>
				<li id="advanced_tab"><span><a href="javascript:mcTabs.displayTab('advanced_tab','advanced_panel');" onmousedown="return false;">{$lang_savehtmltemplate_tab_advanced}</a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper" style="height:150px;">
		<img id="msgicon" style="vertical-align:middle;" src="<?php echo $tiny_url;?>/libraries/images/spacer.gif" width="1" height="16" alt="Message" title="Message" border="0" /><span id="message"></span>
			<div id="general_panel" class="panel current">
				<fieldset>
				<legend>{$lang_savehtmltemplate_tab_general}</legend>
                    <div><label style="vertical-align:middle;">{$lang_savehtmltemplate_dir}</div>
                    <div></label><?php echo writeList( $dirlist );?></div>
            		<div><label>{$lang_savehtmltemplate_name}:</label></div>
                    <div>
                        <input type="text" id="tmplname" name="tmplname" size="30" />
                        <select name="tmplext" id="tmplext" style="width:80px">
                            <option value=".html" selected="selected">.html</option>
                            <option value=".htm">.htm</option>
                        </select>
                    </div>
                    <div><input type="checkbox" id="overwrite" name="overwrite" style="vertical-align:middle;" />
                    <label style="vertical-align:middle;">{$lang_savehtmltemplate_overwrite}</label>
                    </div>
              </fieldset>
            </div>
            <div id="advanced_panel" class="panel">
				<fieldset>
				<legend>{$lang_savehtmltemplate_tab_advanced}</legend>
				<div><label style="vertical-align:middle;">{$lang_savehtmltemplate_tmpldoctype}</label></div>
				<div>
                    <select name="tmpldoctype" id="tmpldoctype">
                        <option value="transitional">HTML 4.0 Transitional</option>
                        <option value="strict">HTML 4.0 Strict</option>
                     </select>
                </div>
				<div><label style="vertical-align:middle;">{$lang_savehtmltemplate_tmpltitle}</label></div>
                <div><input type="text" id="tmpltitle" name="tmpltitle" size="55" /></div>
                <div><label style="vertical-align:middle;">{$lang_savehtmltemplate_tmplmetadesc}</label></div>
                <div><input type="text" id="tmplmetadesc" name="tmplmetadesc" size="55" /></div>
                <div><label style="vertical-align:middle;">{$lang_savehtmltemplate_tmplmetakey}</label></div>
                <div><input type="text" id="tmplmetakey" name="tmplmetakey" size="55" /></div>
				</fieldset>
            </div>
        </div>
        <div class="mceActionPanel">
			<div style="float: left">
                <input type="button" id="insert" name="insert" value="{$lang_savehtmltemplate_save}" onclick="saveContent();" style="vertical-align:middle;"/>
			</div>
			<div style="float: right">
				<input type="button" id="cancel" name="cancel" value="{$lang_savehtmltemplate_close}" onclick="tinyMCEPopup.close();" />
			</div>
		</div>
</form>
</body>
</html>
