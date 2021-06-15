<?php
session_start();
require 'database.php';
require 'statisticsPHP.php';
?>

<!DOCTYPE html>

<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/gitGaMa/adminPages/CSS/statisticsCSS.css">
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
               <li><a href="/gitGaMa/adminPages/administrationPage.php" class="signBtn"><i class="fas fa-gavel"></i> Administrate</a></li>
               <li><a href="/gitGaMa/adminPages/mainPage.php" class="signBtn"><i class="fas fa-home"></i> Home</a></li>
            </ul>
      </div>
  </div>
 </div>

 <!-- AICI SE AFISEAZA TOTI JUCATORII CARE SUNT INTR-UN TURNEU, RESPECTIV SI LA CE JOC -->
 <div class="usersStatistics">
    <ul>
        <!-- Procentaje male/female -->
        <li><a id="statisticsDefaultAtribute">The total number of users: </a><a style="color: purple; font-size:40px; font-weight:600">
            <?php 
                echo $numberOfTotalUsers;
            ?>
        </a></li>

        <li><a id="statisticsDefaultAtribute">The % of users that are </a><a style="color: lightskyblue; font-size:40px; font-weight:600">male
            <?php 
                echo round($percentOfMales,2).'% ('.$numberOfMales.')';
            ?>
        </a></li>
        
        <li><a id="statisticsDefaultAtribute">The % of users that are </a><a style="color: red; font-size:40px; font-weight:600">female
            <?php 
                echo round($percentOfFemales,2).'% ('.$numberOfFemales.')';
            ?>
        </a></li>

        <!-- Procentaje categorii varsta -->
        <li><a id="statisticsDefaultAtribute">The % of users that have 1-13 years</a>
            <a style="font-size:40px; font-weight:600; color:burlywood">
            <?php 
                echo round($percentOf1_13,2).'% ('.$numberOfAge1_13.')'; // arata doar 2 zecimale dupa virgula
            ?>
        </a></li>

        <li><a id="statisticsDefaultAtribute">The % of users that have 14-70 years</a>
            <a style="font-size:40px; font-weight:600; color:burlywood">
            <?php 
                echo round($percentOf14_70,2).'% ('.$numberOfAge14_70.')'; // arata doar 2 zecimale dupa virgula
            ?>
        </a></li>

        <li><a id="statisticsDefaultAtribute">The % of users that have 71-99 years</a>
            <a style="font-size:40px; font-weight:600; color:burlywood">
            <?php 
                echo round($percentOf71_99,2).'% ('.$numberOfAge71_99.')'; // arata doar 2 zecimale dupa virgula
            ?>
        </a></li>
    </ul>

</div>

<div class="gamesStatistics">
    <ul>
        <li><a id="statisticsDefaultAtribute">The total number of games:</a>
            <a style="font-size:40px; font-weight:600; color:purple">
            <?php 
                echo $numberTotalGames;
            ?>
        </a></li>

        <li><a id="statisticsDefaultAtribute">The % of <a id="digitalGameAtribute">digital</a> <a id="statisticsDefaultAtribute"> games</a>
            <a style="font-size:40px; font-weight:600; color:rgb(59, 92, 120)">
            <?php 
                echo round($precentOfDigitalGames,2).'% ('.$numberDigitalGames.')'; // arata doar 2 zecimale dupa virgula
            ?>
        </a></li>

        <li><a id="statisticsDefaultAtribute">The % of <a id="boardGameAtribute">board</a> <a id="statisticsDefaultAtribute">games</a>
            <a style="font-size:40px; font-weight:600; color:rgb(100, 155, 137)">
            <?php 
                echo round($percentOfBoardGames,2).'% ('.$numberBoardGames.')'; // arata doar 2 zecimale dupa virgula
            ?>
        </a></li>
    </ul>
    
</div>

<div class="buttonsDiv">
    <button>Export</button>
</div>

<div class="copyright">
        <div class="container">
            <h5>&copy; 2020 GaMa | Created by Macrescu Cosmin-Ionut & Alexandru Doru-Petru</h5>
        </div>
    </div>

</html>