<?php
$_SESSION['tablou'] = [];
session_start();
$_SESSION["contorGlobal"] = 0;

require 'database.php';

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $stmt = "DELETE FROM playersgame where id ='$id'";
    $resultGetID = mysqli_query($conn, $stmt);
}
if (isset($_POST['changeValue'])) {
    $value = $_POST["value"];
    $id = $_POST['id'];
    $stmt = "UPDATE playersgame SET points='$value' where id ='$id'";
    $resultGetID = mysqli_query($conn, $stmt);
}
if (isset($_POST['reset'])) {
    $nume = $_GET["game"];
    $stmt = "SELECT idGame FROM games where tittleGame = \"$nume\"";
    $answer = mysqli_query($conn, $stmt);
    $row = mysqli_fetch_array($answer);

    $stmt = "UPDATE users SET Twon=Twon+1 where usernameUsers= '" . $_SESSION['castigator'] . "'";
    $resultCastigatorID = mysqli_query($conn, $stmt);

    $stmt1 = "DELETE FROM playersgame where idGgame = " . $row['idGame'];
    $resultGetID = mysqli_query($conn, $stmt1);
}

//Verific daca jocul are turneu
$gameName = $_GET['game'];
$checkTourneyOKSQL = "SELECT tourney from games where tittleGame='$gameName'";
$resultTOK = mysqli_query($conn, $checkTourneyOKSQL);
$row = $resultTOK->fetch_assoc();
$tourneyOK = $row['tourney'];

?>

<!DOCTYPE html>

<html lang="en-US">

<head>
    <title>GaMa</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/gitGaMa/gamesCategory/gamesCSS/GoTCSS.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/gitGaMa/gamesCategory/gamesCSS/Bracket.css">
    <script>
        const queryString = window.location.search;

        const urlParams = new URLSearchParams(queryString);

        const page_type = urlParams.get('game')

        // Check and Wait until page is loaded
        document.addEventListener('DOMContentLoaded', function() {
            let inc = 0;
            // Get form
            var form = document.querySelector('#battle');
            // Add listener for form submit
            form.addEventListener('submit', function(submitEvent) {
                // Prevent form from being submitted
                submitEvent.preventDefault();
                // Open AJAX Connection
                var xhr = new XMLHttpRequest();

                inc++;
                // Setup our listener to process completed requests
                xhr.onload = function(response) {
                    console.log(xhr);

                    var notice = document.querySelector('#main');
                    notice.insertAdjacentHTML('beforeend', xhr.response);
                    var button = document.querySelector('#reset');
                    if (inc >= 3) {
                        button.innerHTML = `<form method=\'post\'>\n    <input hidden name=\'game\' value=\"${page_type} \">\n    <button type=\'submit\' name=\'reset\' id=\'resetButtonAdmin\'>Resetare</button>\n</form>`;
                    }
                };

                // Serialize all from data
                var formData = new URLSearchParams(new FormData(form)).toString();

                // Checkout the serialized form
                console.log(formData);


                // Trimit POST request
                xhr.open('POST', 'battleForm.php');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send(formData);
            });

        });
    </script>
</head>

