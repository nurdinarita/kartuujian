var total = 0;

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

$('.btn-tambah-kode').click(function() {
    let dataButton = $(this).data('button-voucher');
    if(dataButton == 'off') {
        $(this).addClass('btn-tambah-kode-active');
        $(this).next().slideDown();
        $(this).data('button-voucher', 'on');
    } else {
        $(this).removeClass('btn-tambah-kode-active');
        $(this).next().slideUp();
        $(this).data('button-voucher', 'off');
    }
});

$('.payment-virtual-account').click(function() {
    $(this).addClass('payment-virtual-account-active');
    $(this).siblings().removeClass('payment-virtual-account-active');
});

$('#pilih-semua-check').click(function() {
    if ($(this).is(':checked') && $(this).val() == 'yes') {
        $('.main-box .form-check-input').prop("checked", true);
        $('#btn-submit-keranjang').prop("disabled", false).addClass('btn-beli-active');
    } else {
        $('.main-box .form-check-input').prop("checked", false);
        $('#btn-submit-keranjang').prop("disabled", true).removeClass('btn-beli-active');
    }
});

$('.main-box .form-check-input').click(function() {
    if($('.main-box .form-check-input').is(':checked')) { 
        $('#btn-submit-keranjang').prop("disabled", false).addClass('btn-beli-active');
    } else {
        $('#btn-submit-keranjang').prop("disabled", true).removeClass('btn-beli-active');
    }
    
    updatePrice();
});

function updatePrice(){
    $(".form-check-input-item").each(function(index){
        let checked = $(this).prop('checked');
        let price = $(this).data('price');

        if(checked){
            total += parseInt(price);
        }else{
            total -= parseInt(price);
        }
    });

    $(".subtotal").html("Rp " + total.toString());
    $(".total-price").html("Rp " + total.toString());
}