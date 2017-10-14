<?php include '_includes/getdata.php'; ?>
<?php include '_lib/filter_attr.php';  ?>


<?php
$yellowperch = filter_attr($data, "YellowPerch", true);

print "<pre>";
print '$data array:'."\n";
print_r($yellowperch);
print "</pre>";


?>
