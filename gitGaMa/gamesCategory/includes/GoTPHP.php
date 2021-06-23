<?php
if (isset($_POST['joinTournament-submit'])){


    // MODALITATEA DE A VERIFICA DACA JUCATORUL ESTE INREGISTRAT LA TURNEU, DAR ESTE MAI COMPLICATA, ASA CA AM RENUNTAT LA EA

    
    $username = $_SESSION['usernameUser'];
    $game = $_GET[''];
    $points = rand(1,255);
    $getID = "SELECT idUsers FROM users WHERE usernameUsers='$username';";
    $resultGetID = mysqli_query($conn,$getID);

    while($row = $resultGetID->fetch_assoc())
    {
    $ID = $row['idUsers'];
    }
        $ID = $row['idUsers'];
    
    //verificam daca userul este deja inscris ca atunci cand va incerca sa participe iarasi, sa nu-i permita
    $verify ="SELECT idGuser FROM playersgame WHERE idGuser=$ID;";
    $prepareStatement = mysqli_stmt_init($conn);

    mysqli_stmt_bind_param($prepareStatement,"i",$ID);
    mysqli_stmt_execute($prepareStatement);//va rula statementul pe baza de date
    mysqli_stmt_store_result($prepareStatement);

    $resultCheck = mysqli_stmt_num_rows($prepareStatement); //resultCheck va lua valoarea nr de coloane
    if($resultCheck>0){
        header("Location: loginSIregister/register.php?error=alreadyJoined");
        exit();
    }
    else{
        $insertSQL = "INSERT INTO playersgame (idGuser, idGgame, points) VALUES ($ID,5,$points);";
        $sql = mysqli_query($conn,$insertSQL);
    }
}
?>