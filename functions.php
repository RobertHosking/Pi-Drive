<?php
function list_file($file){
    $assets = 'drive/Downloads/Pi-Drive/';
    if(is_file($_SESSION['dir'].$file)){
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        // If MP4
        if($ext == "mp4"){
            // IF IN MOVIES
            if($_SESSION['dir'] == 'drive/Drive/Movies/' || $_SESSION['dir'] == 'drive/Drive/Movies/Favorites/'){
                if(!file_exists($assets.basename($file, ".mp4").".jpg")){
                    $movie = explode('(',$file);
                    $json = substr(file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=15d2ea6d0dc1d476efbca3eba2b9bbfb&query='.urlencode($movie[0]).'&callback=?'), 2, -1);
                    $obj = json_decode($json, true);
                    if(!$obj["results"]==[]){
                        $poster = $obj["results"][0]["poster_path"];
                        file_put_contents($assets.basename($file, ".mp4").".jpg", fopen("http://image.tmdb.org/t/p/w500".$poster, 'r'));
                    }else{
                        copy($assets.'movie-placeholder.jpg', $assets.basename($file, ".mp4").".jpg");
                    }
                }
                echo "<a class='file' title='".basename($file, ".mp4")."' onclick='online(1)' href='".$_SESSION['dir'].$file."'><img width='150px' src='".$assets.basename($file, ".mp4").".jpg'></a>";
            // IF IN SERIES
            }elseif(substr($_SESSION['dir'],0,19) == "drive/Drive/Series/"){
                //Get SERIES FOLDER ART
                
                // GET SEASON ART
                
            
                echo '<button type="button" onclick="location.href=\''.$_SESSION['dir'].$file.'\';" class="btn file"><i class="fa fa-film"></i>'.$tab.$file.$tab.'</button>';
            }
        }
        if($ext == "jpg" || $ext == "png"){
            echo "<a class='file' href='".$_SESSION['dir'].$file."'><img width='250px' src='".$_SESSION['dir'].$file."'></a>";
        }
        else{
            //echo '<button type="button" onclick="location.href=\''.$_SESSION['dir'].$file.'\';" class="btn btn-primary file">'.$file.'</button>';
        }
    }
}

?>