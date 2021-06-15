<?php
    if(isset($_POST['createTG-submit'])){
        require 'database.php';

    $nameTourney= $_POST['TGName'];
    $tourneyType= $_POST['typeTG'];
    $TGnature='Custom'; //custom in sensul ca este creat ulterior si nu odata cu jocurile prestabilite

    //verific daca numele ales exista deja in baza de date
    $commandVerifySQL= "SELECT tittleGame FROM games WHERE tittleGame='$nameTourney'";
    $verifyResult= mysqli_query($conn,$commandVerifySQL);

    $checkExistance= mysqli_num_rows($verifyResult);

    if($checkExistance>0){ // daca exista deja un turneu cu acest nume da eroare
        header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=createTournament_Game&error=tourenyNameAlreadyExists");
        exit();
    }
    else{//daca in baza de date nu exista acest turneu, il va crea
        $commandSQL= "INSERT INTO games(tittleGame, typeGame, TGnature) VALUES (?,?,?);";
        $sqlSTMT= mysqli_prepare($conn, $commandSQL);
        mysqli_stmt_bind_param($sqlSTMT, "sss",$nameTourney, $tourneyType, $TGnature);
        mysqli_stmt_execute($sqlSTMT);

        header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=createTournament_Game&succes=tourneyCreated");
        exit();

        mysqli_stmt_close($sqlSTMT);
    }

    }
?>