<?php

if (isset($_POST['move-submit'])) {
    require 'database.php';

    $pName = $_POST['playerName'];
    $fromGame = $_POST['fromGame'];
    $toGame = $_POST['toGame'];

    //Verific daca userul scris exista in baza de date
    $sql = "SELECT idUsers FROM users WHERE usernameUsers ='$pName'";
    $OK = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($OK);

    mysqli_stmt_store_result($OK);

    $resultOKCheck = mysqli_stmt_num_rows($OK);
    if ($resultOKCheck > 0) {

        //aflu IDul  jocului initial in functie de nume
        //am folosit prepared statements ca sa evit SQL injection
        $stmt = mysqli_prepare($conn, "SELECT idGame FROM games WHERE tittleGame=?");

        //aici punem valoarea din fromGame in locul "?"
        mysqli_stmt_bind_param($stmt, "s", $fromGame);

        //execut query-ul in baza de date
        mysqli_stmt_execute($stmt);

        //atribui valorile din baza de date variabilei idFromGame
        mysqli_stmt_bind_result($stmt, $idFromGame);
        mysqli_stmt_fetch($stmt);

        mysqli_stmt_close($stmt);


        //IDul celui de-al doilea joc
        $stmt = mysqli_prepare($conn, "SELECT idGame FROM games WHERE tittleGame=?");

        mysqli_stmt_bind_param($stmt, "s", $toGame);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $idToGame);
        mysqli_stmt_fetch($stmt);

        mysqli_stmt_close($stmt);


        //iau IDul playerului
        $stmt = mysqli_prepare($conn, "SELECT idUsers FROM users WHERE usernameUsers=?");

        mysqli_stmt_bind_param($stmt, "s", $pName);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $idPlayer);
        mysqli_stmt_fetch($stmt);

        mysqli_stmt_close($stmt);

        //Iau punctajul de la turneul initial
        $stmt = mysqli_prepare($conn, "SELECT points FROM playersgame WHERE idGuser=?");

        mysqli_stmt_bind_param($stmt, "i", $idPlayer);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt, $oldTourneyPoints);
        mysqli_stmt_fetch($stmt);

        mysqli_stmt_close($stmt);


        //verificam daca jucatorul este inscris la jocul curent ("fromGame")

        $sql = "SELECT idGuser FROM playersgame WHERE idGgame = $idFromGame AND idGuser=$idPlayer";
        $result = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($result);

        mysqli_stmt_store_result($result);

        $resultCheck = mysqli_stmt_num_rows($result);

        if ($resultCheck > 0) { //daca este inscris, urmeaza sa verificam daca nu cumva este deja inscris si la jocu' la care vrem sa-l mutam

            $sql = "SELECT idGuser FROM playersgame WHERE idGgame = $idToGame AND idGuser=$idPlayer";
            $result2 = mysqli_prepare($conn, $sql);
            mysqli_stmt_execute($result2);

            mysqli_stmt_store_result($result2);

            $resultCheck2 = mysqli_stmt_num_rows($result2);

            if ($resultCheck2 > 0) {

                //playerul are deja punctaj la turenul unde vrem sa-l mutam
                header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=movePlayer&error=playerAlreadyInThatTourney");
                exit();
            } else { //va intra pe aceasta ramura doar daca nu exista deja la turneul unde vrem sa-l mutam

                $sql = "select count(idGgame) count from playersgame where idGgame=$idToGame;";
                $result3 = mysqli_query($conn, $sql);
                $row = $result3->fetch_assoc();
                $countPlayersT = $row['count'];

                //Daca numarul jucatorilor din turneu este mai mic ca 8, atunci poate intra
                if ($countPlayersT < 8) {

                    ///// Ii fac insert la turneul jocului nou

                    $sql = "INSERT INTO playersgame (idGuser,idGgame,points) VALUES ($idPlayer, $idToGame, $oldTourneyPoints)";
                    $result4 = mysqli_prepare($conn, $sql);
                    mysqli_stmt_execute($result4);

                    $sql = "DELETE FROM playersgame where idGuser=$idPlayer AND idGgame=$idFromGame";
                    $result5 = mysqli_prepare($conn, $sql);
                    mysqli_stmt_execute($result5);

                    header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=movePlayer&succes=playerMoved");
                    exit();
                } else {
                    //playerul nu poate fi mutat pentru ca turneul este full
                    header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=movePlayer&error=tourneyFull");
                    exit();
                }
            }
        } else { //va intra pe aceasta ramura doar daca se va incerca "mutarea" dintr-un joc la care playerul nu este inscris
            header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=movePlayer&error=playerDoesNotExistsInThatTourney");
            exit();
        }
    } else {
        // Userul nu exista in baza de date
        header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=movePlayer&error=playerDoesNotExistsInDB");
        exit();
    }
}
