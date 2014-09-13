<?php
/*
 * Created on 2006-9-4
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 	define( '_VALID_MOS','cn' );
 	require_once( 'class_pd.php' );
 	require_once( '../language/simplified_chinese.php');
 	$test = new Mospage();
 	$in_text2 = '{mospagebreak title=win-ning}ttt{mospagebreak title=wintong}translation {mospagebreak title=damon} support';
 	$test->parse_text($in_text2,2);
 	print($test->nav_menu);
 	print($test->main_text);
 	
 	
?>
