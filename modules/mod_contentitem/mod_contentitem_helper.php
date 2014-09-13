<?php
 /*
  * mod_contentitem_helper 2006-04-06 20:40 
  * package mod_contentitem
  * (c) 2006 eikepierstorff@pierstorff.com
	*
	* last change to the module: june 08 2006
  * last change to this file: : june 08 2006
	*
	* createTempArticle
	*
	* @param array $row array that holds the text and title for the merged item
	* @param object $params Item Parameters
	* @param int $deltime time (hours) before temp items are dropped 
	*
	*
	* This is a helper function to the rather misnomed mod_contentitem module
	* It sets up a temporary item in static content for the print/pdf functions
	* in the modules "merged view". 
	*
	* It starts by dropping the previously created temp items. 
  */
 
function createTempArticle($tempitem,$params,$deltime="1",$pdfclean=0)
{
  global $database,$option;
	$date = getdate();
  $today   = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"]. " " . $date["hours"] . ":" . $date["minutes"] . ":" . $date["seconds"]; 
  $deltime = $date["year"] . "-" . $date["mon"] . "-" . $date["mday"]. " " . ($date["hours"]-$deltime) . ":" . $date["minutes"] . ":" . $date["seconds"]; 

	// delete temp items
	$query = "DELETE FROM #__content WHERE metakey = 'mod_contentitem' AND created < '$deltime'";
	$database->setQuery($query);
	$database->query();
	
	// these are the various things that make up a static content item
	$title				          = $tempitem["title"];
  $title_alias				    = "(temporay item from mod_contentitem)";
	if($tempitem["tocMarkup"])
  {
	 $introtext			        = createModItemToc($tempitem["toc"],$tempitem["tocid"],$tempitem["tocMarkup"],false);
	} else 
	{
	 $introtext             = "";
	}
	
	$fulltext               = $database->getEscaped($tempitem["text"]);
	if(pdfclean == 1) {
	 $fulltext               =  "<table>" . cleanforPdf($fulltext) . "</table>";
	} else {
	 $fulltext               =  "<table>" . $fulltext . "</table>";	
	}
	$state				          = 1;
  $sectionid			        = 0;	
	$mask				            = 0;
	$catid				          = 0;	
	$created			          = $today;      
	$created_by			        = "62";
	$created_by_alias	      = "";
	$modified			          = "";
	$modified_by		        = "";
	$checked_out		        = 0;
	$checked_out_time	      = "0000-00-00 00:00:00";
	$frontpage_up		        = null;
	$frontpage_down		      = null;
	$publish_up			        = $created;
	$publish_down		        = "0000-00-00 00:00:00";
	$images				          = "";
	$urls				            = "";
	
	$attribs  = 'pageclass_sfx=\n';
	$attribs .= 'back_button=0\n';
	$attribs .= 'author=0\n';
	$attribs .= 'createdate=0\n';
	$attribs .= 'modifydate=0\n';
	$attribs .= 'navigation=0\n';
	if($tempitem["title"]) 
	{
	 $attribs .= 'item_title=1\n';
	} else {
	 $attribs .= 'item_title=0\n';	
	}	
	$attribs .= 'item_navigation=0\n';
	$attribs .= 'pdf=' . $params->get('pdf' , 0) . "\n";
	$attribs .= 'print=' . $params->get('print' , 0) . "\n";
	$attribs .= 'email=0';
	
	$version			          = 0;
	$parentid			          = 0;
	$ordering			          = 0;
	$metakey			          = "mod_contentitem";
	$metadesc			          = "";
	$access				          = 0;
	$hits				            = "";

  $query  =     "INSERT INTO `#__content` 
	              (`title`, 
								 `title_alias`, 
								 `introtext`, 
								 `fulltext`,
							   `state`, 
								 `sectionid`, 
								 `mask`, 
								 `catid`, 
								 `created`, 
								 `created_by`, 
								 `created_by_alias`, 
								 `modified`, 
								 `modified_by`, 
								 `checked_out`, 
								 `checked_out_time`, 
								 `publish_up`, 
								 `publish_down`, 
								 `images`, 
								 `urls`, 
								 `attribs`, 
								 `version`, 
								 `parentid`, 
								 `ordering`, 
								 `metakey`, 
								 `metadesc`, 
								 `access`, 
								 `hits`) VALUES (
                 '$title', 
								 '$title_alias', 
								 '$introtext', 
								 '$fulltext',
							   '$state', 
								 '$sectionid', 
								 '$mask', 
								 '$catid', 
								 '$created', 
								 '$created_by', 
								 '$created_by_alias', 
								 '$modified', 
								 '$modified_by', 
								 '$checked_out', 
								 '$checked_out_time', 
								 '$publish_up', 
								 '$publish_down', 
								 '$images', 
								 '$urls', 
								 '$attribs', 
								 '$version', 
								 '$parentid', 
								 '$ordering', 
								 '$metakey', 
								 '$metadesc', 
								 '$access', 
								 '$hits');";	

 $database->setQuery( $query );

 $database->query();
 
 // now we retrieve the item that we just created
 // this may sound overly complicated but it ensures that
 // {mosimages} and item parameters are parsed and that there is
 // a content item id to pass on to the print and pdf functions 
 $row = new mosContent( $database );
 $row->load( $database->insertid() ); 

 $item_params = new mosParameters( $row->attribs );
 // For screen view we create a linked version of the TOC
 if($tempitem["tocMarkup"])
 {
  $row->introtext = createModItemToc($tempitem["toc"],$tempitem["tocid"],$tempitem["tocMarkup"],true);
 }

 $row->text = $row->introtext .  "<table>" . $tempitem["text"] . "</table>";

 HTML_content::show( $row, $item_params, $access, $page=0, $option="", $ItemidCount=NULL );
 return;
}

