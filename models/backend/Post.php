<?php 
class Post extends Database
{	
	function __construct()
	{
		parent::__construct();
		$this->table=$this->TableName('post');
	}
	function post_list($page='index')
	{
		if($page=='index')
		{
			$sql="SELECT * FROM $this->table WHERE post_status!='0' ORDER BY post_createdat DESC";
		}
		else
		{
			$sql="SELECT * FROM $this->table WHERE post_status='0' ORDER BY post_createdat DESC";
		}
		return $this->QueryAll($sql);
	}
	function post_rowid($id)
	{
		$sql="SELECT * FROM $this->table WHERE post_id='$id' LIMIT 1";
		return $this->QueryOne($sql);
	}
	function post_update($data,$id)
	{
		$strset='';
		foreach($data as $f=>$v)
		{
			$strset.=$f."='".$v."',";
		}
		$strset= rtrim(trim($strset),',');
		$sql="UPDATE $this->table SET $strset WHERE post_id='$id'";
		$this->QueryNoResult($sql);
	}
	function post_delete($id)
	{
		$sql="DELETE FROM $this->table WHERE post_id='$id'";
		$this->QueryNoResult($sql);
	}
	function post_insert($data)
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
	function post_exists_name($name,$id=0)
	{
		if($id==0)
		{
			$sql="SELECT * FROM $this->table
			WHERE post_name='$name'";
		}
		else
		{
			$sql="SELECT * FROM $this->table
			WHERE post_name='$name' AND post_id!='$id'";
		}
		if($this->QueryCount($sql))
		{
			return false;
		}
		return true;
	}
}
?>