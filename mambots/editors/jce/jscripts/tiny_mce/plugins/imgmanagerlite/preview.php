<?php

defined( '_VALID_MOS' ) or die( 'Restricted Access.' );

$im_version = "1.0.0";

global $mosConfig_absolute_path, $mosConfig_live_site, $database, $my;

$tiny_path = $mosConfig_absolute_path."/mambots/editors/jce/jscripts/tiny_mce";
$tiny_url = $mosConfig_live_site."/mambots/editors/jce/jscripts/tiny_mce";
$im_path = $tiny_path."/plugins/imgmanager";
$im_url = $tiny_url."/plugins/imgmanager";

$img = mosGetParam( $_REQUEST, 'img', '' );
$type = mosGetParam( $_REQUEST, 'type', 'jpeg' );

if($img)
{
    $src = $im_url.'/classes/phpthumb/phpThumb.php/q=50;far=1;bg=ffffff;120x120;'.$img.'';
}else{
  $src = $im_url.'/images/spacer.gif';
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Preview</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<div align="center" style="vertical-align:top; text-align:center;">
    <img src="<?php echo $src; ?>" width="120" height="120" alt="Preview" title="Preview" /></td>
</div>
</body>
</html>
