<?php
session_start();
require_once "classes/class.db.php";

$db=new DB_Con();

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
   <script>
   $(document).ready(function()
	{
    doGeoLocation();
   });
  </script>	
</head>
<body>
<div data-role="page">

	<div data-role="header">
		<h1>NearMe</h1>
		<a href="#nav-panel" class="jqm-navmenu-link" data-icon="bars" data-iconpos="notext">Navigation</a>

	</div><!-- /header -->

	<div data-role="content">
<label for="shout"></label>
<input type ="text" data-clear-btn="true" placeholder="What are you thinking ?" id="shout" />

<fieldset class="ui-grid-a">
    <div class="ui-block-a" style="width:75%;"><label for="slider-fill">Miles</label>
    <input type="range" id="range" name="slider-fill" id="slider-fill" value="10" min="0" max="100" step="1" data-highlight="true"> 
    </div>
    <div class="ui-block-b" style="width:25%;">
    <a href="#" data-role="button" data-inline="true" onclick="Shout();">Shout</a>
    	
    </div>
</fieldset>
<div data-role="content" id="activity_div">
	
<a href='#' onclick='doGeoLocation();' data-role='button'>Load Activities</a>	
</div>


</div>


<div data-role="panel" data-position="left" data-position-fixed="false" data-display="reveal" id="nav-panel" data-theme="a">

					<ul data-role="listview" data-theme="a" data-divider-theme="a" style="margin-top:-16px;" class="nav-search">
						<li data-icon="delete">
							<a href="#" data-rel="close">Close</a>
						</li>
						<li><a href="users.php">Directory</a></li>
					    <li><a href="#users">Alerts</a></li>
                       <li><a href="#" data-rel="close" onclick="getActivity('activity_div',userLat,userLong,'distance');">Shouts</a></li>

					</ul>

					<!-- panel content goes here -->
				</div>

	
</div><!-- /page -->

</body>
</html>
</body>
</html>
