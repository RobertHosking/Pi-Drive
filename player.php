<?php
require 'head.php';
require 'db-connect.php';
?>

 <style>
    body {
      font-family: Arial, sans-serif;
    }
    .info {
      background-color: #eee;
      border: thin solid #333;
      border-radius: 3px;
      margin: 0 0 20px;
      padding: 0 5px;
    }
    /*
      We include some minimal custom CSS to make the playlist UI look good
      in this context.
    */
    .player-container {
      background: #1a1a1a;
      overflow: auto;
      width: 934px;
    }
    .video-js {
      float: left;
    }
    .vjs-playlist {
      float: left;
      width: 300px;
    }
    
    
  </style>
</head>
<body>
  <br>
  <br>
<div class="container">
  <div class="player-container center-block">
    <video
      id="video"
      class="video-js vjs-16-9"
      height="300"
      width="600"
      controls
       data-setup='{
        "autoplay": true}'>
    </video>

    <div class="vjs-playlist">
      <!--
        The contents of this element will be filled based on the
        currently loaded playlist
      -->
    </div>
  </div>
</div>
<?php
$javascripts = scandir('js/post/');
foreach($javascripts as $file) {
    if($file == "." || $file == ".."){
        continue;
    }
    else{
        echo "<script src='js/post/".$file."'></script>";
    }
}
?>

  
  <?php
      session_start();
      $files = scandir($_SESSION['dir']);
      $numfiles = count($files);
      $i = 1;
      $playlist_hash = "[";
      foreach($files as $file){
         if($i++ != $numfiles){
            $d = ",";
          }else{
            $d = "";
          }
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if($ext == "mp4"){
          
          $ffmpeg_output = shell_exec("avconv -i \"$file\" 2>&1");
          if( preg_match('/.*Duration: ([0-9:]+).*/', $ffmpeg_output, $matches) ) {
            $duration = $matches[1];
          } else {
            $duration = "0";
          }
          $url = "https://" . $_SERVER['HTTP_HOST']."/".str_replace(' ', '%20',$_SESSION['dir']).str_replace(' ', '%20', $file);
          $thumbnail = "";
          $playlist_hash = $playlist_hash."{name: '".$file."',description: 'test',duration: ".$duration.",thumbnail: [{srcset: '".$thumbnail."',type: 'image/jpeg',media: '(min-width: 400px;)'},{src: '".$thumbnail."'}],sources: [{ src: '".$url."', type: 'video/mp4' }]}".$d;
        }
      }
      $playlist_hash = $playlist_hash."]";
      ?>
  
  <script>
    var player = videojs('video');
    var playlist_hash = <?php echo $playlist_hash;?>;
    player.playlistUi();
    player.playlist(playlist_hash);
    // Initialize the playlist-ui plugin with no option (i.e. the defaults).
    <?php 
    
    if(isset($_GET['episode'])){
      $ep = $_GET['episode'] -1;
      echo "player.playlist.currentItem(".$ep.");";
    }
    ?>
     player.playlist.autoadvance(2);
  </script>

</body>
