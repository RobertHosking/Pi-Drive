<?php
$query = "SELECT name FROM users WHERE online=1";
$query2 = "SELECT name FROM users WHERE streaming=1";

$result = mysqli_fetch_array(mysqli_query($conn, $query));
$result2 = mysqli_fetch_array(mysqli_query($conn, $query2));
$online_bar = "";

foreach($result as $user){
	if($seen){
		$seen = false;
		continue;
	}else{
		if($user == $_SESSION['username']){
			$user_blurb = "You are online";
		}else{
			$user_blurb = $user." is online";
		}
		if(isset($result2)){
			foreach($result2 as $u){
				if($seen2){
					$seen2 = false;
					continue;
				}else{
					if($user == $u){
						$user_blurb = $user_blurb." and streaming";
					}
					$seen2 = true;
				}	
			}
		}
		$online_bar = $online_bar.$user_blurb."<br>";
		$seen = true;
	}
}

?>

<nav class="navbar navbar-findcond navbar-fixed-top">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" style="font-family:helvetica; font-size:18pt; color:#fff; font-weight:bold;" href="/"><i  class="fa fa-cloud fa-2x"></i><span style="margin:10px; top:0px;">Pi Drive</span></a>
		</div>
		<div class="collapse navbar-collapse" id="navbar">
			<ul style="margin-right:30px;" class="nav navbar-nav navbar-right">

        <li class="active"><li><a href=":9091"><i class="fa fa-magnet fa-2x"></i> <span></span></a></li>
                <li class="active"><li><a href=""><i class="fa fa-play fa-2x"></i> <span></span></a></li>
                <li class="active"><li><a href="logout.php">Logout<span></span></a></li>

			</ul>

		</div>
</nav>
<nav class="navbar  navbar-findcond navbar-default navbar-lower" role="navigation">
  <div class="collapse navbar-collapse collapse-buttons">

			<div class="col-sm-1">
				<button style="margin:10px;" class='btn btn-danger navbar-search pull-left' data-toggle="modal" data-target="#myModal">Upload</button>
			</div>
			
			<div class="col-sm-4">
			    <?php
			    $crumbs = explode("/", $_SESSION['dir']);
			    array_pop($crumbs);
			    $breadcrumb = '<h3 class="breadcrumb">';
			    $parrents = '';
			    $i = 0;
			    $divider = " >  ";
			    $numItems = count($crumbs);
			    foreach ($crumbs as $crumb) {
			        if(++$i === $numItems) {
                        $divider = '';
                      }
			        $breadcrumb = $breadcrumb."<a href='' onclick=\"change_dir('".$parrents.$crumb."');reload();\">".$crumb."</a> ".$divider;
			        $parrents = $parrents.$crumb."/";
			    } 
			    $breadcrumb = $breadcrumb."</h3>";
   			    echo $breadcrumb;
			    ?>
			</div>
				<div id="file-options" class="col-sm-4">
					
					
				</div>
			<div class="col-sm-4 pull-right" style="text-align:right">
				<?php echo $online_bar;?>
			</div>
  </div>
  
</nav>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload File to <?php echo $_SESSION['dir'];?></h4>
      </div>
      <div class="modal-body">
      	<form class="form-horizontal">
<fieldset>

<!-- Form Name -->

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="urlField">From url</label>  
  <div class="col-md-4">
  <input id="urlField" name="urlField" type="text" placeholder="e.x. https://www.fileserver.com/file.ext" class="form-control input-sm">
    
  </div>
</div>
<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="fileButton"></label>
  <div class="col-md-4">
    <input id="fileButton" name="fileButton" class="input-file" type="file">
  </div>
</div>

</fieldset>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Go!</button>
      </div>
    </div>
  </div>
</div>