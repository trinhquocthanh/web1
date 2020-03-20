<?php 
class Post extends Database
{
	
	function __construct()
	{
		parent::__construct();
		$this->table=$this->tableName('post');
	} 

	function post_list($first,$limit)
	{
		$sql="SELECT * FROM $this->table WHERE post_status='1' AND post_type='post' ORDER BY post_createdat DESC LIMIT $first,$limit";
		return $this->QueryAll($sql);
	}
	function post_list_count()
	{
		$sql="SELECT * FROM $this->table WHERE post_status='1'";
		return $this->QueryCount($sql);
	}
	function post_rowslug($slug,$type='post')
	{
		$sql="SELECT * FROM $this->table WHERE post_slug='$slug' AND post_type='$type' AND  post_status='1' LIMIT 1";
		return $this->QueryOne($sql);
	}
	function post_topic($acat,$first,$limit)
	{
		$strin=implode($acat,',');
		$sql="SELECT * FROM $this->table WHERE post_status='1' AND post_topid IN ($strin) ORDER BY post_createdat DESC LIMIT $first,$limit";
		return $this->QueryAll($sql);
	}
	function post_topic_count($acat)
	{
		$strin=implode($acat,',');
		$sql="SELECT * FROM $this->table WHERE post_status='1' AND post_topid IN ($strin)"; 
		return $this->QueryCount($sql);
	}function post_listother($id,$limit)
	{
		$sql="SELECT * FROM $this->table WHERE post_status='1' AND post_id!='$id' AND' ORDER BY post_createdat DESC LIMIT $limit";
		return $this->QueryAll($sql);
	}
}

?>