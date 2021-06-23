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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/gitGaMa/adminPages/CSS/adminCSS.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<!-- Bara de meniu, de aici incepe -->
<div class="topbar">
    <div class="container">

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
                <li><a class="userBtn"><i class="fas fa-user-circle"></i><?php echo $_SESSION['usernameUser']; ?>
                <li><a href="/gitGaMa/adminPages/statistics.php" class="signBtn"><i class="far fa-chart-bar"></i> Statistics</a></li>
                <li><a href="/gitGaMa/adminPages/mainPage.php" class="signBtn"><i class="fas fa-home"></i> Home</a></li>
            </ul>
        </div>
    </div>
</div>

<!-- AICI SE AFISEAZA TOTI JUCATORII CARE SUNT INTR-UN TURNEU, RESPECTIV SI LA CE JOC -->
<div id="Content">
    <div class="gamePlayers">
        <ul>
            <li><a id="font1">IDu.USER-AGE-<i class="fas fa-trophy" style="color: orange"></i></a>
                <nav>
                    <ol>
                        <?php

                        if (isset($_SESSION['usernameUser'])) { //daca sunt logat

                            if ($_SESSION['usernameUser'] !== 'admin') //daca nu sunt admin sa ma dea pe pagina de users
                            {
                                header("Location: /gitGaMa/indexAfterLogin.php?login=SUCCES");
                                exit();
                            }

                            //Iau toti jucatorii

                            $allUsersSQL = "select * from users;";
                            // ANULAT$allUsersSQL="select u.usernameUsers, u.gender, p.points, g.tittleGame from users u join playersgame p on u.idUsers=p.idGuser join games g on p.idGgame=g.idGame order by p.points DESC;";

                            $result = mysqli_query($conn, $allUsersSQL);

                            while ($row = $result->fetch_assoc()) {
                                if ($row['gender'] == 'Male')
                                {
                                    $genderColor = 'lightskyblue';
                                    $gender='M';
                                }
                                else 
                                {
                                    $genderColor = 'red';
                                    $gender='F';
                                }
                                echo '<li><a style="color:' . $genderColor . '; font-size: 21px; font-weight:600">'.$row['idUsers'].'.'. $row['usernameUsers'] .'-'.$row['age'].'-'.$gender.'</a> 
                    <a style="color:grey; font-size: 21px; font-weight:600"> - </a> 
                    <a style="color:orange; font-size: 21px; font-weight:600">' . $row['Twon'] . '</a>';
                            }
                        }
                        ?>
                    </ol>
                </nav>
        </ul>
    </div>
    <!-- AICI AFISEZ TOTI UTILIZATORII INREGISTRATI -->
    <div class="allUsers">
        <ul>
            <li><a id="font2">IDg-IDu-pts</a>
                <nav id="navPlayersGame">
                    <ol>
                        <?php
                        if (isset($_SESSION['usernameUser']) && $_SESSION['usernameUser'] == "admin") {

                            //Iau  toate informatiile din tabela cu jocurile ce au turneu si ce au jucatori 

                            $allUsersSQL = "select * from playersgame;";

                            $result = mysqli_query($conn, $allUsersSQL);

                            while ($row = $result->fetch_assoc())
                            {
                                    echo '<li><a style="color:grey; font-size: 21px; font-weight:600">'.$row['idGgame'] .'-'. $row['idGuser'] .'-'. $row['points'].'</a></li>';
                            }
                        }
                        ?>
                    </ol>
                </nav>
        </ul>
    </div>

    <div class="allGames">
        <!-- all games -->
        <ul>
            <li><a id="font3">IDg.TITTLEg-AGE-TYPE-GENRE-SIZE-REQ-<i class="fas fa-thumbs-up"></i>-T</a>
                <nav id="navGameTable">
                    <ol>
                        <?php
                        if (isset($_SESSION['usernameUser']) && $_SESSION['usernameUser'] == "admin") {

                            //Iau toti jucatorii

                            $allGamesSQL = "select * from games;";

                            $result = mysqli_query($conn, $allGamesSQL);

                            while ($row = $result->fetch_assoc()) {
                                if ($row['tourney'] == 1)
                                {
                                    $tourneyOK = 'YES';
                                    $gameColor = 'rgb(227, 188, 34)';
                                }
                                else 
                                {
                                    $tourneyOK = 'NO';
                                    $gameColor = 'rgb(59, 92, 120)';
                                }
                                echo '<li><a style="color:' . $gameColor . '; font-size: 21px; font-weight:600">' . $row['idGame'] . '.' . $row['tittleGame'] . '-' . $row['minimumAge'] . '|' . $row['maximumAge'] . '-'
                                    . $row['typeGame'] . '-' . $row['genre'] . '-' . $row['dimensions'] . '-' . $row['restriction1'] . '-' . $row['likes'] . '-' . $tourneyOK . '</a></li>';
                            }
                        }
                        ?>
                    </ol>
                </nav>
        </ul>
    </div>
</div> <!-- content -->
<div class="buttonsDiv">
    <ul>
        <li><a href="/gitGaMa/adminPages/commandsAdmin/allCommands.php?command=movePlayer"><button type="button">MOVE PLAYER</button></a></li>
        <li><a href="/gitGaMa/adminPages/commandsAdmin/allCommands.php?command=removePlayer"><button type="button">DELETE USER</button></a></li>
        <!-- ANULAT <li><a href="/gitGaMa/adminPages/commandsAdmin/allCommands.php?command=changePoints"><button type="button">Change points</button></a></li> -->
        <li><a href="/gitGaMa/adminPages/commandsAdmin/allCommands.php?command=createTournament_Game"><button type="button">ADD GAME</button></a></li>
        <li><a href="/gitGaMa/adminPages/commandsAdmin/allCommands.php?command=deleteGame"><button type="button">DELETE GAME</button></a></li>
        <li><a href="/gitGaMa/adminPages/commandsAdmin/allCommands.php?command=modifyGame"><button type="button">MODIFY GAME</button></a></li>
    </ul>
</div>

</html>