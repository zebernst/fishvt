<!DOCTYPE HTML>

<?php
$root = $_SERVER["DOCUMENT_ROOT"];

$fishList = array("Bowfin", "Carp", "Channel Catfish", "White Crappie", "Longnose Gar", "Muskellunge", "White Perch", "American Shad", "Sheepshead",
    "Lake Whitefish", "Brook Trout", "Brown Trout", "Rainbow Trout", "Lake Trout", "Landlocked Salmon", "Rainbow Smelt",
    "Yellow Perch", "Walleye", "Northern Pike", "Chain Pickeral", "Largemouth Bass", "Smallmouth Bass", "Bullhead",
    "Panfish", "Black Crappie", "Burbot");

$fishChoice = array("chkBowfin", "chkCarp", "chkChannelCatfish", "chkWhiteCrappie", "chkLongnoseGar", "chkMuskellunge", "chkWhitePerch",
    "chkAmericanShad", "chkSheepshead", "chkLakeWhitefish", "chkBrookTrout", "chkBrownTrout", "chkRainbowTrout",
    "chkLakeTrout", "chkLandlockedSalmon", "chkRainbowSmelt", "chkYellowPerch", "chkWalleye", "chkNorthernPike",
    "chkChainPickeral", "chkLargemouthBass", "chkSmallmouthBass", "chkBullhead", "chkPanfish", "chkBlackCrappie",
    "chkBurbot");

$binaryList = array("Boats Allowed", "Dock Available", "Winter Plowing");

$binaryChoice = array("chkBoatsAllowed", "chkDockAvailable", "chkWinterPlowing");

$trafficList = array("Light", "Moderate", "Heavy", "Seasonal");
$trafficChoice = array("chkLight", "chkModerate", "chkHeavy", "chkSeasonal");

$parkingList = array("Small", "Medium", "Large");

$parkingChoice = array("chkSmall", "chkMedium", "chkLarge");
$parkingValue = "";

?>

