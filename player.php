<?php
require 'head.php';
require 'db-connect.php';
?>

<body>
<video requestFullScreen id="videoPlayer" autoplay onended="next_video()">
    <source src="drive/Drive/Movies/h.mp4" type='video/mp4'/>
</video>

<script>
video_count =1;
videoPlayer = $('#videoPlayer');

function next_video(){
        video_count++;
        if (video_count == 16) video_count = 1;
        var nextVideo = "video"+video_count+".mp4";
        videoPlayer.src = nextVideo;
        videoPlayer.play();
   };
</script>


<?php
$javascripts = scandir('js/post/');
foreach($javascripts as $file) {
    if($file == "." || $file == ".."){
        continue;
    }else{
        echo "<script src='js/post/".$file."'></script>";
    }
}  
?>



</body>
