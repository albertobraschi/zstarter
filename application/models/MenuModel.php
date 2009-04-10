<?php
class MenuModel extends Zend_Db_Table_Abstract 
{
	protected $_name = 'admin_menu';
	
	public function getMenu() {
		//$select=$this->query("select * from admin_menu where hidden!=0");
		$select=$this->select()
						->from(
							array("sm"=>"admin_menu"),
							array(
								"Name"=>"sm.Name",
								"Description"=>"sm.Description",
								"Alias"=>"sm.Alias"))
						->where("sm.Hidden=0");
						
		$res = $this->fetchAll($select);
		$rowArray = $res->toArray();
		return $rowArray;
	}
}
?>