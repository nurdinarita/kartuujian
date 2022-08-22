function openNav() {
    $('#nav-right').css({ 'left': '0px' });
}
function closeNav() {
    $('#nav-right').css({ 'left': '100%' });
}
$('.nav-hamburger').click(function() {
    openNav();
});
$('.nav-close').click(function() {
    closeNav();
});