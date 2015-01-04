<?php
/* REQUIREMENTS CHECK */
	$mysql = mysql_connect("localhost", "root", "");
	$db = mysql_select_db('landingpage', $mysql);

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
        
        if (mysql_query($sql, $mysql)) 
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
        echo "<p>You may not proceed until you have met all Requirements</p>";
    }
    if ($founds && $errors == 0)
    {
        echo "<h2>Requirements Met</h2>";
        echo "<p>You can start the installation now</p>";
    }
    if ($errors || $founds)
    {
        echo"<h2>Some Requirements Not Met</h2>";
        echo "<p>You may not proceed until you have met all Requirements</p>";
?>
        <ol>
            <?php foreach ($errors AS $error) { echo "<li class='error'>$error</li>"; } ?>
            <?php foreach ($founds AS $found) { echo "<li class='found'>$found</li>"; } ?>
        </ol>
<?php } ?>
<?php
/* INSTALLATION */

//check if no errors were found
    if ($errors == 0 && $founds == 4)
    {
?>
<form action="admin.php">
    <input type="submit" name="Install" value="Install"/>
</form>
<?php
    }
//Install
    function Install()
    {
        echo "installing!";
        //Database insertion stuff
        
        //Create log.txt with install information and an VERSION with current version
    }

//on button Click
    if(isset($_GET['Install'])){
        Install();
    }

?>