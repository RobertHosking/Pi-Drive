<?php
session_start();
if(isset($_REQUEST['folderName']) && isset($_REQUEST['target'])) {
    rename($_SESSION['dir'].$_REQUEST['target'], $_SESSION['dir'].$_REQUEST['folderName']);
}
header('Refresh: 0; URL = index.php');

?>