<?php 
class Product extends Database
{
	function __construct()
	{
		parent::__construct();
		$this->table=$this->TableName('product');
	}
	function product_home_lastnews($limit)
	{
		$sql="SELECT*FROM $this->table WHERE product_status='1'
		ORDER BY product_createdat DESC LIMIT $limit";
		return $this->QueryAll($sql);
	}
	function product_all($first,$limit)
	{
		$sql="SELECT*FROM $this->table WHERE product_status='1'
		ORDER BY product_createdat DESC LIMIT $first,$limit";
		return $this->QueryAll($sql);
	}
	function product_all_count()
	{
		$sql="SELECT*FROM $this->table WHERE product_status='1'";
		return $this->QueryCount($sql);
	}
	function product_category($acat,$first,$limit)
	{
		$strin=implode($acat,',');
		$sql="SELECT*FROM $this->table WHERE product_status='1' AND product_catid IN ($strin)
		ORDER BY product_createdat DESC LIMIT $first,$limit";

		return $this->QueryAll($sql);
	}
	function product_category_count($acat)
	{
		$strin=implode($acat,',');
		$sql="SELECT * FROM $this->table WHERE product_catid IN($strin) AND product_status='1'"; 
		return $this->QueryCount($sql);
	}
	function product_rowslug($slug)
	{
		$sql="SELECT*FROM $this->table WHERE product_slug='$slug'";
		return $this->QueryOne($sql);
	}
	function product_other($listcatid,$id,$limit=8)
	{
		$strin=implode($listcatid,',');
		$sql="SELECT*FROM $this->table WHERE product_catid IN ($strin) AND product_status='1' AND product_id!='$id' ORDER BY  product_createdat DESC LIMIT $limit";
		return $this->QueryAll($sql);
	}
	function product_rowid($id)
	{
		$sql="SELECT*FROM $this->table WHERE product_id='$id'";
		return $this->QueryOne($sql);
	}
}

 ?>