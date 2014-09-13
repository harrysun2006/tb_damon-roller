<?php
global $mosConfig_absolute_path, $mosConfig_live_site, $database;
$tiny_path = $mosConfig_absolute_path."/mambots/editors/jce/jscripts/tiny_mce";
$tiny_url = $mosConfig_live_site."/mambots/editors/jce/jscripts/tiny_mce";
$fm_path = $tiny_path."/plugins/filemanager";
$fm_url = $tiny_url."/plugins/filemanager";
$lib_url = $tiny_url."/libraries";
$lib_path = $tiny_path."/libraries";

//Setup languages
$database->setQuery( "SELECT lang FROM #__jce_langs WHERE published= '1'" );
$lang = $database->loadResult();

include_once ( $lib_path."/langs/$lang.php" );
if( file_exists( $fm_path."/langs/$lang.php" ) ){
    include_once ( $fm_path."/langs/$lang.php" );
}else{
    include_once ( $fm_path."/langs/en.php" );
}
?>
<style type="text/css">
    .help_icon{
        border: 0;
        vertical-align: middle;
        margin: 2px;
    }
    .help_heading{
        font-weight: bold;
        font-size: 12px;
        margin-bottom: 5px;
    }
    .help_subtitle{
        font-weight: bold;
        font-size: 12px;
    }
</style>
<div class="help_heading"><?php echo $fmhelp['help_title'];?></div>
<?php
$tabs = new mosTabs(0);
$tabs->startPane("helpPane");
$tabs->startTab($cmnhelp['interface'],"interface-tab");?>
<table>
    <tr>
        <td>
            <p><?php echo $fmhelp['interface_intro'];?></p>
            <p><img class="help_icon" src="<?php echo $lib_url;?>/images/dir_up.gif" border="0" alt="Directory Up" width="20" height="20" /><?php echo $cmnhelp['interface_updir'];?></p>
            <p><img class="help_icon" src="<?php echo $lib_url;?>/images/new_folder.gif" alt="New Folder" width="20" height="20" /><?php echo $cmnhelp['interface_newdir'];?></p>
            <p><img class="help_icon" src="<?php echo $lib_url;?>/images/upload.gif" border="0" alt="Upload" title="Upload" width="20" height="20" /><?php echo $cmnhelp['interface_upload'];?></p>
            <p><img src="<?php echo $fm_url;?>/docs/images/<?php echo $lang;?>/upload.jpg" /></p>
           <p><img class="help_icon" src="<?php echo $lib_url;?>/images/help.gif" border="0" alt="Help" title="Help" width="20" height="20" /><?php echo $cmnhelp['interface_help'];?></p>
            <p><img class="help_icon" src="<?php echo $lib_url;?>/images/rename.gif" alt="Rename" title="Rename" width="20" height="20" /><?php echo $cmnhelp['interface_rename'];?></p>
            <p><img class="help_icon" src="<?php echo $lib_url;?>/images/delete.gif" border="0" alt="Delete" width="20" height="20" /><?php echo $cmnhelp['interface_delete'];?></p>
            <p><img class="help_icon" src="<?php echo $tiny_url;?>/themes/advanced/images/copy.gif" border="0" alt="Copy" width="20" height="20" /><?php echo $cmnhelp['interface_copy'];?></p>
            <p><img class="help_icon" src="<?php echo $tiny_url;?>/themes/advanced/images/cut.gif" border="0" alt="Cut" width="20" height="20" /><?php echo $cmnhelp['interface_cut'];?></p>
            <p><img class="help_icon" src="<?php echo $tiny_url;?>/themes/advanced/images/paste.gif" border="0" alt="Paste" width="20" height="20" /><?php echo $cmnhelp['interface_paste'];?></p>
            <p><img class="help_icon" src="<?php echo $lib_url;?>/images/view.gif" border="0" alt="View" width="20" height="20" /><?php echo $cmnhelp['interface_view'];?></p>
        </td>
    </tr>
    <tr>
        <td>
            <p class="help_subtitle"><?php echo $fmhelp['interface_info'];?></p>
            <p><?php echo $fmhelp['interface_info_desc'];?></p>
    </tr>
    <tr>
        <td>
        <img src="<?php echo $fm_url;?>/docs/images/<?php echo $lang;?>/fm_layout.jpg" />
        </td>
    </tr>
</table>
<?php $tabs->endTab();?>
<?php $tabs->startTab($cmnhelp['insert'],"insert-tab");?>
<table>
    <tr>
        <td>
            <p class="help_subtitle"><?php echo $fmhelp['insert_file'];?></p>
            <p><?php echo $fmhelp['insert_file_desc1'];?></p>
            <p><img src="<?php echo $fm_url;?>/docs/images/<?php echo $lang;?>/fm_insert1.jpg" /></p>
            <p><?php echo $fmhelp['insert_file_desc2'];?></p>
            <p><img src="<?php echo $fm_url;?>/docs/images/<?php echo $lang;?>/fm_insert2.jpg" /></p>
            <ul>
                <li><?php echo $fmhelp['insert_icon'];?></li>
                <li><?php echo $fmhelp['insert_date'];?></li>
                <li><?php echo $fmhelp['insert_size'];?></li>
            </ul>
                </em></p>
            <p><?php echo $fmhelp['insert_file_desc3'];?></p>
        </td>
    </tr>
</table>
<?php $tabs->endTab();?>
<?php $tabs->endPane();?>
