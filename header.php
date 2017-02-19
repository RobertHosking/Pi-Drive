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
				<button style="margin:10px;" class='btn btn-danger navbar-search pull-left' onclick="location.href='<%= new_report_path%>'">New Report</button>
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
			<div class="col-sm-4 pull-right" style="text-align:right">
				<?php echo $online_bar;?>
			</div>
	

  </div>
</nav>
