<?php
    function checkMojangOnline($service) {
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
    }
    function checkMCServerOnline($server) {
        $server_port = 25565;

        $fp = @fsockopen($server, $server_port, $errno, $errmsg, 1);
        $status = ($fp ? "online" :
                         "offline");

        return $status;
    }
?>
