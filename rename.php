<?php
session_start();
if(isset($_REQUEST['folderTarget']) && isset($_REQUEST['folderName'])) {
    rename($_SESSION['dir'].$_REQUEST['folderTarget'], $_SESSION['dir'].$_REQUEST['folderName']);
}
header('Refresh: 0; URL = index.php');

?>