<?php
   ob_start();
   session_start();
?>

<style>
         body {
            padding-top: 40px;
            padding-bottom: 40px;
         }
         
         .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: #017572;
         }
         
         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }
         
         .form-signin .checkbox {
            font-weight: normal;
         }
         
         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }
         
         .form-signin .form-control:focus {
            z-index: 2;
         }
         
         .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
         }
         
         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
         }
         
         h2{
            text-align: center;
            color: #FFF;
         }
      </style>
      
   </head>
	
   <body>
      
      <h2 style="font-family:helvetica; font-size:18pt; color:#fff; font-weight:bold;"><i  class="fa fa-cloud fa-2x"></i><span style="margin:10px; top:0px;">Pi Drive</span></h2> 
      <div class = "container form-signin">
         <?php
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
                
               $result = mysqli_fetch_array (mysqli_query($conn,"SELECT name FROM users WHERE name='".$_POST['username']."' AND password='".$_POST['password']."'"));
               if (isset($result)){
                  $_SESSION['valid'] = true;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $_POST['username'];
                  
                  $query = "UPDATE users SET online=1 WHERE name='".$_SESSION['username']."'";
                  mysqli_query($conn, $query);
                  
                  header('Refresh: 0; URL = index.php');
               }else{
                  $msg = 'Wrong username or password';
               }
            }
         ?>
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "username" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>
		
      </div> 
      
   </body>