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

$fm_version = "1.0.2";

global $mosConfig_absolute_path, $mosConfig_live_site, $database, $my;

//Setup paths
$tiny_path = $mosConfig_absolute_path."/mambots/editors/jce/jscripts/tiny_mce";
$tiny_url = $mosConfig_live_site."/mambots/editors/jce/jscripts/tiny_mce";
$fm_path = $tiny_path."/plugins/filemanager";
$fm_url = $tiny_url."/plugins/filemanager";
$lib_url = $tiny_url."/libraries";
$lib_path = $tiny_path."/libraries";

require_once( $tiny_path.'/auth_jce.php' );
$fmAuth = new authJCE();

//Setup languages
$database->setQuery( "SELECT lang FROM #__jce_langs WHERE published= '1'" );
$lang = $database->loadResult();

include_once ( $lib_path."/langs/$lang.php" );
if( file_exists( $fm_path."/langs/$lang.php" ) ){
    include_once ( $fm_path."/langs/$lang.php" );
}else{
    include_once ( $fm_path."/langs/en.php" );
}

//Check for access rights
require_once( $mosConfig_absolute_path."/administrator/components/com_jce/plugins/plugins.class.php" );

// load File Manager parameters
$query = "SELECT id"
. "\n FROM #__jce_plugins"
. "\n WHERE plugin = 'filemanager' LIMIT 1"
;
$database->setQuery( $query );
$id = $database->loadResult();
$plugin = new jcePlugins( $database );
$plugin->load( $id );
$params = new mosParameters( $plugin->params );

//Start Authorisation check
$upload_auth        = $fmAuth->authCheck( $params->get( 'upload', '18' ) );
$folder_delete_auth = $fmAuth->authCheck( $params->get( 'folder_del', '18' ) );
$folder_rename_auth = $fmAuth->authCheck( $params->get( 'folder_ren', '18' ) );
$new_folder_auth    = $fmAuth->authCheck( $params->get( 'folder_new', '18' ) );
$file_delete_auth   = $fmAuth->authCheck( $params->get( 'file_del', '18' ) );
$file_rename_auth   = $fmAuth->authCheck( $params->get( 'file_ren', '18' ) );
$file_move_auth     = $fmAuth->authCheck( $params->get( 'file_move', '18' ) );
//End Authorisation

include_once ( $lib_path."/classes/jce.class.php" );
require_once ( $fm_path."/classes/manager.class.php" );

//Help file check
$help_lang = ( JFile::exists( $fm_path."/docs/".$lang ) ) ? $lang : 'en';

$base_dir = $params->get( 'dir', '/images/stories' );
$base_url = $params->get( 'url', '/images/stories' );

$dir_type = $params->get( 'dir_type', 'level' );
$user_dir = $params->get( 'user_dir', '0' );
$user_dir_level = $params->get( 'user_dir_level', '18' );
$usertype = $my->usertype;
$username = $my->username;

if( $user_dir && $fmAuth->id < $user_dir_level ){
    $base_dir = JCEUtils::userDir( $base_dir, $dir_type, $usertype, $username );
    $base_url = $base_dir;
}

$manager = new FileManager( $base_dir, $base_url );
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $fmlang['desc'];?></title>
	<script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/utils/form_utils.js"></script>
	<script type="text/javascript" src="<?php echo $lib_url;?>/jscripts/common.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $fm_url;?>/jscripts/manager.js"></script>
	<link href="<?php echo $lib_url;?>/css/common.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $fm_url;?>/css/manager.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
        var base_url = "<?php echo $manager->getBaseURL(); ?>";
        var hostUrl = "<?php echo $mosConfig_live_site; ?>";
        var pluginurl = "<?php echo $fm_url;?>";
        var help_lang = "<?php echo $help_lang; ?>";
        var common_path = "<?php echo $lib_url;?>";
        var fm_url = "<?php echo $fm_url;?>";
        var lib_url = "<?php echo $lib_url;?>";
        var pasteAction = '';
        var source_dir = '';
        var lang = new Array();
            lang['rename_alert'] = "<?php echo $cmnlang['ren_warning'];?>";
            lang['delete_file_alert'] = "<?php echo $cmnlang['delete_file_alert'];?>";
            lang['delete_folder_alert'] = "<?php echo $cmnlang['delete_folder_alert'];?>";
	</script>
