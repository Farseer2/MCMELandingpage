<?php include_once("config.php"); ?>
<?php header('Conent-type: application/json'); ?>
<?php
    $filename = $_GET['bg'];

    global $mysqli;
    
    $result = $mysqli->query("SELECT *
                                FROM images
                                WHERE name='$filename'");  
    
    $row = mysqli_fetch_array($result);
        
    print_r(json_encode($row));