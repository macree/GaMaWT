<?php
session_start();
require 'database.php';
if ($_SESSION['usernameUser'] != 'admin') {
    header("Location: /gitGaMa/index.php");
    exit();
}
?>
<!DOCTYPE html>

<html lang="en-US">

<head>
    <title>GaMa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/gitGaMa/adminPages/commandsAdmin/css/commandsCSS.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
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
        echo '
        <div class="createTourney">
        <form action="/gitGaMa/adminPages/commandsAdmin/includes/movePlayerPHP.php" method="POST">';

        if(isset($_GET['error'])){
            if($_GET['error']=="playerAlreadyInThatTourney"){
                echo '<h3 style="color=red;">Already in!</h3>';
            }
            if($_GET['error']=="playerDoesNotExistsInThatTourney"){
                echo '<h3 style="color=red;">Player not in fromG!</h3>';
            }
            if($_GET['error']=="tourneyFull"){
                echo '<h3 style="color=red;">Tourney\'s full!</h3>';
            }
            if($_GET['error']=="playerDoesNotExistsInDB"){
                echo '<h3 style="color=red;">User non-existent!</h3>';
            }
        }
        else if(isset($_GET['succes']))
        {
            if($_GET['succes']=="playerMoved"){
                echo '<h3 style="color=green;">Player moved!</h3>';
            }
        }
        
        echo '<label for="pname"><b>Player</b></label>
            <select id="TGFgames-downList" name="fromGame">';
            //AFISEZ DOAR JUCATORII CARE SUNT INTR-UN TURNEU
            $sql=mysqli_query($conn,"select DISTINCT(usernameUsers) as users from users join playersgame on idUsers=idGuser;");
            $row=mysqli_num_rows($sql);
            while($row= mysqli_fetch_array($sql)){
                echo "<option value='". $row['users'] ."'>" .$row['users'] ."</option>" ;
            }
        echo '</select>';
        //<input type="text" placeholder="Enter player name" name="playerName" required>


        echo '
        <label for="fromGame">fromGame</label>
            <select id="TGFgames-downList" name="fromGame">';
            $sql=mysqli_query($conn,"SELECT idGame, tittleGame from games where tourney=1 ;");
            $row=mysqli_num_rows($sql);
            while($row= mysqli_fetch_array($sql)){
                echo "<option value='". $row['tittleGame'] ."'>" .$row['tittleGame'] ."</option>" ;
            }
            echo'</select>
        <label for="toGame">toGame</label>
        <select id="TGTgames-downList" name="toGame">';
            $sql=mysqli_query($conn,"SELECT idGame, tittleGame from games where tourney=1 ;");
            $row=mysqli_num_rows($sql);
            while($row= mysqli_fetch_array($sql)){
                echo "<option value='". $row['tittleGame'] ."'>" .$row['tittleGame'] ."</option>" ;
            }
            echo'</select>
        <button type=submit name="move-submit">Execute</button>
      </div>
    </form>';
    }

    // pagina pentru a scoate un player 
    if($_GET['command']=='removePlayer'){
        echo'
        <div class="createTourney">
        <form action="/gitGaMa/adminPages/commandsAdmin/includes/removePlayerPHP.php" method="POST">';
        if(isset($_GET['succes']))
        {
            if($_GET['succes']=="playerRemoved"){
                echo '<h3 style="color=green;">Player removed!</h3>';
            }
        }
        $sql=mysqli_query($conn,"SELECT usernameUsers from users;");
        $row=mysqli_num_rows($sql);

        echo'<label for="removeUser">Username</label>
            <select id="TGusers-downList" name="removeUser"> <!-- drop-down list -->';
            while($row= mysqli_fetch_array($sql)){
                echo "<option value='". $row['usernameUsers'] ."'>" .$row['usernameUsers'] ."</option>" ;
            }
        echo"</select>
        <button type=submit name='removePlayer-submit' id='removePbutton'>Remove</button>
        </div>
    </form>";
    }

    //Adaugare joc
    if($_GET['command']=='createTournament_Game'){
        echo'
        <div class="createTourney">
        <form action="/gitGaMa/adminPages/commandsAdmin/includes/createTGPHP.php" method="POST">';

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
        
        <label for="description"><b>The description</b></label>
        <input type="text" placeholder="Write it here" name="description" required>

        <label for="dimensions"><b>Dimensions</b></label>
        <input type="text" placeholder="LxWxH or -" name="dimensions" required>

        <label for="ageRestriction">Age</label>
            <select id="TGage-downList" name="ageRestriction"> <!-- drop-down list -->
                <option value="1" id="youngAges">1-13 Years</option>
                <option value="2" id="middleAges">14-70 Years</option>
                <option value="3" id="oldAges">71-99 Years</option>
                <option value="4" id="allAges">1-99 Years</option>
            </select>

        <label for="genre">Genre</label>
            <select id="downListGEN" name="genre"> <!-- drop-down list -->
                <option value="Strategy" id="Strategy">Strategy</option>
                <option value="Puzzler" id="Puzzler">Puzzler</option>
                <option value="Simulation" id="Simulation">Simulation</option>
            </select>

        <label for="tourney">Tourney</label>
        <select id="downListTour" name="tourney"> <!-- drop-down list -->
            <option value="1" id="YES">YES</option>
            <option selected="selected" value="0" id="NO">NO</option>
        </select>

        <label for="requirement1">Requirements</label>
            <select id="downListREQ" name="requirement1"> <!-- drop-down list -->
                <option value="PC" id="PC">PC</option>
                <option value="Table" id="Table">Table</option>
            </select>
            <select id="downListREQ" name="requirement2"> <!-- drop-down list -->
                <option value="-" id="-">-</option>
                <option value="Microphone" id="Microphone">Microphone</option>
                <option value="Vocally" id="Vocally">Vocally</option>
            </select>

        <label for="typeTG">Type</label>
            <select id="TGdrop-downList" name="typeTG"> <!-- drop-down list -->
                <option value="Digital" id="digital">Digital</option>
                <option value="Board" id="board">Board</option>
            </select>
    
        <button type=submit name="createTG-submit" id="createTGbutton">Execute</button>
      </div>
    </form>';
    }
    if($_GET['command']=='deleteGame'){
        echo'
        <div class="createTourney">
        <form action="/gitGaMa/adminPages/commandsAdmin/includes/deleteGamePHP.php" method="POST">';
        
        if(isset($_GET['succes'])){
            if($_GET['succes']=="gameDeleted"){
            echo '<h3 style="color=green;">GAME DELETED!</h3>';
            }
        }

        $sql=mysqli_query($conn,"SELECT tittleGame from games;");
        $row=mysqli_num_rows($sql);

        echo'<label for="deleteGameName">Game</label>
            <select id="deleteGame-downList" name="deleteGameName"> <!-- drop-down list -->';
            while($row= mysqli_fetch_array($sql)){
                echo "<option value='". $row['tittleGame'] ."'>" .$row['tittleGame'] ."</option>" ;
            }
        echo"</select>
        <button type=submit name='deleteGame-submit' id='deleteGameButton'>DELETE</button>
        </div>
    </form>";
    }

    if($_GET['command']=='modifyGame'){

        echo'
        <div class="createTourney">
        <form action="/gitGaMa/adminPages/commandsAdmin/includes/modifyGamePHP.php" method="POST">';
        
        if(isset($_GET['succes'])){
            if($_GET['succes']=="gameModified"){
            echo '<h3 style="color=green;">CHANGES WERE MADE!</h3>';
            }
        }

        $sql=mysqli_query($conn,"SELECT tittleGame from games;");
        $row=mysqli_num_rows($sql);

        echo'<label for="modifyChosenGameName">Game</label>
                <select id="modifyChosenGameGame-downList" name="modifyChosenGameName"> <!-- drop-down list -->';
            while($row= mysqli_fetch_array($sql)){
                echo "<option value='". $row['tittleGame'] ."'>" .$row['tittleGame'] ."</option>" ;
            }
            //<input type="text" placeholder="Write it here" name="description">
        echo'</select>
        <label for="description"><b>The description</b></label>
        <input type="text" placeholder="Write it here" name="description">

        <label for="dimensions"><b>Dimensions</b></label>
        <input type="text" placeholder="LxWxH or -" name="dimensions">

        <label for="ageRestriction">Age</label>
            <select id="TGage-downList" name="ageRestriction"> <!-- drop-down list -->
                <option value="1" id="youngAges">1-13 Years</option>
                <option value="2" id="middleAges">14-70 Years</option>
                <option value="3" id="oldAges">71-99 Years</option>
                <option value="4" id="allAges">1-99 Years</option>
            </select>

        <label for="genre">Genre</label>
            <select id="downListGEN" name="genre"> <!-- drop-down list -->
                <option value="Strategy" id="Strategy">Strategy</option>
                <option value="Puzzler" id="Puzzler">Puzzler</option>
                <option value="Simulation" id="Simulation">Simulation</option>
            </select>

        <label for="tourney">Tourney</label>
        <select id="downListTour" name="tourney"> <!-- drop-down list -->
            <option value="1" id="Strategy">YES</option>
            <option value="0" id="Puzzler">NO</option>
        </select>

        <label for="requirement1">Requirements</label>
            <select id="downListREQ" name="requirement1"> <!-- drop-down list -->
                <option value="PC" id="PC">PC</option>
                <option value="Table" id="Table">Table</option>
            </select>
            <select id="downListREQ" name="requirement2"> <!-- drop-down list -->
                <option value="-" id="-">-</option>
                <option value="Microphone" id="Microphone">Microphone</option>
                <option selected="selected" value="Vocally" id="Vocally">Vocally</option>
            </select>

        <label for="typeTG">Type</label>
            <select id="TGdrop-downList" name="typeTG"> <!-- drop-down list -->
                <option value="Digital" id="digital">Digital</option>
                <option value="Board" id="board">Board</option>
            </select>
    
        <button type=submit name="modifyGameButton-submit" id="modifyGameButton">MODIFY</button>
        </div>
    </form>';
    }

    ?>
</body>
 </html>
