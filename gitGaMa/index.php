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
                <h3 style="color:RED;">YOU HAVE TO BE LOGGED, IN ORDER TO JOIN</H3>
                <h3>TOP 4 MOST POPULAR GAMES</h3>
                    <ul>
                      <?php
                        require 'database.php';

                        /* Aici am facut un select, pentru a afla la care din jocuri s-au inscris cel mai multi jucatori in turnament */
                        $sqlTopGamesDesc = "SELECT g.tittleGame titGame FROM games g JOIN playersgame p ON g.idGame=p.idGgame GROUP BY p.idGgame ORDER BY count(p.idGgame) DESC";
                        $result = mysqli_query($conn,$sqlTopGamesDesc);
                        $i=1;

                        while(($row = $result->fetch_assoc())&$i<=4){
                            echo '<li><a href=""><img src="/gitGaMa/images/' .$row['titGame']. '.png" alt="' .$row['titGame']. '"></a></li>';
                            $i++;
                        }
                      
                      ?>
                    </ul>
            </div>
        </div>


    <!-- Honorable games -->
    <div class="honorableMentions">
            <div class="container">
                <!-- <h3 style="color:RED;">YOU HAVE TO BE LOGGED, IN ORDER TO JOIN</H3> -->
                <h3>STRATEGY - BOARD GAMES</h3>
                    <ul>
                      <li><a href=""><img src="/gitGaMa/images/GoT.png" alt="GoT"></a></li>
                      <li><a href=""><img src="/gitGaMa/images/gWho.png" alt="gWho"></a></li>
                      <li><a href=""><img src="/gitGaMa/images/BoIboard.png" alt="BoI"></a></li>
                      <li><a href=""><img src="/gitGaMa/images/monopoly.png" alt="mono"></a></li>
                      <li><a href=""><img src="/gitGaMa/images/pandemic.png" alt="Pandemic"></a></li>
                      <li><a href=""><img src="/gitGaMa/images/qCubes.png" alt="qCubes"></a></li>
                      <li><a href=""><img src="/gitGaMa/images/domino.png" alt="domino"></a></li>
                      <li><a href=""><img src="/gitGaMa/images/chessKid.png" alt="chessKid"></a></li>

                    </ul>
            </div>
        </div>

    <div class="honorableMentions">
            <div class="container">
                <h3>PUZZLE - DIGITAL</h3>
                    <ul>
                      <li><a href=""><img src="/gitGaMa/images/go.png" alt="go"></a></li>
                      <li><a href=""><img src="/gitGaMa/images/labyrinth.png" alt="Labyrinth"></a></li>
                      <li><a href=""><img src="/gitGaMa/images/Solitaire.png" alt="Solitaire"></a></li>
                      <li><a href=""><img src="/gitGaMa/images/Hearthstone.png" alt="BoI"></a></li>
                      <li><a href=""><img src="/gitGaMa/images/RedAlert2.png" alt="RedAlert2"></a></li>
                    </ul>
            </div>
        </div>


    <!-- Zona partererilor/reclame -->

    <div class="partnerArea">
            <div class="container">
              <h3>OUR PARTNERS</h3>
                    <ul>
                      <li><a href="https://www.info.uaic.ro/"><img src="/gitGaMa/images/FIIsponsor2.png" alt="FII"></a></li>
                      <li><a href="https://www.bancatransilvania.ro"><img src="/gitGaMa//images/BTsponsor.jpg" alt="BT"></a></li>
                      <li><a href="https://www.amazon.com"><img src="/gitGaMa/images/AmazonSponsor.png" alt="Amazon"></a></li>
                    </ul>
            </div>
        </div>

    <!-- Footer-ul -->

    <div class="footer">
        <div class="container">
            <div class="col-3">
                <p><strong>Where you can find us:</strong><br>Iasi, Str. Ioanesei Adrian, Nr. 69</p>
                <a href="/gitGaMa/RSSfeed.php"><img src="/gitGaMa/images/rss_icon.png" width="20" height="20"></a>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <h5>&copy; 2020 GaMa | Created by Macrescu Cosmin-Ionut & Alexandru Doru-Petru</h5>
            <p><a href="http://jigsaw.w3.org/css-validator/check/referer">
                <img style="border:0;width:88px;height:31px"
                src="http://jigsaw.w3.org/css-validator/images/vcss"
                alt="Valid CSS!" />
                </a>
            </p>
        </div>
    </div>

    <!-- Login / Singup form-->

    </body>
</html>
