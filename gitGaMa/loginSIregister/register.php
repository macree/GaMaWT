<!DOCTYPE html>

<html lang="en-US">

<head>
  <link rel="stylesheet" type="text/css" href="/gitGaMa/loginSIregister/registerCSS.css">
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
               <li><a href="/gitGaMa/loginSIregister/login.php" class="signBtn"><i class="fas fa-user-circle"></i> Login</a></li>
            </ul>
      </div>>
  </div>
 </div>

<form action="/gitGaMa/loginSIregister/includes/registerPHP.php" method="post">
 <div class="registerContainer">
 <?php
if(isset($_GET['error'])){
   if($_GET['error']=="invalidUsername"){
      echo '<label id=registerErrorLabel>Invalid username!</label>';
   }
   if($_GET['error']=="invalidAge"){
      echo '<label id=registerErrorLabel>Invalid age!</label>';
   }
   if($_GET['error']=="passwordCheck"){
      echo '<label id=registerErrorLabel>Passwords are not the same!</label>';
   }
   if($_GET['error']=="usernameTaken"){
      echo '<label id=registerErrorLabel>The username already exists!</label>';
   }
}
if(isset($_GET['register'])){
   if($_GET['register']=="succes"){
      echo '<label id=registerSuccesLabel>Registration complete!</label>';
   }
}
?>
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter your Username" name="uName" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter your Password" name="psw" required>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Repeat Password" name="pswRepeat" required>

    <label for="age" id="age">Age</label>
    <input type="text" name="age" placeholder="Enter your age" required>

    <label for="sexSelect">Gender</label>
    <select id="gender" name="sexSelect"> <!-- drop-down list -->
       <option value="Male" id="male">Male</option>
       <option value="Female" id="female">Female</option>
    </select>

    <button type="submit" name="register-submit">Register</button>
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
