<?php require_once('includes/functions.php'); ?>
<?php require_once('includes/config.php'); ?>
<?php
    $startTime = microtime(true);
    $kotomi_indexFile = "../";
    $kotomi_container = true;
    $fileDir = dirname(__FILE__)."/{$kotomi_indexFile}";
    require "{$fileDir}/library/Dark/Kotomi/KotomiHeader.php";

    $freebuildStatus = checkMCServerOnline('freebuild.mcmiddleearth.com');
    $buildStatus = checkMCServerOnline('build.mcmiddleearth.com');
?>
<html>
    <head>
        <link rel='stylesheet' href='assets/styles/style.css'>
        <link rel='stylesheet' href='assets/styles/nav.css'>
        <title><?php echo getSetting("info","subHeader");?> | Home</title>
    </head>
    <body>
        <?php include_once("includes/nav.php"); ?>
    <h3 id='desc' class='screenshot-placename'>Glittering Caves</h3>
        <div class='header'>
            <img class='logo' src='assets/images/Icons/logo.png'>
            <h1 class='header1'><?php echo getSetting("info","Header");?></h1>
            <h2 class='header2'><?php echo getSetting("info","subHeader");?></h2>
        </div>
        <div class='news'>
            <?php
                /* (TODO) Configurable */
                $threadModel = XenForo_Model::create('XenForo_Model_Thread');
                $conditions = array();
                $options = array('join' => XenForo_Model_Thread::FETCH_FIRSTPOST,
                                'limit' => getSetting("info","threadLimit"));
                $threads = $threadModel->getThreadsInForum(2, $conditions, $options);
                foreach ($threads AS $threadId => $thread) {
                    if ($threadModel->canViewThread($thread,$thread) && $thread['cta_ft_featured'] == 1) {
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
            <div class="user-info">
                <?php
                    XenForo_Session::startPublicSession();
                    $visitor = XenForo_Visitor::getInstance();
                    $user_id = $visitor->getUserId();
                    if ($user_id != null) {
                        
                        $userModel = XenForo_Model::create('XenForo_Model_User');
                        //$trophyModel = Xenforo_Model::create('Xenforo_Model_Trophy');
                        
                        //$trophycount = $trophyModel->countTrophiesForUserId(1);
                        $avatarUrl = XenForo_Template_Helper_Core::callHelper('avatar', array($visitor->toArray(), 'm', null, false));

                        echo '<img class="avatar" src="/forums/'.$avatarUrl.'">';
                        echo '<a href="/forums/index.php?members/'.$user_id.'"><p class="username link">'.$visitor["username"].'</p></a>';
                        
                        echo '<ul class="userstats">';
                        //echo '<li>Messages: '.$trophycount.'</li>'; //messages (TODO)
                        //echo '<li>Likes: '.$trophycount.'</li>'; //Likes (TODO)
                        //echo '<li>Points: '.$trophycount.'</li>'; //trophy points

                    } else {
                        echo "<div class='button'>JOIN US</div>";
                    }  
/*
                    if ($visitor->isStaff)
                    {
                     echo "<h1>kewl</h1>";
                    }
*/
                ?>
                </ul>
            </div>
            <div class='side-header'>Servers</div>
            <div class='side-content'>
                <div class='server-status'>
                    <div class='status-row'>
                        <a tooltip="build.mcmiddleearth.com"><p class='status-name'>Build</p></a>
                        <p class='<?php if($buildStatus == 'offline') {echo 'offline';}?> status'>Online</p>
                    </div>
                    <div class='status-row'>
                        <div class="list">
                            <?php
                                if ($buildStatus != 'offline') getPlayerList(1); else echo "<p>Couldn't fetch Playerlist..</p>";
                            ?>
                        </div>
                    </div>
                    <div class='status-row'>
                        <a tooltip="freebuild.mcmiddleearth.com"><p class='status-name'>Freebuild</p></a>
                        <p class='<?php if($freebuildStatus == 'offline') {echo 'offline';}?> status'>Online</p>
                    </div>
                    <div class='status-row'>
                        <div class="list" id="list">
                            <?php
                                if ($freebuildStatus != 'offline') getPlayerList(2); else echo "<p>Couldn't fetch Playerlist..</p>";
                            ?>
                        </div>
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
        <!-- (TODO) Footer here-->
        </div>
        <script src='assets/scripts/jquery-1.11.2.min.js'></script>
        <?php include_once("assets/scripts/script.php"); ?>
    </body>
</html>