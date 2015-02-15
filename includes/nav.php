<?php
    XenForo_Session::startPublicSession();
    $visitor = XenForo_Visitor::getInstance();
    $user_id = $visitor->getUserId();
?>
    <div class='navbar'>
            <ul class='nav'>
                <li><a href='<?php echo getSetting("info","homeLink");?>'>HOME</a></li>
                <li><a href='<?php echo getSetting("info","forumsLink");?>'>FORUMS</a></li>
                <li><a href='<?php echo getSetting("info","donateLink");?>'>DONATE</a></li>
                <li><a href='<?php echo getSetting("info","mediaLink");?>'>MEDIA</a></li>
                <li><a href='<?php echo getSetting("info","resourcesLink");?>'>RESOURCES</a></li>
                <li><a href='<?php echo getSetting("info","wikiLink");?>'>WIKI</a></li>
                <li><a href='<?php echo getSetting("info","NewPlayersLink");?>'>NEW PLAYERS</a></li>
                <?php 
                    if (!$user_id != null) 
                    { 
                        echo "<li class='right'><a href='/index.php/login'>LOGIN</a></li>";
                    }
                    else
                    {
                        echo '<li class="right"><a href="/index.php?members/'.$user_id.'">'.$visitor["username"].'</a></li>';
                    }
                ?>
            </ul>
        </div>