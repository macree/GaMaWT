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
        <link rel="stylesheet" type="text/css" href="/gitGaMa/GaMaCSS.css">
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
                        <li><a href="/gitGaMa/adminPages/mainPage.php"><i class="fas fa-home"></i> Home</a></li>
                      </ul>
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
                    <?php
                    //doar adminul sa aiba acces aici
                        if(isset($_SESSION['usernameUser'])&&$_SESSION['usernameUser']=='admin'){
                            $name=$_SESSION['usernameUser'];
                            echo'<li><a class="userBtn"><i class="fas fa-user-circle"></i>'.$name;
                             
                            echo'<li><a href="/gitGaMa/adminPages/administrationPage.php" class="myTournamentsBtn"><i class="fas fa-gavel"></i> Administrate </a></li>
                            <li><a href="/gitGaMa/myTournaments/customTournaments.php" class="myTournamentsBtn"><i class="fas fa-cogs"></i>Custom Tourneys</a></li>
                            <li><form action="/gitGaMa/loginSIregister/includes/logoutPHP.php" method="post">
                            <button type="submit" name="logout-submit" class="buttonLogout"><i class="fas fa-sign-out-alt"></i> Logout</button>
                            </form></li>';
                        }
                        else {//daca e user obisnuit il redirectioneaza la pagina de user, in caz ca incearca sa acceseze admin-page
                            header("Location: /gitGaMa/indexAfterLogin.php?login=SUCCES");
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
                <h3>TOP POPULAR GAMES</h3>
                    <ul>';

                        /* Luam toate cele mai populare jocuri din toate cele existente */
                        $sqlTopGamesDesc = "SELECT g.tittleGame titGame FROM games g JOIN playersgame p ON g.idGame=p.idGgame GROUP BY p.idGgame ORDER BY count(p.idGgame) DESC";
                        $result2 = mysqli_query($conn,$sqlTopGamesDesc);
                        $i=1;

                        while(($row = $result2->fetch_assoc())&$i<=4){
                            echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game='.$row['titGame'].'"><img src="/gitGaMa/images/' .$row['titGame']. '.png" alt="' .$row['titGame']. '"></a></li>';
                            $i++;
                        }
                      
                    echo '</ul>
            </div>
        </div>';
    }
    ?>

    <div class="honorableMentions">
            <div class="container">
                <h3>BOARD GAMES</h3>
                    <ul>
                      <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=chessKid"><img src="/gitGaMa/images/chessKid.png" alt="chessKid"></a></li>
                      <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=gWho"><img src="/gitGaMa/images/gWho.png" alt="gWho"></a></li>
                      <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=GoT"><img src="/gitGaMa/images/GoT.png" alt="GoT"></a></li>
                      <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=Monopoly"><img src="/gitGaMa/images/Monopoly.png" alt="Monopoly"></a></li>
                      <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=Pandemic"><img src="/gitGaMa/images/Pandemic.png" alt="Pandemic"></a></li>
                      <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=qCubes"><img src="/gitGaMa/images/qCubes.png" alt="qCubes"></a></li>
                      <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=Domino"><img src="/gitGaMa/images/Domino.png" alt="Domino"></a></li>
                    </ul>
            </div>
        </div>
        <div class="honorableMentions">
        <div class="container">
            <h3>DIGITAL GAMES</h3>
                <ul>
                  <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=go"><img src="/gitGaMa/images/go.png" alt="go"></a></li>
                  <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=labyrinth"><img src="/gitGaMa/images/labyrinth.png" alt="labyrinth"></a></li>
                  <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=Rummy"><img src="/gitGaMa/images/Rummy.png" alt="Rummy"></a></li>
                  <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=Solitaire"><img src="/gitGaMa/images/Solitaire.png" alt="Solitaire"></a></li>
                  <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=Hearthstone"><img src="/gitGaMa/images/Hearthstone.png" alt="Hearthstone"></a></li>
                  <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=RedAlert2"><img src="/gitGaMa/images/RedAlert2.png" alt="RedAlert2"></a></li>
                  <li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$_SESSION['usernameUser'].'&game=Scrable"><img src="/gitGaMa/images/Scrable.png" alt="Scrable"></a></li>
                </ul>
        </div>
    </div>

    <!-- Zona partererilor/reclame -->

    <div class="partnerArea">
            <div class="container">
              <h3>OUR PARTNERS</h3>
                    <ul>
                      <li><a href="https://www.info.uaic.ro/"><img src="/gitGaMa/images/FIIsponsor2.png" alt="FII"></a></li>
                      <li><a href="https://www.bancatransilvania.ro"><img src="/gitGaMa//images/BTsponsor.jpg" alt="BT"></a></li>
                      <li><a href="https://www.amazon.com"><img src="/gitGaMa/images/AmazonSponsor.png" alt="Amazon"></a></li>
                    </ul>
            </div>
        </div>

    <!-- Footer-ul -->

    <div class="footer">
        <div class="container">
            <div class="col-3">
                <p><strong>Where you can find us:</strong><br>Iasi, Str. Aioanesei Adrian, Nr. 69</p>
                <a href="/gitGaMa/RSSfeed.php"><img src="/gitGaMa/images/rss_icon.png" width="20" height="20"></a>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <h5>&copy; 2020 GaMa | Created by Macrescu Cosmin-Ionut & Alexandru Doru-Petru</h5>
        </div>
    </div>

    </body>
</html>
