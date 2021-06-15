<?php
if (isset($_POST['login-submit'])){

    require 'database.php';

    $usernameL = $_POST['usernameLogin'];
    $passwordL = $_POST['passwordLogin'];

    if(empty($usernameL)||empty($passwordL)){
        header("Location: /gitGaMa/loginSIregister/login.php?error=oneOrMoreFieldsAreEmpty");
        exit();
    }
    else {
        $sql = "SELECT * from users WHERE usernameUsers=?;";
        $preparedStatement = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($preparedStatement,$sql)){
            header("Location: /gitGaMa/loginSIregister/login.php?error=sqlError");
            exit();
        }
        else {

            mysqli_stmt_bind_param($preparedStatement, "s", $usernameL);
            mysqli_stmt_execute($preparedStatement);
            $result= mysqli_stmt_get_result($preparedStatement);

            if($row = mysqli_fetch_assoc($result)){
                $passwordCheck = password_verify($passwordL,$row['passwordUsers']); //pswcheck este 0 sau 1
                if($passwordCheck == false){
                    header("Location: /gitGaMa/loginSIregister/login.php?error=wrongPassword");
                    exit();
                }
                else if($passwordCheck == true){
                    //pornim o sesiune
                    session_start();
                    $_SESSION['userID']= $row['idUsers'];
                    $_SESSION['usernameUser']= $row['usernameUsers'];

                    //verific daca este contul de admin sau user simplu dupa username
                    //daca este admin, o sa aiba o interfata de administrator (il duce pe o alta pagina imediat ce da login)

                    if($_SESSION['usernameUser']=='admin'){
                        header("Location: /gitGaMa/adminPages/mainPage.php?login=SUCCES");
                        exit();
                    }
                    else{
                        header("Location: /gitGaMa/indexAfterLogin.php?login=SUCCES");
                        exit();
                    }
                }
            }
            else{
                header("Location: /gitGaMa/loginSIregister/login.php?error=userNotExist");
                exit();

            }
        }
    }
}
else {
    header("Location: /gitGaMa/index.php");
    exit();
}
?>