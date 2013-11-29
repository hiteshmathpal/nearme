<?php
session_start();
$userid=$_SESSION["userid"];
$lat=$_REQUEST['lat'];
$long=$_REQUEST['long'];
require_once "classes/class.db.php";
require_once "classes/class.user.php";

    $db=new DB_Con();
	$user=new User();
    $now=date("Y-m-d H:i:s");
	
	 $select="select * from user_activity where userid='$userid' order by activityTime desc limit 0,1";
	 $rows=$db->getSelect($select);
	 $records=$rows[0];
	 
	 if($db->getResultsCount()>0)
	 {
	 	$diff=$user->distance($lat,$long,$records->lat,$records->lng);
		$timediff=strtotime($now)-strtotime($records->activityTime);
		$period=round($timediff/60,2);
		$diff=round($diff,2);
		if($diff<=0 && $period<=30)
		{
		$array=array("id"=>0,"msg"=>"Too early ".$period." Minutes with same location");
		echo json_encode($array);
			
		exit;
		}
	 }
	
	
    $arr=array("userid"=>$userid,"activityType"=>"checkIn","post"=>"","activityTime"=>$now,"lat"=>$lat,"lng"=>$long);
	$insert=$db->setData($arr,"user_activity");
	$array=array("id"=>0);
	if($insert)
	{ 
	
		$array=array("id"=>1);
	
	}
	
	echo json_encode($array);
?>