
function swipeUp() {
    $('#section').css({ 'top': '150px' });
    $('.row-btn-3').css({ 'margin-bottom': '1.5rem' });
    $('.btn-swipe-up-down').html(`
        <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.59 3.43323e-05L6 4.58003L1.41 3.43323e-05L0 1.41003L6 7.41003L12 1.41003L10.59 3.43323e-05Z" fill="#363636" fill-opacity="0.5"/>
        </svg>
        <span>Swipe ke bawah</span>
    `);
}
function swipeDown() {
    $('#section').css({ 'top': 'calc(100% - 130px)' });
    $('.row-btn-3').css({ 'margin-bottom': '150px' });
    $('.btn-swipe-up-down').html(`
        <svg class="mr-2" width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.41 7.41L6 2.83L10.59 7.41L12 6L6 0L0 6L1.41 7.41Z" fill="#363636" fill-opacity="0.5"/>
        </svg>
        <span>Swipe ke atas</span>
    `);
}

$('.btn-swipe-up-down').click(function() {
    let checkDataButton = $(this).data('button');
    if(checkDataButton == 'close') {
        swipeUp();
        $(this).data('button', 'open');
    } else {
        swipeDown();
        $(this).data('button', 'close');
    }
});

// Initialize Swiper
var swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 5,
    navigation: {
        nextEl: '.swiper-button-next-review',
        prevEl: '.swiper-button-prev-review',
    },
});

// SAME WIDTH & HEIGHT DAFTAR NOMOR SOAL
let widthNoSoal = $('.daftar-nomor-soal').innerWidth();
$('.daftar-nomor-soal').css({'height': widthNoSoal + 'px'});