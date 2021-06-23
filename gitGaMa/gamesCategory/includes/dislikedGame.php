<?php
if (isset($_POST['iDislikeIt-submit'])){
    require 'database.php';

    $username = $_POST['user'];
    $gameName = $_POST['game'];


    $getIDuser = "SELECT idUsers FROM users WHERE usernameUsers='$username';";
    $resultGetID = mysqli_query($conn,$getIDuser);
        while($row = $resultGetID->fetch_assoc())
            $ID = $row['idUsers'];

    $getIDgame = "SELECT idGame,TGnature FROM games WHERE tittleGame='$gameName';";
    $resultGetIDgame = mysqli_query($conn,$getIDgame);
        while($row = $resultGetIDgame->fetch_assoc()){
            $IDgame=$row['idGame'];
            $TGnature=$row['TGnature'];
        }

    $sql = "DELETE FROM userslikedgames WHERE idUser='$ID' and idLikedGame='$IDgame';";
    $result = mysqli_query($conn,$sql);

    $sqlUpdateLikes = "UPDATE games SET likes = likes -1 where idGame='$IDgame';";
    $result = mysqli_query($conn,$sqlUpdateLikes);


    header("Location: /gitGaMa/gamesCategory/gameTourney.php?username=".$username."&game=".$gameName."&TGnature=".$TGnature."&dislike=succes");
    exit();
}
?>
