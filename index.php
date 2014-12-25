<?php
    $startTime = microtime(true);
    $kotomi_indexFile = "./forums/";
    $kotomi_container = true;
    $fileDir = dirname(__FILE__)."/{$kotomi_indexFile}";
    require "{$fileDir}/library/Dark/Kotomi/KotomiHeader.php";
?>
<?php require_once('includes/functions.php'); ?>
<html>
    <head>
        <link rel='stylesheet' href='assets/styles/style.css'>
        <script src='assets/scripts/jquery-1.11.2.min.js'></script>
        <script src='assets/scripts/script.js'></script>
        <title>Minecraft Middle Earth | Home</title>
    </head>
    <body>
        <div class='navbar'>
            <ul class='nav'>
                <li><a href='#'>HOME</a></li>
                <li><a href='forums'>FORUMS</a></li>
                <li><a href='#'>DONATE</a></li>
                <li><a href='#'>MEDIA</a></li>
                <li><a href='#'>RESOURCES</a></li>
                <li><a href='#'>WIKI</a></li>
                <li><a href='#'>NEW PLAYERS</a></li>
            </ul>
        </div>
        
    <h3 id='desc' class='screenshot-placename'>Glittering Caves</h3>
        <div class='header'>
            <img class='logo' src='assets/images/Icons/logo.png'>
            <h1 class='header1'>MCME</h1>
            <h2 class='header2'>minecraft middle earth</h2>
        </div>
        <div class='news'>
            <?php
                /* TODO: Configurable */
                $threadModel = XenForo_Model::create('XenForo_Model_Thread');
                $conditions = array();
                $options = array('join' => XenForo_Model_Thread::FETCH_FIRSTPOST,
                                'limit' => 2);
                $threads = $threadModel->getThreadsInForum(2, $conditions, $options);
                foreach ($threads AS $threadId => $thread) {
                    if ($threadModel->canViewThread($thread,$thread)) {
                      echo '<div class="article">
                                    <h3 class="article-header">' . XenForo_Helper_String::wholeWordTrim($thread['title'], 48) . '</h3>  
                                    <p>' . XenForo_Helper_String::wholeWordTrim($thread['message'], 440) . '</p> 
                                    <span class="replycount">Replies: ' . $thread['reply_count'] . '</span><br />
                                    <a class="link" href="' . XenForo_Link::buildPublicLink('canonical:threads', $thread) . '">Read More</a>
                                </div>';
                    }
                }
            ?>
        </div>
        <div class='sidebar'>
            <?php
                XenForo_Session::startPublicSession();
                $visitor = XenForo_Visitor::getInstance();
                $user_id = $visitor->getUserId();
                if ($user_id != null) {

                    $userModel = XenForo_Model::create('XenForo_Model_User');
                    $trophyModel = Xenforo_Model::create('Xenforo_Model_Trophy');

                    $trophycount = $trophyModel->countTrophiesForUserId(1);
                    $avatarUrl = XenForo_Template_Helper_Core::callHelper('avatar', array($visitor->toArray(), 'm', null, false));
                
                    echo '<img alt="" width="100" height="100" src="/forums/'.$avatarUrl.'">';
                    echo $visitor['username']."</br>";
                    echo $trophycount;

                } else {
                    echo "<div class='button'>JOIN US</div>";
                }            
            ?>
            <div class='side-header'>Servers</div>
            <div class='side-content'>
                <div class='server-status'>
                    <div class='status-row'>
                        <p class='status-name'>Build</p><p class='<?php if(checkMCServerOnline('build.mcmiddleearth.com') == 'offline') {echo 'offline';}?> status'>Online</p>
                    </div>
                    <div class='status-row'>
                        <p class='ip'>build.mcmiddleearth.com</p>
                    </div>
                    <div class='status-row'>
                        <p class='status-name'>Freebuild</p><p class='<?php if(checkMCServerOnline('freebuild.mcmiddleearth.com') == 'offline') {echo 'offline';}?> status'>Online</p>
                    </div>
                    <div class='status-row'>
                        <p class='ip'>freebuild.mcmiddleearth.com</p>
                    </div>
                    <div class='status-row'>
                        <p class='status-name'>PVP</p><p class='<?php if(checkMCServerOnline('pvp.mcmiddleearth.com') == 'offline') {echo 'offline';}?> status'>Offline</p>
                    </div>
                    <div class='status-row'>
                        <p class='ip'>pvp.mcmiddleearth.com</p>
                    </div>
                </div>
                <div class='side-header'>Staff Online Now</div>
                <div class='staff-list'>
                    <ul>
                        <li><img class='staff-pic' src='http://www.mcmiddleearth.com/data/avatars/l/0/43.jpg?1394287711'>MaDIIReD<p class='staff'></p></li>
                        <li><img class='staff-pic' src='http://www.mcmiddleearth.com/data/avatars/l/0/5.jpg?1414188440'>Ghundra<p class='staff'></p></li>
                    </ul>
                </div>
                <div class='side-header'>Jobs</div>
                <div class='jobs'>
                    <p class='job'>RoadJob1</p><p class='ip'>Public</p>
                </div>
                <div class='side-header'>Mojang</div>
                <div clas='services'>
                    <div class='status-row'>
                        <p class='status-name'>WebSite</p><p class='<?php if(checkMojangOnline('website') == 'red') {echo 'offline';}?> status'>Online</p>
                    </div>
                    <div class='status-row'>
                        <p class='ip'>minecraft.net</p>
                    </div>
                    <div class='status-row'>
                        <p class='status-name'>Login</p><p class='<?php if(checkMojangOnline('login') == 'red') {echo 'offline';}?> status'>Online</p>
                    </div>
                    <div class='status-row'>
                        <p class='ip'>Login Server</p>
                    </div>
                    <div class='status-row'>
                        <p class='status-name'>Session</p><p class='<?php if(checkMojangOnline('session') == 'red') {echo 'offline';}?> status'>Online</p>
                    </div>
                    <div class='status-row'>
                        <p class='ip'>Session Server</p>
                    </div>
                    <div class='status-row'>
                        <p class='status-name'>Skin</p><p class='<?php if(checkMojangOnline('skin') == 'red') {echo 'offline';}?> status'>Online</p>
                    </div>
                    <div class='status-row'>
                        <p class='ip'>Skin Server</p>
                    </div>
                </div>
            </div>
        </div>
        <div id='footer'>
        <!-- TODO: Footer here-->
        </div>
    </body>
</html>

