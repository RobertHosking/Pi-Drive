<?php
require "head.php";
session_start();
?>

<body>
    <div class="container">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="col-xs-4 col-xs-offset-4" style="">
            <div class="center-block">
                <h1 class="text-center" style="font-family:helvetica; font-weight:bold;">Moving  to <?php echo $_REQUEST['dest'];?><h2>
                <img class="center-block" src="images/default.svg"></img>
            </div>
        </div>
    </div>
</body>

<?php
#moveItems[Folder/, file, file];

if(explode(" ",$_REQUEST['dest'])[0] == "Movies"){
    if(count(explode(" ",$_REQUEST['dest'])) > 1){
        $dest = "drive/Drive/Movies/".substr($_REQUEST['dest'], strlen("Movies "), strlen($_REQUEST['dest']));
    }else{
         $dest = "drive/Drive/Movies/".$_REQUEST['target'];
    }
}elseif(explode(" ",$_REQUEST['dest'])[0] == "Favorites"){
    if(count(explode(" ",$_REQUEST['dest'])) > 1){
        $dest = "drive/Drive/Movies/Favorites/".substr($_REQUEST['dest'], strlen("Favorites "), strlen($_REQUEST['dest']));
    }else{
        $dest = "drive/Drive/Movies/Favorites/".$_REQUEST['target'];
    }
}elseif( explode(" ",$_REQUEST['dest'])[0] == "Series"){
    if(count(explode(" ",$_REQUEST['dest'])) > 1){
        $dest = "drive/Drive/Series/".substr($_REQUEST['dest'], strlen("Series "), strlen($_REQUEST['dest']));
    }else{
       $dest = "drive/Drive/Series/".$_REQUEST['target'];
    }
}else{
    $dest = $_REQUEST['dest'];
}
$full_path = $_SESSION['dir'].$_REQUEST['target'];
if(explode("/",$_SESSION['dir'])[1] == explode("/",$dest)[1] ){
    rename($full_path, $dest);
}else{
    if(is_dir($full_path)){
        exec("cp -r ".$full_path." ".$dest.$_REQUEST['target']);
    }else{
        copy($full_path, $dest);
    }
}
header('Refresh: 0; URL = index.php');
?>