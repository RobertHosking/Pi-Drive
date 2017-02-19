<?php
$tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

foreach(glob($_SESSION['dir']."*", GLOB_ONLYDIR) as $dir) {
    $dirname = basename($dir);
    echo '<button type="button" onclick=\'focus(this)\' ondblclick=\'change_dir("'.$_SESSION["dir"].$dirname.'"); reload();\' class="btn btn-secondary folder"><i class="fa  fa-folder"></i>'.$tab.$dirname.$tab.'</button>';
}


$files = scandir($_SESSION['dir']); 
foreach($files as $file){
    list_file($file);
}

?>