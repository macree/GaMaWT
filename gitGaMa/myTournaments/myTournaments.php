<?php
session_start();
require 'database.php';
?>

<!DOCTYPE html>

<html lang="en-US">

<head>
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

 <div class="myTournaments">
            <div class="container">
                <h3>MY TOURNAMENTS <i class="fas fa-chess"></i></h3>
                    <ul>
                      <?php
                        if(isset($_SESSION['usernameUser'])){ //daca sunt logat
                
                        $nameUser=$_SESSION['usernameUser'];
                        
                        //selectez toate jocurile la care userul este inregistrat
                        $tittleGameSQL="select g.tittleGame from users u join playersgame p on u.idUsers=p.idGuser join games g on p.idGgame=g.idGame where u.usernameUsers='$nameUser' order by p.points DESC;";
                
                        $result = mysqli_query($conn,$tittleGameSQL);
                        $resultRowsNum= mysqli_num_rows($result);
                        
                        //daca este inregistrat la macar unul, le va afisa
                        if($resultRowsNum>0){
                        while($row = $result->fetch_assoc())
                            {
                            echo '<li><a href="/gitGaMa/gamesCategory/gameTourney.php?username='.$nameUser.'&game='. $row['tittleGame'] .'"><img src="/gitGaMa/images/' . $row['tittleGame'] . '.png" alt="' . $row['tittleGame'] . '>" </a></li>';
                            }
                        }
                        else echo '<li style=" color:red; font-size:25px; font-weight:600 ">You have not joined any tournaments</li>';
                        //altfel, i se va spune ca nu este intregistrat le vreunul din ele
                    }
                    ?>
                    </ul>
            </div>
        </div>
 </html>