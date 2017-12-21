<?php
function filter_attr(array $data, $attribute, $value) {
	$filtered_locations = array();

	foreach($data as $location) {
		if ($location['attributes'][$attribute] == $value) {
			$filtered_locations[] = $location;
		}
	}

	return $filtered_locations;
}
?>
