<?php  session_start(); ?>

<?php

if(isset($_SESSION['use']))   // Checking whether the session is already there or not if 
                              // true then header redirect it to the home page directly 
 {
    header("Location:index.php"); 
 }

if(isset($_POST['login']))   // it checks whether the user clicked login button or not 
{
     $user = $_POST['user'];
     $pass = $_POST['pass'];

      if($user == "roukee" && $pass == "merke99")  // username is  set to "Ank"  and Password   
         {                                   // is 1234 by default     

          $_SESSION['use']=$user;


         echo '<script type="text/javascript"> window.open("index.php","_self");</script>';            //  On Successful Login redirects to home.php

        }

        else
        {
            echo "invalid UserName or Password";        
        }
}
 ?>
<html>
<head>

<title>Login | team baitmain</title>
<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/simple-sidebar.css">
<link rel="stylesheet" href="css/login.css">
</head>

<div class="jumbotron">
            <div class="container">
                <center>
                <h1>team baitmain | TTT-Server</h1>
                <h2>baitmain.de</h2>
                </center>
                <!-- <p class="lead">This library was created to query game server which use the Source (Steamworks) query protocol.</p>			
			    <p>
			    <a class="btn btn-large btn-primary" href="https://xpaw.me">Made by xPaw</a>
			    <a class="btn btn-large btn-primary" href="https://github.com/xPaw/PHP-Source-Query">View on GitHub</a>
			    <a class="btn btn-large btn-danger" href="https://github.com/xPaw/PHP-Source-Query/blob/master/LICENSE">LGPL v2.1</a>
		        </p> -->
            </div>
        </div>
<div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="POST">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" class="form-control" placeholder="Username" required autofocus name="user" >
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="pass" >
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit" name="login">Sign in</button>
            </form><!-- /form -->

        </div><!-- /card-container -->
    </div>
