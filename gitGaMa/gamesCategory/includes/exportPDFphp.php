<?php
    if(isset($_POST['exportCSV-execute'])){
    require 'database.php';

    include_once('libs/fpdf.php');
    class PDF extends FPDF
    {
    // Page header
    function Header()
    {
    // Logo
    $this->Image('/gitGaMa/images/download.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Title',1,0,'C');
    // Line break
    $this->Ln(20);
    }

     // Page footer
     function Footer()
     {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
     }
    }

    $result = mysqli_query($conn, "select u.usernameUsers, p.points from users u join playersgame p on u.idUsers=p.idGuser join games g on p.idGgame=g.idGame where g.tittleGame='".$gameName."' order by p.points DESC");

    require('fpdf/fpdf.php');
    $pdf = new FPDF();
    $pdf -> AddPage();
    $pdf -> SetFont('Arial','B','12');
    foreach()
    }
?>