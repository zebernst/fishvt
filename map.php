<!DOCTYPE HTML>

<?php 
$fishList = array("Bowfin", "Carp", "ChannelCatfish", "WhiteCrappie", "LongnoseGar", "Muskellunge", "WhitePerch", "AmericanShad", "Sheepshead",
        "LakeWhitefish", "BrookTrout", "BrownTrout", "RainbowTrout", "LakeTrout", "LandlockedSalmon", "RainbowSmelt", 
        "YellowPerch", "Walleye", "NorthernPike", "ChainPickeral", "LargemouthBass", "SmallmouthBass", "Bullhead", 
        "Panfish", "BlackCrappie", "Burbot");

$fishChoice = array("chkBowfin", "chkCarp", "chkChannelCatfish", "chkWhiteCrappie", "chkLongnoseGar", "chkMuskellunge", "chkWhitePerch",
                    "chkAmericanShad", "chkSheepshead", "chkLakeWhitefish", "chkBrookTrout", "chkBrownTrout", "chkRainbowTrout",
                    "chkLakeTrout", "chkLandlockedSalmon", "chkRainbowSmelt", "chkYellowPerch", "chkWalleye", "chkNorthernPike",
                    "chkChainPickeral", "chkLargemouthBass", "chkSmallmouthBass", "chkBullhead", "chkPanfish", "chkBlackCrappie",
                    "chkBurbot");
?>

<HTML lang="en">
    <head>
        <title>Fish VT</title>
        <meta charset="utf-8">
        <meta name="author" content="UVM CS Crew">
        <meta name="description" content="HackVT">
        <link rel="icon" type="image/png" href="images/Pufferfish.png">
        <link rel="stylesheet" href="final.css" type="text/css" media="screen">
    </head>

    <body>   
    <?php include ("nav.php"); ?>
    <br><br>
    
    <!--Get and display user location -->
    
    <div id="rectangle">
        
    
        <!-- PROMPT USER FOR SOME FISH -->
        <form action="<?php print $phpSelf; ?>" id="frmRegister" method = "post"> 
            <fieldset class="checkbox contact">
                <legend>Fish: Check all that apply</legend>
                <table style = "width: 100%">
                <?php 
                for($x = 0; $x < count($fishList); $x++) {  
                    if($x % 5 == 0) { echo "<tr>";}
                    echo "<th>";
                    echo "<label><input
                            id='" . $fishChoice[$x] . "'
                            name='" . $fishChoice[$x] . "' 
                            type='checkbox'
                            value='" . $fishList[$x] . "'>" . $fishList[$x] . "</label> ";
                    echo "</th>";
                    if($x % 5 == 5) { echo "</tr>";}
            } 
            
            ?>
                </table>
            </fieldset>
            
            
            <p id="demo"></p>
            <?php include ("geolocation.php");?>
            
            <!--BUTTONS AND WIRES-->
             <fieldset class ="buttons">
                <legend></legend>
                <input class="button" onclick="getLocation()" id="btnSubmit" name="btnSubmit" tabindex="900" type="submit" value="Register" >
            </fieldset> <!-- Ends Buttons -->
        </form>
        
        <p>You selected: <?php 
        
        for($x = 0; $x <= count($fishChoice); $x++) {
        echo $_POST[$fishChoice[$x]]; 
        echo " ";
        }
        
        ?>
        
        </p>
        
        
        
        
        
   </div>
</body>
</html>