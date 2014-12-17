<?php echo '<html>
 <head>
  <title>PHP Player Test</title>
 </head>
 <body>';
 include_once '/status.class.php'; //include the class
$status = new MinecraftServerListPing(); // call the class
$response = $status->ping17('freebuild.mcmiddleearth.com');
if(!$response) {
    echo"Freebuild is offline!";
} else {
    foreach($response['players'] as $player){
        echo "<img src='http://mcme.co/skin/".$player."' title='".$player."' height='96' width='48'>";
    }
}
$response = $status->ping17('build.mcmiddleearth.com'); 
if(!$response) {
    echo"Build is offline!";
} else {
    foreach($response['players'] as $player){
        echo "<img src='http://mcme.co/skin/".$player."' title='".$player."' height='96' width='48'>";
    }
}
echo '
 </body>
</html>';
?>