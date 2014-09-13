<?php
defined( '_VALID_MOS' ) or die( 'Restricted Access.' );

$al_version = "1.0.3";

global $mosConfig_absolute_path, $mosConfig_live_site, $database, $my;

$tiny_path = $mosConfig_absolute_path."/mambots/editors/jce/jscripts/tiny_mce";
$tiny_url = $mosConfig_live_site."/mambots/editors/jce/jscripts/tiny_mce";
$al_path = $tiny_path."/plugins/advlink";
$al_url = $tiny_url."/plugins/advlink";
$lib_url = $tiny_url."/libraries";
$lib_path = $tiny_path."/libraries";

require_once( $tiny_path.'/auth_jce.php' );

//Setup languages
$database->setQuery( "SELECT lang FROM #__jce_langs WHERE published= '1'" );
$lang = $database->loadResult();

include_once ( $lib_path."/langs/$lang.php" );
if( file_exists( $al_path."/langs/$lang.php" ) ){
    include_once ( $al_path."/langs/$lang.php" );
}else{
    include_once ( $al_path."/langs/en.php" );
}

//Check for access rights
require_once( $mosConfig_absolute_path."/administrator/components/com_jce/plugins/plugins.class.php" );
$alAuth = new authJCE();

// load Image Manager info
$query = "SELECT id"
. "\n FROM #__jce_plugins"
. "\n WHERE plugin = 'advlink' LIMIT 1"
;
$database->setQuery( $query );
$id = $database->loadResult();
$plugin = new jcePlugins( $database );
$plugin->load( $id );
$params = new mosParameters( $plugin->params );

$article_auth   = $alAuth->authCheck( $params->get( 'article_level', '18' ) );
$section_auth   = $alAuth->authCheck( $params->get( 'section_level', '18' ) );
$static_auth    = $alAuth->authCheck( $params->get( 'static_level', '18' ) );
$category_auth  = $alAuth->authCheck( $params->get( 'category_level', '18' ) );
$contact_auth   = $alAuth->authCheck( $params->get( 'contact_level', '18' ) );
$menu_auth      = $alAuth->authCheck( $params->get( 'menu_level', '18' ) );
$search_auth    = $alAuth->authCheck( $params->get( 'search_level', '18' ) );

function makeSelectList( $arr, $elm, $def, $disabled )
{
    global $mainframe, $mosConfig_live_site;
    $elm_array = array( 'articles', 'static_content', 'category', 'section', 'contact' );
    $javascript = "onChange=\"insertLink(this.value);\n";
    foreach( $elm_array as $jitem ){
        if( $jitem != $elm ){
            $javascript .= "document.forms[0].$jitem.value = '';";
        }
    }
    $javascript .= "\"";
    $list = "<select name=\"$elm\" $javascript style=\"width:200px\" $disabled>";
    $list .= "<option value=\"\" selected>$def</option>";
    foreach ( $arr as $item ) {

        //Don't create links for menu items linking to outside of the site.
        if( $elm == 'menu' && strpos( str_replace( $mosConfig_live_site, '', $item->href ), 'index.php' ) === false )
            continue;

        $item_id = $mainframe->getItemid( $item->value );
	    if ( !$item_id ){
	        $item_id = "";
	    }else{
            $item_id = "&amp;Itemid=".$item_id;
         }
        $list .= "<option value=\"".$item->href.$item_id."\">".$item->text."</option>";
    }
    $list .= "</select>";
    return $list;
}

//Articles
$article_disabled = ( $article_auth ) ? '' : 'disabled="true"';
$query = "SELECT a.id as value, CONCAT( a.title, ' /', a.title_alias, '' ) AS text, CONCAT( '$mosConfig_live_site/index.php?option=com_content&amp;task=view&amp;id=', a.id) AS href
         FROM #__content AS a
         WHERE a.state = '1' AND a.sectionid != '0'
         ORDER BY a.id";

        $database->setQuery( $query );
        $contents = $database->loadObjectList( );

        $list['article'] = makeSelectList( $contents, 'articles', $allang['select_article'], $article_disabled );

