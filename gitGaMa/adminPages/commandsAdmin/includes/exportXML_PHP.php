<?php

if(isset($_POST['xmlExport-submit'])){
    require 'database.php';
    require('statisticsPHP.php');

    $xml = new DOMDocument("1.0","UTF-8");

    $container = $xml->createElement("container");
    $container = $xml->appendChild($container);

    $statistics = $xml->createElement("statistics");
    $statistics = $container->appendChild($statistics);

    $description = $xml->createElement("description","Number of users");
    $description = $statistics->appendChild($description);

    $result = $xml->createElement("result",$numberOfTotalUsers);
    $result = $statistics->appendChild($result);

    $description = $xml->createElement("description","% of users that are male");
    $description = $statistics->appendChild($description);

    $result = $xml->createElement("result",round($percentOfMales, 2));
    $result = $statistics->appendChild($result);

    $description = $xml->createElement("description","% of users that are female");
    $description = $statistics->appendChild($description);

    $result = $xml->createElement("result",round($percentOfFemales, 2));
    $result = $statistics->appendChild($result);

    $description = $xml->createElement("description","% of users that have 1-13 years");
    $description = $statistics->appendChild($description);

    $result = $xml->createElement("result",round($percentOf1_13, 2));
    $result = $statistics->appendChild($result);

    $description = $xml->createElement("description","% of users that have 14-70 years");
    $description = $statistics->appendChild($description);

    $result = $xml->createElement("result",round($percentOf14_70, 2));
    $result = $statistics->appendChild($result);

    $description = $xml->createElement("description","% of users that have 71-99 years");
    $description = $statistics->appendChild($description);

    $result = $xml->createElement("result",round($percentOf71_99, 2));
    $result = $statistics->appendChild($result);

    $description = $xml->createElement("description","Number of games");
    $description = $statistics->appendChild($description);

    $result = $xml->createElement("result",$numberTotalGames);
    $result = $statistics->appendChild($result);

    $description = $xml->createElement("description","% of digital games");
    $description = $statistics->appendChild($description);

    $result = $xml->createElement("result",round($precentOfDigitalGames, 2));
    $result = $statistics->appendChild($result);

    $description = $xml->createElement("description","% of board games");
    $description = $statistics->appendChild($description);

    $result = $xml->createElement("result",round($percentOfBoardGames, 2));
    $result = $statistics->appendChild($result);

    $xml->formatOutput=true;
    $string_value=$xml->saveXML();
    $xml->save("GaMa_Statistics.xml");

    header("Location: /gitGaMa/adminPages/statistics.php?&xml=succes");
    exit();
}

?>