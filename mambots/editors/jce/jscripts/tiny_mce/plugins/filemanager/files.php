<?php
/**
 * Show a list of files.
 * @author $Author: Ryan Demmer $
 * @version $Id: files.php 27 2006-03-06 10:25:57Z Ryan Demmer $
 * @package FileManager
 */
defined( '_VALID_MOS' ) or die( 'Restricted Access.' );

$fm_version = "1.0.2";

global $mosConfig_absolute_path, $mosConfig_live_site, $database, $my;

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

//Setup paths
$tiny_path = $mosConfig_absolute_path."/mambots/editors/jce/jscripts/tiny_mce";
$tiny_url = $mosConfig_live_site."/mambots/editors/jce/jscripts/tiny_mce";
$fm_path = $tiny_path."/plugins/filemanager";
$fm_url = $tiny_url."/plugins/filemanager";
$lib_url = $tiny_url."/libraries";
$lib_path = $tiny_path."/libraries";

require_once( $tiny_path.'/auth_jce.php' );

//Create new Authorisation instance
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

//Load Classes
require_once ( $lib_path."/classes/jce.class.php" );
include_once ( $fm_path."/classes/manager.class.php" );

/*Get variables
 *param $curr_dir The relative path passed
 *param $ret_file The relative file returned from the editor
*/
$curr_dir = rawurldecode( mosGetParam( $_REQUEST, 'dir', '/' ) );
$ret_file = mosGetParam( $_REQUEST, 'ret_file', false );

//User Directory Restrictions
//Get base directory and base url from config setings
$base_dir = $params->get( 'dir', '/images/stories' );
$base_url = $params->get( 'url', '/images/stories' );

//Get restriction settings from config
$dir_type = $params->get( 'dir_type', 'level' );
$user_dir = $params->get( 'user_dir', '0' );
$user_dir_level = $params->get( 'user_dir_level', '18' );

//Setup directory access based on above settings
if( $user_dir && $fmAuth->id < $user_dir_level ){
    $base_dir = JCEUtils::userDir( $base_dir, $dir_type, $my->usertype, $my->username );
    $base_url = $base_dir;

    $curr_dir = str_replace( $mosConfig_live_site, '', $curr_dir );

    //Check to see if the returned file is within the users allowed directory tree
    if( !JFolder::exists( JPath::makePath( JPath::makePath( $mosConfig_absolute_path, $base_dir ), $curr_dir ) ) && $ret_file ){
        //If not, set $ret_file to false (even if there is one) and reset $curr_dir.
        $ret_file = false;
        $curr_dir = '/';
    }
}
//End User Directory Restrictions
$manager = new FileManager( $base_dir, $base_url );

//If a returned file exists, create the path to the current dir
if( $ret_file ){
    $ret_file = JPath::makePath( $curr_dir, $ret_file );
}
//Setup allowed extensions and file size settings
$ext_list = $params->get( 'ext', 'html,htm,doc,xls,txt,gif,jpeg,jpg,png,pdf,zip,swf,rar,tar,gz,mov,wmv,wav' );
$filter = '\.('.str_replace( ',', '|', $ext_list ).')$';
$view_files = $params->get( 'view', 'html,htm,doc,xls,txt,gif,jpeg,jpg,png,pdf,swf,mov,wmv,wav' );
$max_size = intval( $params->get( 'size', '2' ) )*1024*1024;

//process file actions
$opt = mosGetParam( $_REQUEST, 'opt' );
switch( $opt ){
    case 'new_folder':
        $new_dir = mosGetParam( $_REQUEST, 'newd' );
        $error = JFolder::newFolder( $manager->getBaseDir(), $curr_dir, $new_dir );
    break;
    case 'del_folder':
        $folder = mosGetParam( $_REQUEST, 'deld' );
        $error = $manager->deleteFolder( $folder );
    break;
    case 'del_file':
        $files = mosGetParam( $_REQUEST, 'delf' );
        $error = $manager->deleteFiles( $files );
    break;
    case 'copy_file':
        $copy_file = mosGetParam( $_REQUEST, 'copyf' );
        $dest = mosGetParam( $_REQUEST, 'dest' );
        $error = $manager->copy( $copy_file, $dest );
    break;
    case 'move_file':
        $move_file = mosGetParam( $_REQUEST, 'movef' );
        $dest = mosGetParam( $_REQUEST, 'dest' );
        $error = $manager->move( $move_file, $dest );
    break;
    case 'rename_file':
        $ren_file = mosGetParam( $_REQUEST, 'renf' );
        $new_file = mosGetParam( $_REQUEST, 'newf' );
        $error = $manager->renameFile( $ren_file, $new_file );
    break;
    case 'rename_folder':
        $ren_dir = mosGetParam( $_REQUEST, 'rend' );
        $new_dir = mosGetParam( $_REQUEST, 'newd' );
        $error = $manager->renameDir( $ren_dir, $new_dir );
    break;
    default:
        $error = false;
    break;
}
//Process uploads
$upload_file = mosGetParam( $_FILES, 'upload', false );
if( $upload_file ){
    $curr_dir = rawurldecode( mosGetParam( $_POST, 'dirPath' ) );
    $overwrite = mosGetParam( $_POST, 'overwrite' );
    $unique = mosGetParam( $_POST, 'unique' );
    $curr_dir = rawurldecode( mosGetParam( $_POST, 'dirPath' ) );
    $error = $manager->doUpload( $curr_dir, $upload_file, $ext_list, $max_size, $overwrite, $unique );
}
//Get the files and directories
$file_list = $manager->getFiles( $curr_dir, $filter );
$dir_list = $manager->getFolders( $curr_dir );

