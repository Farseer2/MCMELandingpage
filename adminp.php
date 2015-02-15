<?php
    $startTime = microtime(true);
    $fileDir = '../';

    require($fileDir . '/library/XenForo/Autoloader.php');
    XenForo_Autoloader::getInstance()->setupAutoloader($fileDir . '/library');

    XenForo_Application::initialize($fileDir . '/library', $fileDir);
    XenForo_Application::set('page_start_time', $startTime);

    XenForo_Session::startPublicSession();

    $visitor = XenForo_Visitor::getInstance();
        
    if ($visitor['is_admin'] != true)
    {
        echo "<div class='container'><h1>You must be Super Admin to continue</h1>";
        echo "<form><INPUT Type='button' value='Go back' onClick='history.go(-1);return true;'></form></div>";
        echo "<style>.container{text-align:center;}</style>"; //just to make things a little nice ;)
    }
    if ($visitor['is_admin'] == true)
    {
?>
    <?php include_once("includes/functions.php");?>
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/nav.css">
    <?php if (file_exists("VERSION")) { ?>
    <?php
    /* REQUIREMENTS CHECK */
        global $mysqli; //(TODO) fix this check! also on line 47-64
//        $db = mysqli_select_db($mysqli,"landingpage");

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
        /*if (!$db)
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
        }*/
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
    <div class="install-form">
        <div class="req">
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
        </div>
        <?php
        /* INSTALLATION */
        //check if no errors were found
            if (1==1)
            {
        ?>
        <form action="adminp.php">
            <input class="button reset" type="submit" name="Reset" value="Reset"/>
            <input class="button install" type="submit" name="Install" value="Install"/>
        </form>
    </div>
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
    <style>
        body
        {
            background: white;
            transition: none;
        }
        li
        {
            list-style-type: none;
        }
        .button
        {
            font-size: 35;

            width: 6em;
            width: 150px;
            height: 50px;

            border: 0;
            outline: 0;
        }
        .req
        {
            text-align:center;
        }
        .install
        {
            float: right;
            margin-right: 450px;
        }
        .reset
        {
            float:left;
            margin-left: 450px;
        }
        .install-form
        {
            background: lightgrey;
            height:50%;
        }
    </style>
    <script src='assets/scripts/jquery-1.11.2.min.js'></script>
      <script>
      $(function() {
        $( "#dialog" ).dialog();
      });
      </script>

    <div id="dialog" title="Basic dialog">
      <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
    </div>
<?php
}
?>