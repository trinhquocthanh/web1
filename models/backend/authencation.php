<?php 
class Authencation extends Database
{
	
	function __construct()
	{
		parent::__construct();
		$this->table=$this->TableName('user');
	}
	function user_exists_username($username)
	{
		$sql="SELECT * FROM $this->table WHERE user_username='$username' AND user_access='1' AND user_status='1'";
		if($this->QueryCount($sql))
		{
			return TRUE;
		}
		return FALSE;
	}
	function auth_guard($username,$password)
	{
		$sql="SELECT * FROM $this->table WHERE user_username='$username' AND user_password='$password' AND  user_access='1' AND user_status='1'";
		if($this->QueryCount($sql))
		{
			return $this->QueryOne($sql);
		}
		return FALSE;
	}
}