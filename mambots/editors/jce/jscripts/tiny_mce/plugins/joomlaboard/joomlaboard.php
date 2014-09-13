<?php
/**
* @version $Id: manager.php 2005-12-27 09:23:43Z Ryan Demmer $
* @package JCE
* @copyright Copyright (C) 2005 Ryan Demmer. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* JCE is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
*/
defined( '_VALID_MOS' ) or die( 'Restricted Access.' );

$jb_version = "1.0.0";

global $mosConfig_absolute_path, $mosConfig_live_site, $database, $my;

$tiny_path = $mosConfig_absolute_path."/mambots/editors/jce/jscripts/tiny_mce";
$tiny_url = $mosConfig_live_site."/mambots/editors/jce/jscripts/tiny_mce";
$jb_path = $tiny_path."/plugins/joomlaboard";
$jb_url = $tiny_url."/plugins/joomlaboard";
$lib_url = $tiny_url."/libraries";
$lib_path = $tiny_path."/libraries";

//Static Content Items for Long Description
$query = "SELECT a.id AS value, a.name AS text
         FROM #__sb_categories AS a
         WHERE a.published = '1'
         ORDER BY a.id";

        $database->setQuery( $query );
        $sb_item = $database->loadObjectList();
        $list = "<select name=\"catid\" style=\"width:200px\">";
        $list .= "<option value=\"\" selected>---</option>";
        foreach ( $sb_item as $item ) {
            $list .= "<option value=\"".$item->value."\">".$item->text."</option>";
        }
        $list .= "</select>";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>JoomlaBoard DiscussBot : <?php echo $jb_version;?></title>
	<script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $jb_url;?>/jscripts/joomlaboard.js"></script>
</head>
<body onload="init();" style="display: none">
<form onsubmit="insertAction();return false;" action="#">
	<div class="tabs">
			<ul>
				<li id="general_tab" class="current"><span><a href="javascript:mcTabs.displayTab('general_tab','general_panel');" onmousedown="return false;">{$lang_joomlaboard_desc}</a></span></li>
			</ul>
		</div>

		<div class="panel_wrapper" style="height:70px;">
			<div id="general_panel" class="panel current">
				<fieldset>
						<legend>{$lang_joomlaboard_title}</legend>
						<table class="properties">
							<tr>
                                <td>{$lang_joomlaboard_category}</td>
                                <td><?php echo $list;?></td>
							</tr>
						</table>
				</fieldset>
			</div>

		
		</div>
	<div class="mceActionPanel">
		<div style="float: right">
			<input type="button" id="insert" name="insert" value="{$lang_insert}" onclick="insertAction();" />
			<input type="button" id="cancel" name="cancel" value="{$lang_cancel}" onclick="cancelAction();" />
		</div>
	</div>
    </form>
</body> 
</html> 
