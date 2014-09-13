<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
/**
*
* @version $Id: shop.index.php,v 1.5.2.1 2006/03/14 18:42:23 soeren_nb Exp $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
require_once( CLASSPATH . 'ps_product.php');
require_once( CLASSPATH . 'ps_product_category.php');
$ps_product = new ps_product;

// Show only top level categories and categories that are
// being published
$query  = "SELECT * FROM #__{vm}_category, #__{vm}_category_xref ";
$query .= "WHERE #__{vm}_category.category_publish='Y' AND ";
$query .= "(#__{vm}_category_xref.category_parent_id='' OR #__{vm}_category_xref.category_parent_id='0') AND ";
$query .= "#__{vm}_category.category_id=#__{vm}_category_xref.category_child_id ";
$query .= "ORDER BY #__{vm}_category.list_order, #__{vm}_category.category_name ASC";

// initialise the query in the $database connector
// this translates the '#__' prefix into the real database prefix
$db->query( $query );

$iCol = 0;
$categories_per_row = 3;
$cellwidth = intval( 100 / $categories_per_row );
?>

<?php echo $vendor_store_desc;  ?>
<table width="100%" cellspacing="10" cellpadding="0" border="0">  

  <?php
        // cycle through the returned rows displaying them in a table
	// with links to the product category
	// escaping in and out of php is now permitted
          $first_line .= "";
	  $second_line .= "";
    while( $db->next_record() ) {
	$iCol++;			  
     if ($iCol == 1) {
          $first_line .= "<tr>";
	  $second_line .= "<tr>";
        }

		$plink = ' <a title="'.$catname.'" href="'.$sess->url(URL.'index.php?option=com_virtuemart&amp;page=shop.browse&amp;category_id='.$db->f("category_id")).'">'; 
		$catname = shopMakeHtmlSafe($db->f("category_name"));
		$first_line .= '<td width ="'.$cellwidth.'%" align="center">';
		$second_line .= '<td width ="'.$cellwidth.'%" align="center">';
		if ($db->f("category_thumb_image")) {
			$first_line .= $plink;
        	    $first_line .= $ps_product->show_image2( $db->f("category_thumb_image"), "alt=\"$catname\"", 0, "category");
			$first_line .= '</a>';
	        }else{$first_line.='&nbsp;';}
		 
	$second_line .= $plink.$catname.'</a>' ;
	 
	   $first_line .= "</td>";
	  $second_line .= "</td>";
        if ($iCol == $categories_per_row) {
		  $first_line .= "</tr>";
		  $second_line .= "</tr>";
	          $iCol = 0;
        }

 }
if($iCol!=0){
		//$first_line='';
		//$second_line='';
	for($j=$iCol;$j<$categories_per_row;$j++){
		$first_line.='<td>&nbsp;</td>';
		$second_line.='<td>&nbsp;</td>';

	}
		  $first_line .= "</tr>";
		  $second_line .= "</tr>";
}
	  
		  echo  $first_line;
		  echo  $second_line;
?>
</table>
