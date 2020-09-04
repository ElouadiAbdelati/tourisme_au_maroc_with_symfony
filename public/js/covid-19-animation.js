$('#covid').click(function () {
    $('#close_covid').show();
    $('#mySidebar').animate({
        width: "300px"
    }, 1000);
    $('#main').animate({
        marginRight: "300px"
    }, 1000);
    $('#covid').hide();
    $('html,body').animate({
        scrollTop: 0
    }, 2000);

});

$('#close_covid').click(function () {
    $('#close_covid').hide();

    $('#mySidebar').animate({
        width: "0"
    }, 1000);
    $('#main').animate({
        marginRight: "0"
    }, 1000);
    $('#covid').show();

});

$('#close_covid').hide();
