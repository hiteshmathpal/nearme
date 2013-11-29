<?php
session_start();
$userid=$_SESSION["userid"];
$lat=$_REQUEST['lat'];
$lng=$_REQUEST['long'];
$text=$_REQUEST['shout'];
$range=$_REQUEST['range'];
require_once "classes/class.db.php";

    $db=new DB_Con();

    $now=date("Y-m-d H:i:s");
    $arr=array("userid"=>$userid,"activityType"=>"shout","post"=>$text,"activityTime"=>$now,"distance"=>$range,"lat"=>$lat,"lng"=>$lng);
	$insert=$db->setData($arr,"user_activity");
	$array=array("id"=>0);
	if($insert)
	{ 
	
		$array=array("id"=>1);
		
		$sql="select * from user_activity where  DATEDIFF( activityTime,NOW())<=1";
		$rows=$db->getSelect($sql);
	
	}
	
	echo json_encode($array);
?>