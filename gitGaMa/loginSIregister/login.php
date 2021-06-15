<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en-US">

<head>
  <link rel="stylesheet" type="text/css" href="/gitGaMa/loginSIregister/loginCSS.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>

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

<form action="/gitGaMa/loginSIregister/includes/loginPHP.php" method="post">
 <div class="loginContainer">
 <?php
if(isset($_GET['error'])){
   if($_GET['error']=="wrongPassword"){
      echo '<label id=errorLoginLabel>Incorrect password!</label>';
   }
   if($_GET['error']=="userNotExist"){
      echo '<label id=errorLoginLabel>Username non-existent!</label>';
   }
}
?>
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter your Username" name="usernameLogin" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter your Password" name="passwordLogin" required>

    <button type=submit name="login-submit">Login</button>
  </div>
</form>

 <!-- Footer-ul -->

 <div class="footer">
  <div class="container">
     <div class="col-3">
         <p><strong>Where you can find us:</strong><br>Iasi, Str. Aioanesei Adrian, Nr. 69</p>
     </div>
  </div>
 </div>

 <div class="copyright">
  <div class="container">
     <h5>&copy; 2020 GaMa | Created by Macrescu Cosmin-Ionut & Alexandru Doru-Petru</h5>
  </div>
 </div>
 </html>
