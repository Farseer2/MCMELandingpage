<?php require_once('includes/functions.php'); ?>
<?php require_once('includes/config.php'); ?>
<?php require_once('includes/header.php'); ?>
<?php
    $visitor = XenForo_Visitor::getInstance();

    $currentVersion = getVersion();
    $ghVersion = checkVersion();

    if($visitor['is_staff'] == false)
    {
        echo "<h1>You must be staff to continue</h1>";
    }
    if (getSetting("info","useStaffPage") == 0)
    {
        echo "<h1>Staff page not enabled by Administrator</h1>";
    }
   if($visitor['is_staff'] == true && getSetting("info","useStaffPage") == 1)
    {
        if (isset($_GET['update'])) //when the update button is clicked..
        {
            function updateSettings() //..get inputs and update the values in the database
            {
                global $mysqli;
                sleep(2);
                
                if(isset($_POST['staffSettings']) == true)
                {
                    $staffSettings = $_POST['staffSettings'];
                    
                    foreach($staffSettings as $staffSetting => $staffValue)
                    {   
                        if($staffValue != "")
                        {
                            updateSetting(array("name","info"),$staffSetting,$staffValue);
                            header('location:staffp.php');
                        }
                    }
                }    
                if(isset($_POST['adminSettings']) == true)
                {
                    $adminSettings = $_POST['adminSettings'];
                    
                    foreach($adminSettings as $adminSetting => $adminValue)
                    {
                        updateSetting(array("name","info"),$adminSetting,$adminValue);
                    }
                }
            }
            updateSettings();
        }
       if (isset($_GET['addjob']))
       {
           function addNewJob()
           {   
               global $mysqli;
               //addJob($jobname, $jobinfo, $joblink, $jobwarp, $expiration)
                $jobValues = $_POST['jobValues'];
               
                if($jobValues['name'] != "")
                { 
                    addJob($jobValues['name'], $jobValues['info'], $jobValues['link'], $jobValues['warp'], $jobValues['expiration']);
                    header('location:staffp.php');
                }
           }
           addNewJob();
       }
      // var_dump($_POST['jobValues']);
       
?>
<html>
    <head>
        <link rel='stylesheet' href='assets/styles/staff.css' media="screen" type="text/css" >
        <link rel='stylesheet' href='assets/styles/nav.css'>
        <title>Minecraft Middle Earth | Home</title>
    </head>
    <body>
        <div class="row">
            <h1>Staff Page</h1>
            <div class="settings"> 
                <div class="tab">
                    <ul class="tabs">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Staff settings</a></li>
                        <li><a href="#">Jobs</a></li>
                        <li><a href="#">Updates</a></li>
                        <li><a href="#">Customize</a></li>
                        <li><a href="#">Admin settings</a></li>
                    </ul>
                    <div class="tab_content">
                        <div class="tabs_item">
                            <h4>Home</h4>
                            <p>Home page of the Staff settings page</p>
                        </div>
                        <div class="tabs_item" style="display:none;">
                            <h4>Staff settings</h4>
                            <form name="form" action="staffp.php?update=update" method="post">
                                <?php
                                    $result = $mysqli->query("SELECT info,name FROM settings WHERE type='staff'");

                                    while($row=mysqli_fetch_array($result))
                                    {   
                                          echo '<span>
                                            <input name="staffSettings['.$row["name"].']" class="slide" type="text" placeholder="'.getSetting("info",$row["name"]).'"/><label>'.$row["name"].'</label>
                                          </span>';
                                    }
                                ?>
                                <div class="load-container"><p>Saving values</p><div class="loader"></div></div>
                                <input id="update" type="submit" class="button update-settings" value="update"></input>
                            </form>
                        </div>
                        <div class="tabs_item">
                            <h4>Jobs</h4>
                            <form name="form" action="staffp.php?addjob=addjob" method="post">
                                <!--addJob($jobname, $jobinfo, $joblink, $jobwarp, $expiration)-->
                                <div class="job-inputs">
                                    <div class="job-input">
                                        <label>Name:</label>
                                        <input name="jobValues[name]" class="input" type="text" required/>
                                    </div>
                                    <div class="job-input">
                                        <label>Info:</label>
                                        <input name="jobValues[info]" class="input" type="text" required/>
                                    </div>
                                    <div class="job-input">
                                        <label>Link:</label>
                                        <input name="jobValues[link]" class="input" type="text" required/>
                                    </div>
                                     <div class="job-input">
                                        <label>Warp:</label>
                                        <input name="jobValues[warp]" class="input" type="text" required/>
                                    </div>
                                    <div class="job-input">
                                        <label>Expiration:</label>
                                        <input name="jobValues[expiration]" id="datepicker" class="input job-expiration" type="text" required/>
                                    </div>
                                </div>
                                <div class="load-container"><p>Saving values</p><div class="loader"></div></div>
                                <input id="add" type="submit" class="button update-settings add" value="add"></input>
                            </form>
                        </div>
                        <div class="tabs_item">
                            <h4>Updates</h4>
                            <p>You may not have permissions to update the LandingPage.</p>
                            <a href="/bracketsHome/adminp.php"><div class="button">Update</div></a> <!--(TODO) fix this -->
                        </div>
                        <div class="tabs_item">
                            <h4>Customize</h4>
                            <h3>There is being worked on this feature. So it isn't available yet.</h3>
                        </div>
                        <div class="tabs_item">
                            <h4>Admin settings</h4>
                            <!--SUPER ADMIN CONFIG-->
                            <?php 
                                if ($visitor->isMemberOf(3) === true) 
                                    {
                            ?>
                            <form name="form" action="staffp.php?update=update/#update" method="post">
                                <?php
                                    $result = $mysqli->query("SELECT info,name FROM settings WHERE type='admin'");

                                    while($row=mysqli_fetch_array($result))
                                    {   
                                          echo '<span>
                                            <input name="adminSettings['.$row["name"].']" class="slide admin" type="text" placeholder="'.getSetting("info",$row["name"]).'"/><label>'.$row["name"].'</label>
                                          </span>';
                                    }
                                ?>
                                <div class="load-container"><p>Saving values</p><div class="loader"></div></div>
                                <input id="update" type="submit" class="button update-settings" value="update"></input>
                            </form>
                            <?php   
                                }
                                else
                                {
                                    echo "<h3>You must be Super Admin to change or view these settings.</h3>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src='assets/scripts/jquery-1.11.2.min.js'></script>
<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
        <script>
            //tabs
            $(document).ready(function() { 
                
                (function ($) { 
                    $('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
                    $('.tab ul.tabs li a').click(function (g) { 
                        var tab = $(this).closest('.tab'), 
                            index = $(this).closest('li').index();

                        tab.find('ul.tabs > li').removeClass('current');
                        $(this).closest('li').addClass('current');

                        tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
                        tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();

                        g.preventDefault();
                    } );
                })(jQuery);
                
            });
            //loading animation
            document.querySelector("#update").addEventListener("click", function(){
                $( "#update" ).fadeOut( "slow", function() {
                document.querySelector(".load-container").style.display = "block";
              });
            });
            
          $(function() {
            $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' }).val()
          });
        </script>
    </body>
</html>
<?php } ?>