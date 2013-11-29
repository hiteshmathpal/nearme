<?php
session_start();
require_once "classes/class.db.php";

$db=new DB_Con();
$sql="select * from login_info";
$rows=$db->getSelect($sql);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>jQuery Mobile Demos</title>
	<link rel="stylesheet"  href="css/themes/default/jquery.mobile-1.3.2.min.css">
	<link rel="stylesheet" href="_assets/css/jqm-demos.css">
	<link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<script src="js/jquery.js"></script>
	<script src="_assets/js/index.js"></script>
	<script src="js/jquery.mobile-1.3.2.min.js"></script>
	<script src="js/lib.js"></script>
</head>
<body>
<div data-role="header">
		<h1>Directory</h1>
		<a href="home.php" class="jqm-navmenu-link"  data-icon="back" data-iconpos="notext">Back</a>

	</div><!-- /header -->

	<div data-role="content">
<ul data-role="listview" data-inset="true">
	<?php
	
	foreach($rows as $user)
	{
	$img=$user->image;	
	if($user->userid==$_SESSION["userid"])	
	echo "<li><img src='$img' style='width:75px;'><h3>".$user->name." (Me)</h3><p style='white-space:normal;'>".$user->bio."</p></li>";	
	else
	echo "<li><img src='$img' style='width:75px;'><h3>".$user->name."</h3><p style='white-space:normal;'>".$user->bio."</p></li>";	
	}
	
	?>
</ul>
</div>
</div>
</body>
</html>