/*
 * cleanforPdf
 *
 * @param string $fulltext text to clean
 * @return string $fulltext cleaned text   
 *
 * This function is very ugly. We have to store the "merged item" in a way that  
 * keeps the formatting for print display and yet looks half-way decent in PDF view  
 * which is more or less mutually exclusive.
 *
 * Joomlas PDF-Class is terribly literary-minded in converting
 * spaces and linebreaks, so we need to remove some of these on a case-by-case basis.
 *
 * It is not possible (at least not for me) to write a more generalized approach, so  
 * this will have to do.
 */
 
function cleanforPdf($fulltext)
{

	$fulltext			          = ereg_replace("\\\\r\\\\n","",$fulltext);
  $fulltext			          = ereg_replace("\\\\n","",$fulltext);
	$fulltext			          = ereg_replace('<table class="contentpaneopen">','\n\n\n<table class="contentpaneopen">\n',$fulltext);	
	$fulltext			          = ereg_replace('<span','\n\n<span',$fulltext);
	$fulltext			          = ereg_replace('</span>','</span>\n\n',$fulltext);
	$fulltext			          = ereg_replace('<ul>','\n\n<ul>',$fulltext);
	$fulltext			          = ereg_replace('<ol>','\n\n<ol>',$fulltext);
	$fulltext			          = ereg_replace('</ul>','</ul>\n\n',$fulltext);
	$fulltext			          = ereg_replace('<ol>','</ol>aaaa\n\n',$fulltext);				
	$fulltext			          = ereg_replace('<a name="','\n\n<a name="',$fulltext);	
//  $fulltext			          = ereg_replace('>.[[:space:]]+','>',$fulltext);
//	$fulltext			          = ereg_replace('[[:space:]]+.<','<',$fulltext);			
  $fulltext			          = ereg_replace("^[>].[[:space:]]+.$[<]", "", $fulltext);	
  $fulltext			          = ereg_replace("<tr>","\n<tr>\n",$fulltext);		
  $fulltext			          = ereg_replace("[[:space:]]+", " ", $fulltext); 
  $fulltext			          = ereg_replace("{mospagebreak}", "", $fulltext);
  $fulltext			          = "\n\n\n" . $fulltext;
	$fulltext               = ereg_replace(_READ_MORE, " ", $fulltext);
  return $fulltext;
}


/*
 * createModItemToc
 *
 * @param array $toc array with item titles  
 * @param array $toc array with item ids
 * @param string tocMarkup what kind of markup to use (ordered list, unordered list, table)
 * @param bool linked are TOC entries linked?
 *
 *
 * @return string $showtoc The Table of contents
 */

function createModItemToc($toc,$tocid,$tocMarkup,$linked=false) {
 switch($tocMarkup)
 {
 case("table"):
  $format = "<tr><td style=\"vertical-align:top\"> %2\$d. </td><td style=\"vertical-align:top\">%1\$s</td></tr>";
 break;
 case("ul"):
 case("ol"):
 default: 
  $format = "<li>%s</li>";
 break; 
 }
 
 $showtoc  = '<' . $tocMarkup . '>';
 $count = count($toc);
 for($i=0;$i<$count;$i++)
 {
  if($linked)
	{
   $link = '<a href="#toc_' . $tocid[$i] . '">' . $toc[$i] . '</a>';
	} else {
   $link = $toc[$i];
	}
  $showtoc .= sprintf($format,$link,($i+1));
	
 }  
 $showtoc .= '</' . $tocMarkup . '>';
 return $showtoc;
}


function cst_pdf()
{
 echo "hallo";
}
?>