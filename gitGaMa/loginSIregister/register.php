<!DOCTYPE html>

<html lang="en-US">

<head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
               <li><a href="/gitGaMa/loginSIregister/login.php" class="signBtn"><i class="fas fa-user-circle"></i> Login</a></li>
            </ul>
      </div>
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
      <input type="text" placeholder="Username" name="uName" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Password" name="psw" required>
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="rPassword" name="pswRepeat" required>

      <label for="age" id="age">Age</label>
      <input type="text" name="age" placeholder="Age" required>

      <label for="sexSelect">Gender</label>
      <select id="genderScrollMenuRegister" name="sexSelect"> <!-- drop-down list -->
         <option value="Male" id="male">Male</option>
         <option value="Female" id="female">Female</option>
      </select>

      <button type="submit" name="register-submit" id="register-submitButton">Register</button>
   </div>
</form>
</body>
</html>
