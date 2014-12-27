(function () {
    var bgCounter = 0,
        backgrounds = ["assets/images/bg/1.png",
                       "assets/images/bg/2.png",
                       "assets/images/bg/3.png",
                       "assets/images/bg/4.png",
                       "assets/images/bg/5.png",
                       "assets/images/bg/6.png"], //configurable
        descriptions = ["Misty Mountains",
                        "Misty Mountains",
                        "Rivendell",
                        "Harlond",
                        "Paths of the Dead",
                        "Pelennor Fields"];
        //this should be together with the images, 2d array?

    function changeBackground() 
    {
        $('#desc').text(descriptions[bgCounter]);
        bgCounter = (bgCounter+1) % backgrounds.length;
        $('body').css('background', 'url('+backgrounds[bgCounter]+') no-repeat center center fixed');
        $("body").css("background-size", "cover");

        setTimeout(changeBackground,10000);
    }
    changeBackground();
})();