<!DOCTYPE HTML>
<?php include "_includes/init.php";

// variable initializations
$fishList = array("Bowfin", "Carp", "Channel Catfish", "White Crappie", "Longnose Gar", "Muskellunge", "White Perch", "American Shad", "Sheepshead",
    "Lake Whitefish", "Brook Trout", "Brown Trout", "Rainbow Trout", "Lake Trout", "Landlocked Salmon", "Rainbow Smelt",
    "Yellow Perch", "Walleye", "Northern Pike", "Chain Pickeral", "Largemouth Bass", "Smallmouth Bass", "Bullhead",
    "Panfish", "Black Crappie", "Burbot");

$fishChoice = array("chkBowfin", "chkCarp", "chkChannelCatfish", "chkWhiteCrappie", "chkLongnoseGar", "chkMuskellunge", "chkWhitePerch",
    "chkAmericanShad", "chkSheepshead", "chkLakeWhitefish", "chkBrookTrout", "chkBrownTrout", "chkRainbowTrout",
    "chkLakeTrout", "chkLandlockedSalmon", "chkRainbowSmelt", "chkYellowPerch", "chkWalleye", "chkNorthernPike",
    "chkChainPickeral", "chkLargemouthBass", "chkSmallmouthBass", "chkBullhead", "chkPanfish", "chkBlackCrappie",
    "chkBurbot");

$binaryList    = array("Boats Allowed", "Dock Available", "Winter Plowing");
$binaryChoice  = array("chkBoatsAllowed", "chkDockAvailable", "chkWinterPlowing");

$trafficList   = array("Light", "Moderate", "Heavy", "Seasonal");
$trafficChoice = array("chkLight", "chkModerate", "chkHeavy", "chkSeasonal");

$parkingList   = array("Small", "Medium", "Large");
$parkingChoice = array("chkSmall", "chkMedium", "chkLarge");
$parkingValue  = "";

?>

