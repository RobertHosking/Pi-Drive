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

<div class="btn-wrapper" data-toggle="modal" data-target="#newfolder" >
  <button class="circle" onclick="">
     <img src="add.png" alt="" />
  </button>
</div>


<!-- Modal -->
<div class="modal fade" id="newfolder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add folder to <?php echo $_SESSION['dir'];?></h4>
      </div>
      <div class="modal-body">
       <form class="form-group" action="create-folder.php" method="POST">
  <label class="col-md-4 control-label" for="folderName">Folder Name</label>  
  
  <input id="folderName" name="folderName" type="text" placeholder="e.x. My Folder" class="form-control input-md">
    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Folder</button>
        </form>

      </div>
    </div>
  </div>
</div>

</html>