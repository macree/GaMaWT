<?php
session_start();
session_unset(); //ia toate sesiunile si le sterge valorile care au fost atribuite in aceasta
session_destroy();

header("Location: /gitGaMa/index.php?succes=logoutSucces");
?>