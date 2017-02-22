<?php

list_folders();


if(explode(" ",(explode("/",$_SESSION['dir'])[4]))[0] == "Season"){
    
  echo "<table class='table table-hover table-responsive'><thead><tr><th>Episode</th><th>Title</th><th>Overview</th><th></th></tr></thead><tbody>";
  $files = scandir($_SESSION['dir']); 
  $i = 0;
  foreach($files as $file){
      list_file($file, $i);
      $i++;
  }
  echo "</tbody></table>";
}else{
  $files = scandir($_SESSION['dir']); 
  foreach($files as $file){
      list_file($file);
  }
}



?>

<div class="modal fade" id="trashModal" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Move to trash?</h4>
      </div>
     <form class="form-group" action="trash.php" method="POST">
       <div class="target"></div>

      <div class="modal-body center-block text-center">
        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-default">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="renameModal"role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Rename</h4>
      </div>
      <div class="modal-body">
   <form class="form-group" action="rename.php" method="POST">
       <div class="target"></div>

  <label class="col-md-4 control-label" for="folderName">New Name</label>  
  
  <input autofocus="autofocus" id="folderName" name="folderName" type="text" placeholder="e.x. Anything" class="form-control input-md">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="btn-wrapper" data-toggle="modal" data-target="#newfolder" >
  <button class="circle" onclick="">
     <img src="images/add.png" alt="" />
  </button>
</div>