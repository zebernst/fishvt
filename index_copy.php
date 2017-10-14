<!DOCTYPE HTML>
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
    
        
        
    <h1 class="white" id="name">Fish Vermont</h1>
    <p class="white"><STRONG>Find some Fish.</STRONG></p>
    <br><br>
    
    <div style="text-align: center;">
    <p id="demo"></p>
    </div>
    <?php include ("geolocation.php");?> 
    <button onclick="getLocation()" class="centered">Try It</button>

    
</body>
</html>
