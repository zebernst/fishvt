<head>
 	<link 	rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
   			integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ=="
   			crossorigin=""/>
   	<!-- leaflet.js -->
	<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"
   			integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log=="
   			crossorigin=""></script>
</head>
<body>

<?php include '_includes/getdata.php'; ?>
<?php include '_lib/filter_attr.php';  ?>


<!--
<div id="mapid" style="width: 600px; height: 400px;"></div>
<?php include "_private/mapboxapi.php"; ?>
<script>
	var mymap = L.map('mapid').setView([44.0511, -72.9245], 7);
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    	attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
    	maxZoom: 18,
    	id: 'mapbox.streets',
    	accessToken: "<?php print $apiKey; ?>"
	}).addTo(mymap);

	var locations = [
	<?php
		foreach ($data as $location) {
			$waterBody = $location['attributes']['WaterBody'];
			$directions = $location['attributes']['Directions'];
			$info = "\"<strong>$waterBody</strong><br>$directions\"";
			$lat = $location['geometry']['y'];
			$lon = $location['geometry']['x'];
			print "[$info, $lat, $lon],\n";
		}
	?>
	];

	marker = new L.marker([<?php print $user_lat; ?>, <?php print $user_lon; ?>])
		.bindPopup("<strong>Your current location</strong>")
		.addTo(mymap);

	for (var i = 0; i < locations.length; i++) {
			marker = new L.marker([locations[i][1],locations[i][2]])
				.bindPopup(locations[i][0])
				.addTo(mymap);
		}

</script>
-->
<?php
$yellowperch = filter_attr($data, "YellowPerch", true);
$sheepshead  = filter_attr($data, "Sheepshead",  true);


$ids = array();




print "<pre>";
// print_r($yellowperch);
print "</pre>";

// $cmd = escapeshellcmd("python $root/_scripts/intersect.py " . escapeshellarg(json_encode($data)) . escapeshellarg(json_encode($yellowperch)));
// print $cmd;


print "<pre>";
print '$data array:'."\n";
// print_r($yellowperch);
print "</pre>";
?>

<?php// include "_private/googleapi.php"; ?>
<?php// include "_includes/display_map.php" ?>
<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php print $apiKey; ?>&callback=initMap"></script> -->
<!-- <iframe src="http://geojson.io/"></iframe> -->
</body>
