var map;
function loadMap() {
	map = new google.maps.Map(document.getElementById('map'), {
	 	zoom: 12,
	 	center: {lat: 18.9903, lng: 73.1187}
	});

	var marker = new google.maps.Marker({
	  position: pune,
	  map: map
	});
}