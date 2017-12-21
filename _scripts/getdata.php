<?php
/**
 * Created by PhpStorm.
 * User: zach
 * Date: 12/20/17
 * Time: 3:46 PM
 */

/* ### fetch data (python) [OBSOLETE] ###
$cmd = escapeshellcmd("python $root/_scripts/getdata.py 44.518087699999995 -73.18415689999999");
$output = shell_exec($cmd);
$data = json_decode($output, true);
*/


/** calculates great-circle distance between two points on sphere
 *
 * reference: https://en.wikipedia.org/wiki/Haversine_formula
 * @param $lat1 float|int pos1 latitude
 * @param $lon1 float|int pos1 longitude
 * @param $lat2 float|int pos2 latitude
 * @param $lon2 float|int pos2 longitude
 * @return float|int the distance in km between the two points
 */
function calculate_distance($lat1, $lon1, $lat2, $lon2) {
    $earth_radius = 6371.0; # radius of the earth in km
    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);

    $hav    = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2); // haversine of central angle
    $havInv = 2 * asin(sqrt($hav)); // inverse haversine function
    $dist   = $earth_radius * $havInv; # distance in km

    return $dist;
}


#  user location - todo: make this dynamic
// currently hardcoded to green mountain power in colchester, vt
$hasUserLocationData = true;
$userLat = 44.518087699999995;
$userLon = -73.18415689999999;


# get data
$jsonStr = file_get_contents("https://anrmaps.vermont.gov/arcgis/rest/services/Open_Data/OPENDATA_ANR_TOURISM_SP_NOCACHE_v2/MapServer/163/query?where=1%3D1&outFields=*&outSR=4326&f=json")
        ?: file_get_contents("$root/_tmp/json_backup.json"); // file_get_contents() returns false if it fails -- in that case, use a local backup.
$data    = json_decode($jsonStr, true)["features"];


# mutate data
foreach ($data as $idx => $entry) {
    # add distance from user
    if ($hasUserLocationData) {
        $featureLat = $entry["geometry"]["y"];
        $featureLon = $entry["geometry"]["x"];
        $distKm  = calculate_distance($featureLat, $featureLon, $userLat, $userLon);
        $distDeg = sqrt(pow($userLat - $featureLat, 2) + pow($userLon - $featureLon, 2)); # distance formula

        $data[$idx] += array("distance" => array("km" => $distKm, "deg" => $distDeg));
    }

    # sanitize yes, no, and n/a values
    foreach ($entry["attributes"] as $attr => $value) {
        switch (strtolower($value)) {
            case "no"  : $data[$idx]["attributes"][$attr] = false; break;
            case "yes" : $data[$idx]["attributes"][$attr] = true;  break;
            case "n/a" : $data[$idx]["attributes"][$attr] = null;  break;
        }
    }
}

// print data array
if ($debug) {
    print "<pre>";
    print '$data array:'. PHP_EOL;
    print_r($data);
    print "</pre>";
}