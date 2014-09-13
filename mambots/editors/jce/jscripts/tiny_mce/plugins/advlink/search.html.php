<?php
/**
* @version $Id: search.html.php,v 1.7 2005/02/16 10:43:04 akede Exp $
* @package Mambo
* @subpackage Search
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

//Modified for mosCE Advanced Link Search feature - 20/02/2005 Ryan Demmer

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Restricted Access.' );
global $tiny_url, $al_url;

/**
* @package Mambo
* @subpackage Search
*/
class search_html {

        function openhtml( $params ) {
                if ( $params->get( 'page_title' ) ) {
                        ?>
                        <div class="componentheading<?php echo $params->get( 'pageclass_sfx' ); ?>">
                        <?php echo $params->get( 'header' ); ?>
                        </div>
                        <?php
                }
        }

        function searchbox( $searchword, &$lists, $params ) {
                global $Itemid, $mosConfig_live_site, $tiny_url, $al_url, $allang;

                ?>
                <form action="index2.php?option=com_jce&no_html=1&task=plugin&plugin=advlink&file=search.php" method="post">
                <table class="contentpaneopen<?php echo $params->get( 'pageclass_sfx' ); ?>">
                        <tr>
                                <td nowrap="nowrap">
                                <?php echo $allang['search'];?>:
                                </td>
                                <td nowrap="nowrap">
                                <input type="text" name="searchword"size="15" value="<?php echo stripslashes($searchword);?>" class="inputbox" />
                                </td>
                                <td width="100%" nowrap="nowrap">
                                <input type="submit" name="submit" value="<?php echo $allang['search'];?>" class="button" />
                                </td>
                        </tr>
                        <tr>
                                <td colspan="3">
                                <?php echo $lists['searchphrase']; ?>
                                </td>
                        </tr>
                        <tr>
                                <td colspan="3"><?php echo $allang['order'];?>: <?php echo $lists['ordering'];?></td>
                        </tr>
                </table>
                <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>" />
                </form>
                </body>
                </html>
                <?php
        }

        function searchintro( $searchword, $params ) {
                global $allang;
                ?>
                <table class="searchintro<?php echo $params->get( 'pageclass_sfx' ); ?>">
                <tr>
                        <td colspan="3" align="left"><?php echo $allang['key'];
                        ' <b>' . stripslashes($searchword) . '</b>'; ?>
                <?php
        }

        function message( $message, $params ) {
                ?>
                <table class="searchintro<?php echo $params->get( 'pageclass_sfx' ); ?>">
                <tr>
                        <td colspan="3" align="left">
                        <?php eval ('echo "'.$message.'";');        ?>
                        </td>
                </tr>
                </table>
                <?php
        }

        function displaynoresult() {
                ?>
                        </td>
                </tr>
                <?php
        }

        function display( &$rows, $params ) {
                global $mosConfig_offset, $mosConfig_live_site;

                $c = count ($rows);
                $tabclass = array("sectiontableentry1", "sectiontableentry2");
                $k = 0;

                // number of matches found
                printf( _SEARCH_MATCHES, $c );
                ?>
                        </td>
                </tr>
                </table>
                <br />
                <table class="contentpaneopen<?php echo $params->get( 'pageclass_sfx' ); ?>">
                <?php
                foreach ($rows as $row) {
                        if ($row->created) {
                                $created = mosFormatDate ($row->created, '%d %B, %Y');
                        } else {
                                $created = '';
                        }
                        ?>
                        <tr>
                                <td>
                                <?php
                                if ( strstr( $row->href, 'http://' ) ) {
                                        $href = $row->href;
                                }else{
                                   $href = "$mosConfig_live_site/".$row->href;
                                }

                                $title = $row->title;
                                $section = $row->section;
                                $text = $row->text;
                                ?>
                                        <a href="javascript:;" onClick="SearchLink('<?php echo $href; ?>');">
                                        <?php
                                echo $title;
                                ?>
                                </a>
                                (<?php echo $section; ?>)
                                </td>
                        </tr>
                        <tr>
                                <td>
                                <?php echo $text;?> &#133;
                                </td>
                        </tr>
                        <tr>
                                <td>
                                <?php echo $created; ?>
                                </td>
                        </tr>
                        <tr>
                                <td>
                                &nbsp;
                                </td>
                        </tr>
                        <?php
                        $k = 1 - $k;
                }
        }

}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="<?php echo $tiny_url;?>/themes/advanced/css/editor_popup.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
    var site_url = "<?php echo $mosConfig_live_site;?>";
    function SearchLink(val){
        var topDoc = parent.document;
        var formObj = topDoc.forms[0];

        if(formObj.ispopup.checked)
        {
            if( val.indexOf( site_url+'index.php?option=', 0) )
            {
                formObj.popupurl.value = val.replace( 'index.php?option=', 'index2.php?option=', 'gi' );
                formObj.href.value = val;
            }else{
                alert( 'Only site links can be used for popups.' );
            }
        }else{
            formObj.href.value = val;
        }
    }
</script>
</head>
<body>
