<?php
// trims $array, leaving only elements where the value of $attr matches the value provided as $testValue.
function filter_attr(array $data, $attr, $testValue) {
    // initialize empty array of locations that match filter
	$valid_locations = array();

	// loop through each entry in $data
	foreach($data as $entry) {
	    // if the value stored in the entry for the given attribute matches the value to test against,
        // then append it to the array of matching locations.
		if ($entry['attributes'][$attr] == $testValue)
			$valid_locations[] = $entry;
	}

	// return the array of matching data entries.
	return $valid_locations;
}
?>
