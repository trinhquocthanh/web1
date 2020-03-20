<?php 
class Menu extends Database
{
	function __construct()
	{
		parent::__construct();
		$this->table=$this->TableName('menu');
	}
	function menu_parentid($pos,$parentid=0)
	{
		$sql="SELECT * FROM $this->table
			WHERE menu_parentid='$parentid' AND menu_position='$pos' AND menu_status='1'";
		return $this->QueryAll($sql);
	}
}
?>