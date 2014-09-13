<?php
defined( '_VALID_MOS' ) or die( 'Restricted Access.' );
global $mosConfig_absolute_path, $mosConfig_live_site, $database, $my;

$tiny_path = $mosConfig_absolute_path."/mambots/editors/jce/jscripts/tiny_mce";
$tiny_url = $mosConfig_live_site."/mambots/editors/jce/jscripts/tiny_mce";
$im_path = $tiny_path."/plugins/imgmanager";
$im_url = $tiny_url."/plugins/imgmanager";
$lib_url = $tiny_url."/libraries";
$lib_path = $tiny_path."/libraries";

$img_title = mosGetParam( $_REQUEST, 'a', '' );
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title><?php echo $img_title; ?></title>
	<style type="text/css">
    body {
          font-family: Verdana, Helvetica, Arial, Sans-Serif;
          font: message-box;
        }
    </style>
    <script language="Javascript">
	<!--
	// http://www.xs4all.nl/~ppk/js/winprop.html
	function CrossBrowserResizeInnerWindowTo(newWidth, newHeight) {
		if (self.innerWidth) {
			frameWidth  = self.innerWidth;
			frameHeight = self.innerHeight;
		} else if (document.documentElement && document.documentElement.clientWidth) {
			frameWidth  = document.documentElement.clientWidth;
			frameHeight = document.documentElement.clientHeight;
		} else if (document.body) {
			frameWidth  = document.body.clientWidth;
			frameHeight = document.body.clientHeight;
		} else {
			return false;
		}
		if (document.layers) {
			newWidth  -= (parent.outerWidth - parent.innerWidth);
			newHeight -= (parent.outerHeight - parent.innerHeight);
		}
		// original code
		//parent.window.resizeTo(newWidth, newHeight);

		// fixed code: James Heinrich, 20 Feb 2004
		parent.window.resizeBy(newWidth - frameWidth, newHeight - frameHeight);

		return true;
	}
	// -->
	</script>
</head>
<body style="margin: 0px;">
<?php
$image_src = mosGetParam( $_REQUEST, 'img', '' );
$image_size = mosGetParam( $_REQUEST, 's', '' );
$imgw = mosGetParam( $_REQUEST, 'w', '' );
$imgh = mosGetParam( $_REQUEST, 'h', '' );

	echo '<script language="Javascript">'."\n";
	echo 'CrossBrowserResizeInnerWindowTo('.$imgw.', '.$imgh.');'."\n";
	echo 'document.writeln(\'<div align="center" style="vertical-align:middle;"><img onclick="window.close();" src="'.$image_src.'" title="'.$img_title.'" alt="'.$img_title.'" width="'.$imgw.'" height="'.$imgh.'" border="0" style="cursor: pointer;" /></div>\');';
	echo '</script>';
?>
</body>
</html>