<body>
    <!-- Bara de meniu, de aici incepe -->
    <div class="topbar">
        <div class="container">
            <div class="topleft">
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
                    <li><a class="userBtn"><i class="fas fa-user-circle"></i><?php echo $_SESSION['usernameUser']; ?></a>
                        <?php
                        if ($_SESSION['usernameUser'] == 'admin')
                            echo '<li><a href="/gitGaMa/adminPages/administrationPage.php" class="signBtn"><i class="fas fa-chess"></i> Administrate </a></li>';
                        else
                            echo '<li><a href="/gitGaMa/indexAfterLogin.php" class="signBtn"><i class="fas fa-home"></i> Home</a></li>';
                        ?>
                </ul>
            </div>
        </div>
    </div>

    <div id="content">
        <div class="gamePlayers1">
            <!--<main style="display: flex;flex-direction: row;" id="main">-->
            <ul id="imageUL">
                <li id="gameImageLI"><img src=<?php
                                                if ($_GET['TGnature'] == 'Custom')
                                                    echo '"/gitGaMa/images/customTourneyCup.png" alt="customTourneyCup"';
                                                else
                                                    echo '"/gitGaMa/images/' . $_GET['game'] . '.png" alt="' . $_GET['game'] . '"';
                                                ?>>
                    <?php
                    $username = $_SESSION['usernameUser'];
                    ?>
            </ul>
        </div>
        <div class="gamePlayers2">
            <ul id="detailsUL">
                <li><a style="font-size:25px; font-weight:600">Game:</a>
                    <?php
                    $gameSQL = "SELECT * FROM games where tittleGame='$gameName'";
                    $result = mysqli_query($conn, $gameSQL);
                    $row = $result->fetch_assoc();
                    $gameName = $row['tittleGame'];
                    echo '<a style="font-size:25px; font-weight:600; color:rgb(118,0,0);">' . $gameName . '</a>';
                    ?>
                </li>

                <!-- Tipul de joc -->
                <li><a style="font-size:25px; font-weight:600">Type of the game:</a>
                    <?php
                    $gameType = $row['typeGame'];

                    if ($gameType == 'Board')
                        echo '<a style="font-size:25px; font-weight:600; color:rgb(118,0,0);">' . $gameType . '</a>';
                    else echo '<a style="font-size:25px; font-weight:600; color:rgb(100, 115, 210);">' . $gameType . '</a>';
                    ?>
                </li>

                <!-- Pentru ce tip de varsta se incadreaza jocul -->
                <li><a style="font-size:25px; font-weight:600">Suited for:</a>
                    <?php
                    $minimumAge = $row['minimumAge'];
                    $maximumAge = $row['maximumAge'];
                    if ($minimumAge == 1 && $maximumAge = 99)
                        echo '<a style="font-size:25px; font-weight:600; color:rgb(0,118,0);"><i class="fas fa-baby"></i> <i class="fas fa-child"></i> <i class="fas fa-male"></i> <i class="fas fa-blind"></i></a>';
                    elseif ($minimumAge == 71 && $maximumAge = 99)
                        echo '<a style="font-size:25px; font-weight:600; color:rgb(0,118,0);"><i class="fas fa-blind"></i></a>';
                    elseif ($minimumAge == 1 && $maximumAge = 13)
                        echo '<a style="font-size:25px; font-weight:600; color:rgb(0,118,0);"><i class="fas fa-baby"></i></a>';
                    elseif ($minimumAge == 14 && $maximumAge = 70)
                        echo '<a style="font-size:25px; font-weight:600; color:rgb(0,118,0);"><i class="fas fa-child"></i> <i class="fas fa-male"></i> <i class="fas fa-blind"></i></a>';
                    ?>
                </li>

                <!-- Genul jocului -->
                <li><a style="font-size:25px; font-weight:600">Genre:</a>
                    <?php echo '<a style="font-size:25px; font-weight:600; color:rgb(173, 70, 71);">' . $row['genre'] . '</a>'; ?>
                </li>

                <!-- Dimensiuni -->
                <li><a style="font-size:25px; font-weight:600">Dimensions:</a>
                    <?php echo '<a style="font-size:25px; font-weight:600; color:rgb(46, 0, 0);">' . $row['dimensions'] . '</a>'; ?>
                </li>

                <!-- Restrictiile -->
                <li><a style="font-size:25px; font-weight:600">Requirements:</a>
                    <?php
                    $requieremnt1 = $row['restriction1'];
                    $requieremnt2 = $row['restriction2'];
                    echo '<a style="font-size:25px; font-weight:600; color:rgb(0,118,0);">' . $requieremnt1 . ' ' . $requieremnt2 . '</a>';
                    ?>
                </li>

                <!-- Daca are turneu sau nu -->
                <li><a style="font-size:25px; font-weight:600;">Tourney:</a>
                    <?php
                    $tOK = $row['tourney'];
                    if ($tOK == 1) {
                        $color = 'green';
                        $tOK = '<i class="fas fa-check-circle"></i>-8';
                    } else {
                        $color = 'red';
                        $tOK = '<i class="fas fa-times-circle"></i>';
                    }
                    echo '<a style="font-size:25px; font-weight:600; color:' . $color . ';">' . $tOK . '</a>';
                    ?>
                </li>

                <!-- Likes -->
                <li><a style="font-size:25px; font-weight:600; color:blue;"><i class="fas fa-thumbs-up"></i></a>
                    <?php
                    $likes = $row['likes'];
                    echo '<a style="font-size:25px; font-weight:600; color:rgb(0,118,0);">' . $likes . '</a>';
                    ?>
                </li>
                <?php
                $checkUserLikedGameSQL = "SELECT idUsers, tittleGame, idUser, idLikedGame from users join userslikedgames on idUsers=idUser join games on idLikedGame=idGame where idLikedGame is not null and usernameUsers='$username' and tittleGame='$gameName'";
                $result = mysqli_query($conn, $checkUserLikedGameSQL);
                $resultRowsNum = mysqli_num_rows($result);

                if ($username != 'admin') {
                    //echo '<div class="gamePlayers4">';
                    if ($resultRowsNum == 0) { //daca nu a dat like ii va parea butonul de LIKE
                        echo '<li><form action="./includes/likedGame.php" method="post" id="formLike">
                    <input type="hidden" name="game" value="' . $gameName . '"/>
                    <input type="hidden" name="user" value="' . $username . '"/>
                    <button type="submit" id="iLikeIt-submit" name="iLikeIt-submit">LIKE!</button>
                    </form></li>';
                    } else { //daca a da like sa poata da si dislike, in caz ca nu ii mai place
                        echo '<li><form action="./includes/dislikedGame.php" method="post" id="formDislike">
                    <input type="hidden" name="game" value="' . $gameName . '"/>
                    <input type="hidden" name="user" value="' . $username . '"/>
                    <button type="submit" id="iDislikeIt-submit" name="iDislikeIt-submit">DISLIKE!</button>
                    </form></li>';
                    }
                    //echo '</div';
                }
                ?>
                <li>
                    <?php
                    echo '<form action="./includes/exportCSVphp.php" method="post" id="formExport">
                <input type="hidden" name="game" value="' . $gameName . '"/>
                <input type="hidden" name="user" value="' . $username . '"/>
                <button type="submit" name="exportCSV-execute" id="exportButtonGT">Export CSV</button>
                </form>';
                    ?>
                </li>
            </ul>
        </div>
        <div class="gamePlayers3">
            <ul id="descriptionUL">
                <li><a style="font-size:25px; font-weight:600">Description:</a>
                    <div class="scroll-box" id="descriptionBOX">
                        <?php
                        $description = $row['description'];
                        echo '<p style="color:grey; font-size: 20px; font-weight:600">' . $description . '</p>';
                        ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div id="content2">
        <div class="gamePlayers">
            <ul id="bracketUL">
                <?php
                if ($tourneyOK == 1)
                    echo '<li><a style="font-size:25px; font-weight:600">Players that are in the tournament:</a></li>';
                ?>
                <!--<ol>-->
                <!--<div>-->
                <main style="display: flex;flex-direction: row;" id="main">
                    <ul class="round" id="round1">
                        <li class="spacer">&nbsp;</li>

                        <?php
                        if (isset($_SESSION['usernameUser'])) { //daca sunt logat
                            if ($_SESSION['usernameUser'] == 'admin')
                                $adminLogged = true;
                            else $adminLogged = false;
                            //Iau toti jucatorii ce sunt inscrisi la joc

                            if ($tourneyOK == 1) {
                                $checkExistance = null;
                                $array = [];
                                $usernameAndPointsSQL = "select p.id, u.usernameUsers, p.points from users u join playersgame p on u.idUsers=p.idGuser join games g on p.idGgame=g.idGame where g.tittleGame='$gameName';";

                                $result = mysqli_query($conn, $usernameAndPointsSQL);
                                $resultRowsNum = mysqli_num_rows($result);

                                if ($resultRowsNum > 0) {
                                    $increment = 0;
                                    while ($row = $result->fetch_assoc()) {
                                        $username = $row['usernameUsers']; //memorez numele
                                        $points = $row['points'];          // memorez punctele
                                        $idPG = $row['id'];                //memorez id-ul

                                        if (strcmp($_SESSION['usernameUser'], $username) == 0) {
                                            $checkExistance = 1;
                                            if ($increment % 2 == 0) {
                                                echo <<<TAG
                                                    <li class="game game-top" style="color:red">
                                                        <form method="post">
                                                TAG;
                                                if ($adminLogged)
                                                    echo '<input type="submit" name="changeValue" value="✓">';
                                                echo <<<TAG
                                                        <input hidden name='id' value="{$idPG}"> 
                                                        <input style="width: 22px" name="value" value="{$points}">
                                                        </form>
                                                        <form method="post">
                                                        {$username}
                                                        <input hidden name='id' value="{$idPG}">
                                                        TAG;
                                                if ($adminLogged)
                                                    echo '<input type="submit" name="delete" value="X">';
                                                echo '</form>
                                                    </li>';
                                                //TAG;
                                            }
                                            if ($increment % 2 == 1) {
                                                echo <<<TAG
                                                    <li class="game game-spacer">&nbsp;</li>
                                                    <li class="game game-bottom" style="color:red">
                                                        <form method="post">
                                                    TAG;
                                                if ($adminLogged)
                                                    echo '<input type="submit" name="changeValue" value="✓">';
                                                echo <<<TAG
                                                        <input hidden name='id' value="{$idPG}"> 
                                                        <input style="width: 22px" name="value" value="{$points}">
                                                        </form>
                                                        <form method="post">
                                                        {$username}
                                                        <input hidden name='id' value="{$idPG}">
                                                        TAG;
                                                if ($adminLogged)
                                                    echo '<input type="submit" name="delete" value="X">';
                                                echo '</form>
                                                    </li>
                                                    <li class="spacer">&nbsp;</li>';
                                                //TAG;
                                            }
                                            $array[$increment][$username] = $points;
                                            $increment++;
                                            continue;
                                        }
                                        if ($increment % 2 == 0) {
                                            echo <<<TAG
                                                <li class="game game-top" >
                                                    <form method="post">
                                                TAG;
                                            if ($adminLogged)
                                                echo '<input type="submit" name="changeValue" value="✓">';
                                            echo <<<TAG
                                                        <input hidden name='id' value="{$idPG}"> 
                                                        <input style="width: 22px" name="value" value="{$points}">
                                                        </form>
                                                        <form method="post">
                                                        {$username}
                                                        <input hidden name='id' value="{$idPG}">
                                                    TAG;
                                            if ($adminLogged)
                                                echo '<input type="submit" name="delete" value="X">';
                                            echo '</form>
                                                </li>';
                                            //TAG;
                                        } else if ($increment % 2 == 1) {
                                            echo <<<TAG
                                                <li class="game game-spacer">&nbsp;</li>
                                                <li class="game game-bottom">
                                                <form method="post">
                                                TAG;
                                            if ($adminLogged)
                                                echo '<input type="submit" name="changeValue" value="✓">';
                                            echo <<<TAG
                                                    <input style="width: 22px" name="value" value="{$points}">
                                                    <input hidden name='id' value="{$idPG}"> 
                                                    </form>
                                                    <form method="post">
                                                    {$username}
                                                    <input hidden name='id' value="{$idPG}">
                                                    TAG;
                                            if ($adminLogged)
                                                echo '<input type="submit" name="delete" value="X">';
                                            echo '</form>   
                                                </li>
                                                <li class="spacer">&nbsp;</li>';
                                            //TAG;
                                        }
                                        $array[$increment][$username] = $points;
                                        $increment++;
                                    }
                                    $arrayString = serialize($array);
                                } else echo '<li style=" color:red; font-size:22px; font-weight:600;" id="thereAreNoPlayersLI">There are no players!</li>';
                            } //IF DE LA tourneyOK
                        } else {
                            header("Location: /gitGaMa/index.php?error=notLogged");
                            exit();
                        }


                        echo '</ul></main></ul>
                        </div>
                        <div id="gamePlayersTforms">
                        <ul id="formTurneyButtons">'; // </ul></main></ul><ul>

                        $username = $_SESSION['usernameUser'];

                        if ($tourneyOK == 1) {
                            if ($checkExistance == 1)
                                echo '<li style=" color:red; font-size:22px; font-weight:600">You are in!</li>';
                            $count = count($array);
                            if ($count == 8 && $count < 9) {
                                if ($_SESSION['usernameUser'] == "admin") {
                                    echo <<<TAG
                                    <div id="reset"></div>
                                    <form method="post" id="battle">
                                        <input hidden value='{$arrayString}' name = 'Salut' >
                                        <button type="submit" name="battle-submit" id="battleButtonAdmin">Battle</button>
                                    </form>
                                    TAG;
                                }
                            } else {
                                echo <<<Tag
                                    <h1 style="color: red; font-size: 2em; padding-top: 10px; font-weight:600">There are not enough Players</h1>
                                    Tag;
                            }
                        }
                        if ($tourneyOK == 1)
                            if ($checkExistance !== 1 && ($count < 8)) {
                                echo '
                        <div style=" color:blue; font-size:2em; font-weight:600 ;padding-top: 10px;" >You are not joined! </div>
                        <form action="joinTournamentPHP.php" method="post">
                        <input type="hidden" name="user" value="' . $username . '"/>
                        <input type="hidden" name="game" value="' . $gameName . '"/>
                        <button type="submit" name="joinTournament-submit" id="joinTournament-submit">Join tournament</button>
                        </form>';
                            }
                        //echo '</nav></ul></li>';
                        ?>
                    </ul>
        </div> <!-- gamePlayersTforms -->
    </div> <!-- /content2 -->
</body>

</html>