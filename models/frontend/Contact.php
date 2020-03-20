<?php 
class Contact extends Database
{
	
	function __construct()
	{
		parent::__construct();
		$this->table=$this->TableName('contact');
	}
	function contact_insert($data)
	{
		$strf='';
		$strv='';
		foreach ($data as $f=>$v) 
		{
			$strf.=$f.',';
			$strv.="'".$f."',";
		}
		$strf=rtrim($strf,',');
		$strv=rtrim($strv,',');
		$sql="INSERT INTO $this->table($strf) VALUES($strv) ";
		return $this->QueryNoResult($sql);
	}
}

 ?>