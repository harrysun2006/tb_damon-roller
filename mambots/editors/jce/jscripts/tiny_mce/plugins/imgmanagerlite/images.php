<?php
/**
 * Show a list of images and folders.
 * @author $Author: Ryan Demmer $
 * @version $Id: images.php 27 2006-03-06 10:09:59Z Ryan Demmer $
 * @package ImageManager
 */
defined( '_VALID_MOS' ) or die( 'Restricted Access.' );

$im_version = "1.0.0";

global $mosConfig_absolute_path, $mosConfig_live_site, $database, $my;

require_once( $mosConfig_absolute_path."/administrator/components/com_jce/plugins/plugins.class.php" );

// load Image Manager info
$query = "SELECT id"
. "\n FROM #__jce_plugins"
. "\n WHERE plugin = 'imgmanagerlite' LIMIT 1"
;
$database->setQuery( $query );
$id = $database->loadResult();
$plugin = new jcePlugins( $database );
$plugin->load( $id );
$params = new mosParameters( $plugin->params );

$tiny_path  = $mosConfig_absolute_path."/mambots/editors/jce/jscripts/tiny_mce";
$tiny_url   = $mosConfig_live_site."/mambots/editors/jce/jscripts/tiny_mce";
$im_path    = $tiny_path."/plugins/imgmanagerlite";
$im_url     = $tiny_url."/plugins/imgmanagerlite";
$lib_url    = $tiny_url."/libraries";
$lib_path   = $tiny_path."/libraries";

require_once( $tiny_path.'/auth_jce.php' );
$imAuth = new authJCE();


//Setup languages
$database->setQuery( "SELECT lang FROM #__jce_langs WHERE published= '1'" );
$lang = $database->loadResult();

include_once ( $lib_path."/langs/$lang.php" );

if( file_exists( $im_path."/langs/$lang.php" ) ){
    include_once ( $im_path."/langs/$lang.php" );
}else{
    include_once ( $im_path."/langs/en.php" );
}

require_once ( $lib_path."/classes/jce.class.php" );
include_once ( $im_path."/classes/manager.class.php" );;

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
$dir_type       = $params->get( 'dir_type', 'level' );
$user_dir       = $params->get( 'user_dir', '0' );
$user_dir_level = $params->get( 'user_dir_level', '18' );

