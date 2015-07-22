<?php require_once('home/includes/functions.php'); ?>
<?php require_once('home/includes/config.php'); ?>
<?php $fileDir = '.'; require_once('home/includes/header.php'); ?>
<?php
//error_reporting(0);
//set_time_limit(5);
    $herodevModel = XenForo_Model::create('HeroDev_MinecraftStatus_Model_MinecraftServer');
    $server1 = $herodevModel->getMinecraftServerById(1);
    $server2 = $herodevModel->getMinecraftServerById(2);

    $freebuildStatus = checkMCServerOnline($server1['address']);
    $buildStatus = checkMCServerOnline($server2['address']);
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='home/assets/styles/style.css'>
        <link rel='stylesheet' href='home/assets/styles/nav.css'>
        <title><?php echo getSetting("info","subHeader");?> | Home</title>
    </head>
    <body>
        <?php include_once("home/includes/nav.php"); ?>
        <h3 id='desc' class='screenshot-placename'>
            <?php 
                $result = $mysqli->query("SELECT *
                                FROM images
                                WHERE name='bg1'");  
    
                $row = mysqli_fetch_array($result); echo $row['description'];
            ?>
        </h3>
        <div class="ips">
            <h3 class="ip-header"><?php echo $server1['address']; ?></h3>
            <h3 class="ip-header"><?php echo $server2['address']; ?></h3>
        </div>
        <div class='header'>
            <img class='logo' src='home/assets/images/Icons/logo.png'>
            <h1 class='header1'><?php echo getSetting("info","Header");?></h1>
            <h2 class='header2'><?php echo getSetting("info","subHeader");?></h2>
            <div class="clear"></div>
        </div>
        <div class="container">
            <div class='sidebar'>
                <div class="left-side">
                    <div class="user-info">
                        <?php
                            if ($user_id != null) {

                                $userModel = XenForo_Model::create('XenForo_Model_User');
                                $alertModel = Xenforo_Model::create('Xenforo_Model_User');
                                
                                //XenForo_Model_Alert::alert($visitor['user_id'], 2, "Aaldim", "post", 2, "insert");
                                //XenForo_Model_Alert::getAlertsForUser(1,"get");

                                $avatarUrl = XenForo_Template_Helper_Core::callHelper('avatar', array($visitor->toArray(), 'm', null, false));

                                echo '<img class="avatar" src="/'.$avatarUrl.'">';
                                echo '<a href="/index.php?members/'.$user_id.'"><p class="username link">'.$visitor["username"].'</p></a>';

                                echo '<ul class="userstats">';
                                echo '<li>Messages: '.$visitor['message_count'].'</li>'; 
                                echo '<li>Likes: '.$visitor['like_count'].'</li>'; 
                                echo '<li>Points: '.$visitor['trophy_points'].'</li>'; 

                            } else {
                                echo "<a href='http://www.mcmiddleearth.com/faq/'><div class='button modal-button'>JOIN US</div></a>
                                or<a class='link' href='/login/'> login</a>";
                            }  
                        ?>
                        </ul>
                    </div>
                    <div class='side-header'>Servers</div>
                    <div class='side-content'>
                        <div class='server-status'>
                            <div class='status-row'>
                                <a tooltip="<?php echo $server1['address']; ?>"><p class='status-name'><?php echo $server1['name']; ?></p></a>
                                <p class='<?php if($buildStatus == 'offline') echo "offline status'>Offline"; else echo "online status'>Online"?></p>
                            </div>
                            <div class='status-row'>
                                <div class="list">
                                    <?php
                                        if ($buildStatus != 'offline') getPlayerList(1); else echo "<p>Couldn't fetch Playerlist..</p>";
                                    ?>
                                </div>
                            </div>
                            <div class='status-row'>
                                <a tooltip="<?php echo $server2['address']; ?>"><p class='status-name'><?php echo $server2['name']; ?></p></a>
                                <p class='<?php if($freebuildStatus == 'offline') echo "offline status'>Offline"; else echo "online status'>Online"?></p>
                            </div>
                            <div class='status-row'>
                                <div class="list" id="list">
                                    <?php
                                        if ($freebuildStatus != 'offline') getPlayerList(2); else echo "<p>Couldn't fetch Playerlist..</p>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="middle-side">
                        <div class='side-header'>Staff Online Now</div>
                        <div class='staff-list'>
                            <ul>
                                <?php 
                                    $sessionModel = XenForo_Model::create('XenForo_Model_Session');

                                    $onlineUsers = $sessionModel->getSessionActivityQuickList(
                                        $visitor->toArray(),
                                        array('cutOff' => array('>', $sessionModel->getOnlineStatusTimeout())),
                                        ($visitor['user_id'] ? $visitor->toArray() : null)
                                    );
                                    foreach($onlineUsers['records'] as $user) 
                                    {
                                        $avatarUrl = XenForo_Template_Helper_Core::callHelper('avatar', array($user, 'm', null, false));
                                        $url = "/index.php?members/".$user['user_id']."";

                                        if($user['is_staff'] == true) 
                                        {
                                            echo "<li><img class='staff-pic' src='/$avatarUrl'><a href=".$url." class='link'>".$user['username']."</a><p class='staff'></p></li>";
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class='side-header'>Jobs</div>
                            <div class="jobs">
                                <?php 
                                    if(getSetting("info","useJobs") == 1) 
                                        fetchJobs(); 
                                    else if(getSetting("info","useJobs") == 0)
                                        echo "hi";
                                ?>
                                <?php
                                /* (TODO) add themes a some point */ 
                                /*
                                    $threadModel = XenForo_Model::create('XenForo_Model_Thread');

                                    $threads = $threadModel->getStickyThreadsInForum(4);

                                    $themeDates = array();

                                    foreach($threads as $thread)
                                    {
                                        $themeDates[$thread["thread_id"]] = $thread["post_date"];

                                        $theme = array_search(max($themeDates), $themeDates);

                                    }
                                    if (strpos($threads[$theme]["title"], "Project Build") != true && strpos($threads[$theme]["title"], "Concept Build") != true)
                                    {
                                        echo "<div class='job-title theme'>".$threads[$theme]["title"]."</div>";
                                    }
                                    else if (strpos($threads[$theme]["title"], "Project Build") == true)
                                    {
                                        echo "<div class='job-title project'>".$threads[$theme]["title"]."</div>";
                                    }
                                    else if (strpos($threads[$theme]["title"], "Concept Build") == true)
                                    {
                                        echo "<div class='job-title concept'>".$threads[$theme]["title"]."</div>";
                                    }
                                    */
                                ?>
                            </div>
                    </div>
                    <div class="right-side"> <!-- DISABLED FOR NOW (TODO) -->
                        <!--<div clas='mojang'>
                            <div class='side-header'>Mojang</div>
                            <div class='status-row'>
                                <p class='status-name'>Website</p><p class='<?php if(checkMojangOnline('website') == 'red') echo "offline status'>Online"; 
                                                                                                                        else echo "online status'>online</p>";?>

                            </div>
                            <div class='status-row'>
                                <p class='ip'>minecraft.net</p>
                            </div>
                            <div class='status-row'>
                            <p class='status-name'>login</p><p class='<?php if(checkMojangOnline('login') == 'red') echo "offline status'>Online"; 
                                                                                                                        else echo "online status'>online</p>";?>

                            </div>
                            <div class='status-row'>
                                <p class='ip'>Login Server</p>
                            </div>
                            <div class='status-row'>
                                <p class='status-name'>Session</p><p class='<?php if(checkMojangOnline('session') == 'red') echo "offline status'>Online"; 
                                                                                                                        else echo "online status'>online</p>";?>

                            </div>
                            <div class='status-row'>
                                <p class='ip'>Session Server</p>
                            </div>
                            <div class='status-row'>
                                <p class='status-name'>Skin</p><p class='<?php if(checkMojangOnline('session') == 'red') echo "offline status'>Online"; 
                                                                                                                        else echo "online status'>online</p>";?>

                            </div>
                            <div class='status-row'>
                                <p class='ip'>Skin Server</p>
                            </div>
                        </div>-->
                    </div>
                </div>
            <div class="clear"></div>
            </div>
            <div class='news'>
                <div class="articles">
                    <?php
                        /* (TODO) Configurable */
                        $threadModel = XenForo_Model::create('XenForo_Model_Thread');
                        $conditions = array();
                        $options = array('join' => XenForo_Model_Thread::FETCH_FIRSTPOST,
                                        'limit' => getSetting("info","threadLimit"),
                                        'order'          => 'thread_id');
                        $threads = $threadModel->getThreadsInForum(2, $conditions, $options);
                        foreach ($threads AS $threadId => $thread) {
                            if ($threadModel->canViewThread($thread,$thread) && $thread['cta_ft_featured'] == 1) {
                              echo '<div class="article">
                                            <h3 class="article-header">' . XenForo_Helper_String::wholeWordTrim($thread['title'], 48) . '</h3>  
                                            <p>' . XenForo_Helper_String::wholeWordTrim($thread['message'], 440) . '</p> 
                                            <span class="replycount">Replies: ' . $thread['reply_count'] . '</span><br />
                                            <a class="link readmore" href="' . XenForo_Link::buildPublicLink('canonical:threads', $thread) . '">Read More</a>
                                        </div>';
                            }
                            //var_dump($thread);
                        }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
            <!--
        <div class='footer'>
            <img class='logo' src='home/assets/images/Icons/logo.png'>
            <div class="footer-left">
                <h3>About Us</h3>
                <p>Our community recreates the world of Middle Earth as described by J.R.R. Tolkien's books. Through online collaboration between people of different countries and of all ages, we build that world block by block within a Minecraft server.</p>
                <p class="credits">Forum software:          <a href="https://xenforo.com/" class="link">xenforo</a></p>
                <p class="credits">Home page Designers:</br><a href="http://www.mcmiddleearth.com/members/aaldim.112/" class="link">Aaldim</a>, 
                                                            <a href="http://www.mcmiddleearth.com/members/ivan1pl.19/" class="link">Ivan1pl</a>,
                                                            <a href="http://www.mcmiddleearth.com/members/dallen.1020/" class="link">Dallen</a</p>
            </div>
            <div class="footer-middle">
                <h3>Contact Us</h3>
                <p>The administrator of the project is  <a href="http://www.mcmiddleearth.com/members/q220.1/" class="link">q220</a>. 
For inquires or questions, please direct yourself to    <a href="http://www.mcmiddleearth.com/members/q220.1/" class="link">q220</a>, or use the 
                                                        <a href="http://www.mcmiddleearth.com/misc/contact" class="link">Contact Us</a> page.
                                                        <a href="http://www.mcmiddleearth.com/misc/contact" class="link">Contact Administrator</a></p>


<p>A list of the current Staff members can be found under the <a href="http://www.mcmiddleearth.com/members/?type=staff" class="link">Staff Members</a></p>
            </div>
            <div class="footer-right">
                <h3>Support Us</h3>
                <p>This community has no income whatsoever through advertisements or selling products. While hosting a website and game server not only requires a massive time investment to maintain, it also costs a lot of money. You can help us by making a voluntary donation towards the Community Costs to help keep the community stay alive.</p><a href="http://www.mcmiddleearth.com/donate/"><div class='button donate'>Donate to us!</div></a>
            </div>
            <div class="clear"></div>
        </div>
        -->
<!--MODAL-->
          <div class="modal">
           <div class="overlay"></div>
               <div class="modal_contents modal-transition">
                <div class="modal-header">
                  <span class="close"> X </span>
                  <img class="logo" src="http://www.mcmiddleearth.com/styles/uix/uix/logo.png">
                  <h3>Welcome to MCME!</h3>
                </div>
                <div class="modal-body">
                  <div class="content-left">
                  <h3>How to join the server?</h3>
                  <p>blah blah blah</p>
                    <ol>
                      <li>Buildserver</li>
                      <li>Freebuildserver</li>
                      <li></li>
                    </ol>
                  </div>
                  <div class="content-right">
                    <h3>How to get into Middle Earth?</h3>
                   <p>Information for the quiz... blah blah</p>
                 </div>
               </div>
             </div>
        </div>
<!--//MODAL-->
        <script src='home/assets/scripts/jquery-1.11.2.min.js'></script>
        <?php include_once("home/assets/scripts/script.php"); ?>
    </body>
</html>
    <?php 
    XenForo_Template_Public::setStyleId(2);
    $template = $dependencies->createTemplateObject('uix_extendedFooter', $params);
        echo $template->render();
    ?>