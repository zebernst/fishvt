<!-- ######################     Main Navigation   ############################## -->

<h1 class="white" id="name">Fish Vermont</h1>
    <p class="white"><STRONG>Find some Fish.</STRONG></p>


<nav id='nav'>
  <a href="index_copy.php"><img src="/images/fish.png" alt="FishyBoi" height="100"></a>
    <article class="welcome">
    <p class="tagLine">Let's get Fishy</p>
    </article>
    <ol>
        <?php
        print '<li class = "';
        if ($path_parts['filename'] == "home") {
            print ' activePage ';
        }
        print '">';
        print '<a href="index.php">Home</a>';
        print '</li>';

        print '<li class="';
        if ($path_parts['filename'] == "map") {
            print ' activePage ';
        }
        print '">';
        print '<a href="map.php">Map</a>';
        print '</li>';
        ?>
    </ol>
</nav>
