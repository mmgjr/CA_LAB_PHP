$(function(){
	$('.tabItem').on('click',function(){

		$('.activeTab').removeClass('activeTab');
		$(this).addClass('activeTab');

		var item = $('.activeTab').index();
		$('.tabBody').hide();
		$('.tabBody').eq(item).show();
	});

	$('#search').on('focus',function(){
		$(this).animate({
			width:'250px'
		});
	});

	$('#search').on('blur',function(){
		if($(this).val() == ''){
			$(this).animate({
				width:'100px'
			});	
		}
		//atrasando esse evento para o clique funcionar e direcionar para outra página
		setTimeout(function(){
			$('.searchresults').hide();//esconde o elemento sempre que tirar cursos do campo
		}, 500)
		
	});

	$('#search').on('keyup',function(){
		var datatype = $(this).attr('data-type');
		var q = $(this).val();

		if(datatype != ''){
			$.ajax({
				url:BASE_URL+'ajax/'+datatype,
				type:'GET',
				data:{q:q},
				dataType:'json',
				success:function(json){
					if($('.searchresults').length == 0){
						$('#search').after('<div class="searchresults"></div>');
					}

					/*Posicionando div de busca*/
					var searchLeft = $('#search').offset().left;
					var searchTop = $('#search').offset().top + $('#search').height();
					$('.searchresults').css('left',searchLeft+'px');
					$('.searchresults').css('top',searchTop+2+'px');

					/*Montando HTML com os dados do retorno do JSON*/
					var html = '';
					for(var i in json){
						html += '<div class="si"><a href="'+json[i].link+'">'+json[i].name+'</a></div>';
					}
					$('.searchresults').html(html);
					$('.searchresults').show();//Monstra a div sempre que digitar
				}
			});
		}
		
	});



});