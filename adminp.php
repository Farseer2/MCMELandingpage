<?php include_once("includes/functions.php");?>
<link rel="stylesheet" href="assets/styles/admin.css">
<?php if (file_exists("VERSION")) { ?>
<?php
/* REQUIREMENTS CHECK */
	$db = mysqli_select_db($mysqli,"landingpage");

//TESTS
	$errors = array();
    $founds = array();

	$phpVersion = phpversion();
//version
	if (version_compare($phpVersion, '5.2.11', '<'))
	{
		$errors['phpVersion'] = 'PHP 5.2.11 or newer is required. ' . $phpVersion . ' does not meet this requirement. Please ask your host to upgrade PHP.';
	}
    else
    {
        $founds['phpVersion'] = "PHP version is 5.2.11 or higher";
    }
//database
	if (!$db)
	{
        $sql = 'CREATE DATABASE landingpage';
        
        if (mysqli_query($sql, $mysql)) 
        {
            $founds['database'] = "Database 'landingpage' not found but created now";
        } 
        else 
        {
            $errors['database'] = 'Error creating database: ' . mysql_error();
        }
	}
    else
    {
        $founds['database'] = "Database 'landingpage' found.";
    }
//mysqli
	if (!function_exists('mysqli_connect'))
	{
		$errors['mysqlPhp'] = 'The required PHP extension MySQLi could not be found. Please ask your host to install this extension.';
	}
    else
    {
        $founds['mysqlPhp'] = "MySQLi extension found.";
    }
//log folder
    if (!is_writable("log/"))
    {
        $errors['log'] = 'The /log/ folder isnt writable. Please change the permissions of the folder.';
    }
    else
    {
        $founds['log'] = "The Log directory is writable.";
    }
?>
<?php
    if ($errors && $founds == 0)
    {
        echo "<h2>Requirements Not Met</h2>";
    }
    if ($founds && $errors == 0)
    {
        echo "<h2>Requirements Met</h2>";
    }
    if ($errors || $founds)
    {
        echo"<h2>Some Requirements Not Met</h2>";
?>
        <ol>
            <?php foreach ($errors AS $error) { echo "<li class='error'>$error</li>"; } ?>
            <?php foreach ($founds AS $found) { echo "<li class='found'>$found</li>"; } ?>
        </ol>
<?php } ?>
<?php
/* INSTALLATION */
//check if no errors were found
    if (1==1)
    {
?>
<form action="adminp.php">
    <input class="isntall-button" type="submit" name="Install" value="Install"/>
</form>
<?php
    }
//Install
    function Install()
    {
        echo "installing!";
        
        if (!file_exists("log/log.txt"))
        {
            $fp = fopen("log/log.txt","wb");
            fclose($fp);
            
            Logger("i","Successfully created Log file");
        }
        else
        {
            Logger("n","Log file already exists, ignoring");
        }
        if (!file_exists("VERSION"))
        {
            $content = getVersion();
            $fp = fopen("VERSION","wb");
            
            fwrite($fp,$content);
            fclose($fp);
            
            Logger("i","Successfully created VERSION file");
        }
        else
        {
            Logger("n","VERSION file already exists, ignoring");
        }
        //database insertion
    }
//on button Click
    if(isset($_GET['Install']))
    {
        Install();
    }
}
?>
<?php
     /*       $sql = "INSERT INTO settings (name, info) VALUES ('Header','MCME')";
            if (!mysql_query($sql))
                {
                die('Error: ' . mysql_error());
                }
                
                    
*/

//updateSetting(array("name","info"),"subHeader","Minecraft Middle Earth");

    //echo getSetting("info","subHeader")['info'];

//setSetting("name,info","staffGroupID",3);
//updateSetting(array("name","info"),"threadLimit",2);

/*
setSetting("name,info","homeLink","http://www.mcmiddleearth.com/");
setSetting("name,info","forumsLink","http://www.mcmiddleearth.com/forums");
setSetting("name,info","donateLink","http://www.mcmiddleearth.com/donate");
setSetting("name,info","mediaLink","http://www.mcmiddleearth.com/media");
setSetting("name,info","resourcesLink","http://www.mcmiddleearth.com/resources");
setSetting("name,info","wikiLink","http://www.mcmiddleearth.com/wiki");
setSetting("name,info","NewPlayersLink","http://www.mcmiddleearth.com/pages/new-player-guide/");
*/

?>