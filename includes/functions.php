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
    function getOnlinePlayers($query_data) {
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
?>