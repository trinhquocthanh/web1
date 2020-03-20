<?php 
class Category extends Database
{	
	function __construct()
	{
		parent::__construct();
		$this->table=$this->TableName('category');
	}
	function category_list($page='index')
	{
		if($page=='index')
		{
			$sql="SELECT * FROM $this->table WHERE category_status!='0' ORDER BY category_createdat DESC";
		}
		else
		{
			$sql="SELECT * FROM $this->table WHERE category_status='0' ORDER BY category_createdat DESC";
		}
		return $this->QueryAll($sql);
	}
	function category_rowid($id)
	{
		$sql="SELECT * FROM $this->table WHERE category_id='$id' LIMIT 1";
		return $this->QueryOne($sql);
	}
	function category_update($data,$id)
	{
		$strset='';
		foreach($data as $f=>$v)
		{
			$strset.=$f."='".$v."',";
		}
		$strset= rtrim(trim($strset),',');
		$sql="UPDATE $this->table SET $strset WHERE category_id='$id'";
		$this->QueryNoResult($sql);
	}
	function category_delete($id)
	{
		$sql="DELETE FROM $this->table WHERE category_id='$id'";
		$this->QueryNoResult($sql);
	}
	function category_insert($data)
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
	function category_exists_name($name,$id=0)
	{
		if($id==0)
		{
			$sql="SELECT * FROM $this->table
			WHERE category_name='$name'";
		}
		else
		{
			$sql="SELECT * FROM $this->table
			WHERE category_name='$name' AND category_id!='$id'";
		}
		if($this->QueryCount($sql))
		{
			return false;
		}
		return true;
	}

	
	function category_namecat($id)
	{
		$sql="SELECT * FROM $this->table WHERE category_id='$id' LIMIT 1";
		$row=$this->QueryOne($sql);
		if($row==NULL)
		{
			return "None";
		}
		return $row['category_name'];
	}
}
?>