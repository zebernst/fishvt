<?php

print "test";

$cmd = escapeshellcmd('python ./getdata.py');
$output = shell_exec($cmd);

print "<pre>$output</pre>";

$data = json_decode($output);

print "<pre>";
print_r($data);
print "</pre>";

?>
