<?php
session_start();
?>
<!DOCTYPE html>

<html lang="en-US">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/gitGaMa/adminPages/commandsAdmin/css/commandsCSS.css">
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
     <div class="headerright">
                <ul>
                    <li><a href="/gitGaMa/adminPages/administrationPage.php" class="registerBtn"><i class="fas fa-user-circle"></i> Administrate</a></li>
                </ul>
            </div>
  </div>
 </div>

<?php

    // pagina pentru comanda de a muta playerul
    if($_GET['command']=='movePlayer'){
        echo '<form action="/gitGaMa/adminPages/commandsAdmin/includes/movePlayerPHP.php" method="POST">
        <div class="loginContainer">';

        if(isset($_GET['error'])){
            if($_GET['error']=="playerAlreadyInThatTourney"){
                echo '<h3 style="color=red;">Already in!</h3>';
            }
            if($_GET['error']=="playerDoesNotExistsInThatTourney"){
                echo '<h3 style="color=red;">Player not in fromG!</h3>';
            }
        }
        else if(isset($_GET['succes']))
        {
            if($_GET['succes']=="playerMoved"){
                echo '<h3 style="color=green;">Player moved!</h3>';
            }
        }

        echo '<label for="pname"><b>Player</b></label>
        <input type="text" placeholder="Enter player name" name="playerName" required>
    
        <label for="fromGame"><b>Game</b></label>
        <input type="text" placeholder="From" name="fromGame" required>
    
        <label for="toGame"><b>toGame</b></label>
        <input type="text" placeholder="To" name="destinationGame" required>
    
        <button type=submit name="move-submit">Execute</button>
      </div>
    </form>';
    }

    // pagina pentru comanda de a schimba punctele unui jucator
    if($_GET['command']=='changePoints'){
        echo '<form action="/gitGaMa/adminPages/commandsAdmin/includes/changePointsPHP.php" method="POST">
        <div class="loginContainer">';

        if(isset($_GET['error'])){
            if($_GET['error']=="playerIsNotInThatTourney"){
            echo '<h3 style="color=red;">Non-existent points!</h3>';
            }
        }
        else if(isset($_GET['succes']))
        {
            if($_GET['succes']=="pointsChanged"){
                echo '<h3 style="color=green;">Points changed!</h3>';
            }
        }

        echo '<label for="pname"><b>Player</b></label>
        <input type="text" placeholder="Enter player name" name="playerName" required>
    
        <label for="fromGame"><b>Game</b></label>
        <input type="text" placeholder="From" name="fromGame" required>
    
        <label for="pointsGame"><b>Points</b></label>
        <input type="text" placeholder="How many points?" name="newPoints" required>
    
        <button type=submit name="changePoints-submit">Execute</button>
      </div>
    </form>';
    }

    // pagina pentru a scoate un player 
    if($_GET['command']=='removePlayer'){
        echo'<form action="/gitGaMa/adminPages/commandsAdmin/includes/removePlayerPHP.php" method="POST">
        <div class="loginContainer">';

        if(isset($_GET['error'])){
            if($_GET['error']=="playerIsNotInThatTourney"){
            echo '<h3 style="color=red;">Player not-in!</h3>';
            }
        }
        else if(isset($_GET['succes']))
        {
            if($_GET['succes']=="playerRemoved"){
                echo '<h3 style="color=green;">Player removed!</h3>';
            }
        }

        echo '<label for="pname"><b>Player</b></label>
        <input type="text" placeholder="Enter player name" name="playerName" required>
    
        <label for="fromGame"><b>Game</b></label>
        <input type="text" placeholder="From" name="fromGame" required>
    
        <button type=submit name="removePlayer-submit" id="removePbutton">Execute</button>
      </div>
    </form>';
    }

    //Creare turenu/game (D)
    if($_GET['command']=='createTournament_Game'){
        echo'<form action="/gitGaMa/adminPages/commandsAdmin/includes/createTGPHP.php" method="POST">
        <div class="loginContainer">';

        if(isset($_GET['error'])){
            if($_GET['error']=="tourenyNameAlreadyExists"){
            echo '<h3 style="color=red;">Tourney name taken!</h3>';
            }
        }
        else if(isset($_GET['succes']))
        {
            if($_GET['succes']=="tourneyCreated"){
                echo '<h3 style="color=green;">Tourney created!</h3>';
            }
        }


        echo '<label for="TGname"><b>Name of Tourney</b></label>
        <input type="text" placeholder="Enter the name of it" name="TGName" required>
        
        <label for="typeTG">Type</label>
            <select id="TGdrop-downList" name="typeTG"> <!-- drop-down list -->
                <option value="Digital" id="digital">Digital</option>
                <option value="Board" id="board">Board</option>
            </select>
    
        <button type=submit name="createTG-submit" id="createTGbutton">Execute</button>
      </div>
    </form>';    
    }
?>

 <div class="copyright">
  <div class="container">
     <h5>&copy; 2020 GaMa | Created by Macrescu Cosmin-Ionut & Alexandru Doru-Petru</h5>
  </div>
 </div>
 </html>
