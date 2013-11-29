var userLat="";
var userLong="";
var TimeOutValue=3000;
function doGeoLocation()
{
    if (navigator.geolocation != undefined) 
    {
        navigator.geolocation.watchPosition(onFound, onError);
    }
    else
    alert("Something wrong with geolocation settings");
}

function onFound(pos) {
     userLat = pos.coords.latitude;
     userLong = pos.coords.longitude;
    $.ajax({
          url: "checkin.php",
          type: "POST",
		  timeout:TimeOutValue,
		  data:{"lat":userLat,"long":userLong},
          success: function(json,status)
		                {
                         getActivity("activity_div",userLat,userLong,"main");
                        },
	error: function( objAJAXRequest, strError )
		  {
              
		  }
 
       });
    
}

function onError(pos) {
    alert("Your Geolocation settings are off.");
}

function getActivity(div,lat,long,type)
   {
    
    $.ajax({
          url: "activity.php",
          timeout:TimeOutValue,
		  data:{"lat":lat,"long":long,"type":type},
          success: function(data,status)
		                {
                         $("#"+div).html(data);
                         $("#"+div).trigger("create");
                        },
	error: function( objAJAXRequest, strError )
		  {
            $("#"+div).html("Some Problem");
		  }
 
       });
 }
 
function Shout()
   {
    var shout=$("#shout").val();
    var range=$("#range").val();
    $.ajax({
          url: "shout.php",
          timeout:TimeOutValue,
          data:{"lat":userLat,"long":userLong,"shout":shout,"range":range},

          success: function(data,status)
		                {
                         getActivity("activity_div",userLat,userLong,"main");
                        },
	error: function( objAJAXRequest, strError )
		  {
            alert("Some Problem");
		  }
 
       });
 }