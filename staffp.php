<?php require_once('includes/functions.php'); ?>
<?php require_once('includes/config.php'); ?>
<?php
    $startTime = microtime(true);
    $kotomi_indexFile = "../";
    $kotomi_container = true;
    $fileDir = dirname(__FILE__)."/{$kotomi_indexFile}";
    require "{$fileDir}/library/Dark/Kotomi/KotomiHeader.php";

    global $mysqli;
?>
<?php
    XenForo_Session::startPublicSession();
    $visitor = XenForo_Visitor::getInstance();

    if ($visitor->isMemberOf(3) == false)
    {
        echo "<h1>You must be staff to continue</h1>";
    }
    if (getSetting("info","useStaffPage") == 0)
    {
        echo "<h1>Staff page not enabled by Administrator</h1>";
    }
    if ($visitor->isMemberOf(3) == true && getSetting("info","useStaffPage") == 1)
    {
?>
<html>
    <head>
        <link rel='stylesheet' href='assets/styles/staff.css'>
        <link rel='stylesheet' href='assets/styles/nav.css'>
        <title>Minecraft Middle Earth | Home</title>
    </head>
    <body>
        <?php include_once("includes/nav.php"); ?>
        <div class="row">
            <h1>Staff Page</h1>
            <div class="settings"> <!--(TODO) make a loop here :/ -->
                <?php
                    $result = $mysqli->query("SELECT info,name FROM settings WHERE type='staff'");

                    while($row=mysqli_fetch_array($result))
                    {   
                          echo '<span>
                            <input class="slide" type="text" placeholder="'.getSetting("info",$row["name"]).'"/><label>'.$row["name"].'</label>
                          </span>';
                    }
                ?>
                <!--SUPER ADMIN CONFIG-->
                <?php if ($visitor->isMemberOf(3) == true) {?>
                    <?php
                        $result = $mysqli->query("SELECT info,name FROM settings WHERE type='admin'");

                        while($row=mysqli_fetch_array($result))
                        {   
                              echo '<span>
                                <input class="slide admin" type="text" placeholder="'.getSetting("info",$row["name"]).'"/><label>'.$row["name"].'</label>
                              </span>';
                        }
                    ?>
                <?php } ?>
            </div>
        </div>
    </body>
</html>
<?php } ?>