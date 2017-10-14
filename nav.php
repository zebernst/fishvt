<!-- ######################     Main Navigation   ############################## -->
<div class="header">
  <img src="/images/fish.png" alt="FishyBoi" height="100">
  <h1 class="white" id="name">Fish Vermont</h1>

</div>

<nav id='nav'>

    <article class="welcome">

    </article>
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
