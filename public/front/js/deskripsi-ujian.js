$('.nav-description button').click(function() {
    let dataButton = $(this).data('button');
    if(dataButton == 'deskripsi') {
        $(this).addClass('btn-active');
        $(this).siblings().removeClass('btn-active');
        $('.data-description-deskripsi').slideDown();
        $('.data-description-syarat').hide(0);
    } else {
        $(this).addClass('btn-active');
        $(this).siblings().removeClass('btn-active');
        $('.data-description-syarat').slideDown();
        $('.data-description-deskripsi').hide(0);
    }
});