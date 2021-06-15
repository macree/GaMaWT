<?php
    session_start();
    require 'database.php';
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>GaMa</title>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="/gitGaMa/images/download.png" />
        <link rel="stylesheet" type="text/css" href="/gitGaMa/myTournaments/customTournamentsCSS.css">
        <!--Am folosit acest site pentru a folosi anumite simboluri, fonturi.-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>
    <body >

        <!-- Bara de meniu, de aici incepe -->
        <div class="topbar">
            <div class="container" >

                <!-- Partea din stanga-->
                <div class="topleft">
                    <ul>
                        <li> <i class="fas fa-globe-europe"></i> EN </li>
                        <!--In acest mod ma folosesc de simbolurile specifice, prin intermediul tagului <i>-->

                    </ul>
                </div>

                <!-- Centru -->
                <div class="topcenter">
                    <ul>
                        <li><a href="/gitGaMa/indexAfterLogin.php"><i class="fas fa-home"></i> Home</a></li>
                      </ul>
                </div>
            </div>
        </div>

    <!-- De aici incepe header-ul -->
    <div class="header">
        <div class="container">
            <div class="logo">
                <a href="/gitGaMa/indexAfterLogin.php"><img src="/gitGaMa/images/download.png" width="80" alt=""></a>
            </div>

            <div class="headerright">
                <ul>
                    <?php   
                        if(isset($_SESSION['usernameUser'])){
                            $name=$_SESSION['usernameUser'];
                            echo'<li><a class="userBtn"><i class="fas fa-user-circle"></i>'.$name;
                            echo'<li><a href="/gitGaMa/myTournaments/myTournaments.php" class="myTournamentsBtn"><i class="fas fa-chess"></i>My Tournaments</a></li>
                            <li><a href="/gitGaMa/indexAfterLogin.php" class="myTournamentsBtn"><i class="fas fa-home"></i>Home</a></li>
                            <li><form action="/gitGaMa/loginSIregister/includes/logoutPHP.php" method="post">
                            <button type="submit" name="logout-submit" class="buttonLogout"><i class="fas fa-sign-out-alt"></i>Logout</button>
                            </form></li>';
                        }
                        else {
                            header("Location: /gitGaMa/index.php?error=notLogged");
                            exit();
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Games category -->
    
    <?php

    if(isset($_SESSION['usernameUser'])){
    $name=$_SESSION['usernameUser'];
    
    echo'<div class="customTGdiv">
            <div class="container">
                <h3>List of custom tourneys</h3>
                    <ul>';

                        /* Luam toate cele mai populare jocuri la care utilizatorul se incadreaza ca varsta */

                        $sqlCustomTG = "SELECT tittleGame titGame, typeGame FROM games WHERE TGnature='Custom';";
                        $result = mysqli_query($conn,$sqlCustomTG);

                        while($row =mysqli_fetch_array($result)){
                            if($row['typeGame']=='Digital')
                            echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$name.'&game='.$row['titGame'].'&TGnature=Custom" style="color:rgb(59, 92, 120)">'.$row['titGame'].'</a></li>';
                            else if($row['typeGame']=='Board')
                            echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$name.'&game='.$row['titGame'].'&TGnature=Custom" style="color:rgb(100, 155, 137)">'.$row['titGame'].'</a></li>';
                        }
                      
                    echo '</ul>
            </div>
        </div>';
    }
    ?>

    </body>
</html>