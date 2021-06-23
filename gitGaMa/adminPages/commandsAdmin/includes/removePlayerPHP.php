<?php
    if(isset($_POST['removePlayer-submit'])){
        require 'database.php';

        $uName = $_POST['removeUser'];
        //$fromGame = $_POST['fromGame'];

        //iau IDul playerului
        $getIDSQL="SELECT idUsers FROM users WHERE usernameUsers='$uName'";
        $result = mysqli_query($conn,$getIDSQL);
        $row = $result->fetch_assoc();
        $idPlayer=$row['idUsers'];

        //stergem playerul si datele aferente
        $deleteSQL="DELETE FROM userslikedgames WHERE idUser='$idPlayer'";
        $result = mysqli_query($conn,$deleteSQL);

        $deleteSQL="DELETE FROM playersgame WHERE idGuser='$idPlayer'";
        $result = mysqli_query($conn,$deleteSQL);

        $deleteSQL="DELETE FROM users WHERE idUsers='$idPlayer'";
        $result = mysqli_query($conn,$deleteSQL);

        header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=removePlayer&succes=playerRemoved");
        exit();
    }
?>