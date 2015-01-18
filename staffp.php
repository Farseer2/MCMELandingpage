<?php require_once('includes/functions.php'); ?>
<?php require_once('includes/config.php'); ?>
<?php
    $startTime = microtime(true);
    $kotomi_indexFile = "../";
    $kotomi_container = true;
    $fileDir = dirname(__FILE__)."/{$kotomi_indexFile}";
    require "{$fileDir}/library/Dark/Kotomi/KotomiHeader.php";
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
              <span>
                <input class="slide" type="text" placeholder="<?php echo getSetting("info","Header");?>" /><label>Header</label>
              </span>
              <span>
                <input class="slide" type="text" placeholder="<?php echo getSetting("info","subHeader");?>" /><label>Sub Header</label>
              </span>
              <span>
                <input class="slide" type="text" placeholder="<?php echo getSetting("info","threadLimit");?>" /><label>Thread Limit</label>
              </span>
                <span>
                <input class="slide" type="text" placeholder="<?php echo getSetting("info","homeLink");?>" /><label>Home Link</label>
              </span>
                <span>
                <input class="slide" type="text" placeholder="<?php echo getSetting("info","forumsLink");?>" /><label>Home Link</label>
              </span>
                 <span>
                <input class="slide" type="text" placeholder="<?php echo getSetting("info","donateLink");?>" /><label>Donate Link</label>
              </span>
                <span>
                <input class="slide" type="text" placeholder="<?php echo getSetting("info","mediaLink");?>" /><label>Media Link</label>
              </span>
                <span>
                <input class="slide" type="text" placeholder="<?php echo getSetting("info","resourcesLink");?>" /><label>Resources Link</label>
              </span>
                <span>
                <input class="slide" type="text" placeholder="<?php echo getSetting("info","wikiLink");?>" /><label>Wiki Link</label>
              </span>
                <span>
                <input class="slide" type="text" placeholder="<?php echo getSetting("info","NewPlayersLink");?>" /><label>New Players Link</label>
              </span>
                <!--SUPER ADMIN CONFIG-->
                <?php if ($visitor->isMemberOf(3) == true) {?>
                  <span>
                    <input class="slide admin" type="text" placeholder="<?php echo getSetting("info","useLog");?>" /><label>Use Log</label>
                  </span>
                  <span>
                    <input class="slide admin" type="text" placeholder="<?php echo getSetting("info","useStaffPage");?>" /><label>Use Staff Page</label>
                  </span>
                  <span>
                    <input class="slide admin" type="text" placeholder="<?php echo getSetting("info","staffGroupID");?>" /><label>Staff group ID</label>
                  </span>
                <?php } ?>
            </div>
        </div>
    </body>
</html>
<?php } ?>