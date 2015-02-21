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
    }
    if ($visitor['is_admin'] == true)
    {
?>
    <?php include_once("includes/functions.php");?>
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/nav.css">
    <?php if (file_exists("VERSION")) { ?>
    <div class="container">
        <h1>Install Landingpage</h1>
        <form action="adminp.php">
            <input class="button reset" type="submit" name="Reset" value="Reset"/>
            <input class="button install" type="submit" name="Install" value="Install"/>
        </form>
    </div>
    <?php
    //Install
        function Install()
        {
            echo "<div class='container'>installing!</div>";

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
        .container{text-align:center;}
        body{background: white;}
    </style>
    <script src='assets/scripts/jquery-1.11.2.min.js'></script>
<?php
}
?>