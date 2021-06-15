<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

    if (isset($_POST['joinTournament-submit'])){
        require 'database.php';

        // valorile le iau cu ajutorul formului, de acolo vine 'user' si 'game'
        $username = $_POST['user'];
        $gameName = $_POST['game'];
        $points = 1;

        function testRand(){ //aici generez un punctaj random
            return random_int(1,255);
        }
        
        $points=testRand();

        $getID = "SELECT idUsers FROM users WHERE usernameUsers='$username';";
        $resultGetID = mysqli_query($conn,$getID);

        while($row = $resultGetID->fetch_assoc()){
            $IDuser = $row['idUsers'];
        }

        $getGameID = "SELECT idGame FROM games WHERE tittleGame='$gameName';";
        $resultGetGameID = mysqli_query($conn,$getGameID);
    
        while($row = $resultGetGameID->fetch_assoc()){
            $IDgame = $row['idGame'];
        }

        $insertSQL = "INSERT INTO playersgame (idGuser, idGgame, points) VALUES ($IDuser,$IDgame,$points);";
        $sql = mysqli_query($conn,$insertSQL);
        
        header("Location: /gitGaMa/gamesCategory/gameTourney.php?succes=joined&username=$username&game=$gameName");
        exit();
    }
?>