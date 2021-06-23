<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>GaMa</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/gitGaMa/images/download.png" />
        <link rel="stylesheet" type="text/css" href="/gitGaMa/GaMaCSS.css">
        <!--Am folosit acest site pentru a folosi anumite simboluri, fonturi.-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </head>
    <body >

        <!-- Bara de meniu, de aici incepe -->
        <div class="topbar">
            <div class="container" >

                <!-- Partea din stanga-->
                <div class="topleft">
                    <ul>
                        <li> <i class="fas fa-globe-europe"></i> EN </li>
                        <!--In acest mod ma folosesc de simbolurile specifice, prin intermediul tagului <i>-->

                    </ul>
                </div>

                <!-- Centru -->
                <div class="topcenter">
                    <ul>
                        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                      </ul>
                </div>
            </div>
        </div>

    <!-- De aici incepe header-ul -->
    <div class="header">
        <div class="container">
            <div class="logo">
                <a href="index.php"><img src="/gitGaMa/images/download.png" width="80" alt=""></a>
            </div>

            <div class="headerright">
                <ul>
                    <?php
                        if(isset($_GET['succes'])){
                            echo'<li><a>You just logged out!</a></li>';
                        }
                        else {
                            echo'<li><a>You are not logged!</a></li>';
                        }
                    ?>
                    <li><a href="/gitGaMa/loginSIregister/login.php" class="signBtn"><i class="fas fa-user-circle"></i> Login</a></li>
                    <li><a href="/gitGaMa/loginSIregister/register.php" class="registerBtn"><i class="fas fa-user-circle"></i> Register</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Top 4 most played Games -->

    <div class="honorableMentions">
            <div class="container">
                <h3 style="color:RED;">YOU HAVE TO BE LOGGED IN</H3> 
            </div>
        </div>

    </body>
</html>