<HTML lang="en">
    <head>
        <title>Fish VT</title>
        <meta charset="utf-8">
        <meta name="author" content="UVM CS Crew">
        <meta name="description" content="HackVT">
        <link rel="icon" type="image/png" href="images/Pufferfish.png">
        <link rel="stylesheet" href="final.css" type="text/css" media="screen">

        <!-- leaflet.js -->
        <link   rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
            integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ=="
            crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"
            integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log=="
            crossorigin=""></script>
    </head>

    <body>
        <?php include ("$root/_includes/nav.php"); ?>
        <br>
        <img id = "imageboy" src="images/flyfish.jpg" alt="A lone man fishes in the wilderness of VT">
        <br>

        <!--Get and display user location -->

        <div id="mapRectangle">

            <!-- PROMPT USER FOR SOME FISH -->
            <form action="<?php print $phpSelf; ?>" id="frmRegister" method = "post">
                <fieldset class="checkbox contact">
                    <legend>Fish: Check all that apply, or select none to search all sites</legend>
                    <br>
                    <table style = "width: 100%">
                        <?php
                        for ($x = 0; $x < count($fishList); $x++) {
                            if ($x % 4 == 0) {
                                echo "<tr>";
                            }
                            echo "<th id = 'fishleft'>";
                            echo "<label><input
                            id='" . $fishChoice[$x] . "'
                            name='" . $fishChoice[$x] . "'
                            type='checkbox'
                            value='" . $fishList[$x] . "'>" . $fishList[$x] . "</label> ";
                            echo "</th>";
                            if ($x % 4 == 4) {
                                echo "</tr>";
                            }
                        }
                        ?>
                    </table>
                </fieldset>
                <hr>
                <fieldset class="checkbox contact">
                    <legend>Traffic: Check all that apply</legend>
                    <br>
                    <table style = "width: 100%">
                        <?php
                        for ($x = 0; $x < count($trafficList); $x++) {
                            if ($x == 0) {
                                echo "<tr>";
                            }
                            echo "<th>";
                            echo "<label><input
                            id='" . $trafficChoice[$x] . "'
                            name='" . $trafficChoice[$x] . "'
                            type='checkbox'
                            value='" . $trafficList[$x] . "'>" . $trafficList[$x] . "</label> ";
                            echo "</th>";
                        }
                        echo "</tr>";
                        ?>
                    </table>
                </fieldset>
                <hr>
                <fieldset class="checkbox contact">
                    <legend>Parking: Check all that apply</legend>
                    <br>
                    <table style = "width: 100%">
                        <?php
                        for ($x = 0; $x < count($parkingList); $x++) {
                            if ($x == 0) {
                                echo "<tr>";
                            }
                            echo "<th>";
                            echo "<label><input
                            id='" . $parkingChoice[$x] . "'
                            name='" . $parkingChoice[$x] . "'
                            type='checkbox'
                            value='" . $parkingList[$x] . "'>" . $parkingList[$x] . "</label> ";
                            echo "</th>";
                        }
                        echo "</tr>";
                        ?>
                    </table>
                </fieldset>
                <hr>
                <fieldset class="checkbox contact">
                    <legend>Conditions: Check all that apply</legend>
                    <br>
                    <table style = "width: 100%">
                        <?php
                        for ($x = 0; $x < count($binaryList); $x++) {
                            if ($x == 0) {
                                echo "<tr>";
                            }
                            echo "<th>";
                            echo "<label><input
                            id='" . $binaryChoice[$x] . "'
                            name='" . $binaryChoice[$x] . "'
                            type='checkbox'
                            value='" . $binaryList[$x] . "'>" . $binaryList[$x] . "</label> ";
                            echo "</th>";
                        }
                        echo "</tr>";
                        ?>
                    </table>
                </fieldset>




                <p id="demo"></p>
                <?php include ("$root/_includes/geolocation.php"); ?>
                <hr>
                <!--BUTTONS AND WIRES -->
                <fieldset class ="buttons">
                    <legend></legend>
                    <input class="button" onclick="getLocation()" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Submit" >
                </fieldset> <!--Ends Buttons-->

            </form>

            <h3>You selected:</h3><p><?php
                /*                 * for ($x = 0; $x <= count($fishChoice); $x++) {
                  echo $_POST[$fishChoice[$x]];
                  echo " ";
                  }
                 * 
                  echo "<br>";
                 * 
                  for ($x = 0; $x <= count($binaryChoice); $x++) {
                  echo $_POST[$binaryChoice[$x]];
                  echo " ";
                  }
                  echo "<br>";
                 * 
                  for ($x = 0; $x < count($trafficChoice); $x++) {
                  echo $_POST[$trafficChoice[$x]];
                  echo " ";
                  }
                 * 
                  echo "<br>";
                 * 
                  for ($x = 0; $x < count($parkingChoice); $x++) {
                  echo $_POST[$parkingChoice[$x]];
                  echo " ";
                  }* */
                include "$root/_lib/filter_attr.php";
                include "$root/_includes/getdata.php";
                
                $list_of_lists = array();
                
                $list_of_lists[] = $data;
                $id_superlist = array();
                
                for($x = 0; $x<count($fishChoice); $x++){
                    if($_POST[$fishChoice[$x]] != ""){
                        echo $_POST[$fishChoice[$x]];
                        print "<br>";
                        $name = str_replace(' ', '', $fishList[$x]);
                        $fishArray = filter_attr($data, $name, $_POST[$x]);
                        $fishIds = array();
                        foreach ($fishArray as $loc) {
                            $id = $loc['attributes']['id'];
                            $fishIds[] = $id;
                        }
                        $id_superlist[] = $fishIds;
                    }
                }
            

                foreach ($trafficChoice as $x) {
                    if($_POST[$x] != ""){
                        echo $_POST[$x];
                        print "<br>";
                        $name = str_replace('mm', 'm', $_POST[$x]);
                        // echo $name;
                        $trafficArray = filter_attr($data, "UseVolume", $_POST[$x]);
                        $trafficIds = array();
                        foreach ($trafficArray as $loc) {
                            $id = $loc['attributes']['id'];
                            $trafficIds[] = $id;
                        }
                        $id_superlist[] = $trafficIds;
                    }
                }

                foreach ($parkingChoice as $x) {
                    if($_POST[$x] != ""){
                        echo $_POST[$x];
                        print "<br>";
                        $parkingArray = filter_attr($data, "Parking", $_POST[$x]);
                        $parkingIds = array();
                        foreach ($parkingArray as $loc) {
                            $id = $loc['attributes']['id'];
                            $parkingIds[] = $id;
                        }
                        $id_superlist[] = $parkingIds;
                    }
                }

                foreach ($binaryChoice as $x){
                    if($_POST[$x] != ""){
                        echo $_POST[$x];
                        print "<br>";
                        if($_POST[$x]=="Boats Allowed"){
                            $boatsArray = array_merge(filter_attr($data, "AccessType", "Boating"), filter_attr($data, "AccessType", "Boating/Fishing"));
                            $boatsIds = array();
                            foreach($boatsArray as $loc) {
                                $id = $loc['attributes']['id'];
                                $boatsIds[] = $id;
                            }
                            $id_superlist[] = $boatsIds;
                        }
                        else if($_POST[$x]=="Dock Available"){
                            $dockArray = filter_attr($data, "Dock", TRUE);
                            $dockIds = array();
                            foreach($dockArray as $loc) {
                                $id = $loc['attributes']['id'];
                                $dockIds[] = $id;
                            }
                            $id_superlist[] = $dockIds;
                        }
                        else if($_POST[$x]=="Winter Plowing"){
                            $winterArray = filter_attr($data, "WinterPlowing", TRUE);
                            $winterIds = array();
                            foreach($winterArray as $loc) {
                                $id = $loc['attributes']['id'];
                                $winterIds[] = $id;
                            }
                            $id_superlist[] = $winterIds;
                        }
                    }
                }
                
                $intersected = range(0,350);

                foreach($id_superlist as $thisArray) {
                    $intersected = array_intersect($intersected, $thisArray);
                }

                $locations = array();
                foreach($data as $location) {
                    if (in_array($location['attributes']['id'], $intersected)) {
                        $locations[] = $location;
                    }
                }

                // print "<pre>";
                // print_r($locations);
                // print "</pre>";
                
               
                ?>

            </p>
            <div id="mapid" style="width: 100%; height: 800px;"></div>
            <?php include "_private/mapboxapi.php"; ?>
            <script>
                var mymap = L.map('mapid').setView([44.0511, -72.9245], 7);
                L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">          CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
                    maxZoom: 18,
                    id: 'mapbox.streets',
                    accessToken: "<?php print $apiKey; ?>"
                }).addTo(mymap);
            
                var placelist = [
                <?php
                    foreach ($locations as $location) {
                        $waterBody = $location['attributes']['WaterBody'];
                        $directions = $location['attributes']['Directions'];
                        $info = "\"<strong>$waterBody</strong><br>$directions\"";
                        $lat = $location['geometry']['y'];
                        $lon = $location['geometry']['x'];
                        print "[$info, $lat, $lon],\n";
                    }
                ?>
                ];
            
                var currentLocationIcon = L.icon({
                    iconUrl: 'images/urhere.png',
                
                    iconSize:     [48, 48], // size of the icon
                    iconAnchor:   [24, 48], // point of the icon which will correspond to marker's location
                    popupAnchor:  [0, -48] // point from which the popup should open relative to the iconAnchor
                });

                marker = new L.marker([44.518087699999995, -73.18415689999999], {icon: currentLocationIcon})
                    .bindPopup("<strong>Your current location</strong>")
                    .addTo(mymap);
            
                for (var i = 0; i < placelist.length; i++) {
                        marker = new L.marker([placelist[i][1],placelist[i][2]])
                            .bindPopup(placelist[i][0])
                            .addTo(mymap);
                    }
            
            </script>
        </div>

        <br>
    </body>
</html>
