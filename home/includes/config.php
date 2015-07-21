<?php
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "landingpage";
?>
<?php   
    global $mysqli;
    $mysqli = new mysqli("$hostname", "$username", "$password","$database");