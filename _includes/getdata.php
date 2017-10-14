<?php
// debug
$debug = false;
if (isset($_GET['debug'])) {
	$debug = true;
}

// fetch data
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$cmd = escapeshellcmd("python $root/_scripts/getdata.py 44.518087699999995 -73.18415689999999");
$output = shell_exec($cmd);
$data = json_decode($output, true);

// print data array
if ($debug) {
	print "<pre>";
	print '$data array:'."\n";
	print_r($data);
	print "</pre>";
}
?>
