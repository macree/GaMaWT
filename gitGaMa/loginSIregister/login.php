<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en-US">

<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!--<link rel="stylesheet" type="text/css" href="/gitGaMa/loginSIregister/loginCSS.css">-->
   <link rel="stylesheet" type="text/css" href="/gitGaMa/GaMaCSS.css">
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>
<body>
 <!-- Bara de meniu, de aici incepe -->
 <div class="topbar">
     <div class="container" >

     </div>
 </div>

 <!-- De aici incepe header-ul -->
 <div class="header">
  <div class="container">
     <div class="logo">
         <a href="/gitGaMa/index.php"><img src="download.png" width="80" alt=""></a>
     </div>
     <div class="headerright">
                <ul>
                    <li><a href="/gitGaMa/loginSIregister/register.php" class="registerBtn"><i class="fas fa-user-circle"></i> Register</a></li>
                </ul>
            </div>
  </div>
 </div>

<div class="loginContainer">
<form action="/gitGaMa/loginSIregister/includes/loginPHP.php" method="post">
 <?php
if(isset($_GET['error'])){
   if($_GET['error']=="wrongPassword"){
      echo '<label id=errorLoginLabel>Wrong password!</label>';
   }
   if($_GET['error']=="userNotExist"){
      echo '<label id=errorLoginLabel>Non-existent!</label>';
   }
}
?>
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Username" name="usernameLogin" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Password" name="passwordLogin" required>

    <button type=submit name="login-submit" id="login-submitButton">Login</button>
  </div>
</form>
</body>
 </html>
