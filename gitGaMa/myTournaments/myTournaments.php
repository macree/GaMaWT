<?php
session_start();
require 'database.php';
?>

<!DOCTYPE html>

<html lang="en-US">

<head>
    <title>GaMa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/gitGaMa/myTournaments/myTournaments.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

 <!-- Bara de meniu, de aici incepe -->
 <div class="topbar">
     <div class="container" >
        
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
               <li><a href="/gitGaMa/indexAfterLogin.php" class="signBtn"><i class="fas fa-home"></i> Home</a></li>
            </ul>
      </div>
  </div>
 </div>

 <div class="honorableMentions">
            <div class="container">
                <h3>GAMES THAT I LIKE <i class="fas fa-thumbs-up"></i></h3>
                    <ul>
                      <?php
                        if(isset($_SESSION['usernameUser'])){ //daca sunt logat
                
                        $nameUser=$_SESSION['usernameUser'];
                        
                        $getIDuser = "SELECT idUsers FROM users WHERE usernameUsers='$nameUser';";
                        $resultGetID = mysqli_query($conn,$getIDuser);
                        while($row = $resultGetID->fetch_assoc())
                            $ID = $row['idUsers'];

                        $likedGamesSQL="select idUser,tittleGame,TGnature from userslikedgames join games on idLikedGame=idGame where idUser='$ID'";
                
                        $result = mysqli_query($conn,$likedGamesSQL);
                        $resultRowsNum= mysqli_num_rows($result);
                        
                        //Daca am vreun joc care este apreciat il afisez in lista
                        if($resultRowsNum>0){
                        while($row = $result->fetch_assoc())
                            {
                            if($row['TGnature']=='Original')
                            echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$nameUser.'&game='. $row['tittleGame'] .'&TGnature=Original"><img src="/gitGaMa/images/' . $row['tittleGame'] . '.png" alt="' . $row['tittleGame'] . '"> </a></li>';
                            else echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$nameUser.'&game='. $row['tittleGame'] .'&TGnature=Custom"><img src="/gitGaMa/images/customTourneyCup.png" alt="' . $row['tittleGame'] . '"> </a></li>';
                            }
                        }
                        else echo '<li style=" color:red; font-size:25px; font-weight:600 ">You have not liked any games yet!</li>'; //altfel, i se va spune ca nu are niciun joc apreciat
                    }
                    else{
                    header("Location: /gitGaMa/index.php");
                    exit();
                    }
                        ?>
                    </ul>
                    <?php
                        $myTourneysSQL="select Twon from playersgame join users on idGuser=idUsers where idGuser='$ID'";
                        $result2 = mysqli_query($conn,$myTourneysSQL);
                        $resultRowsNum= mysqli_num_rows($result2);
                        if($resultRowsNum>0)$hasTwon=1; else $hasTwon=0;
                        $row = $result2->fetch_assoc();
                    ?>
                <h3>My tourneys <?php if($hasTwon==1)echo $row['Twon']; else echo 0;?><i class="fas fa-trophy" style="color: orange"></i></h3>
                    <ul>
                        <?php
                        //Turneele la care sunt inscris
                        $myTourneysSQL="select idGuser,tittleGame,TGnature from playersgame join games on idGgame=idGame where idGuser='$ID'";
                        $result3 = mysqli_query($conn,$myTourneysSQL);
                        $resultRowsNum= mysqli_num_rows($result3);

                        if($resultRowsNum>0){
                            while($row = $result3->fetch_assoc())
                                {
                                if($row['TGnature']=='Original')
                                echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$nameUser.'&game='. $row['tittleGame'] .'&TGnature=Original"><img src="/gitGaMa/images/' . $row['tittleGame'] . '.png" alt="' . $row['tittleGame'] . '"> </a></li>';
                                else echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$nameUser.'&game='. $row['tittleGame'] .'&TGnature=Custom"><img src="/gitGaMa/images/customTourneyCup.png" alt="' . $row['tittleGame'] . '"> </a></li>';
                                }
                            }
                            else echo '<li style=" color:red; font-size:25px; font-weight:600 ">You are not in any tourney!</li>';
                    ?>
                    </ul>
            </div>
        </div>
 </html>