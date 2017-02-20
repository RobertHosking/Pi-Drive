  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Pi Drive</title>

<?php

session_start();
$path = "/var/www/html/";
if(isset($_SESSION['dir'])){
    
}else{
    $_SESSION['dir'] = "drive/Drive/"; 
}

$stylesheets = scandir('css/');
foreach($stylesheets as $file) {
    if($file == "." || $file == ".."){
        continue;
    }
    else{
        echo "<link rel='stylesheet' href='css/".$file."'>";
    }
}
$javascripts = scandir('js/pre/');
foreach($javascripts as $file) {
    if($file == "." || $file == ".."){
        continue;
    }
    else{
        echo "<script src='js/pre/".$file."'></script>";
    }
}
?>

</head>
