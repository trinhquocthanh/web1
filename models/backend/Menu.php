<?php 
class Menu extends Database
{	
	function __construct()
	{
		parent::__construct();
		$this->table=$this->TableName('Menu');
	}
	function Menu_list($page='index')
	{
		if($page=='index')
		{
			$sql="SELECT * FROM $this->table WHERE Menu_status!='0' ORDER BY Menu_createdat DESC";
		}
		else
		{
			$sql="SELECT * FROM $this->table WHERE Menu_status='0' ORDER BY Menu_createdat DESC";
		}
		return $this->QueryAll($sql);
	}
	function Menu_rowid($id)
	{
		$sql="SELECT * FROM $this->table WHERE Menu_id='$id' LIMIT 1";
		return $this->QueryOne($sql);
	}
	function Menu_update($data,$id)
	{
		$strset='';
		foreach($data as $f=>$v)
		{
			$strset.=$f."='".$v."',";
		}
		$strset= rtrim(trim($strset),',');
		$sql="UPDATE $this->table SET $strset WHERE Menu_id='$id'";
		$this->QueryNoResult($sql);
	}
	function Menu_delete($id)
	{
		$sql="DELETE FROM $this->table WHERE Menu_id='$id'";
		$this->QueryNoResult($sql);
	}
	function Menu_insert($data)
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
	function Menu_exists_name($name,$id=0)
	{
		if($id==0)
		{
			$sql="SELECT * FROM $this->table
			WHERE Menu_name='$name'";
		}
		else
		{
			$sql="SELECT * FROM $this->table
			WHERE Menu_name='$name' AND Menu_id!='$id'";
		}
		if($this->QueryCount($sql))
		{
			return false;
		}
		return true;
	}

	
	function Menu_namecat($id)
	{
		$sql="SELECT * FROM $this->table WHERE Menu_id='$id' LIMIT 1";
		$row=$this->QueryOne($sql);
		if($row==NULL)
		{
			return "None";
		}
		return $row['menu_name'];
	}
}
?>