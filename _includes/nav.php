<!-- ######################     Main Navigation   ############################## -->

<h1 class="white" id="name">Fish Vermont</h1>
    <p class="white"><STRONG>Find some Fish.</STRONG></p>
    
    
<nav>
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
