var check = true;
var allHeight = 0;


function load(){

	//check windows size
	//windowsResize();
	
	$('.header_menu ul li').click(function() { //button click class name is myDiv
		$('.header_menu ul li ul').toggle(); 
	})
	
	$('.header_menu ul li').click(function(e) { //button click class name is myDiv
		e.stopPropagation();
	})

	$(function(){
		$(document).click(function(){  
		$('.header_menu ul li ul').hide(); //hide the button

		});
	});

	windowResizeAd();
	
	
	$(window).resize(function() {
		windowResizeAd();
		//windowsResize();
	});
	
	
	$(window).scroll(function(event) {
		//srcollLeft();

		//switchSticky();
		
		//move ad
		moveSidebar();
		scrollLeftAd();
	});
	
	
	var processing;
	$(document).scroll(function(e){

        if (processing){
			return false;
        }
            

	});
	
	//Submit
	$("#nick").change(function(){
		var path = '../application/controller/_nickController.php';
		var value = $(this).val();
		
		//console.log(value);
		
		$("#nick_msg").html("<img src='../images/loading.gif' width='30' height='30' style='vertical-align: middle' />");
		
		$.post(path, { nick: value}, function(data) {
			console.log(data);
			
			if(data == 1){
				$("#nick").css({"border-color" : "#E46C6D" });
				$("#nick_msg").css({"color" : "#E46C6D" });
				$("#nick_msg").html("Nick is already in use");
			}else{
				$("#nick").css({"border-color" : "green" });
				$("#nick_msg").css({"color" : "green" });
				$("#nick_msg").html("Nickname is available!");
			}
		});

	});
	
	
	//key up ID
	$(document).keyup(function(event){

		var next = $("#go_next").attr('href');
		var prev = $("#go_prev").attr('href');
	
		//left key
		if(event.which == 37 ){
			if(prev != null){
				window.location.href = prev;
			}
		}
		
		//Right key
		if(event.which == 39 ){
			if(next != null){
				window.location.href = next;
			}
		}
	});
	
	
	//settings section
	$(".btn_change_pass").click(function(){
		
		
		if(!$(".settings_password").is(":hidden")){
			//alert("visible");
			$(".password_show").remove();
			$(".settings_password").slideUp();
		}
		if($(".settings_password").is(":hidden")){
			$(".settings_password").append('<input type="hidden" class="password_show" name="password_show" value="true" />');
			$(".settings_password").slideDown();
			//alert("hidden");
		}
	});
	
	//***********************************************
	//Votes
	//***********************************************
	$(".article_button_not_logged, .view_article_vote_not_logged").click(function(){
		alert("Please Sign In");
	});
	
	
	
	
	//***********************************************
	//Votes View
	//***********************************************
	$(".view_article_vote, .article_button").click(function(){
	
		if( $(this).hasClass("up") ){

			//add comments
			//var test = $(this).parent().prev(".title_article_comments").attr("class");
			
			var article_id = $(this).data("article_id");
			
			var voteClass = $("#view_votes_" + article_id);

			value = parseInt(voteClass.html());
			

			var path = '../../application/controller/voteController.php';
			
			
			if (!$(this).hasClass("button_voted_up")){

				var downButton = $(this).next().hasClass("button_voted_down")
				
				//change color
				$(this).addClass("button_voted_up");
				$(this).next("div").removeClass("button_voted_down");
			
				if(  downButton ){
					value += 2;
				}else{
					value += 1;
				}
				
				voteClass.html(value);
			
				$.post(path, { vote: "up", id: article_id}, function(data) {
					//$('.result').html(data);
					
					//alert(data);
					//alert("hello");
				});
			}else{

				value -= 1;
				voteClass.html(value);
				
				$(this).removeClass("button_voted_up");
				
				$.post(path, { vote: "remove_up", id: article_id}, function(data) {
					//$('.result').html(data);
					
					//alert("remove_up");
				});
			}
			
		}// end hasClass UP
		
		
		
		
		if( $(this).hasClass("down") ){

			var article_id = $(this).data("article_id");
			
			var voteClass = $("#view_votes_" + article_id);
			
			value = parseInt(voteClass.html());

			
			var path = '../../application/controller/voteController.php';
			
			
			if (!$(this).hasClass("button_voted_down")){
			
				var upButton = $(this).prev().hasClass("button_voted_up")
			
			
				//change color
				$(this).addClass("button_voted_down");
				$(this).prev("div").removeClass("button_voted_up");
			

				if(  upButton ){
					value -= 2;
				}else{
					value -= 1;
				}
				
				voteClass.html(value);
			
				$.post(path, { vote: "down", id: article_id}, function(data) {
					//$('.result').html(data);
					
					//alert(data);
					//alert("down: " + article_id);
				});
			}else{

				value += 1;
				voteClass.html(value);

				$(this).removeClass("button_voted_down");
				
				$.post(path, { vote: "remove_down", id: article_id}, function(data) {
					//$('.result').html(data);
					
					//alert("remove_down");
				});
			}

		}
	
	});
	
	//***********************************************
	//***********************************************
	

	
	
	//submit
	$("#title, #url, #upload, #urlVideo, #sourceUrl").focus(function(){
		$(this).nextAll("span").slideDown();
	});
	
	$("#upload_file_link").click(function(){
		$("#upload_file").show();
		$("#spanUpload").show();
		$("#url_file").hide();
	});
	
	$("#url_file_link").click(function(){
		$("#upload_file").hide();
		$("#spanUpload").hide();
		$("#url_file").show();
	});
	
	//type of upload
	
	$("#picture").css({"background-position" : "0px 100px"});
	
	
	$("#picture").click(function(){
		$("#radio_picture").prop("checked","checked");
		$("#radio_video").removeProp("checked");
		$("#picture").css({"background-position" : "0px 100px"});
		$("#video").css({"background-position" : "0px 0px"});
		
		$("#url_file").show();
		$("#urlVideoWrapp").hide();
		
	});
	
	$("#video").click(function(){
		$("#radio_video").prop("checked","checked");
		$("#radio_picture").removeProp("checked");
		
		$("#video").css({"background-position" : "0px 100px"});
		$("#picture").css({"background-position" : "0px 0px"});
		
		$("#url_file").hide();
		$("#urlVideoWrapp").show();
		
	});
	
	
	$(window).scroll(function(){
		if  ( $(window).scrollTop() >=  (($(document).height()) - $(window).height() ) - 20){
			
			//console.log("hello");
		}
	});


}

