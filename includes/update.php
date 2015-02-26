<?php include_once("config.php"); ?>
<?php
    $startTime = microtime(true);
    $kotomi_indexFile = "../../";
    $kotomi_container = true;
    $fileDir = dirname(__FILE__)."/{$kotomi_indexFile}";
    require "{$fileDir}/library/Dark/Kotomi/KotomiHeader.php";
?>
<?php 
    global $mysqli;

    function check() 
    {
        XenForo_Session::startPublicSession();
        $visitor = XenForo_Visitor::getInstance();
        
        if ($visitor->isSuperAdmin() === true) 
        {
            if (isset($_GET['update'])) 
            {   
                return "update";
            }
            if (isset($_GET['reset'])) 
            {   
                return "reset";
            }
            else
            {   
                return "noinput";
            }
        }
        else
        {   
            return "noadmin";
        }
    }
    function update()
    { 
        global $mysqli;
        
        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }

        echo 'Success... ' . $mysqli->host_info . "<br />";
        echo 'Retrieving dumpfile' . "<br />";

        $sql = file_get_contents('landingpage.sql');
        if (!$sql){
            die ('Error opening file');
        }

        echo 'processing file <br />';
        mysqli_multi_query($mysqli,$sql);

        echo 'done.';
        $mysqli->close();
    }
?>
<div class="container">
    <?php
        if (check() != "noadmin" && check() == "update" && $_GET['update'] == "OK")
        {
            echo "<h1>Update</h1>";
            echo "Updating database..";
            update();
        }
        if (check() != "noadmin" && check() == "reset")
        {
            echo "<h1>Reset</h1>";
            echo "Sorry, resetting isn't possible at this time.";
        }
        if (check() == "noinput")
        {
            echo "<h1>No input</h1>";
            echo "What are you doing here?";
        }
        if (check() == "noadmin")
        {
            echo "<h1>No Super Admin</h1>";
            echo "You must a Super Admin to access this page.";
        }
    ?>
    Please add OK to your link to confirm updating the database.
    So that it looks like: update.php?update=OK
</div>
<style>
    .container
    {
        text-align: center;
    }
</style>