<?php
function navItem($href, $itemText) {
    global $path_parts; // get global variable $path_parts
    $path_filename = $path_parts['filename'];
    $link_filename = pathinfo($href)['filename']; // get filename part of passed link

    $activePage = ($path_filename == $link_filename) ? "activePage" : ""; // use ternary operator to set $activePage only if the page is the one being currently visited.
    print "<li class='navItem $activePage'>";
    print "<a href='$href'>$itemText</a>";
    print "</li>" . PHP_EOL;
}
?>