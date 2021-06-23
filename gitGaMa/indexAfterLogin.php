<?php
session_start();
require 'database.php';
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>GaMa</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/gitGaMa/images/download.png" />
        <link rel="stylesheet" type="text/css" href="/gitGaMa/GaMaCSS.css">
        <!--Am folosit acest site pentru a folosi anumite simboluri, fonturi.-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>
    <body>

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
                        if($_SESSION['usernameUser']=='admin'){ // in caz ca suntem deja logti ca admin si incercam sa accesam pagina direct din pagina de url sa de dea direct in pagina de admin
                            header("Location: /gitGaMa/adminPages/mainPage.php?login=SUCCES");
                            exit();
                        }

                        else
                        
                        if(isset($_SESSION['usernameUser'])){
                            $name=$_SESSION['usernameUser'];
                            echo'<li><a class="userBtn"><i class="fas fa-user-circle"></i>'.$name;

                            $sql="SELECT age FROM users where usernameUsers='$name';";
                            $result = mysqli_query($conn,$sql);
                            $row =mysqli_fetch_array($result);
                                if($row['age']>=5 && $row['age']<14)
                                echo ' <i class="fas fa-baby"></i></a></li>';
                                else if($row['age']>=14 && $row['age']<=29)
                                echo ' <i class="fas fa-child"></i></a></li>';
                                else if($row['age']>=30 && $row['age']<=69)
                                echo ' <i class="fas fa-male"></i></a></li>';
                                else echo ' <i class="fas fa-blind"></i>';
                             
                            echo'<li><a href="/gitGaMa/myTournaments/myTournaments.php" class="myTournamentsBtn"><i class="fas fa-chess"></i>My Games</a></li>
                            <li><form action="/gitGaMa/loginSIregister/includes/logoutPHP.php" method="post">
                            <button type="submit" name="logout-submit" class="buttonLogout"><i class="fas fa-sign-out-alt"></i>Logout</button>
                            </form></li>';
                            // ANULATA <li><a href="/gitGaMa/myTournaments/customTournaments.php" class="myTournamentsBtn"><i class="fas fa-cogs"></i>Custom Tourneys</a></li>
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

    $sql="SELECT age FROM users where usernameUsers='$name';"; // Luam varsta userului
    $result = mysqli_query($conn,$sql);

    echo'<div class="honorableMentions">
            <div class="container">
                <h3>TOP POPULAR GAMES FOR YOUR AGE: <a style="color: purple">'.$row[0].'</a><a href="/gitGaMa/RSSfeed.php?userAge='.$row[0].'"><img src="/gitGaMa/images/rss_icon.png" alt="RSS" width="20" height="20"></a></h3>
                    <ul>';

                        /* Luam toate cele mai populare jocuri la care utilizatorul se incadreaza ca varsta */

                        $row =mysqli_fetch_array($result);
                        //$sqlTopGamesDesc = "SELECT g.tittleGame titGame FROM games g JOIN playersgame p ON g.idGame=p.idGgame WHERE minimumAge<=$row[0] AND maximumAge>=$row[0] GROUP BY p.idGgame ORDER BY count(p.idGgame) DESC";
                        $sqlTopGamesDesc = "SELECT * FROM games WHERE minimumAge<=$row[0] AND maximumAge>=$row[0] ORDER BY likes DESC";
                        $result2 = mysqli_query($conn,$sqlTopGamesDesc);
                        $i=1;

                        while(($row = $result2->fetch_assoc())&$i<=4){
                            if($row['TGnature']=='Custom')
                            echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game='.$row['tittleGame'].'&TGnature=Custom"><img src="/gitGaMa/images/customTourneyCup.png" alt="customTourneyCup"></a></li>';
                            else
                            echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game='.$row['tittleGame'].'&TGnature=Original"><img src="/gitGaMa/images/' .$row['tittleGame']. '.png" alt="' .$row['tittleGame']. '"></a></li>';
                            $i++;
                        }
                      
                    echo '</ul>
            </div>
        </div>';

    $sqlGAMES="SELECT tittleGame,minimumAge,maximumAge from games;";
    $result = mysqli_query($conn,$sqlGAMES);
    /*while($row =mysqli_fetch_array($result)){
        //$row =mysqli_fetch_array($result);
        if($row['minimumAge']>=1 && $row['maximumAge']<14)
        echo ;*/
        }
    ?>

    <div class="honorableMentions">
            <div class="container">
                <h3><a href="/gitGaMa/gamesCategory/boardGames.php">BOARD GAMES</a></h3>
            </div>
        </div>
    <div class="honorableMentions">
            <div class="container">
                <h3><a href="/gitGaMa/gamesCategory/digitalGames.php">DIGITAL GAMES</a></h3>
            </div>
        </div>

    <!-- Footer-ul -->

    <div class="footer">
        <div class="container">
            <div class="col-3">
                <p><strong>Where you can find us:</strong><br>Iasi, Str. Aioanesei Adrian, Nr. 69</p>
                <!-- <a href="/gitGaMa/RSSfeed.php"><img src="/gitGaMa/images/rss_icon.png" width="20" height="20"></a> -->
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <h5>&copy; 2021 GaMa | Created by Macrescu Cosmin-Ionut</h5>
            <p><a href="http://jigsaw.w3.org/css-validator/check/referer">
                <img style="border:0;width:88px;height:31px"
                src="http://jigsaw.w3.org/css-validator/images/vcss"
                alt="Valid CSS!">
                </a>
            </p>
        </div>
    </div>

    </body>
</html>
