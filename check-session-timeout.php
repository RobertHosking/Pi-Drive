<?php
    session_start();
if((time() - $_SESSION['timeout']) > 3600){
    header('Refresh: 0; URL = logout.php');
}else{
     $_SESSION['timeout'] = time();
}

?>