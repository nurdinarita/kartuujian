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

$(document).ready(function(){
	$(".btn-tab").on("click", function(){
		let target = $(this).data('button');

		$(".btn-tab.btn-active").removeClass('btn-active');
		$(this).addClass('btn-active');

		if(target == "deskripsi"){
			$(".data-description-syarat").hide();
			$(".data-description-deskripsi").show();
		}else{
			$(".data-description-deskripsi").hide();
			$(".data-description-syarat").show();
		}
	});
});