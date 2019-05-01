$(function(){
	$('.tabItem').on('click',function(){

		$('.activeTab').removeClass('activeTab');
		$(this).addClass('activeTab');

		var item = $('.activeTab').index();
		$('.tabBody').hide();
		$('.tabBody').eq(item).show();
	});
});