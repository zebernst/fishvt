<?php
function filter_attr(array $data, string $attribute, $value) {
	// print "<pre>";
	// print_r($data);
	// print "</pre>";

	$filtered_locations = array();

	foreach($data as $location) {
		if ($location['attributes'][$attribute] == $value) {
			$filtered_locations[] = $location;
		}
	}

	return $filtered_locations;
}
?>
