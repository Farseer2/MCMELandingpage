<?php
    function isMobileDevice(){
        $aMobileUA = array(
            '/iphone/i' => 'iPhone', 
            '/ipod/i' => 'iPod', 
            '/ipad/i' => 'iPad', 
            '/android/i' => 'Android', 
            '/blackberry/i' => 'BlackBerry', 
            '/webos/i' => 'Mobile'
        );

        foreach($aMobileUA as $sMobileKey => $sMobileOS){
            if(preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT'])){
                return true;
            }
        }
        return false;
    }

    if (isMobileDevice() == true)
    {

    }
    if (isMobileDevice() == false)
    {
?>
<script>
    (function () {
        var bgCounter = 0,
            backgrounds = ["assets/images/bg/1.jpg",
                           "assets/images/bg/2.jpg",
                           "assets/images/bg/3.jpg",
                           "assets/images/bg/4.jpg",
                           "assets/images/bg/5.jpg",
                           "assets/images/bg/6.jpg"], //configurable (TODO)
            descriptions = ["Glittering Caves",  //2
                            "Misty Mountains",  //3
                            "Rivendell",        //4
                            "Harlond",          //5
                            "Paths of the Dead",//6
                            "Misty Mountains"];//1
            //this should be together with the images, 2d array? (TODO)

        function changeBackground() 
        {
            $('#desc').text(descriptions[bgCounter]);
            bgCounter = (bgCounter+1) % backgrounds.length;
            
            $.getJSON('/bracketshome/includes/headerchange.php?img='+backgrounds[bgCounter]+'', function(data) {
                 //alert(data);
                 $(".header,.screenshot-placename").css("color", ""+data+"");
            });
            
            $('body').css('background', 'url('+backgrounds[bgCounter]+') no-repeat center center fixed');
            $("body").css("background-size", "cover");

            setTimeout(changeBackground,10000);

        }
        changeBackground();
    })();
    </script>
<?php } ?>

<!--MODAL-->
<script>
/*var modal = $('.modal');
    $( ".modal-button" ).on( "click", function(e) {
      e.preventDefault();
      $( modal ).toggleClass('modal-show');
    });
    $( ".overlay" ).on( "click", function() {
      $( modal ).toggleClass('modal-show');
    });*/ 
    // (TODO) this ^^
    
    // (TODO) simplify this code :/
    $( "#1.showplist" ).on( "click", function(e) {
        $( ".plist#1" ).fadeOut( "slow", function() {
            $( "#1.fullplist" ).fadeIn( "slow", function() {
          });
        });
    }); 
    $( "#2.showplist" ).on( "click", function(e) {
        $( ".plist#2" ).fadeOut( "slow", function() {
            $( "#2.fullplist" ).fadeIn( "slow", function() {
          });
        });
    }); 
</script>