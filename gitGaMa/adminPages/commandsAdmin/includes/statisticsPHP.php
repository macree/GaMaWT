<?php

    require 'database.php';

    //Baieti %
    $sqlTotalUsers="SELECT COUNT(idUsers) FROM users;";
    $resultTotalUsers = mysqli_query($conn,$sqlTotalUsers);
    $row=mysqli_fetch_row($resultTotalUsers);
    $numberOfTotalUsers = $row[0];

    $sqlMaleUsers="SELECT COUNT(gender) FROM users WHERE gender='Male';";
    $resultMaleUsers = mysqli_query($conn,$sqlMaleUsers);
    $row=mysqli_fetch_row($resultMaleUsers);
    $numberOfMales = $row[0];

    $percentOfMales = ($numberOfMales*100)/$numberOfTotalUsers;

    //Fete %
    $sqlFemaleUsers="SELECT COUNT(gender) FROM users WHERE gender='Female';";
    $resultFemaleUsers = mysqli_query($conn,$sqlFemaleUsers);
    $row=mysqli_fetch_row($resultFemaleUsers);
    $numberOfFemales = $row[0];

    $percentOfFemales = ($numberOfFemales*100)/$numberOfTotalUsers;

    ////////

    //Procentaj useri cu varsta intre 1-13 ani
    $sqlAge1_13="SELECT COUNT(idUsers) FROM users WHERE age<=13;";
    $resultAge1_13 = mysqli_query($conn,$sqlAge1_13);
    $row=mysqli_fetch_row($resultAge1_13);
    $numberOfAge1_13 = $row[0];

    $percentOf1_13 = ($numberOfAge1_13*100)/$numberOfTotalUsers;

    //Procentaj useri cu varsta intre 14-70 ani
    $sqlAge14_70="SELECT COUNT(idUsers) FROM users WHERE age>=13 AND age<=70;";
    $resultAge14_70 = mysqli_query($conn,$sqlAge14_70);
    $row=mysqli_fetch_row($resultAge14_70);
    $numberOfAge14_70 = $row[0];

    $percentOf14_70 = ($numberOfAge14_70*100)/$numberOfTotalUsers;

    //Procentaj useri cu varsta intre 71_99 ani
    $sqlAge71_99="SELECT COUNT(idUsers) FROM users WHERE age>=71 AND age<=99;";
    $resultAge71_99 = mysqli_query($conn,$sqlAge71_99);
    $row=mysqli_fetch_row($resultAge71_99);
    $numberOfAge71_99 = $row[0];

    $percentOf71_99 = ($numberOfAge71_99*100)/$numberOfTotalUsers;

    ////////

    //Procentaj categorie joc

    //Digital games
    $sqlDigitalGames="SELECT COUNT(idGame) FROM games WHERE typeGame='Digital';";
    $resultDigitalGames= mysqli_query($conn,$sqlDigitalGames);
    $row = mysqli_fetch_row($resultDigitalGames);
    $numberDigitalGames = $row[0];

    $sqlTotalGames="SELECT COUNT(idGame) FROM games;"; // nr total de jocuri
    $resultTotalGames= mysqli_query($conn,$sqlTotalGames);
    $row = mysqli_fetch_row($resultTotalGames);
    $numberTotalGames=$row[0];

    $precentOfDigitalGames = ($numberDigitalGames*100)/$numberTotalGames;

    //Board games

    $sqlBoardGames="SELECT COUNT(idGame) FROM games WHERE typeGame='Board';";
    $resultBoardGames= mysqli_query($conn,$sqlBoardGames);
    $row = mysqli_fetch_row($resultBoardGames);
    $numberBoardGames = $row[0];

    $percentOfBoardGames = ($numberBoardGames*100)/$numberTotalGames;
?>