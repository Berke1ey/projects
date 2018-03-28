var windowHeight = $(window).height();

var carousel = {
	currentImageID: 0,
	lastImageID: 0,
	imageWidth: 0,
	timer: 0,

	init: function() {
		carousel.imageWidth = $("#big").width();
		$("#big").find('li').width(carousel.imageWidth);
		$("#big").find('img').width(carousel.imageWidth);
		$('.shading').height($("#prev").find('img').height()+2);
		$("#big").scrollLeft(carousel.imageWidth*carousel.currentImageID);
	},
	load: function(images) {
		carousel.lastImageID = images.length-1;

		for (i = 0; i < images.length+1; i++) {
			var image;
			(i % images.length == 0) ? image = images[0] : image = images[i];
			$("#big").find('ul').append($('<li/>').append($('<img/>').attr('src', image)))
			if (i  < images.length)
				$("#prev").find('ul')
				.append($('<li/>').attr('onclick', 'carousel.flip(this)')
					.append($('<img/>').attr('src', images[i]))
					.append($('<span/>').addClass('shading')))
		}

		$('.shading').height($("#prev").find('img').height()+2)
		$("#prev").find('li').eq(carousel.currentImageID).find('.shading').hide();
		carousel.init();
		carousel.imageWidth = $('#big').width();
		carousel.start()
	},
	flip: function(t) {
		var index = $(t).index();
		carousel.currentImageID = index
		$("#prev").find('li').find('.shading').show();
		$("#prev").find('li').eq(carousel.currentImageID).find('.shading').hide();
		$("#big").animate({ scrollLeft: carousel.imageWidth*index }, 500);
		carousel.reset()
	},
	reset: function() {
		clearInterval(carousel.timer);
		carousel.timer = 0;
		carousel.start();
	},
	start: function() {
		carousel.timer = setInterval(function() {
			if (carousel.currentImageID <= carousel.lastImageID)
				carousel.currentImageID++;
			$("#prev").find('li').find('.shading').show();
			$("#prev").find('li').eq(carousel.currentImageID).find('.shading').hide();
			$("#big").animate({ scrollLeft: carousel.imageWidth*carousel.currentImageID }, 500);
			if (carousel.currentImageID == carousel.lastImageID+1) {
				carousel.currentImageID = 0;
				$("#prev").find('li').find('.shading').show();
				$("#prev").find('li').eq(carousel.currentImageID).find('.shading').hide();
				$("#big").animate({ scrollLeft: 0 }, 0);
			}
		}, 5000)
	}
}

function up() {
	var body = $("html, body");
	body.stop().animate({scrollTop:0}, '500', 'swing')
}

function osSelected(t) {
	if($(t).children().is(":checked")) {
		$(t).parent().find('.app').show();
	}
	else {
		$(t).parent().find('.app').hide();
	}
}

$( document ).scroll(function() {
	if (window.pageYOffset > windowHeight/4)  
		$("#scrllTop").animate({opacity:1}, '500', 'swing')
})

$( window ).resize(function() {	
	carousel.init();
})
