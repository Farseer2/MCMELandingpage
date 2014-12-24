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
            <div class='article'>
                <h3 class='article-header'>Resource packs updated</h3>
                <p>The following Resourcepacks have been updated to the next milestone (16 Dec 2014):
                <ul>
                    <li>Eriador</li>
                    <li>Lothlorien</li>
                    <li>Gondor</li>
                    <li>Rohan</li>
                </ul>
                <a class='link' href='http://www.mcmiddleearth.com/threads/resource-packs-updated.1935/'>Read More</a>
            </div>
            <div class='separater'></div>
            <div class='article'>
                <h3 class='article-header'>~The MCME Times~ [12/14/14]</h3>
                <img alt='' width='500' src='http://i.imgur.com/qZRemZY.png'>
                <p><h3>Opening Statement</h3>
It's been an interesting week for MCME with lots of things happening, both happy and sad. Projects have been finished and new ones have been started. There have been rumours about a reboot of Pelargir though that would still be a while off.
I've seen the many, many, many suggestions you guys made. And I will take them to heart.</p>
            <a class='link' href='http://www.mcmiddleearth.com/threads/resource-packs-updated.1935/'>Read More</a>
            </div>
        </div>
        <div class='sidebar'>
            <div class='button'>JOIN US</div>
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
