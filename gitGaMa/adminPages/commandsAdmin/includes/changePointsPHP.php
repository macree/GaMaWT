<?php

if(isset($_POST['changePoints-submit'])){
    require 'database.php';

    $pName = $_POST['playerName'];
    $fromGame = $_POST['fromGame'];
    $newPoints = $_POST['newPoints'];

    //aflu IDul  jocului initial in functie de nume
    //am folosit prepared statements ca sa evit SQL injection
    $stmt = mysqli_prepare($conn,"SELECT idGame FROM games WHERE tittleGame=?");
    
    //aici punem valoarea din fromGame in locul "?"
    mysqli_stmt_bind_param($stmt, "s",$fromGame);

    //execut query-ul in baza de date
    mysqli_stmt_execute($stmt);

    //atribui valorile din baza de date variabilei idFromGame
    mysqli_stmt_bind_result($stmt,$idFromGame);
    mysqli_stmt_fetch($stmt);

    mysqli_stmt_close($stmt);


    //iau IDul playerului
    $stmt = mysqli_prepare($conn,"SELECT idUsers FROM users WHERE usernameUsers=?");

    mysqli_stmt_bind_param($stmt, "s",$pName);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt,$idPlayer);
    mysqli_stmt_fetch($stmt);

    mysqli_stmt_close($stmt);

    //verific daca playerul are puncte la acel joc

    $OK=0;
    $sql = "SELECT idGuser FROM playersgame WHERE idGgame = $idFromGame";
    $result = mysqli_query($conn,$sql);
        while($row =mysqli_fetch_array($result)){
            if($row['idGuser']==$idPlayer){
                $OK=1; // playerul participa la turneu, deci este eligibil pentru schimbarea punctelor
            }
        }
    
    
    //daca are puncte, atunci putem schimba valoarea punctelor
    if($OK==1){
        $stmt = mysqli_prepare($conn,"UPDATE playersgame SET points =? WHERE idGuser=? AND idGgame=?");

        mysqli_stmt_bind_param($stmt,"iii",$newPoints,$idPlayer,$idFromGame);

        mysqli_stmt_execute($stmt);

        header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=changePoints&succes=pointsChanged");
        exit();

        mysqli_stmt_close($stmt);
    }
    else{
        header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=changePoints&error=playerIsNotInThatTourney");
        exit();
    }
}

?>