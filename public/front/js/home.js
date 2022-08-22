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

var swiperArticle = new Swiper('.article-swiper-container', {
    slidesPerView: 'auto',
});

var swiperTestimonial = new Swiper('.testimoni-swiper-container', {
    slidesPerView: 'auto',
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    }
});