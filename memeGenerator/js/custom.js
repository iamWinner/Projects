
$(document).on('ready', function(event) {

	window.onresize=ImageAdjust;
	
	$('#newuploadedfile').animate({opacity:'1'} , 500);

		$('#feedback').animate({top:'0' , opacity:'1'} , 500);
		$('#ins').animate({bottom:'0' , opacity:'1'} , 500);
			$('#ins').delay(5000).animate({bottom:'-100px' , opacity:'1'} , 500);

	$('#closeNav').on('click' , function(event) {
		
		if($('.main').hasClass('imagesIn'))
		{
			$('.main').animate({ marginLeft:'0'} , 500 , function(){

			$('.main').animate({width:'100%'} , 0 ,function(){

				ImageAdjust();
			})
			

		});

		}
		else
		{
			

			$('.main').animate({width:'100%' ,  marginLeft:'0'} , 500 );

				
			
		}
		
		$('.nav').animate({left:'-300px'} , 500);

		
		
	});

	$('#mainHam').on('click' , function(event) {


		var reduceWidth=$(window).innerWidth()-300;


		if($('.main').hasClass('imagesIn'))
		{
			$('.main').animate({ marginLeft:'300px'} , 500 , function(){

			$('.main').animate({width:reduceWidth+'px'} ,0 , function(){
			ImageAdjust();
			});
		
		});
			
		}
		else
		{
			

			$('.main').animate({ marginLeft:'300px' , width:reduceWidth+'px'} , 500 )
		
	

				
			
		}

		$('.nav').animate({left:'0'} , 500);
		$('.nav').animate({left:'0'} , 500);
		
	});

	if($('.main').hasClass('menuActive'))
	{
		$('.main').css({width:'calc( 100% - 300px )', marginLeft:'300px'});

		ImageAdjust();


		
	}



	$('#top-text').on('input', function(event) {
		
		$('#topTextShow').html($(this).val());
		

		
		if($(this).val().indexOf('w') > -1 || $(this).val().indexOf('W') > -1 )  
		{
			$('#topTextShow').css({'font-size':'40px'})
		}
		else if($(this).val().indexOf('b') > -1 || $(this).val().indexOf('B') > -1   )  
		{
			$('#topTextShow').css({'font-size':'55px'})
		}

		else if($(this).val().indexOf('m') > -1 || $(this).val().indexOf('M') > -1)  
		{
			$('#topTextShow').css({'font-size':'36px'})
		}
		else
		{
			$('#topTextShow').css({'font-size':'60px'})
		}
		
	});


		$('#bottom-text').on('input', function(event) {


		
		$('#bottomTextShow').html($(this).val());

		
		if($(this).val().indexOf('w') > -1 || $(this).val().indexOf('W') > -1 )  
		{
			$('#bottomTextShow').css({'font-size':'40px'})
		}
		else if($(this).val().indexOf('b') > -1 || $(this).val().indexOf('B') > -1   )  
		{
			$('#bottomTextShow').css({'font-size':'55px'})
		}

		else if($(this).val().indexOf('m') > -1 || $(this).val().indexOf('M') > -1)  
		{
			$('#bottomTextShow').css({'font-size':'36px'})
		}
		else
		{
			$('#bottomTextShow').css({'font-size':'60px'})
		}
		

		
	});



});
function ImageAdjust()
{



	var totalImages=document.querySelectorAll('.memes li');

	for (var i=1 ; i <= totalImages.length ; i++ )
//alert(i);
				
{

	if($('.main').innerWidth() < 322*i)
	{
		$('.memes').stop().animate({width:322*(i-1)+'px'} , 0
			, function(){

				

		$.each( $('.memes li') ,  function(index, val) {
		console.log(index/(i-1));

			if(index%(i-1)==0)
			{
				$(val).stop().animate({left:'0' , top:(parseInt(index/(i-1)))*400+'px' ,opacity:1} , 600);
			}
			else
			{
				$(val).stop().animate({ left:324*(index%(i-1)) ,top:(parseInt(index/(i-1)))*400+'px' , opacity:1}, 600);
			}
			
			
		});


		


			});

		
	//	console.log($('.memes').css('width'));

		break;
		console.log(i);
			
	}
	else
	{
		$('.memes').stop().animate({width:322*(i)+'px'} , 0
			, function(){

				

		$.each( $('.memes li') ,  function(index, val) {
		console.log(index/(i));

			if(index%(i)==0)
			{
				$(val).stop().animate({left:'0' , top:(parseInt(index/(i)))*400+'px' ,opacity:1} , 600);
			}
			else
			{
				$(val).stop().animate({ left:324*(index%(i)) ,top:(parseInt(index/(i)))*400+'px' , opacity:1}, 600);
			}
			
			
		});


		


			});

	}

	
}
}

function textSixeAdjust()
{
	var allTopTexts=document.querySelectorAll('.memeTopText');



		$.each( allTopTexts, function(index, elm) {

		
			
			if($(elm).html().indexOf('w') > -1 || $(elm).html().indexOf('W') > -1 )  
		{
			$(elm).css({'font-size':'30px'})
		}
		else if($(elm).html().indexOf('b') > -1 || $(elm).html().indexOf('B') > -1   )  
		{
			$(elm).css({'font-size':'36px'})
		}

		else if($(elm).html().indexOf('m') > -1 || $(elm).html().indexOf('M') > -1)  
		{
			$(elm).css({'font-size':'28px'})
		}
		else
		{
			$(elm).css({'font-size':'40px'})
		}

		});

		var allBottomexts=document.querySelectorAll('.memeBottomText');



		$.each( allBottomexts, function(index, elm) {

			
			
			if($(elm).html().indexOf('w') > -1 || $(elm).html().indexOf('W') > -1 )  
		{
			$(elm).css({'font-size':'30px'})
		}
		else if($(elm).html().indexOf('b') > -1 || $(elm).html().indexOf('B') > -1   )  
		{
			$(elm).css({'font-size':'36px'})
		}

		else if($(elm).html().indexOf('m') > -1 || $(elm).html().indexOf('M') > -1)  
		{
			$(elm).css({'font-size':'28px'})
		}
		else
		{
			$(elm).css({'font-size':'40px'})
		}

		});
}
	$(window).on('resize', ImageAdjust());
	//alert($(window).innerWidth() );

	$.each( $('.memeBottomText') ,  function(index, val) {
			
			console.log($(val).html());
			
			if($(val).html().length)
			{
				$(val).css({'bottom':60+'px'})
			}
		});