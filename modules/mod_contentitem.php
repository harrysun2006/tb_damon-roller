<?php
/**
* mod_contentitem 2006-04-06 20:40 
* package mod_contentitem
*
* c September 2005 eikepierstorff@pierstorff.com
* re-written & extended april 2006
* GPL'd
* last change to the module: june 08 2006
* last change to this file: : june 08 2006
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
require_once( $mainframe->getPath( 'front_html', 'com_content') );
require_once( 'mod_contentitem/mod_contentitem_helper.php' );
global $my, $mosConfig_shownoauth, $mosConfig_offset, $acl;

// regex for removal of mospagebreak
$fixpagebreak = '/{(mospagebreak)\s*(.*?)}/i';

// cache activation
$cache =& mosCache::getCache( 'com_content' );
// which items/cats/section to select
$mod_itemid 		= trim( $params->get( 'mod_itemid' ) );
// what kind of content to select content item/cat/section
$ctype     = $params->get( 'ctype' );
// allow edit for registered users
$allow_edit = $params->get( 'allow_edit', false );
// order criteria
$order = trim( $params->get( 'order' ) );
$show_front	= $params->get( 'show_front', 1 );
// how many items are displayed
$num_of_items = $params->get( 'num_of_items', false );
// css class
$class_sfx	= $params->get( 'moduleclass_sfx' );
// show fulltext yes/no
$fulltext   = $params->get( 'fulltext' , 0);
// show readmore link yes/no
$readmore  = $params->get( 'readmore');
// show title in print view default/no/yes
$item_title = $params->get( 'item_title' , 0);
// show author in print view default/no/yes
$author = $params->get( 'author' , 0);
// show createdate in print view default/no/yes
$createdate = $params->get( 'createdate' , 0);
// show modifydate in print view default/no/yes
$modifydate = $params->get( 'modifydate' , 0);
// strip {mosimages} yes/no
$show_images = $params->get( 'show_images' , 0);
//merge multiple content items
$merge   = $params->get( 'merge' , 0);
// show a global title for the merged items
$merged_title   = $params->get( 'merged_title' , false);
// markup for the individual titles in the merges items
$merged_headlinemarkup   = $params->get( 'merged_headlinemarkup' , "");
$merged_headlinemarkup = html_entity_decode($merged_headlinemarkup);
// show pdf link in merged view yes/no
$pdf = $params->get( 'pdf' , 0);
// show print link in merged view yes/no
$print = $params->get( 'print' , 0);
// use cleanup function for pdf generation
$cleanpdf = $params->get( 'cleanpdf' , 0);
// markup for the content table items in the merges items
// if false no toc is created
$tocMarkup = $params->get( 'tocmarkup' , false);
$toc  = array(); // define variable that holds TOC entries
$tocid = array(); // define variable that holds TOC ids, these make the names for inner-site links

// how many rows
$num_of_cols = $params->get( 'num_of_cols' , 2);
// how many leading  stories (full width)
$leading = $params->get( 'leading' , 1);
// 
$link_titles = $params->get( 'link_titles' , 1);

// enable / disable edit ability icon
if($allow_edit) 
{
 $access = new stdClass();
 $access->canEdit 	= $acl->acl_check( 'action', 'edit', 'users', $my->usertype, 'content', 'all' );
 $access->canEditOwn = $acl->acl_check( 'action', 'edit', 'users', $my->usertype, 'content', 'own' );
 $access->canPublish = $acl->acl_check( 'action', 'publish', 'users', $my->usertype, 'content', 'all' );
} else 
{
 $access = new stdClass();
 $access->canEdit 	= 0;
 $access->canEditOwn = 0;
 $access->canPublish = 0;
}



// date + server time offset
$now 		= date( 'Y-m-d H:i:s', time() );

//$now 		= date( 'Y-m-d H:i:s', time());
$noauth = !$mainframe->getCfg( 'shownoauth' );

// generate clause for content type
switch($ctype) {
 case(3):
   $ar = preg_split("/[,]/", $mod_itemid);
   $clause = "a.sectionid = '" . implode ("' OR a.sectionid= '", $ar) . "'";
 break;
 case(2):
  $ar = preg_split("/[,]/", $mod_itemid); 
  $clause = "a.catid = '" . implode ("' OR a.catid= '", $ar) . "'";
 break;
 case(1): 
 default:
  $ar = preg_split("/[,]/", $mod_itemid);  
  $clause = "a.id = '" . implode ("' OR a.id= '", $ar) . "'";	 
 break;
}

// generate clause for order
switch($order) {
 case(13):
    $orderclause = " ORDER BY a.created DESC ";
 break;
 case(12):
    $orderclause = " ORDER BY a.created ASC ";
 break;
 case(11):
   $orderclause = " ORDER BY a.sectionid,a.catid, a.created DESC ";
 break;
 case(10):
   $orderclause = " ORDER BY a.sectionid,a.catid, a.created ASC ";
 break;
 case(9):
   $orderclause = " ORDER BY RAND() ";
 break;
 case(8):
   $orderclause = " ORDER BY a.sectionid DESC, a.catid DESC, a.title DESC ";
 break;	 
 case(7):
   $orderclause = " ORDER BY  a.sectionid ASC, a.catid ASC , a.title ASC";
 break;	 
 case(6):
   $orderclause = " ORDER BY a.sectionid DESC, a.catid DESC, a.ordering DESC ";
 break;	 
 case(5):
   $orderclause = " ORDER BY a.sectionid ASC, a.catid ASC, a.ordering ASC ";
 break;
 case(4):
   $orderclause = " ORDER BY a.ordering DESC ";
 break;
 case(3):
   $orderclause = " ORDER BY a.ordering ASC ";	
 break;
 case(2):
   $orderclause = " ORDER BY a.title DESC ";		
 break;
 case(1):
   $orderclause = " ORDER BY a.title ASC ";		
 break;  
 case(0): 
 default:
   $orderclause = "";
 break;
}

if($num_of_items)
{
 $limitclause = " LIMIT " . intval($num_of_items);
} else {
 $limitclause = "";
}

 $query = "SELECT a.id"
  . "\n FROM #__content AS a"
  . "\n WHERE ( a.state = '1' AND a.checked_out = '0')"
	. "\n AND (". $clause . ")"
  . "\n AND ( a.publish_up = '0000-00-00 00:00:00' OR a.publish_up <= '". $now ."' )"
  . "\n AND ( a.publish_down = '0000-00-00 00:00:00' OR a.publish_down >= '". $now ."' )"
  . ( $access ? "\n AND a.access <= '". $my->gid ."'" : '' ) . $orderclause . $limitclause
  . "\n"
  ;
$database->setQuery( $query );
$rows = $database->loadResultArray();

// determine rowcount for tabled output
$cnt = count($rows);

if($num_of_cols > $cnt) { $num_of_cols = 1;}
if(($cnt)%$num_of_cols != 0){
 $cnt = $cnt + ($num_of_cols - ($cnt%$num_of_cols));
}

if($num_of_cols > $leading) {
 $cnt = $cnt + $leading;
 // i do not want to apologize for something that works, but this is cargo cult. 
 // If anybody can explain why I need this please do, but if I cut this I alway end up with an
 // extra col in the table
 if($num_of_cols < count($rows)) {
  $cnt = $cnt - $num_of_cols;
 }
}
/* dito */
if($leading%$num_of_cols != 0 && ($num_of_cols <= $leading)) {
 $cnt = $cnt + ($leading%$num_of_cols);
} 

