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

$tmplRegex 	= '\.(html|htm)$';

$path = $mosConfig_absolute_path.$tmpl_dir;
$list = JFolder::Files( $path, $tmplRegex, true, true );

function writeList( $list )
{
    global $path;
    if(is_dir( $path ))
    {
        $javascript = "onChange=\"selectTmpl(this.value)\"";
        $template_list = "<select name=\"tmplFile\" $javascript style=\"width:200px\">";
        $template_list .= "<option value=\"\" selected>--Select Template--</option>";

        if( !empty( $list ) ){
            foreach ( $list as $file_list ) {
                //$file_list = mosFS::getNativePath( $file_list, false );
                $file_list = str_replace( "\\", "/", $file_list );
                $file_list = str_replace( $path, "", $file_list );
                $file_name = $file_list;
                if($file_name{0} == '/') $file_name = substr($file_list, 1);
                $template_list .= "<option value=\"".$file_list."\">".$file_name."</option>\n";
            }
        }
        $template_list .= "</select>";
    }else{
      echo "<span style=\"color: red; font-weight: bold;\">Directory $path not found!</span>";
    }
    return $template_list;
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>{$lang_htmltemplate_desc}</title>
<script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $html_url;?>/jscripts/htmltemplate.js"></script>
<link href="<?php echo $html_url;?>/css/htmltemplate.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var html_path = "<?php echo $html_url;?>";
    var tmpl_path = "<?php echo $mosConfig_live_site.$tmpl_dir;?>";
</script>
</head>
<body scroll="no" onload="onLoadInit();" onresize="resizeInputs();">
<form name="source" onsubmit="saveContent();" action="#">
    <div class="title">{$lang_htmltemplate_desc}</div>
		<div><?php echo writeList( $list );?></div><br />
		<div id="iframecontainer"></div>
		<div class="mceActionPanel">
			<div style="float: left">
				<input type="button" id="insert" name="insert" value="{$lang_insert}" onclick="saveContent();" style="vertical-align:middle;"/>
			</div>

			<div style="float: right">
				<input type="button" id="cancel" name="cancel" value="{$lang_cancel}" onclick="tinyMCEPopup.close();" />
			</div>
		</div>
</form>
</body>
</html>
