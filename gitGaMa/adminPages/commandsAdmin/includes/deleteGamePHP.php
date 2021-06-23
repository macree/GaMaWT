<?php

if(isset($_POST['deleteGame-submit'])){
    require 'database.php';
    $nameGame= $_POST['deleteGameName'];

    $sql1= "SELECT idGame from games where tittleGame='$nameGame'";
    $exec1= mysqli_query($conn, $sql1);
    $row = $exec1->fetch_assoc();
    $idGame = $row['idGame'];

    $sql2 = "DELETE FROM userslikedgames WHERE idLikedGame=$idGame";
    $exec2 = mysqli_query($conn, $sql2);

    $sql3 = "DELETE FROM playersgame WHERE idGgame=$idGame";
    $exec3 = mysqli_query($conn, $sql3);

    $sql4 = "DELETE FROM games WHERE idGame='$idGame'";
    $exec4 = mysqli_query($conn, $sql4);
    
    header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=deleteGame&succes=gameDeleted");
    exit();
}

?>