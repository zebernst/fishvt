<?php
// debug
$debug = false;
if (isset($_GET['debug'])) {
	$debug = true;
}



// fetch data
$output = shell_exec(escapeshellcmd('python ./getdata.py'));
$data = json_decode($output);

// print data array
if ($debug) {
	print "<pre>";
	print_r($data);
	print "</pre>";
}
?>
