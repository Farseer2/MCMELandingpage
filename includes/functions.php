<?php include_once('config.php'); ?>
<?php
/*
    Functions
*/
    /**
     * Logger
     *
     * Logs errors to the log file.
     *
     * @param type Type of the error: notice, error, or info.
     * @param message Message for the log.
     */
    function Logger($type,$message) //currently no longer used (TODO)
    {
        $date = new DateTime();
        $time = $date->format('Y-m-d H:i:s');
            
        if (strtolower($type) == "n" || strtolower($type) == "notice"):
            $prefix = "[NOTICE]";

        elseif (strtolower($type) == "e" || strtolower($type) == "error"):
            $prefix = "[ERROR]";

        elseif (strtolower($type) == "i" || strtolower($type) == "info"):
            $prefix = "[INFO]";
        endif;

        //error_log($prefix.$message.PHP_EOL, 3, "log/log.txt");
    }
    /**
     * checkMojangOnline
     *
     * Checks if a Mojang service is online or offline.
     *
     * @param service Mojang service: website, skin, login or session.
     * @return green or red (online or offline)
     */
    function checkMojangOnline($service) 
    {
        $MojangServers = file_get_contents("http://status.mojang.com/check");
        $website = "minecraft.net";
        $skin = "skins.minecraft.net";
        $login = "auth.mojang.com";
        $session = "session.minecraft.net";
        
        $ws = 0;
        $ss = 4;
        $sl = 3;
        $sss = 1;
        
        switch($service)
        {
            case 'website': $service = $website; $s=$ws; break;
            case 'skin': $service = $skin; $s=$ss; break;
            case 'login': $service = $login; $s=$sl; break;
            case 'session': $service = $session; $s=$sss; break;
            default: $service = "none"; break;
        }
        if(!empty($MojangServers))
        {
            $result = json_decode($MojangServers, true);
        }
        if ($result[$s]["$service"] == "green")
        {
            return "green";
        }
        if ($result[$s]["$service"] == "red")
        {
            return "red";
        }
        else
        {
            return "An error occoured.";
        }
    }
    /**
     * checkMCServerOnline
     *
     * Checks if a Minecraft Server is online.
     *
     * @param server Minecraft server IP.
     * @return online or offline.
     */
    function checkMCServerOnline($server) 
    {
        $server_port = 25565;
        $fp = @fsockopen($server, $server_port, $errno, $errmsg, 1);
        $status = ($fp ? "online" :
                         "offline");
        return $status;
        
        if($status == "offline")
        {
            Log("Couldn't establish a connection with the '".$server."' server it may be offline or wrongly configured.");
        }
    }
    /**
     * getOnlinePlayers
     *
     * Get online players from a Minecraft server.
     *
     * @param query_data Data from the HeroCraft addon.
     * @return Online players.
     */
    function getOnlinePlayers($query_data) 
    {
        $data = explode(':',$query_data,3);
        $resplayers = Array();
        if($data[0] == 'a') {
            $data[1] = $data[2];
            $data = explode(';',substr($data[1],1,-1),2);
            $field = explode(':',$data[0]);
            while(count($field) < 3 || $field[2] != '"playerList"') {
                $data = explode(';',$data[1],2);
                $field = explode(':',$data[0]);
            }
            $data = explode(':',$data[1],3);
            if($data[0] == 'a' && $data[1] != '0') {
                $regex = '#\{((?>[^\{\}]+)|(?R))*\}#x';
                preg_match($regex,$data[2],$data);
                $data = substr($data[0],1,-1);
                $data = explode(';',$data,2);
                preg_match_all($regex,$data[1],$data);
                $data = $data[1];
                for($i = 0; $i < count($data); ++$i) {
                    $data[$i] = explode(';',$data[$i]);
                    for($j = 0; $j < count($data[$i])-1; ++$j) {
                        $data[$i][$j] = substr(explode(':',$data[$i][$j])[2],1,-1);
                    }
                    for($j = 0; $j < count($data[$i])-1; ++$j) {
                        if($data[$i][$j] == 'username') {
                            array_push($resplayers,$data[$i][$j+1]);
                            break;
                        }
                    }
                }
            }
        }
        return $resplayers;
    }
    /**
     * getPlayerList
     *
     * Get online player list from a Minecraft server.
     *
     * @param server Minecraft server IP.
     * @return Online player list.
     */
    function getPlayerList($server)
    {
        $herodevModel = XenForo_Model::create('HeroDev_MinecraftStatus_Model_MinecraftServer');
        $servers = $herodevModel->getAllMinecraftServers();

        $herodevModel->queryMinecraftServer($server);
        
        $players = getOnlinePlayers($servers[$server]['query_data']); 
        
        if (count($players) != 0) 
        {
            echo "<div id='$server' class='plist'>";
                
            foreach(array_slice($players,0,5) as $player) 
            {

                echo '<a tooltip="'.$player.'"><img class="player-pic" src="https://minotar.net/cube/'.$player.'/100.png"></a>';
            }
            echo "</div>";
            echo "<div id='$server' class='fullplist'>";
            
            foreach($players as $player) 
            {

                echo '<a tooltip="'.$player.'"><img class="player-pic" src="https://minotar.net/cube/'.$player.'/100.png"></a>';
            }
            echo "</div>";
            
            $playerNum = count($players);
            $imgDisplay = 5;
            $moreInList = $playerNum - $imgDisplay;

            if (count($players) > 5) { echo "<div id='$server' class='showplist'><a class='link'><p>And $moreInList more..</p></a></div>";}
        }
        else
        {
            echo "<p>No Players online</p>";
        }
    }
    /**
     * checkVersion
     *
     * Get latest version from Github.
     *
     * @return Current (stable) version from Github.
     */
    function checkVersion()
    {
        $version = file_get_contents("https://raw.githubusercontent.com/aaldim1/MCMELandingpage/master/VERSION");
        
        return $version;
    }
    /**
     * getSetting
     *
     * Get setting from the database.
     * 
     * @param column Select which column.
     * @param setting Select setting.
     * @return The requested value.
     */
    function getSetting($column,$setting) //get a single Setting
    {
        global $mysqli;
        
        $result = $mysqli->query("SELECT $column
                                FROM settings
                                WHERE name='$setting'")->fetch_object()->info;  
        
        return $result;
    }
    function setSetting($column,$setting,$info) //only used for installing & updating
    {
        global $mysqli;
        
        $mysqli->query("INSERT INTO settings ($column) 
                        VALUES ('$setting','$info')");
    }
    function updateSetting($columns=array(),$setting,$info) //used in admin & staff panel
    {
        global $mysqli;

        $results = $mysqli->query("UPDATE settings
                                        SET $columns[1]='$info'
                                        WHERE $columns[0]='$setting'");
    }
    function addJob($jobname, $jobinfo, $joblink, $jobwarp, $expiration)
    {
        global $mysqli;
        
        $mysqli->query("INSERT INTO jobs (name,info,link,warp,expiration) 
                        VALUES ('$jobname','$jobinfo','$joblink','$jobwarp','$expiration')");
    }
    function fetchJobs()
    {
        global $mysqli;
        
        $result = $mysqli->query("SELECT * FROM jobs ORDER BY `expiration` ASC");
        
        if ($result->num_rows == 0)
        {
            echo "<div>No jobs could be found.</div>";
        }
        if($result)
        {
            while($row=mysqli_fetch_array($result))
            {   
                if ($row['expiration'] <= date('Y-m-d') == false)
                {
                    echo '<div class="job-title">'.$row["name"].'</div>';
                    echo '<a href="'.$row["link"].'"><div class="job-link link">Post link</div></a>';
                    echo '<div class="job-info">'.$row["info"].'</div>';
                    echo '<div class="job-warp">'.$row["warp"].'</div>';
                    
                    $date = new DateTime('tomorrow');
                    if ($row['expiration'] == $date->format('Y-m-d'))
                    {
                        echo "<div class='expiration'>ends: <div class='orange'>Tomorrow</div></div>";
                    }
                    if ($row['expiration'] >= date('Y-m-d') && $row['expiration'] != $date->format('Y-m-d'))
                    {
                        echo "<div class='expiration'>ends: <div class='green'>".$row['expiration']."</div></div>";
                    }
                    echo "<div class='separater'></div>";
                }
            }
        }
    }
    function getVersion() 
    {
        $version = file_get_contents("VERSION");
        
        return $version;
    }
    function resetDatabase($db)
    {
        global $mysqli;
        
        $mysqli->query('SET foreign_key_checks = 0');
        if ($result = $mysqli->query("SHOW TABLES"))
        {
            while($row = $result->fetch_array(MYSQLI_NUM))
            {
                $mysqli->query('DROP TABLE IF EXISTS '.$row[0]);
            }
        }

        $mysqli->query('SET foreign_key_checks = 1');
        $mysqli->close();
    }