<?php
session_start();
require 'database.php';
?>

<!DOCTYPE html>

<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/gitGaMa/adminPages/CSS/adminCSS.css">
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
         <a href="/gitGaMa/adminPages/mainPage.php"><img src="/gitGaMa/images/download.png" width="80" alt=""></a>
     </div>
     <div class="headerright">
            <ul>
               <li><a class="userBtn"><i class="fas fa-user-circle"></i><?php echo $_SESSION['usernameUser'];?>
               <li><a href="/gitGaMa/adminPages/statistics.php" class="signBtn"><i class="far fa-chart-bar"></i> Statistics</a></li>
               <li><a href="/gitGaMa/adminPages/mainPage.php" class="signBtn"><i class="fas fa-home"></i> Home</a></li>
            </ul>
      </div>
  </div>
 </div>

 <!-- AICI SE AFISEAZA TOTI JUCATORII CARE SUNT INTR-UN TURNEU, RESPECTIV SI LA CE JOC -->
 <div class="gamePlayers">
    <ul>
        <li><a style="font-size:25px; font-weight:600">Players that are in a tournament:</a>
        <nav>
            <ol>
                <?php

                if(isset($_SESSION['usernameUser'])){ //daca sunt logat
                
                if($_SESSION['usernameUser']!=='admin')//daca nu sunt admin sa ma dea pe pagina de users
                {
                    header("Location: /gitGaMa/indexAfterLogin.php?login=SUCCES");
                    exit();
                }
                
                //Iau toti jucatorii

                $allUsersSQL="select u.usernameUsers, u.gender, p.points, g.tittleGame from users u join playersgame p on u.idUsers=p.idGuser join games g on p.idGgame=g.idGame order by p.points DESC;";
                
                $result = mysqli_query($conn,$allUsersSQL);
                
                while($row = $result->fetch_assoc()){
                    if($row['gender']=='Male')
                        $genderColor='lightskyblue';
                        else $genderColor='red';

                    echo '<li><a style="color:'.$genderColor.'; font-size: 21px; font-weight:600">'.$row['usernameUsers'].'</a> 
                    <a style="color:grey; font-size: 21px; font-weight:600"> has </a> 
                    <a style="color:orange; font-size: 21px; font-weight:600">'.$row['points'].'</a>
                    <a style="color:grey; font-size: 21px; font-weight:600"> points@ </a>
                    <a style="color:#8B0000; font-size: 21px; font-weight:600">'.$row['tittleGame'].'</a></li>';
                }
                }
                ?>
            </ol>
        </nav>
    </ul>

    <!-- AICI AFISEZ TOTI UTILIZATORII INREGISTRATI -->
    <div class="allUsers">
    <ul>
        <li><a style="font-size:25px; font-weight:600">All users:</a>
        <nav>
            <ol>
                <?php
                if(isset($_SESSION['usernameUser']) && $_SESSION['usernameUser']=="admin"){ //daca sunt logat
                
                //Iau toti jucatorii

                $allUsersSQL="select usernameUsers, gender from users;";
                
                $result = mysqli_query($conn,$allUsersSQL);

                while($row = $result->fetch_assoc()){
                    if($row['usernameUsers']=='admin')
                    echo '<li><a style="color:purple; font-size: 21px; font-weight:600">THE_BOSS</a></li>';
                    else{
                        if($row['gender']=='Male')
                            $genderColor='lightskyblue';
                            else $genderColor='red';
                        echo '<li><a style="color:'.$genderColor.'; font-size: 21px; font-weight:600">'.$row['usernameUsers'].'</a></li>';
                    }
                }
                }
                ?>
            </ol>
        </nav>
    </ul>
 </div>

 <div class="allGames"> <!-- all games -->
    <ul>
        <li><a style="font-size:25px; font-weight:600">All games:</a>
            <nav>
            <ol>
                <?php
                if(isset($_SESSION['usernameUser']) && $_SESSION['usernameUser']=="admin"){ //daca sunt logat
                
                //Iau toti jucatorii

                $allGamesSQL="select tittleGame, typeGame from games;";
                
                $result = mysqli_query($conn,$allGamesSQL);

                while($row = $result->fetch_assoc()){
                    if($row['typeGame']=='Digital')
                        $gameColor='rgb(59, 92, 120)'; //culoarea mai inchisa -digital games
                        else $gameColor='rgb(100, 155, 137)';
                    echo '<li><a style="color:'.$gameColor.'; font-size: 21px; font-weight:600">'.$row['tittleGame'].'</a></li>';
                }
                }
                ?>
            </ol>
            </nav>
    </ul>
 </div>

 <div class="bestUser">
    <ul>
        <li><a style="font-size:25px; font-weight:600">Best player:</a>
            <ol>
                <?php
                if(isset($_SESSION['usernameUser']) && $_SESSION['usernameUser']=="admin"){ //daca sunt logat
                
                //Iau jucatorul cu cele mai multe puncte in total adunate

                $mostUserPointsSQL="SELECT u.usernameUsers, sum(p.points) points FROM users u JOIN playersgame p ON u.idUsers=p.idGuser GROUP BY idGuser ORDER BY points DESC LIMIT 1";
                
                $result = mysqli_query($conn,$mostUserPointsSQL);

                $row = $result->fetch_assoc();
                    echo '<li><a style="color:red; font-size: 21px; font-weight:600">'.$row['usernameUsers'].' - '.$row['points'].'</a></li>';
                }
                ?>
            </ol>
    </ul>
 </div>

 <div class="buttonsDiv">
    <ul>
        <li><a href="/gitGaMa/adminPages/commandsAdmin/allCommands.php?command=movePlayer"><button type="button">Move player</button></a></li>
        <li><a href="/gitGaMa/adminPages/commandsAdmin/allCommands.php?command=removePlayer"><button type="button">Remove player</button></a></li>
        <li><a href="/gitGaMa/adminPages/commandsAdmin/allCommands.php?command=changePoints"><button type="button">Change points</button></a></li>
        <li><a href="/gitGaMa/adminPages/commandsAdmin/allCommands.php?command=createTournament_Game"><button type="button">Add Game/T</button></a></li>
    </ul>
 </div>

</div>

<div class="copyright">
        <div class="container">
            <h5>&copy; 2020 GaMa | Created by Macrescu Cosmin-Ionut & Alexandru Doru-Petru</h5>
        </div>
    </div>

</html>