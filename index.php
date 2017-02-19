<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
require "db-connect.php";
?>

<?php
require "head.php";
if(isset($_SESSION['username'])){
    require "check-session-timeout.php";
    require "header.php";
    require "functions.php";
    echo "<body><br><br><br><br><br><br><br><br><div class='container'>";
    require "dashboard.php";
    echo "</div></body>";
    echo "<script>online(0);</script>";
}else{
    include "login.php";
}

?>
</html>