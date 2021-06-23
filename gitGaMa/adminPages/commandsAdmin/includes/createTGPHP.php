<?php
    session_start();
    require 'database.php';
    if ($_SESSION['usernameUser'] != 'admin') {
        header("Location: /gitGaMa/index.php");
        exit();
    }
    if(isset($_POST['createTG-submit'])){
        require 'database.php';

    $nameTourney= $_POST['TGName'];
    $tourneyType= $_POST['typeTG'];
    $ageRestriction= $_POST['ageRestriction'];
    $description=$_POST['description'];
    $genre=$_POST['genre'];
    $tourney=$_POST['tourney'];
    $dimensions=$_POST['dimensions'];
    $requirement1=$_POST['requirement1'];
    $requirement2=$_POST['requirement2'];
    $TGnature='Custom'; //custom in sensul ca este creat ulterior si nu odata cu jocurile prestabilite
    
    $hasTourney=TRUE;

    if($ageRestriction=="1")
        {
            $minimumAge=1;
            $maximumAge=13;
        }
        elseif ($ageRestriction=="2") {
            $minimumAge=14;
            $maximumAge=70;
        }
        elseif ($ageRestriction=="3") {
            $minimumAge=71;
            $maximumAge=99;
        }
        else {
            $minimumAge=1;
            $maximumAge=99;
        }
    if($tourney=="1")
        $hasTourney=TRUE;
    else $hasTourney=FALSE;
    //verific daca numele ales exista deja in baza de date
    $commandVerifySQL= "SELECT tittleGame FROM games WHERE tittleGame='$nameTourney'";
    $verifyResult= mysqli_query($conn,$commandVerifySQL);

    $checkExistance= mysqli_num_rows($verifyResult);

    if($checkExistance>0){ // daca exista deja un turneu cu acest nume da eroare
        header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=createTournament_Game&error=tourenyNameAlreadyExists");
        exit();
    }
    else{//daca in baza de date nu exista acest turneu, il va crea
        
        if($requirement2=="-")
        {
            $commandSQL= "INSERT INTO games(tittleGame ,minimumAge, maximumAge, typeGame, genre, dimensions, description, TGnature, restriction1,tourney) VALUES (?,?,?,?,?,?,?,?,?,?);";
            $sqlSTMT= mysqli_prepare($conn, $commandSQL);
            mysqli_stmt_bind_param($sqlSTMT, "siissssssi",$nameTourney,$minimumAge, $maximumAge, $tourneyType, $genre, $dimensions, $description, $TGnature,$requirement1,$hasTourney);
            mysqli_stmt_execute($sqlSTMT);
        }
        else 
        {
            $commandSQL= "INSERT INTO games(tittleGame ,minimumAge, maximumAge, typeGame, genre, dimensions, description, TGnature, restriction1, restriction2) VALUES (?,?,?,?,?,?,?,?,?,?,?);";
            $sqlSTMT= mysqli_prepare($conn, $commandSQL);
            mysqli_stmt_bind_param($sqlSTMT, "siisssssssi",$nameTourney,$minimumAge, $maximumAge, $tourneyType, $genre, $dimensions, $description, $TGnature, $requirement1, $requirement2,$hasTourney);
            mysqli_stmt_execute($sqlSTMT);
        }
        //$commandSQL= "INSERT INTO games(tittleGame ,minimumAge, maximumAge, typeGame, genre, description, TGnature) VALUES (?,?,?,?,?,?,?);";
        /*$sqlSTMT= mysqli_prepare($conn, $commandSQL);
        mysqli_stmt_bind_param($sqlSTMT, "siissss",$nameTourney,$minimumAge, $maximumAge, $tourneyType, $genre, $description, $TGnature);
        mysqli_stmt_execute($sqlSTMT);*/

        header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=createTournament_Game&succes=tourneyCreated");
        exit();

        mysqli_stmt_close($sqlSTMT);
    }

    }
?>