<!-- ######################     Main Navigation   ############################## -->

<nav id='nav'>
  <?php include ("header.php"); ?>
    <ol>
        <?php
        print '<li class="';
        if ($path_parts['filename'] == "map") {
            print ' activePage ';
        }
        print '">';
        print '<a href="map.php">Map</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "about") {
            print ' activePage ';
        }
        print '">';
        print '<a href="about.php">About</a>';
        print '</li>';

        print '<li class = "';
        if ($path_parts['filename'] == "home") {
            print ' activePage ';
        }
        print '">';
        print '<a href="home.php">Home</a>';
        print '</li>';

        ?>
    </ol>
</nav>
