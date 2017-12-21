<?php
/**
 * Created by PhpStorm.
 * User: zach
 * Date: 12/20/17
 * Time: 4:58 PM
 */

// %%%%%%%%%%%%%%%%%%%%%%
// %%    path setup    %%
// %%%%%%%%%%%%%%%%%%%%%%

$domain  = "//";
$server  = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, "UTF-8");
$domain .= $server;

$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
$path_parts = pathinfo($phpSelf);

// setup path prefixing
$host  = parse_url($domain, PHP_URL_HOST);   // get url hostname (i.e. zebernst.w3.uvm.edu)
$netId = explode('.', $host)[0];               // extract netId from hostname
$root  = $_SERVER['DOCUMENT_ROOT'];                    // contains filesystem folder (e.g. /users/z/e/zebernst/www-root)
switch ($netId) {                                      // add root subdirectory based on which silk account it's running on
    case "zebernst" : $rootFolder = "/hackvt"; break;
    default         : $rootFolder = "/fishvt"; break;
}
$root .= $rootFolder;


// setup debug variable
$debug = isset($_GET["debug"]) ? (!in_array(strtolower($_GET["debug"]), array("false", "f", "0")) ? true : false) : false;
?>

