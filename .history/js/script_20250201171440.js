$(function(){
    $('.carousel').carousel({
        interval: 5000
    })
})
$(document).ready(function(){
    $('.book-card').hover(
        function() { $(this).addClass('shadow-lg'); },
        function() { $(this).removeClass('shadow-lg'); }
    );
});