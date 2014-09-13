<?php


class translationVm_categoryFilter extends translationFilter
{
	function translationVm_categoryFilter ($contentElement){
		$this->filterNullValue=-1;
		$this->filterType="vm_category";
		$this->filterField = $contentElement->getFilter("vm_category");
		parent::translationFilter($contentElement);
	}
	
	function _createFilter(){
		global $database;
		if (!$this->filterField ) return "";
		$filter="";
		if ($this->filter_value!=$this->filterNullValue){
			// get list of product_id in the appropriate category
			$sql = "SELECT xref.product_id FROM #__vm_product_category_xref as xref"
			." WHERE xref.category_id=$this->filter_value";
			$database->setQuery($sql);
			$prodids = $database->loadObjectList();
			$idstring = "";
			foreach ($prodids as $pid){
				if (strlen($idstring)>0) $idstring.=",";
				$idstring.=$pid->product_id;
			}
			$filter = "c.product_id IN($idstring)";
		}
		return $filter;
	}
	

	/**
 * Creates vm_category filter 
 *
 * @param unknown_type $filtertype
 * @param unknown_type $contentElement
 * @return unknown
 */
	function _createfilterHTML(){
		global $database;

		if (!$this->filterField) return "";
		$categoryOptions=array();
		$categoryOptions[] = mosHTML::makeOption( '-1',_JOOMFISH_ADMIN_CATEGORY_ALL );

		$sql = "SELECT DISTINCT cat.category_id, cat.category_name FROM #__vm_category as cat,"
			  ." #__".$this->tableName." as c, #__vm_product_category_xref as xref"
			  ." WHERE c.product_id=xref.product_id AND xref.".$this->filterField."=cat.category_id ORDER BY cat.category_name";
		$database->setQuery($sql);
		$cats = $database->loadObjectList();
		$catcount=0;
		foreach($cats as $cat){
			$categoryOptions[] = mosHTML::makeOption( $cat->category_id,$cat->category_name);
			$catcount++;
		}
		$categoryList=array();
		$categoryList["title"]=_JOOMFISH_ADMIN_CATEGORY;
		$categoryList["html"] = mosHTML::selectList( $categoryOptions, 'vm_category_filter_value', 'class="inputbox" size="1" onchange="document.adminForm.submit();"', 'value', 'text', $this->filter_value );

		return $categoryList;

	}

}

?>