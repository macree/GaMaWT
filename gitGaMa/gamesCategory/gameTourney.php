<?php
session_start();
require 'database.php';
?>

<!DOCTYPE html>

<html lang="en-US">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/gitGaMa/gamesCategory/gamesCSS/GoTCSS.css">
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
               <li><a class="userBtn"><i class="fas fa-user-circle"></i><?php echo $_SESSION['usernameUser'];?>
               <?php
                if($_SESSION['usernameUser']=='admin')
                    echo '<li><a href="/gitGaMa/adminPages/administrationPage.php" class="signBtn"><i class="fas fa-chess"></i> Administrate </a></li>';
                    else
                    echo '<li><a href="/gitGaMa/myTournaments/myTournaments.php" class="signBtn"><i class="fas fa-chess"></i> My Tournaments</a></li>';
                ?>
            </ul>
      </div>
  </div>
 </div>

 <div class="gamePlayers">
    <ul>
        <li><img src=<?php 
            if(isset($_GET['TGnature'])=='Custom')
            echo '"/gitGaMa/images/customTourneyCup.png" alt="customTourneyCup"';
            else
            echo '"/gitGaMa/images/' . $_GET['game'] . '.png" alt="' . $_GET['game'] . '"';
            ?>>
        </li>
        <li><a style="font-size:25px; font-weight:600">Players that are in the tournament:</a>
            <ol>
            <nav>
                <?php
                if(isset($_SESSION['usernameUser'])){ //daca sunt logat
                
                //Iau toti jucatorii ce sunt inscrisi la joc
                $gameName=$_GET['game'];
                $checkExistance=null;
                $usernameAndPointsSQL="select u.usernameUsers, p.points from users u join playersgame p on u.idUsers=p.idGuser join games g on p.idGgame=g.idGame where g.tittleGame='$gameName' order by p.points DESC;";
                
                $result = mysqli_query($conn,$usernameAndPointsSQL);
                $resultRowsNum= mysqli_num_rows($result);

                if($resultRowsNum>0){
                    while($row = $result->fetch_assoc())
                    {
                        $username = $row['usernameUsers']; //memorez numele
                        $points = $row['points']; // memorez punctele

                        if(strcmp($_SESSION['usernameUser'],$username)==0){
                        $checkExistance=1;
                        //fac numele userului logat sa apara cu rosu in caz ca participa la turneu pentru a fi mai usor de vazut
                        echo '<li style="color:red; font-size: 23px; font-weight:600">'.$username.' - '.$points.'</li>';
                        }else echo '<li style="color:grey; font-size: 20px; font-weight:600">'.$username.' - '.$points.'</li>';
                    }

                    if($checkExistance==1)
                        echo '<li style=" color:red; font-size:30px; font-weight:600 " >You are in! </a>';
                }
                else echo '<li style=" color:red; font-size:30px; font-weight:600 ">There are no players!</li>';
                }
                else {
                    header("Location: /gitGaMa/index.php?error=notLogged");
                    exit();
                }
            
                echo '</nav></ol></li>';

                $username=$_SESSION['usernameUser'];

                if($checkExistance!==1)
                echo'
                    <a style=" color:red; font-size:30px; font-weight:600 " >You are not joined! </a>
                    <form action="joinTournamentPHP.php" method="post">
                    <input type="hidden" name="user" value="'.$username.'"/>
                    <input type="hidden" name="game" value="'.$gameName.'"/>
                    <button type="submit" name="joinTournament-submit">Join tournament</button>
                    </form>';
                
                //form invizibil pentru CSV
                echo '<form action="./includes/exportCSVphp.php" method="post">
                        <input type="hidden" name="game" value="'.$gameName.'"/>
                        <input type="hidden" name="user" value="'.$username.'"/>
                        <button type="submit" name="exportCSV-execute"/>Export CSV</button>
                      </form>';
                ?>
                <!-- Am folosit type="hidden" deoarce nu exista un camp in care utilizatorul sa scrie, -->
    </ul>
 </div>
 </html>