// JavaScript Document

$(document).ready(init);

function init(){
	//script to run when page loads
	var sortType = $('#sortCollector').val();
		if(sortType=='time')
		{
			$('#switchContainer a:nth-of-type(1)').addClass('currentSwitch');
			$('#mainHead span:nth-of-type(1)').fadeIn(300);

		}
		else
		{
			$('#switchContainer a:nth-of-type(2)').addClass('currentSwitch');
			$('#mainHead span:nth-of-type(2)').fadeIn(300);


		}
	getMemes();
	//If there are anchors/spans with the className "like"
	//then add the click handler
	$(".like").click( submitLike );	
	$(document).delegate(".like", 'click', function(event) {

		submitLike( $(this).attr('id'));
	});
	
	$(".switch").click( switchType );	
	$('#viewMore').on('click' , function() {
		
		getMemes('something');
	});

}



function submitLike(memeID){

		var sortType = $('#sortCollector').val();
	

	var meme_id =memeID;
	
	 $.ajax({
		url: './process/like.php',
		type:'post',
	 	data: {'memeid': meme_id},
	 	dataType:"json"
		
	 }).done( gotReply ).fail( badStuff );
}

function gotReply( data ){
	/**********************************************
	runs with a successful fetch of the JSON file
	successful data object would look like this
	{"code":0, "msg":"Like recorded", "meme_id":23, "likes":12}
	Need to get the number of likes from the 
	JSON and update the span with the count.
	If code is not zero then display the error message.
	************************************************/
	
	var code =data.code ;
	var meme_id = data.meme_id;
	var msg = data.msg;
	switch(code){
		case 0:
			//update the like count
			var likeCount = data.likes;
			//This will add the count of likes into an element with the CSS classname "likes"
			//which is inside of an element with the id "meme_##"
			$("#" + meme_id).siblings(".likes").text(likeCount);
			break;
		case 100:
			alert( msg );
			break;
		case 200:
			alert( msg );
			break;
		case 300:
			alert( msg );
		 	break;
		case 400:
			alert( msg );
			break;
	}
}

function badStuff( jqxhr, status, error ){
	//runs if the AJAX call fails
	//display a message about the failure
	alert(error);

	alert("Sorry. Unable to register your like.");
}


function getMemes(newLimit){

	//var target=$( event.target );

	//if(target.is('.switch'))
	
		var sortType = $('#sortCollector').val();

		if(newLimit!==undefined)
		{
			var limitSetter='infinite';
		}
		else
		{
			var limitSetter=12;

		}
		

	
	//}
	//else
	//{
	//	var sortType = 'time';
	//}
	//alert(target);
	
	
	 $.ajax({
		url: './process/getmemes.php',
		type:'post',
	 	data: {'sorttype': sortType  , 'limit': limitSetter  },
	 	dataType:"html"
		
	 }).done( appendImages ).fail( failedImages );
}

function appendImages( data ){
	/**********************************************
	runs with a successful fetch of the JSON file
	successful data object would look like this
	{"code":0, "msg":"Like recorded", "meme_id":23, "likes":12}
	Need to get the number of likes from the 
	JSON and update the span with the count.
	If code is not zero then display the error message.
	************************************************/
	$('#indexMemes').html(data);

	if($('.main').hasClass('menuActive'))
	{
		$('.main').css({width:'calc( 100% - 300px )', marginLeft:'300px'});

		ImageAdjust();


		
	}

	textSixeAdjust();

	}
	function failedImages( jqxhr, status, error ){
	//runs if the AJAX call fails
	//display a message about the failure
	alert(error);
	alert("Sorry. Unable to register your like.");
}


function switchType(event){


		var sortType = $(this).attr('data-sort');
		$('#sortCollector').val(sortType);

	$('.currentSwitch').removeClass('currentSwitch');
	$(this).addClass('currentSwitch');
if(sortType=='time')
		{
			$('#switchContainer a:nth-of-type(1)').addClass('currentSwitch');
			$('#mainHead span:nth-of-type(1)').fadeIn(300);
			$('#mainHead span:nth-of-type(2)').fadeOut(0);


		}
		else
		{
			$('#switchContainer a:nth-of-type(2)').addClass('currentSwitch');
			$('#mainHead span:nth-of-type(2)').fadeIn(300);
			$('#mainHead span:nth-of-type(1)').fadeOut(0);


		}
	
	 $.ajax({
		url: 'index.php',
		type:'post',
	 	data: {'switchtype': sortType},
	 	dataType:"text"
		
	 }).done( switchSuccess ).fail( failedImages );
}

function switchSuccess( data ){


getMemes();
		
	}
	
	function failedImages( jqxhr, status, error ){
	//runs if the AJAX call fails
	//display a message about the failure
	alert(error);
	alert("Sorry. Unable to register your like.");
}



function switchSuccess( data ){

		

getMemes();
		
	}
	
	function failedImages( jqxhr, status, error ){
	//runs if the AJAX call fails
	//display a message about the failure
	alert(error);
	alert("Sorry. Unable to register your like.");
}


