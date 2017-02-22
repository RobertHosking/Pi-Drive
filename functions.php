<?php
function list_folders(){
    $assets = 'drive/Temp/Pi-Drive/Posters/';

    $tab = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    foreach(glob($_SESSION['dir']."*", GLOB_ONLYDIR) as $dir) {
        if($_SESSION['dir'] == "drive/Drive/Series/"){
            $series = explode("/",$dir)[3];
            if(!file_exists($assets.$series.".jpg")){
                 $json = file_get_contents('https://api.themoviedb.org/3/search/tv?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb&language=en-US&query='.urlencode($series).'&page=1');
                $obj = json_decode($json, true);
                if(!$obj["results"]==[]){
                    $poster = $obj["results"][0]["poster_path"];
                    file_put_contents($assets.$series.".jpg", fopen("http://image.tmdb.org/t/p/w500".$poster, 'r'));
                }else{
                    copy('images/timthumb.jpg', $assets.$series.".jpg");
                }
            }
            echo "<a class='file' title='".$series."' onclick='change_dir(\"".$dir."\"); reload();' href='#'><img width='150px' src='".$assets.$series.".jpg'></a>";
        }elseif(explode(" ",(explode("/",$dir)[4]))[0] == "Season") {
      
            $series = explode("/",$dir)[3];
            $season_num = explode(" ",explode("/",$dir)[4])[1];
            
            $image = $assets.$series."Season ".$season_num.".jpg";
            if(!file_exists($image)){
                $json = file_get_contents('https://api.themoviedb.org/3/search/tv?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb&language=en-US&query='.urlencode($series).'&page=1');
                $obj = json_decode($json, true);
                
                if(!$obj["results"] == []){
                     $show_id = $obj["results"][0]["id"];
                    $json = file_get_contents('https://api.themoviedb.org/3/tv/'.$show_id.'/season/'.$season_num.'?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb&language=en-US');
                    $obj = json_decode($json, true);
                    if(isset($obj['poster_path']) && $obj['poster_path'] != ""){
                        $season_poster = $obj['poster_path'];
                        file_put_contents($image, fopen("http://image.tmdb.org/t/p/w500".$season_poster, 'r'));
                    }else{
                         copy('images/timthumb.jpg', $image);
                    }
                }else{
                    copy('images/timthumb.jpg', $image);
                }
            }
            echo "<a class='file' title='Season ".$season_num."' onclick='change_dir(\"".$dir."\"); reload();' href='#'><img width='150px' src='".$image."'></a>";

        }
        else{
            $dirname = basename($dir);
            echo '<button id="'.$dirname.'" type="button" onclick=\'focus_this(this, "'.$_SESSION['dir'].'");\' onblur=\'focus_lost();\' ondblclick=\'change_dir("'.$_SESSION["dir"].$dirname.'"); reload();\' class="btn btn-secondary folder"><i class="fa  fa-folder"></i>'.$tab.$dirname.$tab.'</button>';
        }
    }
}
function list_file($file, $g = NULL){
    $assets = 'drive/Temp/Pi-Drive/Posters/';
    $data_folder = 'drive/Temp/Pi-Drive/Data/';

    if (!file_exists($assets)) {
        mkdir($assets, 0777, true);
    }
      if (!file_exists($data_folder)) {
        mkdir($data_folder, 0777, true);
    }
    if(is_file($_SESSION['dir'].$file)){
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        // If MP4
        if($ext == "mp4"){
            // IF IN MOVIES
            if(substr($_SESSION['dir'],0,19) == "drive/Drive/Movies/"){
                if(!file_exists($assets.basename($file, ".mp4").".jpg")){
                    $movie = explode('(',$file);
                    $json = substr(file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb&query='.urlencode($movie[0]).'&callback=?'), 2, -1);
                    $obj = json_decode($json, true);
                    if(!$obj["results"]==[]){
                        $poster = $obj["results"][0]["poster_path"];
                        file_put_contents($assets.basename($file, ".mp4").".jpg", fopen("http://image.tmdb.org/t/p/w500".$poster, 'r'));
                    }else{
                        copy('images/timthumb.jpg', $assets.basename($file, ".mp4").".jpg");
                    }
                }
                echo "<a class='file' title='".basename($file, ".mp4")."' onclick='online(1)' href='".$_SESSION['dir'].$file."'><img width='150px' src='".$assets.basename($file, ".mp4").".jpg'></a>";
            // IF IN A SEASON
            }elseif(explode(" ",(explode("/",$_SESSION['dir'])[4]))[0] == "Season"){
                $series = explode("/",$_SESSION['dir'])[3];
                $season = explode(" ",(explode("/",$_SESSION['dir'])[4]))[0];
                $data_file = $data_folder.$series." Season ".$season.".json";
                if(!file_exists($data_file)){
                    $json = file_get_contents('https://api.themoviedb.org/3/search/tv?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb&language=en-US&query='.urlencode($series).'&page=1');
                    $obj = json_decode($json, true);
                    $show_id = $obj["results"][0]["id"];
                
                    $json = file_get_contents('https://api.themoviedb.org/3/tv/'.$show_id.'/season/'.$season.'?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb&language=en-US');
                    if($json != ""){
                        file_put_contents($data_file, $json);   
                    }
                }
                $obj = json_decode(file_get_contents($data_file), true);
                $episode = $obj['episodes'][$g];
                $title = $episode['name'];
                $number = $episode['episode_number'];
                $overview = $episode['overview'];
		        echo "<tr><td>".$number."</td><td>".$title."</td><td>".$overview."</td><td><button class='btn btn-success'  onclick=\"location.href = 'player.php?episode=".$number."';\">Watch</button></td></tr>";
            }else{
            #echo "<a class='file' title='".basename($file, ".mp4")."' onclick='online(1)' href='".$_SESSION['dir'].$file."'>".$file."</a>";
            }
        }
        if($ext == "jpg" || $ext == "png"){
            echo "<a class='file' href='".$_SESSION['dir'].$file."'><img width='250px' src='".$_SESSION['dir'].$file."'></a>";
        }
        else{
           // echo '<button type="button" onclick="location.href=\''.$_SESSION['dir'].$file.'\';" class="btn btn-primary file">'.$file.'</button>';
        }
    }
}

function rename_series($dir){
    if(substr($_SESSION['dir'],0,19) == "drive/Drive/Series/"){
        $files = scandir($dir);
        # make sure all files are mp4
        $i = 0;
        foreach($files as $file){
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if($ext == "mp4"){
                $i++;
                # get series name
                $dirs = explode("/", $dir);
                $series = $dirs[3];
                $season = $dir[4];
                $seasonNum = trim($season.slice(-2));
                if(strlen($seasonNum) == 1){
                    $seasonNum = "0".$seasonNum;
                }
                if($i < 10){
                    $fill = "0";
                }else{$fill="";}
                #use API to get episode title
                $fileName = $series." S".$seasonNum."E".$fill.$i;
                #rename each file   
        
            }
        }
    }
}

?>
