<?php 
session_start();
ob_start();
require_once ('../classes/class.db.php');
require_once ('../classes/class.user.php');

require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

$db=new DB_Con();
$user= new User();

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
/* Request access tokens from twitter */


$access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
$_SESSION['access_token'] = $access_token;

/* If HTTP response is 200 continue otherwise send to connect page to retry */

if (200 == $connection->http_code) 	
{
	
	
$content =$connection->get('account/verify_credentials');
$screenName=$content->screen_name;
$userid=$content->id_str;
$name=$content->name;
$image=$content->profile_image_url;
$bio=$content->description;


$sql="select * from login_info where userid='$userid' and channel='twitter'";
$rows=$db->getSelect($sql);
$now=date("Y-m-d H:i:s");	


if($db->getResultsCount()>0)
{
$sql="update login_info set userid='$userid',username='$screenName',name='$name',logindate=NOW(),bio='$bio',image='$image' where userid='$userid' AND channel='twitter'";


$rows = $db->updateQuery($sql);
if($rows>0)
{
	$user->UserSession($userid,$name,"twitter");
}
else
echo "Not Updated";


print_r($rows);
} 
else 
{
$arr=array("userid"=>$userid,"username"=>$screenName,"name"=>$name,"image"=>$image,"bio"=>$bio,"email"=>"","logindate"=>$now,"channel"=>"twitter");
	$insert=$db->setData($arr,"login_info");
	if($insert)
	{ 
	echo "Inserted";
    $user->UserSession($userid,$name,"twitter");
	
	
	}
	else
	echo "Not Inserted";
}



} 
header("Location:../home.php");
ob_flush();
 ?>
 