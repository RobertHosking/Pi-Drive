<?php
session_start();
if(isset($_REQUEST['folderName'])){
    $structure = $_SESSION['dir'].$_REQUEST['folderName'];
    mkdir($structure, 0777, true);
}else{
    echo "failed";
}
   header('Refresh: 0; URL = index.php');


?>