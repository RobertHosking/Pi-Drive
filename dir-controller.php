<?php

session_start();
$_SESSION['dir'] = $_REQUEST['ch_dir']."/";

echo $_SESSION['dir'];
?>
