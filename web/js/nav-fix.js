$(document).ready(function () {
    $('#nav2 a.toggle').click(function () {
        $("#nav2 > .row > ul").toggleClass('active');
        $("#nav2").toggleClass('fixed');
    });
});