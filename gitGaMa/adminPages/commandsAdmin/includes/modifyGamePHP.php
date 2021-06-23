<?php
session_start();
require 'database.php';
if ($_SESSION['usernameUser'] != 'admin') {
    header("Location: /gitGaMa/index.php");
    exit();
}

if(isset($_POST['modifyGameButton-submit'])){

    //$theNumberOfModifiedThings=0;

    $gameNameF = $_POST['modifyChosenGameName'];
    $tourneyTypeF= $_POST['typeTG'];
    $ageRestrictionF= $_POST['ageRestriction'];
    $descriptionF=$_POST['description'];
    $genreF=$_POST['genre'];
    $tourneyF=$_POST['tourney'];
    $dimensionsF=$_POST['dimensions'];
    $req1F=$_POST['requirement1'];
    $req2F=$_POST['requirement2'];

    $sql1= "SELECT * from games where tittleGame='$gameNameF'";
    $exec1= mysqli_query($conn, $sql1);
    $row = $exec1->fetch_assoc();

    $idGameDB = $row['idGame'];
    $tittleGameDB = $row['tittleGame'];
    $minimumAgeDB = $row['minimumAge'];
    $maximumAgeDB = $row['maximumAge'];
    $typeGameDB = $row['typeGame'];
    $genreDB = $row['genre'];
    $dimensionsDB = $row['dimensions'];
    $descriptionDB = $row['description'];
    $req1DB = $row['restriction1'];
    $req2DB = $row['restriction2'];
    $tourneyDB = $row['tourney'];

    if($ageRestrictionF=="1")
        {
            $minimumAgeF=1;
            $maximumAgeF=13;
        }
        elseif ($ageRestrictionF=="2") {
            $minimumAgeF=14;
            $maximumAgeF=70;
        }
        elseif ($ageRestrictionF=="3") {
            $minimumAgeF=71;
            $maximumAgeF=99;
        }
        else {
            $minimumAgeF=1;
            $maximumAgeF=99;
        }
    
    if($tourneyF=="1")
        $tourneyF=1;
        else $tourneyF=0;
    
    if(!empty($descriptionF)&&($descriptionF!='$descriptionDB'))
    {
        $sqlDescrip="UPDATE games set description='$descriptionF' where idGame=$idGameDB";
        mysqli_query($conn,$sqlDescrip);
        //$theNumberOfModifiedThings++;
    }

    if(!empty($dimensionsF)&&$dimensionsF!='$dimensionsDB')
    {
        $sqlDim="UPDATE games set dimensions='$dimensionsF' where idGame=$idGameDB";
        mysqli_query($conn,$sqlDim);
        //$theNumberOfModifiedThings++;
    }

    if((($minimumAgeF!=$minimumAgeDB)&&($maximumAgeF!=$maximumAgeDB))||
        (($minimumAgeF==$maximumAgeDB)&&($maximumAgeF!=$maximumAgeDB))||
        (($minimumAgeF!=$minimumAgeDB)&&($maximumAgeF==$maximumAgeDB))
        )
    {
        $sqlAge="UPDATE games set minimumAge=$minimumAgeF,maximumAge=$maximumAgeF where idGame=$idGameDB";
        mysqli_query($conn,$sqlAge);
        //$theNumberOfModifiedThings=$theNumberOfModifiedThings+2;
    }

    if($genreF!='$genreDB')
    {
        $sqlGenre="UPDATE games set genre='$genreF' where idGame=$idGameDB";
        mysqli_query($conn,$sqlGenre);
        //$theNumberOfModifiedThings++;
    }

    if($tourneyF!=$tourneyDB)
    {
        if($tourneyF==0)//Daca dorim sa scoatem turneul de la un joc, automat trebuie sa sterg
        //toti jucatorii ce erau inscrisi initial la acesta
        {
            $sqlTourney="UPDATE games set tourney=$tourneyF where idGame=$idGameDB";
            mysqli_query($conn,$sqlTourney);
            $sqlTourneyDel="DELETE FROM playersgame WHERE idGgame=$idGameDB";
            mysqli_query($conn,$sqlTourneyDel);
        }
        else{
            $sqlTourney="UPDATE games set tourney=$tourneyF where idGame=$idGameDB";
            mysqli_query($conn,$sqlTourney);
        }
        //$theNumberOfModifiedThings++;
    }

    if($req1F!='$req1DB')
    {
        $sqlReq="UPDATE games set restriction1='$req1F' where idGame=$idGameDB";
        mysqli_query($conn,$sqlReq);
        //$theNumberOfModifiedThings++;
    }
    if($req2F!='$req2DB'&&$req2F!='-')
    {
        $sqlReq="UPDATE games set restriction2='$req2F' where idGame=$idGameDB";
        mysqli_query($conn,$sqlReq);
        //$theNumberOfModifiedThings++;
    }
    else
    if($req2F=='-'&&!(is_null($req2DB)))
    {
        $sqlReq="UPDATE games set restriction2=NULL where idGame=$idGameDB";
        mysqli_query($conn,$sqlReq);
        //$theNumberOfModifiedThings++;
    }

    if($tourneyTypeF!='$typeGameDB')
    {
        $sqlType="UPDATE games set typeGame='$tourneyTypeF' where idGame=$idGameDB";
        mysqli_query($conn,$sqlType);
        //$theNumberOfModifiedThings++;
    }

    header("Location: /gitGaMa/adminPages/commandsAdmin/allCommands.php?command=modifyGame&succes=gameModified");
    exit();
}
?>