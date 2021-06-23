<?php
session_start();
require 'database.php';
require './commandsAdmin/includes/statisticsPHP.php';
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
    <link rel="stylesheet" type="text/css" href="/gitGaMa/adminPages/CSS/statisticsCSS.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body>
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
                    <li><a href="/gitGaMa/adminPages/administrationPage.php" class="signBtn"><i class="fas fa-gavel"></i> Administrate</a></li>
                    <li><a href="/gitGaMa/adminPages/mainPage.php" class="signBtn"><i class="fas fa-home"></i> Home</a></li>
                </ul>
            </div>
        </div>
    </div>

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
                    echo round($percentOfMales, 2) . '% (' . $numberOfMales . ')';
                    ?>
                </a></li>

            <li><a id="statisticsDefaultAtribute">The % of users that are </a><a style="color: red; font-size:40px; font-weight:600">female
                    <?php
                    echo round($percentOfFemales, 2) . '% (' . $numberOfFemales . ')';
                    ?>
                </a></li>

            <!-- Procentaje categorii varsta -->
            <li><a id="statisticsDefaultAtribute">The % of users that have 1-13 years</a>
                <a style="font-size:40px; font-weight:600; color:burlywood">
                    <?php
                    echo round($percentOf1_13, 2) . '% (' . $numberOfAge1_13 . ')'; // arata doar 2 zecimale dupa virgula
                    ?>
                </a>
            </li>

            <li><a id="statisticsDefaultAtribute">The % of users that have 14-70 years</a>
                <a style="font-size:40px; font-weight:600; color:burlywood">
                    <?php
                    echo round($percentOf14_70, 2) . '% (' . $numberOfAge14_70 . ')'; // arata doar 2 zecimale dupa virgula
                    ?>
                </a>
            </li>

            <li><a id="statisticsDefaultAtribute">The % of users that have 71-99 years</a>
                <a style="font-size:40px; font-weight:600; color:burlywood">
                    <?php
                    echo round($percentOf71_99, 2) . '% (' . $numberOfAge71_99 . ')'; // arata doar 2 zecimale dupa virgula
                    ?>
                </a>
            </li>
        </ul>

    </div>

    <div class="gamesStatistics">
        <ul>
            <li><a id="statisticsDefaultAtribute">The total number of games:</a>
                <a style="font-size:40px; font-weight:600; color:purple">
                    <?php
                    echo $numberTotalGames;
                    ?>
                </a>
            </li>

            <li><a id="statisticsDefaultAtribute">The % of <a id="digitalGameAtribute">digital</a> <a id="statisticsDefaultAtribute"> games</a>
                    <a style="font-size:40px; font-weight:600; color:rgb(59, 92, 120)">
                        <?php
                        echo round($precentOfDigitalGames, 2) . '% (' . $numberDigitalGames . ')'; // arata doar 2 zecimale dupa virgula
                        ?>
                    </a></li>

            <li><a id="statisticsDefaultAtribute">The % of <a id="boardGameAtribute">board</a> <a id="statisticsDefaultAtribute">games</a>
                    <a style="font-size:40px; font-weight:600; color:rgb(100, 155, 137)">
                        <?php
                        echo round($percentOfBoardGames, 2) . '% (' . $numberBoardGames . ')'; // arata doar 2 zecimale dupa virgula
                        ?>
                    </a></li>
        </ul>

    </div>

    <div class="buttonsDiv">
        <form action="./commandsAdmin/includes/exportPDF_PHP.php" method="post">
            <button type="submit" name="pdfExport-submit">PDF</button>
        </form>
        <form action="./commandsAdmin/includes/exportXML_PHP.php" method="post">
            <button type="submit" name="xmlExport-submit">XML</button>
        </form>
    </div>

</html>