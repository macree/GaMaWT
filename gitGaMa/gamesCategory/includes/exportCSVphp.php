<?php
    if(isset($_POST['exportCSV-execute'])){
        require 'database.php';

        $gameName=$_POST['game'];
        header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename=data.csv');
        $output=fopen("php://output","w");
        fputcsv($output,array('Player','Points'));

        //$sql = 'select u.usernameUsers, p.points from users u join playersgame p on u.idUsers=p.idGuser join games g on p.idGgame=g.idGame where g.tittleGame='.$gameName.' order by p.points DESC';
        //daca foloseam variabila sql de mai sus imi dadea eroare, nu stiu exact de ce

        $result = mysqli_query($conn, "select u.usernameUsers, p.points from users u join playersgame p on u.idUsers=p.idGuser join games g on p.idGgame=g.idGame where g.tittleGame='".$gameName."' order by p.points DESC");

        while($row=mysqli_fetch_assoc($result)){
            $lineData = array($row['usernameUsers'], $row['points']);
            fputcsv($output, $lineData);
        }
        fclose($output);

    }
?>