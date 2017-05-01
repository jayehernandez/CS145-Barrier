<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <!-- Site Properties -->
  <title>Barriér</title>
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo_icon.ico'); ?>"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.js"></script>
  <!-- CSS file location -->
  <link href="<?php echo base_url('assets/css/header_footer.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('assets/css/landing_page.css'); ?>" rel="stylesheet" type="text/css">
</head>

<body>
  <!-- header -->
  <?php include('header.php'); ?>
  <div id="map"></div>

  <!-- footer -->
  <!-- <div class="ui fluid orange center aligned inverted vertical  fixed bottom sticky footer segment" id="footer"></div> -->
</body>

<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5VGrg2pYcLveD8MFh7oXZdIQBYLqr4-Y&callback=initMap">
</script>
<script>
//=============================================================================
//=================================map.js======================================
//=============================================================================
var map, currLocation, mark, currMarker;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
   center: {lat: 14.5995, lng: 120.9842},
   zoom: 10
  });
  
  // Multiple Markers
  var markers = [
    ['B1', 14.66864,121.3131],
    ['B2', 14.70292,121.4],
    ['B3', 14.70292,121.5],
  ];
    
  // Loop through our array of markers & place each one on the map  
  for( i = 0; i < markers.length; i++ ) {
      var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
      marker = new google.maps.Marker({
          position: position,
          map: map,
          title: markers[i][0]
      });
  }

  var current = new google.maps.Marker({
    map: map,
    icon: 'http://i67.tinypic.com/ndvfih.png'
  });
  addYourLocationButton(map, current); // for clicking current location
  google.maps.event.addListener(map, 'click', function(event) {
    placeMarker(event.latLng);
  }); // for adding a marker

}

function addYourLocationButton(map, marker) {
  var controlDiv = document.createElement('div');

  var firstChild = document.createElement('button');
  firstChild.style.backgroundColor = '#fff';
  firstChild.style.border = 'none';
  firstChild.style.outline = 'none';
  firstChild.style.width = '28px';
  firstChild.style.height = '28px';
  firstChild.style.borderRadius = '2px';
  firstChild.style.boxShadow = '0 1px 4px rgba(0,0,0,0.3)';
  firstChild.style.cursor = 'pointer';
  firstChild.style.marginRight = '10px';
  firstChild.style.padding = '0px';
  firstChild.title = 'Your Location';
  controlDiv.appendChild(firstChild);

  var secondChild = document.createElement('div');
  secondChild.style.margin = '5px';
  secondChild.style.width = '18px';
  secondChild.style.height = '18px';
  secondChild.style.backgroundImage = 'url(https://maps.gstatic.com/tactile/mylocation/mylocation-sprite-1x.png)';
  secondChild.style.backgroundSize = '180px 18px';
  secondChild.style.backgroundPosition = '0px 0px';
  secondChild.style.backgroundRepeat = 'no-repeat';
  secondChild.id = 'you_location_img';
  firstChild.appendChild(secondChild);

  // you_location_img is the icon above street view don't remove any of that code, note to self
  google.maps.event.addListener(map, 'dragend', function() {
  	$('#you_location_img').css('background-position', '0px 0px');
  });

  firstChild.addEventListener('click', function() {
  	var imgX = '0';
  	var animationInterval = setInterval(function(){
  		if(imgX == '-18') imgX = '0';
  		else imgX = '-18';
  		$('#you_location_img').css('background-position', imgX+'px 0px');
  	}, 500);
  	if(navigator.geolocation) {
  		navigator.geolocation.getCurrentPosition(function(position) {
  			var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        currLocation = latlng; // update global variable
  			marker.setPosition(latlng);
  			map.setCenter(latlng);
        map.setZoom(17);
  			clearInterval(animationInterval);
  			$('#you_location_img').css('background-position', '-144px 0px');
        var circle = new google.maps.Circle({
          center: latlng,
          radius: position.coords.accuracy,
          map: map,
          fillColor: '#badcef',
          fillOpacity: 0.5,
          strokeColor: '#badcef',
          strokeOpacity: 0.5,
          radius: 300,
          clickable: false
        });
  		});
  	}
  	else {
  		clearInterval(animationInterval);
  		$('#you_location_img').css('background-position', '0px 0px');
  	}
  });
  controlDiv.index = 1;
  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(controlDiv);
}

// place a single marker and update current marker location
function placeMarker(location) {
  if (mark) {
    mark.setPosition(location);
  }
  else {
    mark = new google.maps.Marker({
      position: location,
      map: map
    });
  }
  currMarker = location;
}
//=============================================================================
//============================header.js========================================
//=============================================================================
$('#add_modal').modal('attach events', '#add_menu', 'show');

// get current location or marker and set those values in add form
var lat = document.getElementById("latitude");
var lng = document.getElementById("longitude");
$('#curr').on('click', function() {
  lat.value = currLocation.lat();
  lng.value = currLocation.lng();
});
$('#added.button').on('click', function() {
  lat.value = currMarker.lat();
  lng.value = currMarker.lng();
});

// cancel button for edit details
$('.cancel.button').on('click', function() {
  $('.ui.form')[0].reset(); //edit details form
  $('.ui.form .ui.dropdown').dropdown('restore defaults');
});

// reset button for the forms
$('.reset.button').on('click', function() {
  $('.ui.form')[0].reset(); //edit details form
});

// ajax POST function to store marker to database
$(function(){
  $("#save").click(function(event){
    event.preventDefault();//prevent auto submit data
    var ajax_barrier_id= $("#barrier_id").val();
    var ajax_latitude = $("#latitude").val();
    var ajax_longitude = $("#longitude").val();
    if(!isNaN(ajax_latitude) && !isNaN(ajax_longitude) && ajax_barrier_id && ajax_latitude && ajax_longitude){ //validate if input latitude and longitude are numbers
      $.ajax({
        type:"post",
        url: "<?php echo base_url(); ?>/Barrier/add_marker",
        data:{
          ajax_barrier_id:ajax_barrier_id,
          ajax_latitude:ajax_latitude,
          ajax_longitude:ajax_longitude,
          '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
        },
        success:function(data){
            //console.log(data); //uncomment this for debugging
            window.location.reload();
        },
      });
    }
  });
});

// form validation
$('.ui.form').form({
    inline: true,
    on: "blur",
    fields: {
      barrier_id: {
        rules: [
          {
            type   : 'empty'
          }
        ]},
      latitude: {
        rules: [
          {
            type   : 'empty'
          },
          {
            type   : 'number'
          }
        ]},
      longitude: {
        rules: [
          {
            type   : 'empty'
          },
          {
            type   : 'number'
          }
        ]}
    }
  });
</script>
</html>
