<?php 
class Slider extends Database 
{
 function __construct()
{
	parent::__construct();
	$this->table=$this->TableName('slider');
}
function slider_list($pos='slideshow')
{
	$sql="SELECT*FROM $this->table
     WHERE slider_position='$pos' AND slider_status='1'
     ORDER BY slider_order ASC";
     return $this->QueryAll($sql);	
}
}

 ?>