<HTML lang="en">
    <head>
        <title>Fish VT | Map</title>
        <meta charset="utf-8">
        <meta name="author" content="UVM CS Crew">
        <meta name="description" content="HackVT">
        <link rel="icon" type="image/x-icon" href="<?php print $rootFolder; ?>/favicon.ico">
        <link rel="stylesheet" href="_css/site.css" type="text/css" media="screen">

        <!-- leaflet.js -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
              integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ=="
              crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"
                integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log=="
                crossorigin=""></script>
        <!-- jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    </head>

    <body>
        <?php include "$root/_includes/nav.php"; ?>
        <br>
        <img id="imageboy" src="<?php print $rootFolder; ?>/_images/flyfish.jpg" alt="A lone man fishes in the wilderness of VT">
        <br>
        <div id="mapRectangle">

            <!-- PROMPT USER FOR SOME FISH -->
            <form action="<?php print $phpSelf; ?>" id="frmRegister" method="post">
                <fieldset class="checkbox contact">
                    <legend>Fish: Check all that apply, or select none to search all sites</legend>
                    <br>
                    <table style="width: 100%">
                        <?php
                        for ($x = 0; $x < count($fishList); $x++) {
                            if ($x % 4 == 0) echo "<tr>" . PHP_EOL; // 4 cols
                            echo "<th class='fish-left'>";
                            echo "<label><input id='$fishChoice[$x]' name='$fishChoice[$x]'
                                         type='checkbox'      value='$fishList[$x]'>$fishList[$x]</label>";
                            echo "</th>" . PHP_EOL;
                            if ($x % 4 == 4) echo "</tr>" . PHP_EOL; // 4 cols
                        }
                        ?>
                    </table>
                </fieldset>
                <hr>
                <fieldset class="checkbox contact">
                    <legend>Traffic: Check all that apply</legend>
                    <br>
                    <table style="width: 100%">
                        <tr>
                            <?php
                            for ($x = 0; $x < count($trafficList); $x++) {
                                echo "<th>";
                                echo "<label><input id='$trafficChoice[$x]' name='$trafficChoice[$x]'
                                                type='checkbox'         value='$trafficList[$x]'>$trafficList[$x]</label>";
                                echo "</th>" . PHP_EOL;
                            }
                            ?>
                        </tr>
                    </table>
                </fieldset>
                <hr>
                <fieldset class="checkbox contact">
                    <legend>Parking: Check all that apply</legend>
                    <br>
                    <table style="width: 100%">
                        <tr>
                            <?php
                            for ($x = 0; $x < count($parkingList); $x++) {
                                echo "<th>";
                                echo "<label><input id='$parkingChoice[$x]' name='$parkingChoice[$x]'
                                                    type='checkbox'         value='$parkingList[$x]'>$parkingList[$x]</label>";
                                echo "</th>" . PHP_EOL;
                            }
                            ?>
                        </tr>
                    </table>
                </fieldset>
                <hr>
                <fieldset class="checkbox contact">
                    <legend>Conditions: Check all that apply</legend>
                    <br>
                    <table style="width: 100%">
                        <tr>
                            <?php
                            for ($x = 0; $x < count($binaryList); $x++) {
                                echo "<th>";
                                echo "<label><input id='$binaryChoice[$x]' name='$binaryChoice[$x]'
                                                    type='checkbox'        value='$binaryList[$x]'>$binaryList[$x]</label>";
                                echo "</th>" . PHP_EOL;
                            }
                            ?>
                        </tr>
                    </table>
                </fieldset>


                <p id="geoStatus"></p>
                <?php include("$root/_includes/geolocation.php"); ?>
                <hr>
                <!--BUTTONS AND WIRES -->
                <fieldset class="buttons">
                    <legend></legend>
                    <input type="hidden" id="currentPos" name="currentPos" value="">
                    <input class="button" onclick="getLocation()" id="btnSubmit" name="btnSubmit" tabindex="900"
                           type="submit" value="Submit">
                </fieldset> <!--Ends Buttons-->

            </form>

            <?php if (!isset($_POST["btnSubmit"])) print "<p>Press submit to view a map of fishing spots!</p><!--"; // comment out map if form has not been submitted ?>
            <h3>You selected:</h3><p>
                <?php
                // todo: tidy this up
                include "$root/_lib/filter_attr.php";
                include "$root/_scripts/getdata.php";

                if ($debug) {
                    print "<pre>";
                    print_r($_POST);
                    print "</pre>";
                }

                // empty array used for array intersections later on
                $idNestedList    = array();

                // loop through each fish possibility
                for ($i = 0; $i < count($fishChoice); $i++) {
                    // test if any given checkbox is present in POST array
                    if ($_POST[$fishChoice[$i]] != "") {
                        echo $_POST[$fishChoice[$i]];       // print out name of fish that is in POST array
                        print "<br>";

                        $fishName  = str_replace(' ', '', $fishList[$i]);   // trim whitespace to match keys in $data
                        $fishArray = filter_attr($data, $fishName, true);         // filter out events where you can't find the specified fish

                        // create array of location IDs that match these criteria
                        $fishIds   = array();
                        foreach ($fishArray as $loc) {
                            $id        = $loc['attributes']['id'];
                            $fishIds[] = $id;
                        }
                        // add to master ID list
                        $idNestedList[] = $fishIds;
                    }
                }

                // loop through traffic possibilities
                foreach ($trafficChoice as $tfc) {
                    // test if any traffic choice is in POST array
                    if ($_POST[$tfc] != "") {
                        echo $_POST[$tfc];      // print out traffic choice
                        print "<br>";

                        $trafficArray = filter_attr($data, "UseVolume", $_POST[$tfc]); // filter out all events that don't have desired UseVolume value.

                        // create array of location IDs
                        $trafficIds   = array();
                        foreach ($trafficArray as $loc) {
                            $id           = $loc['attributes']['id'];
                            $trafficIds[] = $id;
                        }
                        // add to master ID list
                        $idNestedList[] = $trafficIds;
                    }
                }

                // loop through parking possibilities
                foreach ($parkingChoice as $pc) {
                    // test if any parking choice is in POST array
                    if ($_POST[$pc] != "") {
                        echo $_POST[$pc];   // print chosen parking choice
                        print "<br>";

                        $parkingArray = filter_attr($data, "Parking", $_POST[$pc]); // filter out all events that don't have desired Parking value.

                        // create array of location IDs
                        $parkingIds   = array();
                        foreach ($parkingArray as $loc) {
                            $id           = $loc['attributes']['id'];
                            $parkingIds[] = $id;
                        }
                        // add to master ID list
                        $idNestedList[] = $parkingIds;
                    }
                }

                // loop through misc choices
                foreach ($binaryChoice as $yn) {
                    // test if any binary options are in POST array
                    if ($_POST[$yn] != "") {
                        echo $_POST[$yn]; // print out binary option found
                        print "<br>";

                        if ($_POST[$yn] == "Boats Allowed") {
                            // filter out all locations that don't have boating access
                            $boatsArray = array_merge(filter_attr($data, "AccessType", "Boating"),
                                                      filter_attr($data, "AccessType", "Boating/Fishing"));

                            // id array
                            $boatsIds   = array();
                            foreach ($boatsArray as $loc) {
                                $id         = $loc['attributes']['id'];
                                $boatsIds[] = $id;
                            }
                            $idNestedList[] = $boatsIds;

                        } else if ($_POST[$yn] == "Dock Available") {
                            // filter out all locations that don't have a dock
                            $dockArray = filter_attr($data, "Dock", true);

                            // id array
                            $dockIds   = array();
                            foreach ($dockArray as $loc) {
                                $id        = $loc['attributes']['id'];
                                $dockIds[] = $id;
                            }
                            $idNestedList[] = $dockIds;

                        } else if ($_POST[$yn] == "Winter Plowing") {
                            // filter out all locations that don't have winter plowing
                            $winterArray = filter_attr($data, "WinterPlowing", true);

                            // id array
                            $winterIds   = array();
                            foreach ($winterArray as $loc) {
                                $id          = $loc['attributes']['id'];
                                $winterIds[] = $id;
                            }
                            $idNestedList[] = $winterIds;
                        }
                    }
                }

                // since each location has a unique ID that starts at 0 and ends at n-1 locations, we make a master
                // array that contains every id between the lowest and highest in the data (inclusive).
                $allIds = array_map(function ($value) { return $value['attributes']['id']; }, $data); // extract id into a 1-dimensional array
                $intersected = range(min($allIds), max($allIds));

                foreach ($idNestedList as $thisArray) {
                    // array_intersect returns an array containing all the values in $intersected that are also present
                    // in $thisArray. this iterative loop continuously eliminates IDs from $intersected until the only ones
                    // left are the IDs present in every array contained in $idNestedList.
                    $intersected = array_intersect($intersected, $thisArray);
                }


                $locations = array();   // create array to hold locations that meet every criteria
                foreach ($data as $loc) {
                    // each iteration, check if the needle (this location's id) exists in the
                    // haystack (the array of ids that meet every criteria) and sort accordingly.
                    if (in_array($loc['attributes']['id'], $intersected))
                        $locations[] = $loc;
                }
                ?>

            </p>
            <div id="mapid" style="width: 100%; height: 800px;"></div>
            <?php include "_private/mapboxapi.php"; ?>
            <script type="text/javascript" src="<?php print $rootFolder; ?>/_lib/us-states.js"></script> <!-- gets geoJSON data for 50 US states stored in variable 'statesData' -->
            <script type="text/javascript">
                var vermont = statesData['features'][45]; // isolate vermont geoJSON object

                // initialize map
                var mymap = L.map('mapid').setView([44.0511, -72.9245], 7);
                L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, ' +
                    '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                    'Imagery © <a href="http://mapbox.com">Mapbox</a>',
                    maxZoom: 18,
                    id: 'mapbox.streets',
                    accessToken: "<?php print $mapboxApiKey; ?>"
                }).addTo(mymap);

                // define style for geoJSON polygon
                var vtStyle = {
                    fillColor   : '<?php !empty($locations) ? print '#3388ff' : print "#c21a20"; ?>',
                    fillOpacity :  <?php !empty($locations) ? print 0.3       : print 0.45;      ?>,
                    color       : '<?php !empty($locations) ? print '#3388ff' : print "#c21a20"; ?>',
                    opacity     : 1,
                    weight      : 2
                };

                // create polygon for vermont geoJSON data
                var vtPolygon = L.geoJSON(vermont, {style: vtStyle});
                <?php // bind & open warning popup if no valid locations found with current filter criteria
                if (empty($locations)) print 'vtPolygon.bindPopup("No valid locations were found.<br>Please try again with less restrictive filter criteria.").openPopup()';
                ?>
                vtPolygon.addTo(mymap);

                // define custom icon for current location marker
                var currentLocationIcon = L.icon({
                    iconUrl     : 'images/urhere.png',
                    iconSize    : [48, 48],  // size of the icon
                    iconAnchor  : [24, 48],  // point of the icon which will correspond to marker's location
                    popupAnchor : [0, -48]   // point from which the popup should open relative to the iconAnchor
                });

                // create current location marker (if applicable)
                var marker;
                <?php if (!$hasUserLocationData) print "/*" . PHP_EOL; // if there isn't user location data, comment out the current location marker ?>
                marker = new L.marker([<?php if ($hasUserLocationData) print $userLat; ?>, <?php if ($hasUserLocationData) print $userLon; ?>], {icon: currentLocationIcon})
                    .bindPopup("<strong>Your current location</strong>")
                    .addTo(mymap);
                <?php if (!$hasUserLocationData) print "*/" . PHP_EOL; ?>

                // loop through php array and create each marker's popup content and lat/long arrays
                var placeList = [
                    <?php if (!empty($locations)) {
                        $fishKeys = array_map(function ($value) { return str_replace(' ', '', $value); }, $fishList);

                        function fromCamelCase($camelCaseString)
                        {
                            $re = '/(?<=[a-z])(?=[A-Z])/x';
                            $a  = preg_split($re, $camelCaseString);
                            return join($a, " ");
                        }


                        foreach ($locations as $location) {
                            $accessName = $location['attributes']['AccessName'];
                            $town       = $location['attributes']['Town'];
                            $county     = $location['attributes']['County'];
                            $directions = $location['attributes']['Directions'];
                            $distKm     = round($location['distance']['km'], 2);

                            // get array of fish present at location
                            $fishAtSite = array();
                            foreach ($location['attributes'] as $attr => $val) {
                                if (in_array($attr, $fishKeys) && $val == true)
                                    $fishAtSite[] = fromCamelCase($attr);
                            }

                            $boatSize     = ($location['attributes']['BoatSize'] != null) ? $location['attributes']['BoatSize'] : "N/A";
                            $accessType   = $location['attributes']['AccessType'];
                            $parking      = $location['attributes']['Parking'];
                            $shoreFishing = $location['attributes']['Shorefishing'];
                            $popularity   = ($location['attributes']['UseVolume'] != null) ? $location['attributes']['UseVolume'] : "N/A";

                            // assemble popup html text
                            $popupHtml = "\""
                                . "<span style='font-size:16px;float:left'><strong>$accessName</strong></span>"
                                . ($hasUserLocationData ? "<span style='float:right'>$distKm mi</span>" : "")
                                . "<br style='clear:both'>"
                                . "<span><i>$town, VT | $county Cty.</i></span>"
                                . "<br><hr>"
                                . "<span style='text-decoration:underline'>Fish Present</span><br>" . join(", ", $fishAtSite)
                                . "<hr>"
                                . "<ul>"
                                . "<li class='popupLi'>Activities: $accessType</li>"
                                . "<li class='popupLi'>Max boat size: $boatSize</li>"
                                . "<li class='popupLi'>Parking capacity: $parking</li>"
                                . "<li class='popupLi'>Foot traffic: $popularity</li>"
                                . "</ul><br style='clear:both'>"
                                . "<span>Shorefishing: $shoreFishing</span>"
                                . "<hr>"
                                . "<p style='text-align:left'>$directions</p>"
                                . "\"";

                            $lat = $location['geometry']['y'];
                            $lon = $location['geometry']['x'];
                            print "[$popupHtml, $lat, $lon]," . PHP_EOL;
                        }
                    } ?>
                ];

                // create each marker and add to map
                for (var i = 0; i < placeList.length; i++) {
                    // popup = L.popup({'minWidth': 90}).setContent()
                    marker = new L.marker([placeList[i][1], placeList[i][2]])
                        .bindPopup(placeList[i][0], {minWidth:225, maxWidth: 350})
                        .addTo(mymap);
                }
            </script>
            <?php if (!isset($_POST["btnSubmit"])) print "-->"; // end conditional map display ?>
        </div>

        <br>
    </body>
</html>
