<?php
session_start();
require 'database.php';
if ($_SESSION['usernameUser'] != 'admin') {
    header("Location: /gitGaMa/index.php");
    exit();
}
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
        <div class="container">

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
                        if (isset($_SESSION['usernameUser']) && $_SESSION['usernameUser'] == 'admin') {
                            $name = $_SESSION['usernameUser'];
                            echo '<li><a class="userBtn"><i class="fas fa-user-circle"></i>';
                            echo $name . '</a></li>';

                            echo '<li><a href="/gitGaMa/adminPages/administrationPage.php" class="myTournamentsBtn"><i class="fas fa-gavel"></i> Administrate </a></li>
                            <li><form action="/gitGaMa/loginSIregister/includes/logoutPHP.php" method="post">
                            <button type="submit" name="logout-submit" class="buttonLogout"><i class="fas fa-sign-out-alt"></i> Logout</button>
                            </form></li>';
                            //ANULAT <li><a href="/gitGaMa/myTournaments/customTournaments.php" class="myTournamentsBtn"><i class="fas fa-cogs"></i>Custom Tourneys</a></li>
                        } else { //daca e user obisnuit il redirectioneaza la pagina de user, in caz ca incearca sa acceseze admin-page
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

        if (isset($_SESSION['usernameUser'])) {
            $name = $_SESSION['usernameUser'];

            echo '<div class="honorableMentions">
            <div class="container">
                <h3>TOP POPULAR GAMES<a href="/gitGaMa/RSSfeed.php?userAge=22"><img src="/gitGaMa/images/rss_icon.png" width="20" height="20" alt="RSS"></a></h3>
                    <ul>';

            //$sqlTopGamesDesc = "SELECT g.tittleGame titGame FROM games g JOIN playersgame p ON g.idGame=p.idGgame WHERE minimumAge<=$row[0] AND maximumAge>=$row[0] GROUP BY p.idGgame ORDER BY count(p.idGgame) DESC";
            $sqlTopGamesDesc = "SELECT * FROM games ORDER BY likes DESC";
            $result2 = mysqli_query($conn, $sqlTopGamesDesc);
            $i = 1;

            while (($row = $result2->fetch_assoc()) & $i <= 4) {
                if ($row['TGnature'] == 'Custom')
                    echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username=' . $_SESSION['usernameUser'] . '&game=' . $row['tittleGame'] . '&TGnature=Custom"><img src="/gitGaMa/images/customTourneyCup.png" alt="customTourneyCup"></a></li>';
                else
                    echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username=' . $_SESSION['usernameUser'] . '&game=' . $row['tittleGame'] . '&TGnature=Original"><img src="/gitGaMa/images/' . $row['tittleGame'] . '.png" alt="' . $row['tittleGame'] . '"></a></li>';
                $i++;
            }

            echo '</ul>
            </div>
        </div>';

            $sqlGAMES = "SELECT tittleGame,minimumAge,maximumAge from games;";
            $result = mysqli_query($conn, $sqlGAMES);
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
            </div>
        </div>

</body>

</html>