//Draw the file list
function drawFiles( $file_list, $manager )
{
        global $relative, $lang, $fm_url, $fm_path, $ext_list;
        foreach( $file_list as $file )
        {              
                //Don't display index.html
                if( strtolower( $file['short_name'] ).'.'.strtolower( $file['ext'] ) == 'index.html' )
                    continue;

                $file_url = $file['relative_url'];
                $ext = strtolower( $file['ext'] );
                $name = $file['short_name'];
                $shrtname = substr($name, 0, 50);
                $extlist = explode( ',', $ext_list );
                if ( $ext == 'jpeg' ) $ext = 'jpg';
               
                $file_ext = ( JFile::exists( $fm_path.'/images/ext/'.$ext.'_small.gif' ) ) ? $fm_url.'/images/ext/'.$ext.'_small.gif' : $fm_url.'/images/ext/def_small.gif';
                
        		?>
                <li value="<?php echo $file['relative'];?>,<?php echo $file['relative_url'];?>,<?php echo $file['short_name'];?>,<?php echo $ext;?>,<?php echo $file['size'];?>,<?php echo $file['date'];?>">
                    <img src="<?php echo $file_ext;?>" alt="<?php echo $ext; ?>" height="16" width="16" style="vertical-align:middle;" />
                    <a href="javascript:selectFile('<?php echo $file['fullurl'];?>','<?php echo $name; ?>','<?php echo $file['size'];?>','<?php echo $file['date'];?>','<?php echo $ext;?>');" title="<?php echo $name;?> - <?php echo $file['size'];?>"><?php echo $name.'.'.$ext;?></a>
                </li>
        <?php }
}
//Draw the directory list
function drawDirs( $dir_list, &$manager )
{
        global $fm_url, $lib_url, $cmnlang, $filter;
        foreach( $dir_list as $dir )
        {

            $fullpath = JPath::makePath( $manager->getBaseDir(), $dir['relative'] );
            $num_files = JFile::countFiles( $fullpath, $filter );
            $num_folders = JFolder::countDirs( $fullpath );
          ?>
                <li value="<?php echo $dir['relative'];?>,<?php echo $dir['name'];?>,<?php echo $dir['date'];?>,<?php echo $num_files;?>,<?php echo $num_folders;?>">
                    <img src="<?php echo $lib_url;?>/images/folder.gif" title="<?php echo $cmnlang['folder']; ?>" alt="<?php echo $cmnlang['folder'];?>" height="18" width="18" style="vertical-align:middle;" />
                    <a href="index2.php?option=com_jce&no_html=1&task=plugin&plugin=filemanager&file=files.php&dir=<?php echo rawurlencode($dir['relative']); ?>" onclick="showMessage(topDoc, 'Loading', 'load', 'msg');" title="<?php echo $dir['name']; ?>"><?php echo $dir['name']; ?></a>
                </li>
          <?php
        } 
}
//No result - no files found
function noFiles()
{
    global $fmlang;?>
    <div class="noResult">
        <?php echo $fmlang['no_files']; ?>
    </div>
<?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<title><?php echo $fmlang['file_list'];?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $cmnlang['iso'];?>" />
<script type="text/javascript" src="<?php echo $fm_url;?>/jscripts/files.js"></script>
<script type="text/javascript" src="<?php echo $lib_url;?>/jscripts/selectableelements.js"></script>
<script type="text/javascript" src="<?php echo $lib_url;?>/jscripts/selectablelistitems.js"></script>
<script type="text/javascript" src="<?php echo $lib_url;?>/jscripts/common.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/utils/form_utils.js"></script>
<link href="<?php echo $lib_url;?>/css/common.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $fm_url;?>/css/files.css" rel="stylesheet" type="text/css" />
<style type="text/css">
div#imgDiv li {
    margin: 0px;
    padding: 4px;
    display: block;
    font-size: 9pt;
    font-family: "MS Sans Serif", Geneva, sans-serif;
    color:#000000;
}
</style>

