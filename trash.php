<?php
$trash = 'drive/Temp/Trash/';
session_start();

if (!file_exists($trash)) {
    mkdir($trash, 0777, true);
}

if(isset($_REQUEST['folderTarget'])){
    rename($_SESSION['dir'].$_REQUEST['folderTarget'], $trash.$_REQUEST['folderTarget']);
}
header('Refresh: 0; URL = index.php');

?>