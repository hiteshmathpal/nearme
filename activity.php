<?php
session_start();
$userid=$_SESSION["userid"];
$lat=$_REQUEST['lat'];
$long=$_REQUEST['long'];
$type=$_REQUEST["type"];

require_once "classes/class.db.php";
require_once "classes/class.user.php";


$db=new DB_Con();
$user=new User();
?>
<ul data-role="listview" data-inset='true'>
	
<?php
switch($type)
{
	    case "main":
		deault:	
        $sql="select u.*,l.* from user_activity u, login_info l order by activityTime desc limit 0,10";
		


      $rows=$db->getSelect($sql);
      foreach($rows as $activity)
      {
      $diff=0;
      $period=0;
      $diff=$user->distance($lat, $long, $activity->lat, $activity->lng, $miles = true);
      $diff=round($diff,2);	
      $period=$user->time_difference($activity->activityTime);
      echo "<li><img src='".$activity->image."' style='width:50%'/><h3>".$activity->name."</h3><p>".$activity->post."</p><p>".$activity->activityType." $period<span class=\"ui-li-count\">".$diff." Miles</span></li>";	
      }
     break;
	 
		case "distance":
        $sql="select u.*,l.* from user_activity u, login_info l where  DATEDIFF( activityTime, NOW( ) )<=1 AND u.distance>0 order by activityTime desc limit 0,10";
	  $rows=$db->getSelect($sql);
      foreach($rows as $activity)
      {
      $diff=0;
      $period=0;
      $diff=$user->distance($lat, $long, $activity->lat, $activity->lng, $miles = true);
      $diff=round($diff,2);	
      $period=$user->time_difference($activity->activityTime);
	  if($diff<=$activity->distance)
      echo "<li><img src='".$activity->image."' style='width:50%'/><h3>".$activity->name."</h3><p>".$activity->post."</p><p>".$activity->activityType." $period<span class=\"ui-li-count\">".$diff." Miles</span></li>";	
      }


}
?>
	
</ul>