//Static Content
$static_disabled = ( $static_auth ) ? '' : 'disabled="true"';

$query = "SELECT a.id AS value, CONCAT( a.title, ' /', a.title_alias, '' ) AS text, CONCAT( '$mosConfig_live_site/index.php?option=com_content&amp;task=view&amp;id=', a.id) AS href
         FROM #__content AS a
         WHERE a.state = '1' AND a.sectionid = '0'
         ORDER BY a.id";

        $database->setQuery( $query );
        $static_content = $database->loadObjectList( );

        $list['static'] = makeSelectList( $static_content, 'static_content', $allang['select_static'], $static_disabled );

//Category
$category_disabled = ( $category_auth ) ? '' : 'disabled="true"';
$query = "SELECT a.id AS value, CONCAT( a.title, ' /', a.name, '' ) AS text, CONCAT( '$mosConfig_live_site/index.php?option=com_content&amp;task=category&amp;sectionid=', a.section, '&amp;id=', a.id) AS href
         FROM #__categories AS a
         LEFT JOIN #__sections AS s ON s.id
         WHERE a.published = '1' AND s.id = a.section
         ORDER BY a.id";

        $database->setQuery( $query );
        $category_content = $database->loadObjectList( );

        $list['category'] = makeSelectList( $category_content, 'category', $allang['select_category'], $category_disabled );

//Section
$section_disabled = ( $section_auth ) ? '' : 'disabled="true"';
$query = "SELECT a.id AS value, CONCAT( a.title, ' /', a.name, '' ) AS text, CONCAT( '$mosConfig_live_site/index.php?option=com_content&amp;task=section&amp;id=', a.id) AS href
         FROM #__sections AS a
         WHERE a.published = '1' AND a.scope='content'
         ORDER BY a.id";

        $database->setQuery( $query );
        $section_content = $database->loadObjectList( );

        $list['section'] = makeSelectList( $section_content, 'section', $allang['select_section'], $section_disabled );

//Contact
$contact_disabled = ( $contact_auth ) ? '' : 'disabled="true"';
$query = "SELECT a.id AS value, CONCAT( a.name, ' /', a.con_position, '' ) AS text, CONCAT( '$mosConfig_live_site/index.php?option=com_contact&amp;task=view&amp;contact_id=', a.id) AS href
         FROM #__contact_details AS a
         WHERE a.published = '1'
         ORDER BY a.id";

        $database->setQuery( $query );
        $contact_content = $database->loadObjectList( );

        $list['contact'] = makeSelectList( $contact_content, 'contact', $allang['select_contact'], $contact_disabled );

//Menu
$menu_disabled = ( $menu_auth ) ? '' : 'disabled="true"';
$query = "SELECT a.id AS value, a.menutype, CONCAT( a.name, ' /', a.menutype, '' ) AS text, CONCAT( '$mosConfig_live_site/', a.link) AS href
         FROM #__menu AS a
         WHERE a.published = '1'
         ORDER BY a.menutype, a.name";

        $database->setQuery( $query );
        $menu_content = $database->loadObjectList( );

        $list['menu'] = makeSelectList( $menu_content, 'menu', $allang['select_menu'], $menu_disabled );
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$lang_insert_link_title}</title>
	<script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/utils/mctabs.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo $tiny_url;?>/utils/form_utils.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo $al_url;?>/jscripts/functions.js"></script>
	<link href="<?php echo $al_url;?>/css/advlink.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">
        var site_url = "<?php echo $mosConfig_live_site;?>";
	</script>