<script type="text/javascript">
/*<![CDATA[*/
        var im_url = "<?php echo $fm_url;?>";
        var lib_url = "<?php echo $lib_url;?>";
        var hostURL = "<?php echo $mosConfig_live_site;?>";
        var view_files = "<?php echo $view_files;?>";
        var lang = new Array();
            lang['file'] = "<?php echo $cmnlang['file'];?>";
            lang['size'] = "<?php echo $cmnlang['size'];?>";
            lang['modified'] = "<?php echo $cmnlang['modified'];?>";
            lang['folder'] = "<?php echo $cmnlang['folder'];?>";
            lang['files'] = "<?php echo $cmnlang['files'];?>";
            lang['folders'] = "<?php echo $cmnlang['folders'];?>";
        var topDoc = parent.document;
        
        function init()
        {
            var txt = "<?php echo $fmlang['select_text'];?>";
        	showMessage( topDoc, txt, 'tip', 'msg' );
            <?php
                $dirs = $manager->getDirs();
            ?>
                var html = '';
        		html += '<select class="dirWidth" name="dirPath" id="dirPath" onchange="updateDir(this)">';
        		html += '<option value="/">/</option>';
        		<?php foreach( $dirs as $dir )
    		        {
                    $sel = ( $curr_dir == $dir ) ? ' selected="selected"' : '';
                    ?>
            		html += '<option value="<?php echo rawurlencode($dir);?>"<?php echo $sel;?>><?php echo $dir;?></option>';
            		<?php }?>
        		html += '</select>';
        		parent.document.getElementById('dirlistcontainer').innerHTML = html;
            <?php
            if( $error ){?>
                var error = "<?php echo $error;?>";
                showMessage( topDoc, error, 'error', 'error' );
            <?php }
            if( $ret_file ){?>
                setReturnFile( '<?php echo $ret_file;?>' );
            <?php }?>
        }
/*]]>*/
</script>
</head>
<body style="background-color:#FFFFFF" onload="init();">
<div id="dirDiv" width="270">
    <ul>
<?php if( count( $dir_list ) > 0 ){?>
            <?php drawDirs( $dir_list, $manager );?>
<?php }?>
    </ul>
</div>
<div id="imgDiv">
<?php if( count( $file_list ) > 0 ){?>
        <ul id="fileList">
            <?php drawFiles( $file_list, $manager );?>
        </ul>
<?php
}else{
    noFiles();
}?>
</div>
    <script type="text/javascript">
    var se = new SelectableListItems(document.getElementById("imgDiv"), true);
    se.onchange = function () {
        var items = se.getSelectedItems();
        var text = [];
        for (var i=0; i< items.length; i++) {
          text[i] = items[i].getAttribute("value").toString();
          var textArr = text[i].split(',');
          text[i] = textArr[0];
        }
        var fitems2 = sf.getSelectedItems();
        for (var j=0; j<fitems2.length; j++){
          sf.setItemSelectedUi(fitems2[j], false);
          sf._selectedItems = [];
        }

        if(i <=1 )
        {
          showFile('single', i, textArr[0], textArr[1], textArr[2], textArr[3], textArr[4], textArr[5], textArr[6]);
          iconState('on', 'single');
        }else{
          showFile('multiple',i,'','','','','','');
          iconState('on', 'multiple');
        }
        parent.document.getElementById("imgList").value = text;
    };

    var sf = new SelectableListItems(document.getElementById("dirDiv"), false);
    sf.onchange = function () {
        var fitems = sf.getSelectedItems();
        var ftext = [];
        for (var x=0; x< fitems.length; x++) {
          ftext[x] = fitems[x].getAttribute("value").toString();
          var ftextArr = ftext[x].split(',');
          ftext[x] = ftextArr[0];
        }
        var items2 = se.getSelectedItems();
        for (var y=0; y<items2.length; y++){
          se.setItemSelectedUi(items2[y], false);
          se._selectedItems = [];
        }

        parent.document.getElementById("dirList").value = ftext;
        showFolder(ftextArr[1], ftextArr[2], ftextArr[3], ftextArr[4], ftextArr[5]);
    };
    </script>
</body>
</html>
