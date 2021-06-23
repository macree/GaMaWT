<?php
    if(isset($_POST['exportCSV-execute'])){
        require 'database.php';

        $gameName=$_POST['game'];
        header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename='.$gameName.'.csv');
        $output=fopen("php://output","w");
        fputcsv($output,array('Game_Tittle', 'likes','minimumAge','maximumAge','Game_Type','Genre','Dimensions','TGnature','hasTourney','Req1','Req2','Description'));

        //$sql = 'select u.usernameUsers, p.points from users u join playersgame p on u.idUsers=p.idGuser join games g on p.idGgame=g.idGame where g.tittleGame='.$gameName.' order by p.points DESC';
        //daca foloseam variabila sql de mai sus imi dadea eroare, nu stiu exact de ce

        $result = mysqli_query($conn, "select * from games where tittleGame='".$gameName."';");
        //$result = mysqli_query($conn, "select u.usernameUsers, p.points from users u join playersgame p on u.idUsers=p.idGuser join games g on p.idGgame=g.idGame where g.tittleGame='".$gameName."' order by p.points DESC");

        while($row=mysqli_fetch_assoc($result)){

            if($row['tourney']==1)$hasTourney='YES';
                else $hasTourney='NO';

            $lineData = array($row['tittleGame'], $row['likes'], $row['minimumAge'], $row['maximumAge'], $row['typeGame'], $row['genre'], $row['dimensions'],$row['TGnature'],$hasTourney,$row['restriction1'],$row['restriction2'],$row['description']);
            fputcsv($output, $lineData);
        }
        fclose($output);

    }
?>