</head>
<body id="advlink" onload="tinyMCEPopup.executeOnLoad('init();');" style="display: none">
    <form onsubmit="insertAction();return false;" action="#">
		<div class="tabs">
			<ul>
				<li id="general_tab" class="current"><span><a href="javascript:mcTabs.displayTab('general_tab','general_panel');" onmousedown="return false;"><?php echo $allang['general_tab'];?></a></span></li>
				<li id="popup_tab"><span><a href="javascript:mcTabs.displayTab('popup_tab','popup_panel');" onmousedown="return false;"><?php echo $allang['popup_tab'];?></a></span></li>
				<li id="events_tab"><span><a href="javascript:mcTabs.displayTab('events_tab','events_panel');" onmousedown="return false;"><?php echo $allang['events_tab'];?></a></span></li>
				<li id="advanced_tab"><span><a href="javascript:mcTabs.displayTab('advanced_tab','advanced_panel');" onmousedown="return false;"><?php echo $allang['advanced_tab'];?></a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper">
			<div id="general_panel" class="panel current" style="height:255px; overflow:auto;">
				<fieldset>
					<legend><?php echo $allang['general_tab'];?></legend>
					<table border="0" cellpadding="4" cellspacing="0">
						<tr>
						  <td nowrap="nowrap"><label id="hreflabel" for="href"><?php echo $cmnlang['url'];?></label></td>
						  <td><table border="0" cellspacing="0" cellpadding="0">
								<tr>
								  <td colspan="2"><input id="href" name="href" type="text" value="" size="150" onchange="selectByValue(this.form,'linklisthref',this.value);" /></td>
								</tr>
							  </table></td>
						</tr>
						<tr>
							<td class="column1"><label for="anchorlist"><?php echo $allang['anchors'];?></label></td>
							<td colspan="2" id="anchorlistcontainer">&nbsp;</td>
						</tr>
						<tr>
							<td><label id="targetlistlabel" for="targetlist"><?php echo $cmnlang['target'];?></label></td>
							<td id="targetlistcontainer">&nbsp;</td>
						</tr>
						<tr>
							<td nowrap="nowrap"><label id="titlelabel" for="title"><?php echo $cmnlang['title'];?></label></td>
							<td><input id="title" name="title" type="text" value="" /></td>
						</tr>
						<tr>
							<td><label id="classlabel" for="classlist"><?php echo $cmnlang['class'];?></label></td>
							<td>
								 <select id="classlist" name="classlist" onchange="changeClass();">
									<option value="" selected><?php echo $cmnlang['not_set'];?></option>
								 </select>
							</td>
						</tr>
					</table>
				</fieldset>
				<fieldset>
				<legend><strong><?php echo $allang['email'];?></strong></legend>
                    <table border="0" cellpadding="4" cellspacing="0">
				        <tr id="emailaddressrow">
							<td class="column1"><label for="emailadd"><?php echo $allang['address'];?></label></td>
							<td><input id="emailadd" name="emailadd" type="text" size="40" value="" /></td>
							<td class="column1"><label for="emailsub"><?php echo $allang['subject'];?></label></td>
							<td><input id="emailsub" name="emailsub" type="text" size="40" value="" /></td>
							<td><input id="emailcreate" type="button" onclick="buildAddress();" value="<?php echo $allang['create'];?>" /></td>
						</tr>
                    </table>
                </fieldset>
			</div>

			<div id="popup_panel" class="panel" style="height:255px; overflow:auto;">
				<fieldset>
					<legend><?php echo $allang['popup'];?></legend>

					<input type="checkbox" id="ispopup" name="ispopup" class="radio" onclick="setPopupControlsDisabled(!this.checked);buildOnClick();" />
					<label id="ispopuplabel" for="ispopup"><?php echo $allang['popup'];?></label>

					<table border="0" cellpadding="0" cellspacing="4">
						<tr>
							<td nowrap="nowrap"><label for="popupurl"><?php echo $cmnlang['url'];?></label>&nbsp;</td>
							<td>
								<table border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><input type="text" name="popupurl" id="popupurl" size="150" value="" onchange="buildOnClick();" /></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td nowrap="nowrap"><label for="popupname"><?php echo $allang['popup_name'];?></label>&nbsp;</td>
							<td><input type="text" name="popupname" id="popupname" size="150" value="" onchange="buildOnClick();" /></td>
						</tr>
						<tr>
							<td nowrap="nowrap"><label><?php echo $allang['popup_size'];?></label>&nbsp;</td>
							<td nowrap="nowrap">
								<input type="text" id="popupwidth" name="popupwidth" value="" onchange="buildOnClick();" /> x
								<input type="text" id="popupheight" name="popupheight" value="" onchange="buildOnClick();" /> px
							</td>
						</tr>
						<tr>
							<td nowrap="nowrap" id="labelleft"><label><?php echo $allang['popup_position'];?></label>&nbsp;</td>
							<td nowrap="nowrap">
								<input type="text" id="popupleft" name="popupleft" value="" onchange="buildOnClick();" /> /                                
								<input type="text" id="popuptop" name="popuptop" value="" onchange="buildOnClick();" />&nbsp;<?php echo $allang['popup_position_centre'];?>
							</td>
						</tr>
					</table>

					<fieldset>
						<legend><?php echo $allang['popup_options'];?></legend>

						<table border="0" cellpadding="0" cellspacing="4">
							<tr>
								<td><input type="checkbox" id="popuplocation" name="popuplocation" class="checkbox" onchange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popuplocationlabel" for="popuplocation"><?php echo $allang['popup_location'];?></label></td>
								<td><input type="checkbox" id="popupscrollbars" name="popupscrollbars" class="checkbox" onchange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popupscrollbarslabel" for="popupscrollbars"><?php echo $allang['popup_scrollbars'];?></label></td>
							</tr>
							<tr>
								<td><input type="checkbox" id="popupmenubar" name="popupmenubar" class="checkbox" onchange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popupmenubarlabel" for="popupmenubar"><?php echo $allang['popup_menubar'];?></label></td>
								<td><input type="checkbox" id="popupresizable" name="popupresizable" class="checkbox" onchange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popupresizablelabel" for="popupresizable"><?php echo $allang['popup_resizeable'];?></label></td>
							</tr>
							<tr>
								<td><input type="checkbox" id="popuptoolbar" name="popuptoolbar" class="checkbox" onchange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popuptoolbarlabel" for="popuptoolbar"><?php echo $allang['popup_toolbar'];?></label></td>
								<td><input type="checkbox" id="popupdependent" name="popupdependent" class="checkbox" onchange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popupdependentlabel" for="popupdependent"><?php echo $allang['popup_dependant'];?></label></td>
							</tr>
							<tr>
								<td><input type="checkbox" id="popupstatus" name="popupstatus" class="checkbox" onchange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popupstatuslabel" for="popupstatus"><?php echo $allang['popup_statusbar'];?></label></td>
								<td><input type="checkbox" id="popupreturn" name="popupreturn" class="checkbox" checked="checked" onchange="buildOnClick();" /></td>
								<td nowrap="nowrap"><label id="popupreturnlabel" for="popupreturn"><?php echo $allang['popup_return'];?></label></td>
							</tr>
						</table>
					</fieldset>
				</fieldset>
			</div>

			<div id="advanced_panel" class="panel" style="height:255px; overflow:auto;">
			<fieldset>
					<legend><?php echo $allang['advanced_tab'];?></legend>

					<table border="0" cellpadding="0" cellspacing="4">
						<tr>
							<td class="column1"><label id="idlabel" for="id"><?php echo $cmnlang['id'];?></label></td>
							<td><input id="id" name="id" type="text" value="" /></td> 
						</tr>

						<tr>
							<td><label id="stylelabel" for="style"><?php echo $cmnlang['style'];?></label></td>
							<td><input type="text" id="style" name="style" value="" /></td>
						</tr>

						<tr>
							<td><label id="classeslabel" for="classes"><?php echo $cmnlang['class'];?></label></td>
							<td><input type="text" id="classes" name="classes" value="" onchange="selectByValue(this.form,'classlist',this.value,true);" /></td>
						</tr>

						<tr>
							<td><label id="targetlabel" for="target"><?php echo $allang['advanced_target_name'];?></label></td>
							<td><input type="text" id="target" name="target" value="" onchange="selectByValue(this.form,'targetlist',this.value,true);" /></td>
						</tr>

						<tr>
							<td class="column1"><label id="dirlabel" for="dir"><?php echo $cmnlang['lang_dir'];?></label></td>
							<td>
								<select id="dir" name="dir"> 
										<option value=""><?php echo $cmnlang['not_set'];?></option>
										<option value="ltr"><?php echo $cmnlang['ltr'];?></option>
										<option value="rtl"><?php echo $cmnlang['rtl'];?></option>
								</select>
							</td> 
						</tr>

						<tr>
							<td><label id="hreflanglabel" for="hreflang"><?php echo $allang['advanced_target_langcode'];?></label></td>
							<td><input type="text" id="hreflang" name="hreflang" value="" /></td>
						</tr>

						<tr>
							<td class="column1"><label id="langlabel" for="lang"><?php echo $allang['advanced_langcode'];?></label></td>
							<td>
								<input id="lang" name="lang" type="text" value="" />
							</td> 
						</tr>

						<tr>
							<td><label id="charsetlabel" for="charset"><?php echo $allang['advanced_encoding'];?></label></td>
							<td><input type="text" id="charset" name="charset" value="" /></td>
						</tr>

						<tr>
							<td><label id="typelabel" for="type"><?php echo $allang['advanced_mime'];?></label></td>
							<td><input type="text" id="type" name="type" value="" /></td>
						</tr>

						<tr>
							<td><label id="rellabel" for="rel"><?php echo $allang['advanced_rel'];?></label></td>
							<td><select id="rel" name="rel"> 
									<option value=""><?php echo $cmnlang['not_set'];?></option>
									<option value="alternate">Alternate</option> 
									<option value="designates">Designates</option> 
									<option value="stylesheet">Stylesheet</option> 
									<option value="start">Start</option> 
									<option value="next">Next</option> 
									<option value="prev">Prev</option> 
									<option value="contents">Contents</option> 
									<option value="index">Index</option> 
									<option value="glossary">Glossary</option> 
									<option value="copyright">Copyright</option> 
									<option value="chapter">Chapter</option> 
									<option value="subsection">Subsection</option> 
									<option value="appendix">Appendix</option> 
									<option value="help">Help</option> 
									<option value="bookmark">Bookmark</option> 
								</select> 
							</td>
						</tr>

						<tr>
							<td><label id="revlabel" for="rev"><?php echo $allang['advanced_rev'];?></label></td>
							<td><select id="rev" name="rev"> 
									<option value=""><?php echo $cmnlang['not_set'];?></option>
									<option value="alternate">Alternate</option> 
									<option value="designates">Designates</option> 
									<option value="stylesheet">Stylesheet</option> 
									<option value="start">Start</option> 
									<option value="next">Next</option> 
									<option value="prev">Prev</option> 
									<option value="contents">Contents</option> 
									<option value="index">Index</option> 
									<option value="glossary">Glossary</option> 
									<option value="copyright">Copyright</option> 
									<option value="chapter">Chapter</option> 
									<option value="subsection">Subsection</option> 
									<option value="appendix">Appendix</option> 
									<option value="help">Help</option> 
									<option value="bookmark">Bookmark</option> 
								</select> 
							</td>
						</tr>

						<tr>
							<td><label id="tabindexlabel" for="tabindex"><?php echo $allang['advanced_tabindex'];?></label></td>
							<td><input type="text" id="tabindex" name="tabindex" value="" /></td>
						</tr>

						<tr>
							<td><label id="accesskeylabel" for="accesskey"><?php echo $allang['advanced_accesskey'];?></label></td>
							<td><input type="text" id="accesskey" name="accesskey" value="" /></td>
						</tr>
					</table>
				</fieldset>
			</div>

			<div id="events_panel" class="panel" style="height:255px; overflow:auto;">
			<fieldset>
					<legend><?php echo $allang['events_tab'];?></legend>

					<table border="0" cellpadding="0" cellspacing="4">
						<tr>
							<td class="column1"><label for="onfocus">onfocus</label></td> 
							<td><input id="onfocus" name="onfocus" type="text" value="" /></td> 
							<td class="column1"><label for="onblur">onblur</label></td>
							<td><input id="onblur" name="onblur" type="text" value="" /></td>
						</tr>

						<tr>
							<td class="column1"><label for="onclick">onclick</label></td> 
							<td><input id="onclick" name="onclick" type="text" value="" /></td> 
							<td class="column1"><label for="ondblclick">ondblclick</label></td>
							<td><input id="ondblclick" name="ondblclick" type="text" value="" /></td>
						</tr>

						<tr>
							<td class="column1"><label for="onmousedown">onmousedown</label></td> 
							<td><input id="onmousedown" name="onmousedown" type="text" value="" /></td> 
							<td class="column1"><label for="onmouseup">onmouseup</label></td>
							<td><input id="onmouseup" name="onmouseup" type="text" value="" /></td>
						</tr>

						<tr>
							<td class="column1"><label for="onmouseover">onmouseover</label></td> 
							<td><input id="onmouseover" name="onmouseover" type="text" value="" /></td>
							<td class="column1"><label for="onmousemove">onmousemove</label></td>
							<td><input id="onmousemove" name="onmousemove" type="text" value="" /></td>
						</tr>

						<tr>
							<td class="column1"><label for="onmouseout">onmouseout</label></td> 
							<td><input id="onmouseout" name="onmouseout" type="text" value="" /></td>
                            <td class="column1"><label for="onkeypress">onkeypress</label></td>
							<td><input id="onkeypress" name="onkeypress" type="text" value="" /></td>
						</tr>

						<tr>
							<td class="column1"><label for="onkeydown">onkeydown</label></td> 
							<td><input id="onkeydown" name="onkeydown" type="text" value="" /></td>
							<td class="column1"><label for="onkeyup">onkeyup</label></td>
							<td><input id="onkeyup" name="onkeyup" type="text" value="" /></td>
						</tr>
					</table>
				</fieldset>
			</div>
		</div>
		<div class="panel_wrapper">
		<fieldset><legend><strong><?php echo $allang['content'];?></strong></legend>
                    <table border="0">
                      <tr>
                        <td class="label" valign="middle" nowrap><?php echo $allang['article'];?>:</td>
                        <td><?php echo $list['article']; ?></td>
                        <?php if( $search_auth ){ ?>
                        <td rowspan="5">
                             <div id="searchframe"></div>
                        </td>
                        <?php }else{ ?>
                        <td rowspan="5">
                        <?php } ?>
                      </tr>
                      <tr>
                        <td class="label" valign="middle" nowrap><?php echo $allang['static'];?>:</td>
                        <td><?php echo $list['static']; ?></td>
                      </tr>
                      <tr>
                        <td class="label" valign="middle" nowrap><?php echo $allang['category'];?>:</td>
                        <td><?php echo $list['category']; ?></td>
                      </tr>
                      <tr>
                        <td class="label" valign="middle" nowrap><?php echo $allang['section'];?>:</td>
                        <td><?php echo $list['section']; ?></td>
                      </tr>
                      <tr>
                        <td class="label" valign="middle" nowrap><?php echo $allang['contact'];?>:</td>
                        <td><?php echo $list['contact']; ?></td>
                      </tr>
                       <tr>
                        <td class="label" valign="middle" nowrap><?php echo $allang['menu'];?>:</td>
                        <td><?php echo $list['menu']; ?></td>
                      </tr>
                     </table>
                     </fieldset>
                     </div>
		<div class="mceActionPanel">
			<div style="float: left">
				<input type="button" id="insert" name="insert" value="{$lang_insert}" onclick="insertAction();" />
			</div>

			<div style="float: right">
				<input type="button" id="cancel" name="cancel" value="<?php echo $cmnlang['cancel'];?>" onclick="tinyMCEPopup.close();" />
			</div>
		</div>
    </form>
</body>
</html>
