<?php 
class User extends Database
{	
	function __construct()
	{
		parent::__construct();
		$this->table=$this->TableName('user');
	}
	function user_list($page='index')
	{
		if($page=='index')
		{
			$sql="SELECT * FROM $this->table WHERE user_status!='0' ORDER BY user_createdat DESC";
		}
		else
		{
			$sql="SELECT * FROM $this->table WHERE user_status='0' ORDER BY user_createdat DESC";
		}
		return $this->QueryAll($sql);
	}
	function user_rowid($id)
	{
		$sql="SELECT * FROM $this->table WHERE user_id='$id' LIMIT 1";
		return $this->QueryOne($sql);
	}
	function user_update($data,$id)
	{
		$strset='';
		foreach($data as $f=>$v)
		{
			$strset.=$f."='".$v."',";
		}
		$strset= rtrim(trim($strset),',');
		$sql="UPDATE $this->table SET $strset WHERE user_id='$id'";
		$this->QueryNoResult($sql);
	}
	function user_delete($id)
	{
		$sql="DELETE FROM $this->table WHERE user_id='$id'";
		$this->QueryNoResult($sql);
	}
	function user_insert($data)
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
	function user_exists_name($name,$id=0)
	{
		if($id==0)
		{
			$sql="SELECT * FROM $this->table
			WHERE user_name='$name'";
		}
		else
		{
			$sql="SELECT * FROM $this->table
			WHERE user_name='$name' AND user_id!='$id'";
		}
		if($this->QueryCount($sql))
		{
			return false;
		}
		return true;
	}

	
	function user_namecat($id)
	{
		$sql="SELECT * FROM $this->table WHERE user_id='$id' LIMIT 1";
		$row=$this->QueryOne($sql);
		if($row==NULL)
		{
			return "None";
		}
		return $row['user_fullname'];
	}
}
?>