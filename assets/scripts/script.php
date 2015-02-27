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
        //user is using mobile device, don't load the image switcher code
    }
    if (isMobileDevice() == false)
    {
?>
<script>
    (function () {
        var bgCounter = 0,
            backgrounds = [],
            descriptions = [],
            bgNames = ["bg1","bg2","bg3","bg4","bg5","bg6"];
        

        var i;
        function getBackgrounds()
        {
            for(i = 0; i < bgNames.length; i++) 
            {
                $.getJSON('/home/includes/backgrounds.php?bg='+bgNames[i]+'', function(data) {

                    backgrounds.push(data['url']);
                    descriptions.push(data['desc']);

                    console.log(data['desc']);
                    console.log(data['url']);
                });
                console.log('/home/includes/backgrounds.php?bg='+bgNames[i]+'');
            }         
            console.log("BG COUNTER: ",bgCounter);
            console.log("backgrounds BGCOUNTER",backgrounds[bgCounter]);
            console.log("-----END OF getBackgrounds() function-----\n")
        }

        function changeBackground() 
        {   
            bgCounter = (bgCounter+1) % 6;
            $('#desc').text(descriptions[bgCounter]);
            console.log(backgrounds);
            console.log(descriptions);
            console.log("back ",backgrounds[bgCounter]);
            console.log("desc ",descriptions[bgCounter]);
            
            if(backgrounds[bgCounter] == undefined)
            {
                getBackgrounds();
                console.log("backgrounds[bgCounter] is undefinded\n getBackgrounds()");
            }
            else
            {
                console.log("backgrounds[bgCounter] isn't undefinded\n BGCOUNT",backgrounds[bgCounter]);
            }
            
            
            $.getJSON('/home/includes/headerchange.php?img='+backgrounds[bgCounter]+'', function(data) {
                 //alert(data);
                 $(".header,.screenshot-placename,.ips").css("color", ""+data+"");
            });
            
            $('body').css('background', 'url('+backgrounds[bgCounter]+') no-repeat center center fixed');
            $("body").css("background-size", "cover");

            setTimeout(changeBackground,10000);
        }
        getBackgrounds();
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