</head>
<body id="filemanager" onload="init();" style="display: none">
    <form action="index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=files.php" name="uploadForm" id="uploadForm" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="viewMode" id="viewMode" />
    <input type="hidden" name="imgList" id="imgList" />
    <input type="hidden" name="dirList" id="dirList" />
    <input type="hidden" name="clipboard" id="clipboard" />
    <input type="hidden" name="file_date" id="file_date" />
    <input type="hidden" name="file_size" id="file_size" />
    <input type="hidden" name="file_ext" id="file_ext" />
    <!//--Upload Dialog-->
  	<div id="uploaddlg" class="hide">
	    <fieldset>
	    <legend><?php echo $cmnlang['upload'];?></legend>
	    <table>
		    <tr>
		    	<td colspan="4"><input type="file" name="upload" id="upload" size="50" value="" /></td>
		    </tr>
		    <tr>
		    	<td colspan="2"><input type="checkbox" id="overwrite" name="overwrite" style="vertical-align:middle;" value="false" onclick="checkUpload(this.id, 'unique');"/><label id="overwritelabel" for="overwrite"><?php echo $cmnlang['overwrite'];?></label></td>
                <td colspan="2"><input type="checkbox" id="unique" name="unique" style="vertical-align:middle;" value="false" onclick="checkUpload(this.id, 'overwrite');"/><label id="uniquelabel" for="unique"><?php echo $cmnlang['unique'];?></label></td>
            </tr>
		    <tr>
		    	<td><input type="submit" name="submit" style="cursor:pointer;" value="<?php echo $cmnlang['upload'] ?>" onclick="doUpload();" /></td>
		    	<td colspan="2">&nbsp;</td>
		    	<td align="right"><input type="button" style="cursor:pointer;" name="cancel" value="<?php echo $cmnlang['cancel'] ?>" onclick="hide(document,'uploaddlg');" /></td>
		    </tr>
	    </table>
	    </fieldset>
  	</div>
  	<!//--End Upload Dialog-->
  	<!//--New Folder Dialog-->
  	<div id="folderdlg" class="hide">
		<fieldset>
	    <legend><?php echo $cmnlang['new_dir'];?></legend>
	    <table>
		    <tr>
				<td colspan="2"><input type="text" name="folder" id="folder" size="40" /></td>
		    </tr>
		    <tr>
		    	<td><input type="button" name="createFolder" value="<?php echo $cmnlang['ok'] ?>" onclick="newFolder();" /></td>
		    	<td align="right"><input type="button" name="cancelFolder" value="<?php echo $cmnlang['cancel'] ?>" onclick="hide(document, 'folderdlg');" /></td>
		    </tr>
	    </table>
	    </fieldset>
  	</div>
  	<!//--End New Folder Dialog-->
  	<!//--Rename File Dialog-->
  	<div id="renfiledlg" class="hide">
	    <fieldset>
	    <legend><?php echo $cmnlang['ren'];?></legend>
	    <table>
		    <tr>
		    	<td colspan="2"><input type="text" name="newfilename" id="newfilename" size="40" />
		    	<input type="hidden" name="oldfilename" id="oldfilename" /></td>
		    </tr>
		    <tr>
		    	<td><input type="button" name="renameFile" value="<?php echo $cmnlang['ok'] ?>" onclick="renFile();" /></td>
		    	<td align="right"><input type="button" name="cancelFolder" value="<?php echo $cmnlang['cancel'] ?>" onclick="hide(document, 'renfiledlg');" /></td>
		    </tr>
	    </table>
	    </fieldset>
  	</div>
  	<!//--End Rename File Dialog-->
  	<!//--Rename Folder Dialog-->
  	<div id="rendirdlg" class="hide">
	    <fieldset>
	    <legend><?php echo $cmnlang['ren'];?></legend>
	    <table>
		    <tr>
		    	<td colspan="2"><input type="text" name="newdirname" id="newdirname" size="40" />
		    	<input type="hidden" name="dirpath" id="dirpath" />
		    	</td>
		    </tr>
		    <tr>
		    	<td><input type="button" name="renameDir" value="<?php echo $cmnlang['ok'] ?>" onclick="renDir();" /></td>
		    	<td align="right"><input type="button" name="cancelFolder" value="<?php echo $cmnlang['cancel'] ?>" onclick="hide(document, 'rendirdlg');" /></td>
		    </tr>
	    </table>
	    </fieldset>
  	</div>
  	<!//--End Rename Folder Dialog-->
	<div class="tabs">
		<ul>
			<li id="article_tab" class="current"><span><a href="javascript:mcTabs.displayTab('article_tab','article_panel');" onmousedown="return false;"><?php echo $fmlang['ins_file'];?></a></span></li>
		</ul>
	</div>
	<div class="panel_wrapper">
    	<div id="article_panel" class="panel current" style="height:140px;">
    		<fieldset>
			<legend><?php echo $fmlang['ins_file'];?></legend>
    		<table class="properties" border="0">
				<tr>
					<td class="column1"><label id="srclabel" for="src"><?php echo $cmnlang['url'];?></label></td>
					<td colspan="3">
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
						<td><input name="href" type="text" id="href" value="" class="input" /></td>
						</tr>
			    	</table>
					</td>
		    	</tr>
			    <tr>
					<td><label id="targetlistlabel" for="targetlist"><?php echo $cmnlang['target'];?></label></td>
					<td><?php echo JCEHTML::Target();?></td>
				</tr>
			    <tr>
				    <td class="column1"><label id="titlelabel" for="title"><?php echo $cmnlang['title'];?></label></td>
				    <td colspan="3"><input id="title" name="title" type="text" value="" class="input" /></td>
			    </tr>
			</table>
			<table>
			    <tr>
				    <td><input name="icon" type="checkbox" id="icon" style="vertical-align:middle;" value="icon" /><label id="iconlabel" for="icon"><?php echo $fmlang['icon'];?></label></td>
				    <td><input name="date" type="checkbox" id="date" style="vertical-align:middle;" value="date" /><label id="datelabel" for="date"><?php echo $fmlang['date'];?></label></td>
				    <td><input name="size" type="checkbox" id="size" style="vertical-align:middle;" value="size" /><label id="sizelabel" for="size"><?php echo $fmlang['size'];?></label></td>
			    </tr>
		    </table>
			</fieldset>
    	</div>
	</div>
	<fieldset>
	<legend><?php echo $cmnlang['browse'];?></legend>
    <div id="msgIcon">
        <img id="imgMsgContainer" src="<?php echo $lib_url;?>/images/spacer.gif" width="16" height="16" border="0" alt="Message" title="Message" />
    </div>
    <div id="msgDiv">
        <span id="msgContainer" style="vertical-align:top;"></span>
    </div>
    <div id="dirListBlock">
        <label for="dirlistcontainer" style="vertical-align:middle;"><?php echo $cmnlang['dir'];?></label>&nbsp;<div id="dirlistcontainer" style="vertical-align:middle;"></div>
    </div>
    <div id="dirImg" style="display: inline;"><a href="javascript:void(0)" onclick="javascript: goUpDir();" title="<?php echo $cmnlang['dir_up'];?>" class="toolbar"><img src="<?php echo $lib_url;?>/images/dir_up.gif" width="20" height="20" border="0" alt="<?php echo $cmnlang['dir_up'];?>" /></a></div>

    <?php if( $new_folder_auth ){?>
        <div id="folderImg" style="display: inline;"><a href="javascript:void(0)" class="toolbar" onclick="showDlg(document, 'folderdlg');" title="<?php echo $cmnlang['new_dir'];?>"><img src="<?php echo $lib_url;?>/images/new_folder.gif" width="20" height="20" alt="<?php echo $cmnlang['new_dir'];?>" /></a></div>
    <?php }?>

    <?php if( $upload_auth ){?>
        <div id="upImg" style="display: inline;"><a href="javascript:void(0)" onclick="showDlg(document, 'uploaddlg');" class="toolbar"><img src="<?php echo $lib_url;?>/images/upload.gif" border="0" alt="<?php echo $cmnlang['upload'];?>" width="20" height="20" title="<?php echo $cmnlang['upload'];?>" /></a></div>
    <?php }?>
   <div id="hlpIcon" style="display: inline;"><a href="javascript:void(0)" onclick="javascript: openHelp();" class="toolbar"><img src="<?php echo $lib_url;?>/images/help.gif" border="0" alt="<?php echo $cmnlang['help'];?>" width="20" height="20" title="<?php echo $cmnlang['help'];?>" /></a></div>

    <!--//File Frame-->
    <div id="fileContainer"></div>
    <!--//File Frame-->
    <!--//File Info-->
    <div id="infoBlock">
        <div id="infoTitle">
            <?php echo $cmnlang['details'];?>
        </div>
        <div id="fileDetails">
            <span id="info1" style="font-weight:bold;" class="hide"></span>
                <input type="hidden" id="info1Val" value="" />
            <span id="info2" class="hide"></span>
                <input type="hidden" id="info2Val" value="" />
            <span id="info3" class="hide"></span>
                <input type="hidden" id="info3Val" value="" />
            <span id="info4" class="hide"></span>
                <input type="hidden" id="info4Val" value="" />
            <span id="info5" class="hide"></span>
                <input type="hidden" id="info5Val" value="" />
            <span id="info6" class="hide"></span>
                <input type="hidden" id="info6Val" value="" />
        </div>
    </div>
    <!--//File Info-->
    <!--//Tools-->
    <div id="toolsList">
        <!--//Rename-->
        <?php if( $file_rename_auth ) {?>
       	    <div class="hide" id="renImg"><a href="javascript:void(0)" id="renLink" class="tools" onclick="fileAction('rename', 'file');"><img src="<?php echo $lib_url;?>/images/rename.gif" alt="<?php echo $cmnlang['ren'];?>" title="<?php echo $cmnlang['ren'];?>" width="20" height="20" id="renIcon" /></a></div>
        <?php }else{?>
       	    <div id="renImg" class="hide"></div>
        <?php }?>

        <!--//Delete-->
        <?php if( $file_delete_auth ) {?>
       	    <div id="delImg" class="hide"><a href="javascript:void(0)" id="delLink" title="<?php echo $cmnlang['del'] ?>" onclick="fileAction('delete', 'file');" class="tools"><img src="<?php echo $lib_url;?>/images/delete.gif" id="delIcon" height="20" width="20" border="0" alt="<?php echo $cmnlang['del'] ?>" /></a> </div>
        <?php }else{?>
       	    <div id="delImg" class="hide" ></div>
        <?php }?>

        	<?php if( $file_move_auth ) {?>
        <!--//Copy-->
        <div id="copyImg" class="hide"><a href="javascript:void(0)" id="copyLink" title="<?php echo $cmnlang['copy'] ?>" onclick="copyFile();" class="tools"><img src="<?php echo $tiny_url;?>/themes/advanced/images/copy.gif" id="copyIcon" height="20" width="20" border="0" alt="<?php echo $cmnlang['copy'];?>" /></a> </div>

        <!--//Cut-->
        <div id="cutImg" class="hide"><a href="javascript:void(0)" id="cutLink" title="<?php echo $cmnlang['cut'] ?>" onclick="cutFile();" class="tools"><img src="<?php echo $tiny_url;?>/themes/advanced/images/cut.gif" id="cutIcon" height="20" width="20" border="0" alt="<?php echo $cmnlang['cut'];?>" /></a> </div>

        <!--//Paste-->
        <div id="pasteImg" class="hide"><a href="javascript:void(0)" id="pasteLink" title="<?php echo $cmnlang['paste'] ?>" onclick="pasteFile();" class="tools"><img src="<?php echo $tiny_url;?>/themes/advanced/images/paste.gif" id="pasteIcon" height="20" width="20" border="0" alt="<?php echo $cmnlang['paste'];?>" /></a> </div>
		<?php }else{?>
       	    <div id="copyImg" class="hide"></div>
       	    <div id="cutImg" class="hide"></div>
       	    <div id="pasteImg" class="hide"></div>
        <?php }?>
        
        <!--//View-->
        <div id="viewImg" class="hide"><a href="javascript:void(0)" id="viewLink" title="<?php echo $cmnlang['view'] ?>" onclick="viewFile();" class="tools"><img src="<?php echo $lib_url;?>/images/view.gif" id="viewIcon" height="20" width="20" border="0" alt="<?php echo $cmnlang['view'];?>" /></a> </div>

        <!--//Folder Delete-->
        <?php if( $folder_delete_auth ) {?>
       	    <div id="delDir" class="hide"> <a href="javascript:void(0)" id="delDirLink" title="<?php echo $cmnlang['del'] ?>" onclick="fileAction('delete', 'folder');" class="tools"><img src="<?php echo $lib_url;?>/images/delete.gif" id="delDirIcon" height="20" width="20" border="0" alt="<?php echo $cmnlang['del'];?>" /></a> </div>
        <?php }else{?>
       	    <div id="delDir" class="hide"></div>
        <?php }?>

        <!--//Folder Rename-->
        <?php if( $folder_rename_auth ) {?>
       	    <div id="renDir" class="hide"> <a href="javascript:void(0)" id="renDirLink" title="<?php echo $cmnlang['ren'] ?>" onclick="fileAction('rename', 'folder');" class="tools"><img src="<?php echo $lib_url;?>/images/rename.gif" id="renDirIcon" height="20" width="20" border="0" alt="<?php echo $cmnlang['ren'];?>" /></a> </div>
        <?php }else{?>
       	    <div id="renDir" class="hide"></div>
        <?php }?>
    </div>
    <!--//Tools-->
    </fieldset>
	<div class="mceActionPanel">
		<div style="float: right">
    		<input type="button" class="button "id="refresh" name="refresh" value="<?php echo $cmnlang['refresh'];?>" onclick="refreshAction();" />
			<input type="button" id="insert" name="insert" value="{$lang_insert}" onclick="insertAction();" />
			<input type="button" id="cancel" name="cancel" value="<?php echo $cmnlang['cancel'];?>" onclick="cancelAction();" />
		</div>
	</div>
    </form>
</body> 
</html> 