//Setup directory access based on above settings
if( $user_dir && $imAuth->id < $user_dir_level ){
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

//Check to see if the returned file is within the standard directory tree
if( !JFolder::exists( JPath::makePath( JPath::makePath( $mosConfig_absolute_path, $base_dir ), str_replace( $mosConfig_live_site, '', $curr_dir ) ) ) && $ret_file ){
    //If not, set $ret_file to false (even if there is one) and reset $curr_dir.
    $ret_file = false;
    $curr_dir = '/';
}
//End User Directory Restrictions
$manager = new ImageManager( $base_dir, $base_url );
//If a returned file exists, create the path to the current dir
if( $ret_file ){
    $ret_file = JPath::makePath( $curr_dir, $ret_file );
}
//process file actions
$opt = mosGetParam( $_REQUEST, 'opt' );
switch( $opt ){
    case 'new_folder':
        $new_dir    = mosGetParam( $_REQUEST, 'newd' );
        $error      = JFolder::newFolder( $manager->getBaseDir(), $curr_dir, $new_dir );
    break;
    case 'del_folder':
        $folder = mosGetParam( $_REQUEST, 'deld' );
        $error  = $manager->deleteFolder( $folder );
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
$im_mode = mosGetParam( $_REQUEST, 'mode', $params->get( 'mode', 'list' ) );
$filter = '\.(jpg|jpeg|gif|png)$';
$ext_arr = array('jpg', 'jpeg', 'gif', 'png');
//Upload action
$upload_file = mosGetParam( $_FILES, 'upload', false );
if( $upload_file ){
    $curr_dir = rawurldecode( mosGetParam( $_POST, 'dirPath' ) );
    $overwrite = mosGetParam( $_POST, 'overwrite' );
    $unique = mosGetParam( $_POST, 'unique' );
    $error = $manager->doUpload( $curr_dir, $upload_file, $ext_arr, $overwrite, $unique );
    $im_mode = mosGetParam( $_POST, 'viewMode' );
}
//End File Actions
$img_list = $manager->getFiles( $curr_dir, $filter );
$dir_list = $manager->getFolders( $curr_dir );

/**
 * Draw the files.
 */
function drawImages( $img_list, $manager )
{
        global $mosConfig_live_site, $mosConfig_absolute_path, $relative, $imlang, $im_url;
        foreach( $img_list as $file )
        {
                $dim = @getimagesize( $file['fullpath'] );
                $file['width'] = $dim[0];
                $file['height'] = $dim[1];

                $image_url = $file['relative_url'];

                $prev_width = "45";
                $prev_height = "45";

                $ext = strtolower( $file['ext'] );
                $name = $file['short_name'];
                if( strlen( $name ) > 20 ){
                    $shrtname = substr( $name, 0, 40 ).'...';
                }else{
                    $shrtname = $name;
                }
                $ext_list = array('jpg', 'jpeg', 'bmp', 'gif', 'png');
                if ( !in_array( $ext, $ext_list ) ) $ext = 'def';
                if ( $ext == 'jpeg' ) $ext = 'jpg';

                $ext_img = $im_url.'/images/'.$ext.'.gif';
                
                ?>
                <li value="<?php echo $file['relative'];?>,<?php echo $file['relative_url'];?>,<?php echo $file['short_name'];?>,<?php echo $ext;?>,<?php echo $file['width'];?>,<?php echo $file['height']; ?>,<?php echo $file['size']; ?>,<?php echo $file['date']; ?>">
                    <img src="<?php echo $ext_img;?>" alt="<?php echo $ext; ?>" height="16" width="16" style="vertical-align:middle;" />
                    <a href="javascript:selectImage('<?php echo $file['fullurl'];?>','<?php echo $name; ?>','<?php echo $file['width'];?>','<?php echo $file['height']; ?>');" title="<?php echo $name; ?> - <?php echo $file['size']; ?>"><?php echo $shrtname.'.'.$ext ?></a>
                </li>
          <?php
        }//foreach
}//function drawFiles

/**
 * Draw the directory.
 */
function drawDirs( $dir_list, &$manager )
{
        global $im_url, $lib_url, $cmnlang, $im_mode;
        foreach($dir_list as $dir)
        {
            $fullpath = JPath::makePath( $manager->getBaseDir(), $dir['relative'] );
            $num_files = JFile::countFiles( $fullpath );
            $num_folders = JFolder::countDirs( $fullpath );

          ?>
                <li value="<?php echo $dir['relative'];?>,<?php echo $dir['name']; ?>,<?php echo $dir['date']; ?>,<?php echo $num_files;?>,<?php echo $num_folders;?>">
                    <img src="<?php echo $lib_url;?>/images/folder.gif" title="<?php echo $cmnlang['folder']; ?>" alt="<?php echo $cmnlang['folder'];?>" height="18" width="18" style="vertical-align:middle;" />
                    <a href="index2.php?option=com_jce&no_html=1&task=plugin&plugin=imgmanager&file=images.php&dir=<?php echo rawurlencode($dir['relative']);?>&mode=<?php echo $im_mode;?>" onclick="showMessage(topDoc, 'Loading', 'load', 'msg');" title="<?php echo $dir['name']; ?>"><?php echo $dir['name']; ?></a>
                </li>
          <?php
        } //foreach
}//function drawDirs

/**
 * No directories and no files.
 */
function noImages()
{
    global $imlang;
?>
<div class="noResult"><?php echo $imlang['no_images']; ?></div>
<?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<title>Image List</title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $imlang['iso'];?>" />
<script type="text/javascript" src="<?php echo $lib_url;?>/jscripts/common.js"></script>
<script type="text/javascript" src="<?php echo $im_url;?>/jscripts/images.js"></script>
<script type="text/javascript" src="<?php echo $lib_url;?>/jscripts/selectableelements.js"></script>
<script type="text/javascript" src="<?php echo $lib_url;?>/jscripts/selectablelistitems.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/utils/form_utils.js"></script>
<link href="<?php echo $im_url;?>/css/images.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $lib_url;?>/css/common.css" rel="stylesheet" type="text/css" />
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
        var im_url = "<?php echo $im_url;?>";
        var lib_url = "<?php echo $lib_url;?>";
        var hostURL = "<?php echo $mosConfig_live_site;?>";
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
            var txt = "<?php echo $imlang['select_text1'];?>";
        	showMessage( topDoc, txt, 'tip', 'msg' );
            <?php
                $dirs = $manager->getDirs();
            ?>
                var html = '';
        		html += '<select class="dirWidth" id="dirPath" name="dirPath" onchange="updateDir(this)">';
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
        <?php if( count( $dir_list ) > 0 ) drawDirs( $dir_list, $manager ); ?>
    </ul>
</div>
<div id="imgDiv">
<?php
if( count( $img_list ) > 0 ){?>
    <ul id="imgList">
        <?php drawImages( $img_list, $manager );?>
    </ul>
<?php }else{
    noImages();
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
          sf.setItemSelected(fitems2[j], false);
          sf._selectedItems = [];
        }

        if(i == 1 )
        {
          showImage('single', i, textArr[0], textArr[1], textArr[2], textArr[3], textArr[4], textArr[5], textArr[6], textArr[7], textArr[8]);
          iconState('on', 'single');
        }else{
          showImage('multiple',i,'','','','','','','','','','');
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
          se.setItemSelected(items2[y], false);
          se._selectedItems = [];
        }

        parent.document.getElementById("dirList").value = ftext;
        showFolder(ftextArr[1], ftextArr[2], ftextArr[3], ftextArr[4], ftextArr[5]);
    };
    </script>
</body>
</html>
