<?php
/**
* @package RokLatest
* @copyright Copyright (C) 2006 RocketTheme. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $mosConfig_offset, $mosConfig_live_site, $mainframe;

$type 		= intval( $params->get( 'type', 1 ) );
$count 		= intval( $params->get( 'count', 5 ) );
$catid 		= trim( $params->get( 'catid' ) );
$secid 		= trim( $params->get( 'secid' ) );
$start_open = trim( $params->get( 'start_open', 1) );
$transparent_slide = trim( $params->get( 'transparent_slide', 1) );
$slide_speed = trim( $params->get( 'slide_speed', 200) );
$show_front	= trim( $params->get( 'show_front', 1 ) );
$slider_bg 	= trim( $params->get ('slider_bg' ) );
$slider_sep	= trim( $params->get ('slider_sep' ) );
$now 		= date( 'Y-m-d H:i:s', time() );
$access 	= !$mainframe->getCfg( 'shownoauth' );
$nullDate 	= $database->getNullDate();

if (!function_exists(prepareContent)) {

	function prepareContent( $text, $length=200 ) {
		// strips tags won't remove the actual jscript
		$text = preg_replace( "'<script[^>]*>.*?</script>'si", "", $text );	
		$text = preg_replace( '/{.+?}/', '', $text);
		
		//$text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is','\2', $text );
		
		// replace line breaking tags with whitespace
		$text = preg_replace( "'<(br[^/>]*?/|hr[^/>]*?/|/(div|h[1-6]|li|p|td))>'si", ' ', $text );
		
		$text = substr(strip_tags( $text ), 0, $length) ; 
	
		return $text;
	}
}

// select between Content Items, Static Content or both
switch ( $type ) {
	case 2: 
	//Static Content only
		$query = "SELECT a.id, a.title, a.introtext"
		. "\n FROM #__content AS a"
		. "\n WHERE ( a.state = 1 AND a.sectionid = 0 )"
		. "\n AND ( a.publish_up = '$nullDate' OR a.publish_up <= '$now' )"
		. "\n AND ( a.publish_down = '$nullDate' OR a.publish_down >= '$now' )"
		. ( $access ? "\n AND a.access <= $my->gid" : '' )
		. "\n ORDER BY a.created DESC"
		. "\n LIMIT $count"
		;
		$database->setQuery( $query );
		$rows = $database->loadObjectList();
		break;

	case 3: 
	//Both
		$query = "SELECT a.id, a.title, a.introtext, a.sectionid, a.catid, cc.access AS cat_access, s.access AS sec_access, cc.published AS cat_state, s.published AS sec_state"
		. "\n FROM #__content AS a"
		. "\n LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id"
		. "\n LEFT JOIN #__categories AS cc ON cc.id = a.catid"
		. "\n LEFT JOIN #__sections AS s ON s.id = a.sectionid"
		. "\n WHERE a.state = 1"
		. "\n AND ( a.publish_up = '$nullDate' OR a.publish_up <= '$now' )"
		. "\n AND ( a.publish_down = '$nullDate' OR a.publish_down >= '$now' )"
		. ( $access ? "\n AND a.access <= $my->gid" : '' )
		. ( $catid ? "\n AND ( a.catid IN ( $catid ) )" : '' )
		. ( $secid ? "\n AND ( a.sectionid IN ( $secid ) )" : '' )
		. ( $show_front == '0' ? "\n AND f.content_id IS NULL" : '' )
		. "\n ORDER BY a.created DESC"
		. "\n LIMIT $count"
		;
		$database->setQuery( $query );
		$temp = $database->loadObjectList();
		
		$rows = array();
		if (count($temp)) {
			foreach ($temp as $row ) {
				if (($row->cat_state == 1 || $row->cat_state == '') &&  ($row->sec_state == 1 || $row->sec_state == '') &&  ($row->cat_access <= $my->gid || $row->cat_access == '' || !$access) &&  ($row->sec_access <= $my->gid || $row->sec_access == '' || !$access)) {
					$rows[] = $row;
				}
			}
		}
		unset($temp);
		break;

	case 1:  
	default:
	//Content Items only
		$query = "SELECT a.id, a.title, a.introtext, a.sectionid, a.catid"
		. "\n FROM #__content AS a"
		. "\n LEFT JOIN #__content_frontpage AS f ON f.content_id = a.id"
		. "\n INNER JOIN #__categories AS cc ON cc.id = a.catid"
		. "\n INNER JOIN #__sections AS s ON s.id = a.sectionid"
		. "\n WHERE ( a.state = 1 AND a.sectionid > 0 )"
		. "\n AND ( a.publish_up = '$nullDate' OR a.publish_up <= '$now' )"
		. "\n AND ( a.publish_down = '$nullDate' OR a.publish_down >= '$now' )"
		. ( $access ? "\n AND a.access <= $my->gid AND cc.access <= $my->gid AND s.access <= $my->gid" : '' )
		. ( $catid ? "\n AND ( a.catid IN ( $catid ) )" : '' )
		. ( $secid ? "\n AND ( a.sectionid IN ( $secid ) )" : '' )
		. ( $show_front == '0' ? "\n AND f.content_id IS NULL" : '' )
		. "\n AND s.published = 1"
		. "\n AND cc.published = 1"
		. "\n ORDER BY a.created DESC"
		. "\n LIMIT $count"
		;
		$database->setQuery( $query );
		$rows = $database->loadObjectList();
		break;
}


// needed to reduce queries used by getItemid for Content Items
if ( ( $type == 1 ) || ( $type == 3 ) ) {
	$bs 	= $mainframe->getBlogSectionCount();
	$bc 	= $mainframe->getBlogCategoryCount();
	$gbs 	= $mainframe->getGlobalBlogSectionCount();
}

// Output
?>
<!-- MOVE THIS LINK ELEMENT BELOW INTO THE HEAD ELEMENT IF YOU WANT YOUR SITE TO VALIDATE -->
<link href="<?php echo $mosConfig_live_site;?>/modules/roklatest/roklatest.css" rel="stylesheet" type="text/css"/ >
<script type="text/javascript" src="<?php echo $mosConfig_live_site; ?>/modules/roklatest/loader.js"></script>
<script type="text/javascript">
function init_moofx() {
 
  var sliders  = document.getElementsByClassName('moofx-slider'); 	//div that stretches
  var togglers = document.getElementsByClassName('moofx-toggler'); 	//h3s where I click on
  
  var slide = new fx.Slide(togglers, sliders, {opacity: <?php echo($transparent_slide==1?"true":"false"); ?>, duration: <?php echo $slide_speed; ?>}, <?php echo $start_open; ?>);
}
</script>
<div id="moofx-content">
<?php
foreach ( $rows as $row ) {
	// get Itemid
	switch ( $type ) {
		case 2:
			$query = "SELECT id"
			. "\n FROM #__menu"
			. "\n WHERE type = 'content_typed'"
			. "\n AND componentid = $row->id"
			;
			$database->setQuery( $query );
			$Itemid = $database->loadResult();
			break;

		case 3:
			if ( $row->sectionid ) {
				$Itemid = $mainframe->getItemid( $row->id, 0, 0, $bs, $bc, $gbs );
			} else {
				$query = "SELECT id"
				. "\n FROM #__menu"
				. "\n WHERE type = 'content_typed'"
				. "\n AND componentid = $row->id"
				;
				$database->setQuery( $query );
				$Itemid = $database->loadResult();
			}
			break;

		case 1:
		default:
			$Itemid = $mainframe->getItemid( $row->id, 0, 0, $bs, $bc, $gbs );
			break;
	}

	// Blank itemid checker for SEF
	if ($Itemid == NULL) {
		$Itemid = '';
	} else {
		$Itemid = '&amp;Itemid='. $Itemid;
	}

	$link = sefRelToAbs( 'index.php?option=com_content&amp;task=view&amp;id='. $row->id . $Itemid );
	?>
		<span class="moofx-toggler"></span>
		<span class="moofx-title">
			<a href="<?php echo $link; ?>"><?php echo $row->title; ?></a><br style="clear: left;"/>
		</span>
		<div class="moofx-slider"<?php if (isset($slider_bg) && strlen($slider_bg)>1) { echo " style=\"background:$slider_bg\""; } ?>>
  		<?php echo prepareContent($row->introtext) . '...'; ?>
		</div>
		<div class="moofx-bottom"<?php if (isset($slider_sep) && strlen($slider_sep)>1) { echo " style=\"border-top: 1px solid $slider_sep;\""; } ?>></div>
	<?php
}
?>
</div>
<script type="text/javascript">
Element.cleanWhitespace('moofx-content');
init_moofx();
</script>
