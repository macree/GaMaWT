<?php
session_start();
if(isset($_SESSION['usernameUser'])){
$web_url = "http://". $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];

$str = "<?xml version='1.0'?>";
$str .= "<rss version='2.0'>";

$str .="<channel>";

    $str .= "<title>GaMa Web-Application</title>";
    $str .= "<description>Most popular games and a top of group of players based on the genre</description>";
    $str .= "<language>en-US</language>";
    $str .= "<link>$web_url</link>";

$dbServerName = "localhost";
$dbUserName = "root";
$dbPassword = ""; //no $dbPassword
$dbName = "loginsystem";
$userAge = $_GET['userAge'];

$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);
$result = mysqli_query($conn, $sqlTopGamesDesc = "SELECT * FROM games ORDER BY likes DESC");

//ANULAT $result = mysqli_query($conn, $sqlTopGamesDesc = "SELECT g.tittleGame titGame, minimumAge, maximumAge, count(p.idGuser) countUsers FROM games g JOIN playersgame p ON g.idGame=p.idGgame GROUP BY p.idGgame ORDER BY g.minimumAge ASC");

while($row = mysqli_fetch_object($result)){
    /*$gameTitle = htmlentities($row['titGame']);
    $minAge = htmlentities($row['minimumAge']);
    $maxAge = htmlentities($row['maximumAge']);*/
    $str .= "<item>";
        $str .= "<title>" . $row->tittleGame . "</title>";
        $str .= "<description>With ". $row->likes . " likes, ". $row->typeGame .", ". $row->genre .", with a range of age: " . $row->minimumAge . "-" . $row->maximumAge . "</description>";
        $str .= "<link>". $web_url ."gamesCategory/gamesTourney.php?game=" . $row->tittleGame . "TGnature=". $row->TGnature . "</link>";
    $str .= "</item>";
}

$str .= "</channel>";
$str .= "</rss>";

file_put_contents("rss.xml", $str);
//echo "Done";
header("Location: /gitGaMa/rss.xml");
}
else {
	exit(header("Location: /gitGaMa/index.php"));
}

?>