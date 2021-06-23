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
                    if (isset($_SESSION['usernameUser'])) {
                        $name = $_SESSION['usernameUser'];
                        echo '<li><a class="userBtn"><i class="fas fa-user-circle"></i>' . $name;

                        $sql = "SELECT age FROM users where usernameUsers='$name';";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($result);
                        if ($row['age'] >= 5 && $row['age'] < 14)
                            echo ' <i class="fas fa-baby"></i></a></li>';
                        else if ($row['age'] >= 14 && $row['age'] <= 29)
                            echo ' <i class="fas fa-child"></i></a></li>';
                        else if ($row['age'] >= 30 && $row['age'] <= 69)
                            echo ' <i class="fas fa-male"></i></a></li>';
                        else echo ' <i class="fas fa-blind"></i>';


                        if ($name == 'admin')
                            echo '<li><a href="/gitGaMa/adminPages/administrationPage.php" class="myTournamentsBtn"><i class="fas fa-gavel"></i> Administrate </a></li>';
                        else echo '<li><a href="/gitGaMa/myTournaments/myTournaments.php" class="myTournamentsBtn"><i class="fas fa-chess"></i>My Games</a></li>';


                        echo '<li><a href="/gitGaMa/indexAfterLogin.php" class="signBtn"><i class="fas fa-home"></i> Home</a></li>
                            <li><form action="/gitGaMa/loginSIregister/includes/logoutPHP.php" method="post">
                            <button type="submit" name="logout-submit" class="buttonLogout"><i class="fas fa-sign-out-alt"></i>Logout</button>
                            </form></li>';
                        // ANULATA <li><a href="/gitGaMa/myTournaments/customTournaments.php" class="myTournamentsBtn"><i class="fas fa-cogs"></i>Custom Tourneys</a></li>
                    } else {
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

    if (isset($_SESSION['usernameUser'])) {
        $name = $_SESSION['usernameUser'];

        $sql = "SELECT age FROM users where usernameUsers='$name';"; // Luam varsta userului
        $result = mysqli_query($conn, $sql);
    ?>
        <div class="honorableMentions">
            <div class="container">
                <h3><a href="/gitGaMa/gamesCategory/digitalGames.php">DIGITAL GAMES</a></h3>
                <h3><a href="/gitGaMa/gamesCategory/digitalGames.php?genre=Strategy">STRATEGY</a>-<a href="/gitGaMa/gamesCategory/digitalGames.php?genre=Strategy&tourney=yes"><i class="fas fa-trophy" style="color: orange"></i></a> 
                <a href="/gitGaMa/gamesCategory/digitalGames.php?genre=Puzzler">PUZZLER</a>-<a href="/gitGaMa/gamesCategory/digitalGames.php?genre=Puzzler&tourney=yes"><i class="fas fa-trophy" style="color: orange"></i></a>
                <a href="/gitGaMa/gamesCategory/digitalGames.php?genre=Simulation">SIMULATION</a>-<a href="/gitGaMa/gamesCategory/digitalGames.php?genre=Simulation&tourney=yes"><i class="fas fa-trophy" style="color: orange"></i></a></h3>
                <ul>
                <?php
                //partea de filtru
                if (isset($_GET['genre'])) {
                    if(isset($_GET['tourney']))
                            $hasTourney=1;//are turneu
                            else $hasTourney=0;
                    if ($_GET['genre'] == 'Strategy')
                    {
                        $genre = 'Strategy';
                    }
                    else if ($_GET['genre'] == 'Puzzler')
                    {
                        $genre = 'Puzzler';
                    }
                    else if ($_GET['genre'] == 'Simulation')
                    {
                        $genre = 'Simulation';
                    }
                    $row = mysqli_fetch_array($result);
                    //$sqlTopGamesDesc = "SELECT g.tittleGame titGame FROM games g JOIN playersgame p ON g.idGame=p.idGgame WHERE minimumAge<=$row[0] AND maximumAge>=$row[0] GROUP BY p.idGgame ORDER BY count(p.idGgame) DESC";

                    if ($name == 'admin')
                    {
                        if($hasTourney==1)
                            $sqlTopGamesDesc = "SELECT * FROM games WHERE typegame='Digital' and genre ='$genre' and tourney is true ORDER BY likes DESC";
                        else
                        $sqlTopGamesDesc = "SELECT * FROM games WHERE typegame='Digital' and genre ='$genre' ORDER BY likes DESC";   
                    }
                        //Daca e user obisnuit i le afiseaza doar pe cele la care se incadreaza cu varsta
                    else 
                    {   if($hasTourney==1)
                            $sqlTopGamesDesc = "SELECT * FROM games WHERE minimumAge<=$row[0] AND maximumAge>=$row[0] AND typegame='Digital' and genre ='$genre' and tourney is true ORDER BY likes DESC";
                        else
                        $sqlTopGamesDesc = "SELECT * FROM games WHERE minimumAge<=$row[0] AND maximumAge>=$row[0] AND typegame='Digital' and genre ='$genre' ORDER BY likes DESC";
                    }
                    
                    $result2 = mysqli_query($conn, $sqlTopGamesDesc);

                    while (($row = $result2->fetch_assoc())) {
                        if ($row['TGnature'] == 'Custom')
                            echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username=' . $_SESSION['usernameUser'] . '&game=' . $row['tittleGame'] . '&TGnature=Custom"><img src="/gitGaMa/images/customTourneyCup.png" alt="customTourneyCup"></a></li>';
                        else
                            echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username=' . $_SESSION['usernameUser'] . '&game=' . $row['tittleGame'] . '&TGnature=Original"><img src="/gitGaMa/images/' . $row['tittleGame'] . '.png" alt="' . $row['tittleGame'] . '"></a></li>';
                    }
                    echo '</ul></div></div>';
                } else {
                    /* Luam toate cele mai populare jocuri la care utilizatorul se incadreaza ca varsta */

                    $row = mysqli_fetch_array($result);
                    //$sqlTopGamesDesc = "SELECT g.tittleGame titGame FROM games g JOIN playersgame p ON g.idGame=p.idGgame WHERE minimumAge<=$row[0] AND maximumAge>=$row[0] GROUP BY p.idGgame ORDER BY count(p.idGgame) DESC";

                    if ($name == 'admin')
                        $sqlTopGamesDesc = "SELECT * FROM games WHERE typegame='Digital' ORDER BY likes DESC";
                    //Daca e user obisnuit i le afiseaza doar pe cele la care se incadreaza cu varsta
                    else $sqlTopGamesDesc = "SELECT * FROM games WHERE minimumAge<=$row[0] AND maximumAge>=$row[0] AND typegame='Digital' ORDER BY likes DESC";
                    $result2 = mysqli_query($conn, $sqlTopGamesDesc);

                    while (($row = $result2->fetch_assoc())) {
                        if ($row['TGnature'] == 'Custom')
                            echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username=' . $_SESSION['usernameUser'] . '&game=' . $row['tittleGame'] . '&TGnature=Custom"><img src="/gitGaMa/images/customTourneyCup.png" alt="customTourneyCup"></a></li>';
                        else
                            echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username=' . $_SESSION['usernameUser'] . '&game=' . $row['tittleGame'] . '&TGnature=Original"><img src="/gitGaMa/images/' . $row['tittleGame'] . '.png" alt="' . $row['tittleGame'] . '"></a></li>';
                    }
                }
                echo '</ul></div></div>';
            }
                ?>

</body>

</html>