<?php
$tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

foreach(glob($_SESSION['dir']."*", GLOB_ONLYDIR) as $dir) {
    $dirname = basename($dir);
    echo '<button id="'.$dirname.'" type="button" onclick=\'focus_this(this, "'.$_SESSION['dir'].'");\' onblur=\'focus_lost();\' ondblclick=\'change_dir("'.$_SESSION["dir"].$dirname.'"); reload();\' class="btn btn-secondary folder"><i class="fa  fa-folder"></i>'.$tab.$dirname.$tab.'</button>';
}


$files = scandir($_SESSION['dir']); 
foreach($files as $file){
    list_file($file);
}

?>

<div class="modal fade" id="trashModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Move to trash?</h4>
      </div>
  
      <div class="modal-body center-block text-center">
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-default">Yes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="renameModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Rename</h4>
      </div>
      <div class="modal-body">
   <form class="form-group" action="rename.php" method="POST">
  <label class="col-md-4 control-label" for="folderName">New Name</label>  
  
  <input id="folderName" name="folderName" type="text" placeholder="e.x. Anything" class="form-control input-md">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>