//movesidebar
function moveSidebar(){
	
	//console.log($(document).scrollTop());
	if($(document).scrollTop() >= 550){
		$(".stickySidebar").css({"position": "fixed", "left": 1022, "top": 53});
	}else{
		$(".stickySidebar").css({"position": "static", "left": 1022, "top": 53});
	}
}

function scrollLeftAd(){

	var widthArticleWrapp = $(".article_wrapp, .article_wrapp_view").position().left;
	var widthsidebarWrapp = 700;
	var offset = widthArticleWrapp + widthsidebarWrapp;
	
	$(".stickySidebar").css("left", offset - $(document).scrollLeft());

}


function windowResizeAd(){

	var widthArticleWrapp = $(".article_wrapp, .article_wrapp_view").position().left;
	var widthArticleSingleWrapp = 700;

	var offset = widthArticleWrapp + widthArticleSingleWrapp; // left offset of the fixed div (without scrolling)
    $('.stickySidebar').css({
        'left': offset - $(document).scrollLeft()
    });

}


//check right coordinates on side article 
function windowsResize(){
	var widthArticleWrapp = $(".article_wrapp").position().left;
	var widthArticleSingleWrapp = 500;
	

	var offset = widthArticleWrapp + widthArticleSingleWrapp; // left offset of the fixed div (without scrolling)
    $('.current').css({
        'left': offset - $(document).scrollLeft()
    });

}


//check right coordinates on side article 
function srcollLeft(){

	var widthArticleWrapp = $(".article_wrapp").position().left;
	var widthArticleSingleWrapp = 500;
	var offset = widthArticleWrapp + widthArticleSingleWrapp;
	
	$(".current").css("left", offset - $(document).scrollLeft());

}


//switch sticky
function switchSticky(){
	
	
		var sticky = $(".current").position().top;
		
		//console.log("chido top position: " + $(".chido").position().top)
		
		var wrappArticle =  $(".current").parent();
		
		if(check == true){
			allHeight = (wrappArticle.height()) + 42 ; //42 is the 20 padding on top and bottom plus 2px for the border
		}else{
			
		}
		
	
	
	//console.log("allHeight: " + allHeight );
	//console.log( (sticky + $(document).scrollTop()  + 40) + " <= " + allHeight );
	
	if( ( sticky + $(document).scrollTop()  + 40) <=  allHeight ){
		console.log("Yes");
	}else{
		console.log("NO");
		
		var nextWrapp = wrappArticle.next();
		var nextWrappHeight = nextWrapp.height() + 42;
		var nextSticky = nextWrapp.find(".article_side_wrapp");
		
		
		allHeight +=   nextWrappHeight;
		
		$(".article_side_wrapp").removeClass("current");
		nextSticky.addClass("current");
		
		check=false;
	}
	
	//var nextWrapp = wrappArticle.next();
	//var nextWrappHeight = nextWrapp.height() + 42;
	//var nextSticky = nextWrapp.find(".article_side_wrapp");
	
	
	//console.log( nextWrapp.attr("class") );
	//console.log( "Height: " + nextWrappHeight );
	
	//console.log( );
	console.log(sticky + $(document).scrollTop());
}