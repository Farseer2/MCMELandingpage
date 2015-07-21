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
            var bgCounter = 0;
        
            var backgrounds = [<?php echo json_encode(getImage("bg1","url")); ?>],
            descriptions = [<?php echo json_encode(getImage("bg1","description")); ?>],
            bgNames = ["bg1","bg2","bg3","bg4","bg5","bg6"];

        for(var i = 1; i < bgNames.length; i++) 
            {
            $.getJSON('/home/includes/backgrounds.php?bg='+bgNames[i]+'', function(data) {
                descriptions.push(data['description']);
                backgrounds.push(data['url']);
            });
        }
        function changeBackground() 
        {   
            $('#desc').text(descriptions[bgCounter]);
            
            $.getJSON('/home/includes/headerchange.php?img='+backgrounds[bgCounter]+'', function(data) {
                 $(".header,.screenshot-placename").css("color", ""+data+"");
            });
            
            $('body').css('background', 'url('+backgrounds[bgCounter]+') no-repeat center center fixed');
            $("body").css("background-size", "cover");
            bgCounter = (bgCounter+1) % 6;
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
    
    $('#nav-btn').click(toggleMenu);
$('main').click(function() {
    if ($(this).hasClass('active')) {
        toggleMenu();
    }
});

function toggleMenu() {
    $('#nav-btn, #sidebar, main, #cover').toggleClass('active');
}
</script>