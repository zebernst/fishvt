<?php
// debug
$debug = false;
if (isset($_GET['debug'])) {
	$debug = true;
}



// fetch data
$output = shell_exec(escapeshellcmd('python ./getdata.py 44.518087699999995 -73.18415689999999'));
$data = json_decode($output);

// print data array
if ($debug) {
	print "<pre>";
	print_r($data);
	print "</pre>";
}
?>
