<script>
if(navigator.userAgent.match(/Android/i) &&
   navigator.userAgent.match(/webOS/i) &&
   navigator.userAgent.match(/iPhone/i) &&
   navigator.userAgent.match(/iPod/i) &&
   navigator.userAgent.match(/iPad/i) &&
   navigator.userAgent.match(/Blackberry/i) )
    {
        //user uses a smartphone and we thus don't do the background changer.
    }
else
{
    (function () {
        var bgCounter = 0,
            backgrounds = ["assets/images/bg/1.jpg",
                           "assets/images/bg/2.jpg",
                           "assets/images/bg/3.jpg",
                           "assets/images/bg/4.jpg",
                           "assets/images/bg/5.jpg",
                           "assets/images/bg/6.jpg"], //configurable (TODO)
            descriptions = ["Misty Mountains",
                            "Misty Mountains",
                            "Rivendell",
                            "Harlond",
                            "Paths of the Dead",
                            "Pelennor Fields"];
            //this should be together with the images, 2d array? (TODO)

        function changeBackground() 
        {
            $('#desc').text(descriptions[bgCounter]);
            bgCounter = (bgCounter+1) % backgrounds.length;
            $('body').css('background', 'url('+backgrounds[bgCounter]+') no-repeat center center fixed');
            $("body").css("background-size", "cover");

            setTimeout(changeBackground,10000);
            
            $('style').load('includes/headerchange.php?img='+backgrounds[bgCounter]);

            $.ajax({
                url: 'includes/headerchange.php?img='+backgrounds[bgCounter],
                type: 'GET',
                success: function(res) {
                    var data = $(res.responseText).find('style').text();
                    $(".header").animate({color : ''+data+'' }, 'fast');
                }
            });
        }
        changeBackground();
    })();
}
</script>
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