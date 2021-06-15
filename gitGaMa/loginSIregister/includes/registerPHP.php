<?php
 
    //aici verificam daca userul a accesat aceasta pagina utilizand butonul de submit
    if(isset($_POST['register-submit'])){
        require 'database.php';

    $username = $_POST['uName'];
    $password = $_POST['psw'];
    $passwordRepeat = $_POST['pswRepeat'];
    $age = $_POST['age'];
    $gender = $_POST['sexSelect'];

    //verificam daca userul a "umplut" toate fieldurile, partea asta este optionala pt ca folosesc required

    /*if(empty($username) || empty($password) || empty($passwordRepeat) || empty($age) ){
        header("Location: ../register.php?error=emptyFields&uName=".$username."&age=".$age);
        exit();//opreste scriptul din a functiona in caz ca nu completeaza
    }
    else */
    if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        header("Location: /gitGaMa/loginSIregister/register.php?error=invalidUsername&age=".$age);
        exit();
    }
    else if(!is_numeric($age)){ //(preg_match("/^[0-9][0-9]*$/",$age))
        header("Location: /gitGaMa/loginSIregister/register.php?error=invalidAge&username=".$username);
        exit();
    }
    else if($password !== $passwordRepeat){
        header("Location: /gitGaMa/loginSIregister/register.php?error=passwordCheck&username=".$username."age=".$age);
        exit();
    }
    else { //verificam daca exista deja un utilizator cu acelasi username
        $sql ="SELECT usernameUsers FROM users WHERE usernameUsers=?;"; //? pt a nu putea fi stricata baza de date, hackuita
        $prepareStatement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($prepareStatement,$sql)){
            header("Location: /gitGaMa/loginSIregister/register.php?error=sqlError");
            exit();
        }
        else {

        mysqli_stmt_bind_param($prepareStatement,"s", $username); //s de la string
        mysqli_stmt_execute($prepareStatement);//va rula statementul pe baza de date
        mysqli_stmt_store_result($prepareStatement);//ia rezultatul din baza de date si il pune inapoi in var prepareStatement

        $resultCheck = mysqli_stmt_num_rows($prepareStatement); //resultCheck va lua nr de coloane
        if($resultCheck>0){
            header("Location: /gitGaMa/loginSIregister/register.php?error=usernameTaken&age=".$age);
            exit();
        }
     else { //facem insertul in baza de date
        $sql = "INSERT INTO users(usernameUsers,passwordUsers,age,gender) VALUES (?,?,?,?);"; //>=place holders
        $prepareStatement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($prepareStatement, $sql)){
            header("Location: /gitGaMa/loginSIregister/register.php?error=sqlError");
            exit();
        }
        else {
            //hashuim parola
            $hashedPwd=password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($prepareStatement,"ssis", $username, $hashedPwd, $age, $gender); //s de la string i integer
            mysqli_stmt_execute($prepareStatement);//va rula statementul pe baza de date
            header("Location: /gitGaMa/loginSIregister/register.php?register=succes");
            exit();
        }
    }
}
}
    mysqli_stmt_close($prepareStatement);
    mysqli_close($conn);
}
else {
    header("Location: /gitGaMa/loginSIregister/register.php");
    exit();
}
?>