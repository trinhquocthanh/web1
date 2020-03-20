<?php 
class Product extends Database
{	
	function __construct()
	{
		parent::__construct();
		$this->table=$this->TableName('product');
	}
	function product_list($page='index')
	{
		if($page=='index')
		{
			$sql="SELECT * FROM $this->table WHERE product_status!='0' ORDER BY product_createdat DESC";
		}
		else
		{
			$sql="SELECT * FROM $this->table WHERE product_status='0' ORDER BY product_createdat DESC";
		}
		return $this->QueryAll($sql);
	}
	function product_rowid($id)
	{
		$sql="SELECT * FROM $this->table WHERE product_id='$id' LIMIT 1";
		return $this->QueryOne($sql);
	}
	function product_update($data,$id)
	{
		$strset='';
		foreach($data as $f=>$v)
		{
			$strset.=$f."='".$v."',";
		}
		$strset= rtrim(trim($strset),',');
		$sql="UPDATE $this->table SET $strset WHERE product_id='$id'";
		$this->QueryNoResult($sql);

	}
	function product_delete($id)
	{
		$sql="DELETE FROM $this->table WHERE product_id='$id'";
		$this->QueryNoResult($sql);
	}
	function product_insert($data)
	{
		$strf='';
		$strv='';
		foreach($data as $f=>$v)
		{
			$strf.=$f.",";
			$strv.="'".$v."',";
		}
		$strf=trim($strf);
		$strv=trim($strv);
		$strf=rtrim($strf,',');
		$strv=rtrim($strv,',');
		$sql="INSERT INTO $this->table($strf) VALUES($strv)";
		$this->QueryNoResult($sql);
	}
	function product_exists_name($name,$id=0)
	{
		if($id==0)
		{
			$sql="SELECT * FROM $this->table
			WHERE product_name='$name'";
		}
		else
		{
			$sql="SELECT * FROM $this->table
			WHERE product_name='$name' AND product_id!='$id'";
		}
		if($this->QueryCount($sql))
		{
			return false;
		}
		return true;
	}
}
?>