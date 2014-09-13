<?php
/*
 * Created on 2006-9-4
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 	class Mospage{
 		var $main_text;
 		var $nav_menu;
 		function parse_text($in_text,$page,$url){
 			
 			
 			
 			$regex = '/{(mospagebreak)\s*(.*?)}/i';
 			$matches = array();
			preg_match_all( $regex, $in_text, $matches, PREG_SET_ORDER );
			// split the text around the mambot
			$text = preg_split( $regex, $in_text );
			// 	count the number of pages
			$n = count( $text );
			if($n<=1){
				$this->main_text = $in_text;
				return;
			}
			$this->main_text = $text[$page];
			$this->nav_menu = '<table border="0" cellspacing="0" cellpadding="0"><tr>';
 			foreach ($matches as $k => $value){
 				parse_str( html_entity_decode( $matches[$k][2] ), $args );
 				if(($k+1)==$page){
 					$this->nav_menu .= '<td class="nava_left"></td>';
 					$this->nav_menu .= '<td class="nava_middle">'.$args['title'].'</td>';
 					$this->nav_menu .= '<td class="nava_right"></td>';	
 				} else{
 					$this->nav_menu .= '<td class="nav_left"></td>';
 					$kk = $k + 1;
 					$url2=$url."&mospageno=".$kk;
 					$this->nav_menu .= '<td class="nav_middle"><a href="'.$url2.'">'.$args['title'].'</a></td>';
 					$this->nav_menu .= '<td class="nav_right"></td>';
 				} 
 			}
 			$this->nav_menu .= '</tr></table>';
 		}
 	
 	}
 	
 	
?>
