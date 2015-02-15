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
?>
<div class="container">
    <?php
        if (check() != "noadmin" && check() == "update")
        {
            echo "<h1>Update</h1>";
            echo "Are you sure you want to update?";
        }
        if (check() != "noadmin" && check() == "reset")
        {
            echo "<h1>Reset</h1>";
            echo "Are you sure you want to Reset?";
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
</div>
<style>
    .container
    {
        text-align: center;
    }
</style>