if($cnt > 0) {

  echo '<div class="mod_contentitem' . $moduleclass_sfx . '">';
  $z=1;
 /*
  * following code is for "merged view"
	*
	* Instead of merging the text fields like previous versions of
	* the modules this loads each item, formats it with the content_html
	* show function, buffers the output and creates an temp item from the
	* buffer. That way we keep things like images and author/date info
	*
	* The function to create the temp item is located in 
	* mod_contentitem/mod_contentitem_helper.php
	*/ 
 if($merge){
  ob_start();
	// the moduleclass_sfx class 
  $params->set( 'moduleclass_sfx', "" );
  for($i=0;$i<$cnt;$i++) {
  $row = new mosContent( $database );

  $row->load( $rows[$i] );
	if($fulltext) 
	{
	 $row->text = $row->introtext . $row->fulltext;
	} else {
	 $row->text = $row->introtext;
	}   

	// collects data to create the table of contents and inserts
	// named link für TOC inner-page links
	// The function to create the TOC is located in 
	// mod_contentitem/mod_contentitem_helper.php
	
	if($tocMarkup && $row->title)
	{
	 $toc[]   = $row->title; 
	 $tocid[] = $row->id;
	 $row->text = '<a name="toc_' . $row->id . '"></a>' . $row->text;
	}
	
	// We call this $item_params so that item params will not get mixed up with 
	// module params ($params)  
  $item_params = new mosParameters( $row->attribs );
	// We do not want buttons on indivual items in merged view
	$item_params->set( 'pdf', 0 );
 	$item_params->set( 'print', 0 );
 	$item_params->set( 'mail', 0 );  
	
	// Switches to controll paramaters
	// module controls can overrride the item parameters
	switch($item_title)
	{
	 case("2"):
	 	$item_params->set( 'item_title', 1 );	  
	 break;
	 case("1"):
	  $item_params->set( 'item_title', 0 );
	 break;
  }
	
	switch($link_titles)
	{
	 case("2"):
    $item_params->set( 'link_titles', 1 );	
	  $item_params->set( 'intro_only', 1 );
		$row->fulltext = $readmore;  	  
	 break;
	 case("1"):
    $item_params->set( 'link_titles', 0 );
	 break;
  }
	

  switch($show_images)
	{
	 case("1"):
	  $item_params->set("image",0);
	 break;
	 default:
	 	$item_params->set("image",1);
	 break;
  }	
	
	switch($createdate)
	{
	 case("2"):
	 	$item_params->set( 'createdate', 1 );	  
	 break;
	 case("1"):
	  $item_params->set( 'createdate', 0 );
	 break;
	 default:
	  $item_params->def( 'createdate', 	!$mainframe->getCfg( 'hideCreateDate' ) );
	 break; 
  }	
	
	switch($modifydate)
	{
	 case("2"):
	 	$item_params->set( 'modifydate', 1 );	  
	 break;
	 case("1"):
	  $item_params->set( 'modifydate', 0 );
	 break;
	 default:
	  $item_params->def( 'modifydate', 	!$mainframe->getCfg( 'hideModifyDate' ) );
	 break;	 	 
  }			
	
	switch($author)
	{
	 case("2"):
	 	$item_params->set( 'author', 1 );	  
	 break;
	 case("1"):
	  $item_params->set( 'author', 0 );
	 break;
	 default:
	  $item_params->def( 'author', 		!$mainframe->getCfg( 'hideAuthor' ) );
	 break;	 
  }	
	
 
  if($item_params->get('author'))
	{
	 $query = "SELECT name FROM #__users WHERE id = $row->created_by"; 
	 $database->setQuery( $query );
   $row->author = $database->loadResult();
	}
	// sets readmore to parameter value unless fulltext is set, in which 
	// case a readmore-link would be pointless
	if( $readmore && !$fulltext ) 
	{
	 $item_params->set( 'intro_only', 1 );
	 $item_params->set( 'readmore', $readmore );
	 // joomla actuallay checks if there is "readmore" content
	 // in the usual content function it checks if there are characters
	 // in the fulltext-fields counts them and oputs the number in the 
	 // row->readmore-field  We fake this by setting
	 // the row->readmore to the value of the readmore parameter which
	 // happens to be an integer
	  $row->readmore = $readmore;
	} 
	// we do not want multipage-articles in module positions
 	  $row->text = preg_replace( $fixpagebreak, '', $row->text );

 if($i>=$leading) {
 /**/
 if($z%$num_of_cols == 1 && $num_of_cols > 1){
  if($i>0) {
  echo "</tr>\n<tr>\n";
	} else {
  echo "\n<tr>\n";	
	}
 } else if( $num_of_cols == 1 ) {
  
 if($i>0) {
  echo "</tr>\n<tr>\n";
	} else {
  echo "\n<tr>\n";	
	};		 
 }
 /**/
 } else {
  if($i>0) {
   echo "</tr>\n<tr>\n";
	 } else {
   echo "\n<tr>\n";	
	}
 }
 if($i<$leading) { 
  $leading > 0 ? $colspan = ' colspan="' . $num_of_cols . '" ' : $colspan = "";
 } else {
  $colspan = "";
 }
	if(isset($row->introtext)) {
    echo '<td ' . $colspan . ' style="vertical-align:top;">';
		 HTML_content::show( $row, $item_params, $access, $page=0, $option="", $ItemidCount=NULL );		
	echo "</td>\n";
 } else {
  echo "<td " . $colspan . ">$i</td>\n"; 
 }

  // closing tr
 if($i == $cnt-1) {
  echo "</tr>";
 }

 if($i>=$leading) {
	$z++;
  } 
}
	
	// print/pdf param controls for merged item
	switch($pdf)
	{
	 case("2"):
	 	$params->set( 'pdf', 1 );	  
	 break;
	 case("1"):
	  $params->set( 'pdf', 0 );
	 break;
	 default:
	 	$params->def( 'pdf', 			!$mainframe->getCfg( 'hidePdf' ) );
	 break;
  }	 
	 
	switch($print)
	{
	 case("2"):
	 	$params->set( 'print', 1 );	  
	 break;
	 case("1"):
	  $params->set( 'print', 0 );
	 break;
	 default:
	  $params->def( 'print', 			!$mainframe->getCfg( 'hidePrint' ) );
	 break;
  }
	
	
	// collect the data to create the temp item
	$tempitem["title"] = $merged_title;
	$tempitem["text"]  = ob_get_contents();
	// TOC control
	if($tocMarkup) {
	 $tempitem["toc"] = $toc; 
	 $tempitem["tocid"] = $tocid;	 
	 $tempitem["tocMarkup"] = $tocMarkup;
	} else {
	 $tempitem["toc"] = array();
	 $tempitem["tocid"] = array();
   $tempitem["tocMarkup"] = false;	 
	}
	
  ob_end_clean();
	createTempArticle($tempitem,$params,1,$pdfclean);
 }
 /*
  * end code for "merged view"
	*/ 
 if(!$merge){
 
 $params->set( 'moduleclass_sfx', "" );
 echo "<table>";
 for($i=0;$i<$cnt;$i++) {
  $row = new mosContent( $database );
  $row->load( $rows[$i] );	
	
	if($fulltext) 
	{
	 $row->text = $row->introtext . $row->fulltext;
	} else {
	 $row->text = $row->introtext;
	}   
  $item_params = new mosParameters( $row->attribs );
	
	
	// Switches to controll paramaters
	// module controls can overrride the item parameters
	switch($item_title)
	{
	 case("2"):
	 	$item_params->set( 'item_title', 1 );	  
	 break;
	 case("1"):
	  $item_params->set( 'item_title', 0 );
	 break;
  }
	
	switch($link_titles)
	{
	 case("2"):
    $item_params->set( 'link_titles', 1 );
		$item_params->set( 'intro_only', 1 );
		$row->fulltext = $readmore;  
	 break;
	 case("1"):
    $item_params->set( 'link_titles', 0 );
	 break;
	
  }
	
  switch($show_images)
	{
	 case("1"):
	  $item_params->set("image",0);
	 break;
	 default:
	 	$item_params->set("image",1);
	 break;
  }	 

	switch($pdf)
	{
	 case("2"):
	 	$item_params->set( 'pdf', 1 );	  
	 break;
	 case("1"):
	  $item_params->set( 'pdf', 0 );
	 break;
	 default:
	 	$item_params->def( 'pdf', 			!$mainframe->getCfg( 'hidePdf' ) );
	 break;
  }	 
	 
	 
	 
	switch($print)
	{
	 case("2"):
	 	$item_params->set( 'print', 1 );	  
	 break;
	 case("1"):
	  $item_params->set( 'print', 0 );
	 break;
	 default:
	  $item_params->def( 'print', 			!$mainframe->getCfg( 'hidePrint' ) );
	 break;
  }
	
	switch($createdate)
	{
	 case("2"):
	 	$item_params->set( 'createdate', 1 );	  
	 break;
	 case("1"):
	  $item_params->set( 'createdate', 0 );
	 break;
	 default:
	 	$params->def( 'createdate', 	!$mainframe->getCfg( 'hideCreateDate' ) );
	 break;
  }	
	
	switch($modifydate)
	{
	 case("2"):
	 	$item_params->set( 'modifydate', 1 );	  
	 break;
	 case("1"):
	  $item_params->set( 'modifydate', 0 );
	 break;
	 default:
	  $params->def( 'modifydate', 	!$mainframe->getCfg( 'hideModifyDate' ) );
	 break;
  }			
	
	switch($author)
	{
	 case("2"):
	 	$item_params->set( 'author', 1 );	  
	 break;
	 case("1"):
	  $item_params->set( 'author', 0 );
	 break;
	 default:
	  $item_params->def( 'author', 		!$mainframe->getCfg( 'hideAuthor' ) );
	 break;	 
  }
	
	// resolve created_by value to name
  if($item_params->get('author'))
	{
	 $query = "SELECT name FROM #__users WHERE id = $row->created_by"; 
	 $database->setQuery( $query );
   $row->author = $database->loadResult();
	}

// sets readmore to parameter value unless fulltext is set, in which 
	// case a readmore-link would be pointless
	if( $readmore && !$fulltext ) 
	{
	 $item_params->set( 'intro_only', 1 );
	 $item_params->set( 'readmore', $readmore );
	 // joomla actuallay checks if there is "readmore" content
	 // in the usual content function it checks if there are characters
	 // in the fulltext-fields counts them and oputs the number in the 
	 // row->readmore-field  We fake this by setting
	 // the row->readmore to the value of the readmore parameter which
	 // happens to be an integer
	  $row->readmore = $readmore;
	} 
	// we do not want multipage-articles in module positions
  $row->text = preg_replace( $fixpagebreak, '', $row->text );
	 if($i>=$leading) {
 /**/
 if($z%$num_of_cols == 1 && $num_of_cols > 1){
  if($i>0) {
  echo "</tr>\n<tr>\n";
	} else {
  echo "\n<tr>\n";	
	}
 } else if( $num_of_cols == 1 ) {
  
 if($i>0) {
  echo "</tr>\n<tr>\n";
	} else {
  echo "\n<tr>\n";	
	};		 
 }
 /**/
 } else {
  if($i>0) {
   echo "</tr>\n<tr>\n";
	 } else {
   echo "\n<tr>\n";	
	}
 }
 if($i<$leading) { 
  $leading > 0 ? $colspan = ' colspan="' . $num_of_cols . '" ' : $colspan = "";
 } else {
  $colspan = "";
 }
	if(isset($row->introtext)) {
  echo '<td ' . $colspan . 'style="vertical-align:top;">';
		HTML_content::show( $row, $item_params, $access, $page=0, $option="", $ItemidCount=NULL );
	echo "</td>\n";
 } else {
  echo "<td " . $colspan . "></td>\n"; 
 }

  // closing tr
 if($i == $cnt-1) {
  echo "</tr>";
 }

 if($i>=$leading) {
	$z++;
  } 	

  }
 echo "</table>";	
 }
 echo "</div>";		
}
?>
