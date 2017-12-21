<!-- ######################     Main Navigation   ############################## -->

<div id="rectangle2">
<nav id='nav'>
  <?php include "$root/_includes/header.php"; ?>
    <ol>
        <?php include "$root/_lib/navitem.php";
        // the nav items are floated right, so left-to-right orientation on the
        // page corresponds to bottom-to-top ordering here.

        navItem("$rootFolder/map.php",'Map');
        navItem("$rootFolder/home.php",'Home');
        ?>
    </ol>
</nav>
</div>
