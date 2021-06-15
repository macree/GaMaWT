<?php
    if(isset($_POST['removePlayer-submit'])){
        require 'database.php';

        $pName = $_POST['playerName'];
        $fromGame = $_POST['fromGame'];

        //iau IDul playerului
        $stmt = mysqli_prepare($conn,"SELECT idUsers FROM users WHERE usernameUsers=?");
   
        mysqli_stmt_bind_param($stmt, "s",$pName);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt,$idPlayer);
        mysqli_stmt_fetch($stmt);

        mysqli_stmt_close($stmt);


        //IDul jocului de la care vrem sa-l eliminam
        $stmt = mysqli_prepare($conn,"SELECT idGame FROM games WHERE tittleGame=?");
   
        mysqli_stmt_bind_param($stmt, "s",$fromGame);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_bind_result($stmt,$idFromGame);
        mysqli_stmt_fetch($stmt);

        mysqli_stmt_close($stmt);

        //verificam daca jucatorul este inscris la jocul din caare vrem sa-l scoaatem
        $OK=0;
        $sql = "SELECT idGuser FROM playersgame WHERE idGgame = $idFromGame";
        $result = mysqli_query($conn,$sql);
            while($row = mysqli_fetch_array($result)){
                if($row['idGuser']==$idPlayer){
                    $OK=1; // playerul este inscris la acel turneu
                }
            }
        
        //stergem playerul de la jocul respectiv
        if($OK==1){
        $stmt = mysqli_prepare($conn,"DELETE FROM playersgame WHERE idGuser=? AND idGgame=?");

        mysqli_stmt_bind_param($stmt, "ii", $idPlayer,$idFromGame);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=removePlayer&succes=playerRemoved");
        exit();
        }
        else{
            header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=removePlayer&error=playerIsNotInThatTourney");
            exit();
        }
    }
?>