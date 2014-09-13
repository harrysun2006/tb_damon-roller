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
<script type="text/javascript" src="templates/damon-storage/corner.js"></script>
<?php
if ( $my->id ) {
	initEditor();
}
?>


<link href="templates/damon-storage/css/template_css.css" rel="stylesheet" type="text/css" />

</head>
<body>


<table width="1004" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="73"><table width="100%"  height="109"  border="0" cellpadding="0" cellspacing="0" bgcolor="#080C28">
      <tr>
        <td width="35">&nbsp;</td>
        <td width="442" ><img src="templates/damon-storage/images/logo.jpg"  /></td>


        <td width="527" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="78" align="left" valign="top">
			<table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><img src="templates/damon-storage/images/topmu_left.jpg" /></td>
    <td><?php mosLoadModules( 'top', 0 );?></td>
    <td valign="top"><img src="templates/damon-storage/images/topmu_right.jpg" /></td>
  </tr>
</table>			</td>
          </tr>
          <tr>
            <td align="right"><?php mosLoadModules( 'user4', 2 );?></td>
          </tr>
        </table></td>
      </tr>
    </table>	</td>
  </tr>
  <tr>
       <td>
			<table width="1004" height="16" border="0" cellpadding="0" cellspacing="0" background="templates/damon-storage/images/banner_line.jpg">
		  <tr>
			<td background="templates/damon-storage/images/banner_line.jpg"></td>
			</tr>
		</table>	</td>
  </tr>

  <tr>
    <td><table width="100%" height="400" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td valign="top" >
		    
			<table  border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td colspan="3" ><img src="templates/damon-storage/images/left_top.jpg" width="250" height="25" /></td>
              </tr>
              <tr>
                <td width="55" class="left_left"><img src="templates/damon-storage/images/left_left.jpg" width="55" height="4" /></td>
                <td width="187" valign="top" bgcolor="#00AA79" >
                  <?php mosLoadModules( 'left', 2 );?>
				  
                </td>
                <td  width="8" class="left_right"><img src="templates/damon-storage/images/left_right.jpg" width="8" height="4" /></td>
              </tr>
              <tr>
                <td colspan="3"><img src="templates/damon-storage/images/left_bottom.jpg" width="250" height="22" /></td>
              </tr>
			    <tr>
                <td colspan="3" align="center" height="25"><script language="javascript" src="http://www1.cs800.com/server/server.aspx?serid=roller_damon"></script></td>
              </tr>
            </table>          
			</td>
        <td align="left" valign="top" id="main_right_td" > 


		
<?php	if($option == com_frontpage ){?>	
	


	<table width="610" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td colspan="3" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="610" height="200">
          <param name="movie" value="templates/damon-storage/images/1.swf" />
          <param name="quality" value="high" />
          <embed src="templates/damon-storage/images/1.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="610" height="200"></embed>
        </object></td>
      </tr>
      <tr>
        <td><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="610" height="200">
          <param name="movie" value="templates/damon-storage/images/2.swf" />
          <param name="quality" value="high" />
          <embed src="templates/damon-storage/images/2.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="610" height="200"></embed>
        </object></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    </tr>
	<tr>
    <td colspan="3" height="3"></td>
    </tr>
  <tr>
    <td align="left"><img src="templates/damon-storage/images/view1.jpg" width="200" /></td>
    <td align="center"><img src="templates/damon-storage/images/view2.jpg" width="200"   /></td>
    <td align="right"><img src="templates/damon-storage/images/view3.jpg" width="200"  /></td>
  </tr>
</table>
	
<?php }?>
		 <?php
				if( ereg(_EMPTY_BLOG,$GLOBALS['_MOS_OPTION']['buffer']) == FALSE ) {
					 mosMainBody(); 
				}
		?>		</td>
      </tr>
    </table>	</td>
  </tr>
<?php	if($option == com_frontpage ){?>	  
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<table width="976" border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td width="52">&nbsp;</td>
	<td width="296" valign="top" ><?php mosLoadModules( 'user6', 2 );?></td>
	<td width="18">&nbsp;</td>
    <td width="296" valign="top"><?php mosLoadModules( 'user7', 2 );?></td>
	<td width="18">&nbsp;</td>
    <td width="296" valign="top"><?php mosLoadModules( 'user8', 2 );?></td>
  </tr>
</table>	</td>
  </tr>  
<?php }?>  
   <tr>
    <td height="25" >&nbsp;</td>
  </tr>
  <tr>
    <td height="30" align="center" bgcolor="#AFAFAF"><?php mosLoadModules( 'bottom', 2 );?></td>
  </tr>
  
  <tr>
    <td height="30" >&nbsp;</td>
  </tr>
</table>

</body>
</html>