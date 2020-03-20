<?php 
class Category extends Database
{
	function __construct()
	{
		parent::__construct();
		$this->table = $this->TableName('category');
	}
	function category_parentid($parentid=0)
	{
		$sql="SELECT * FROM $this->table
		WHERE category_parentid='$parentid' AND category_status='1'";
		return $this->QueryAll($sql);
	}
	function category_rowslug($slug)
	{
		$sql="SELECT * FROM $this->table
		WHERE category_slug='$slug' AND category_status='1'";
		return $this->QueryOne($sql);

	}
	function category_listid($catid)
	{
		$a[]=$catid;
		$list1=$this->category_parentid($catid);
		if(count($list1))
		{
			foreach ($list1 as $l1)
			{
				$a[]=$l1['category_id'];
				$list2=$this->category_parentid($l1['category_id']);
				if(count($list2))
				{
					foreach ($list2 as $l2)
					{
						$a[]=$l2['category_id'];         
					}

				}         
			}

		}
		return $a;
	}
}
?>

