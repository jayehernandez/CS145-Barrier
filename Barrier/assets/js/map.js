var map, curr;
function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
   center: {lat: 14.5995, lng: 120.9842},
   zoom: 10
  });
  var currLocation = new google.maps.Marker({
    map: map,
    icon: 'http://i67.tinypic.com/ndvfih.png'
  });
  addYourLocationButton(map, currLocation);
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
        curr = latlng; // update global variable
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
          radius: 300
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
