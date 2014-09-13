<?php
defined( '_VALID_MOS' ) or die( 'Restricted access' );
// needed to seperate the ISO number from the language file constant _ISO
$iso = explode( '=', _ISO );
// xml prolog
echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<?php mosShowHead(); ?>
<?php
if ( $my->id ) {
	initEditor();
}
?>


<link href="templates/damon/css/template_css.css" rel="stylesheet" type="text/css" />
</head>
<body>




<table width="1004" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td height="73"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="30">&nbsp;</td>
        <td ><img src="templates/damon/images/logo.jpg"  /></td>


        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right"><?php mosLoadModules( 'user3', 2 );?></td>
          </tr>
          <tr>
            <td align="right"><?php mosLoadModules( 'user4', 2 );?></td>
          </tr>
        </table></td>
      </tr>
    </table>	</td>
  </tr>


<?php	if($option == com_frontpage ){?>
<tr>
    <td height="2" bgcolor="#000000"></td>
</tr>
  <tr>
    <td >	
<table width="1004" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><a href="#"><img src="images/stories/randomflash/flash.gif" hspace="0" vspace="0" border="0" width="774" height="164"></a></td>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><a href="index.php?option=com_content&task=view&id=13"><img src="images/stories/random1/random1.gif" hspace="0" vspace="0" border="0" width="230" height="82"></a></td>
      </tr>
      <tr>
        <td><a href="index.php?option=com_content&task=view&id=14"><img src="images/stories/random2/random2.gif" hspace="0" vspace="0" border="0" width="230" height="82"></a></td>
      </tr>
    </table></td>
  </tr>
</table>
</td>
  </tr>
<?php }?>
 <tr>
	<td height="2" bgcolor="#E8E8E8"></td>
</tr> 
<tr>
    <td height="20" bgcolor="#00194C"><?php mosLoadModules( 'top', -2 );?></td>
  </tr>
 <tr>
	<td height="2" bgcolor="#828282"></td>
</tr> 
  <tr>
    <td><table width="100%" height="400" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="199" valign="top" bgcolor="#F9F9F9" id="main_left_td">
		    <div class="pathway">
			<?php mospathway() ?>
			</div>
			<?php mosLoadModules( 'left', 2 );?>
<br>
<a href="index.php?option=com_content&task=view&id=27"><img src="templates/damon/images/contact_us.jpg" hspace="10" vspace="0" border="0"></a>
<br>
<div class="pathway"><a href="mailto:zhoubinghua@damon-group.com ">zhoubinghua@damon-group.com </a>
</div>
<br>
<div style="height:40px"></div>
	</td>
        <td valign="top" id="main_right_td" > 
		
<?php	if($option == com_frontpage ){?>	
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
       <td width="1" bgcolor="#7F7F7F" ></td>
    <td height="9"  background="templates/damon/images/pd_spec_bg.gif"></td>
	<td width="1" bgcolor="#7F7F7F" ></td>
    </tr>
  <tr>
    <td width="1" bgcolor="#7F7F7F" ></td>
    <td><?php mosLoadModules( 'user6', 2 );?></td>
    <td width="1" bgcolor="#7F7F7F" ></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#7F7F7F" height="1"></td>
    </tr>
  <tr>
    <td colspan="3" height="10"></td>
    </tr>
</table>
			
 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td  width="375"> 
		<?php mosLoadModules( 'user7', 2 );?>

		<img src="templates/damon/images/lnews_bottom.gif" width="375" height="10" />
	</td>
	<td>&nbsp;</td>
			<td  width="375">
			<?php mosLoadModules( 'user8', 2 );?>
			<a href="#"><img src="templates/damon/images/lnews_bottom.gif" width="375" height="10" vspace="0" border="0" /></a>
		</td>
  </tr>
<tr>
    <td colspan="3" height="10"></td>
    </tr>
</table>
<?php }?>
		 <?php
				if( ereg(_EMPTY_BLOG,$GLOBALS['_MOS_OPTION']['buffer']) == FALSE ) {
					 mosMainBody(); 
				}
		?>

		</td>
      </tr>
    </table></td>
  </tr>
  
  <tr>
    <td height="30" bgcolor="#EEEFEF"><?php mosLoadModules( 'footer', 2 );?></td>
  </tr>
  <tr>
    <td bgcolor="#00154C" height="1"></td>
  </tr>
  <tr>
    <td height="30" bgcolor="#EEEFEF"><?php mosLoadModules( 'bottom', 2 );?></td>
  </tr>
 
</table>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript"> 
_uacct = "UA-2303884-1";
urchinTracker();
</script>
</body>
</html>