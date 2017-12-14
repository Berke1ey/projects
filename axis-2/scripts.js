let a = getRandomInt(6, 9);
let c = getRandomInt(11, 14);
let b = c - a;

let range;


function getRandomInt(min, max) {
  return Math.floor(Math.random() * (max - min)) + min;
}

function init() {
	$("#a").html(a);
	$("#b").html(b);

	drawArrow($(".a-circle"), a);
	drawArrow($(".b-circle"), b);
}

function numbersCheckerInit() {
	$(".a-input").keyup(function() {
		if ($(this).val() == a) {
			$(this).replaceWith($("<span/>").html(a));
			$("#a").css("color", "black");

			$(".b-circle-wrapper").show();
			$(".b-input").focus();
		}
		else {
			$(this).css("color", "red");
			$("#a").css("color", "yellow");
		}
	});

	$(".b-input").keyup(function() {
		if ($(this).val() == b) {
			$(this).replaceWith($("<span/>").html(b));
			$("#b").css("color", "black");

			$("#c").replaceWith($("<input/>").addClass("c-input"));
			$(".c-input").keyup(checkLastNum);

			$(".c-input").focus();
		}
		else {
			$(this).css("color", "red");
			$("#b").css("color", "yellow");
		}
	});
}


function checkLastNum() {
	let input = $(".c-input");
	if (input.val() == c) {
		input.replaceWith($("<span/>").html(c));
	}
	else {
		input.css("color", "red");
	}
}


function drawArrow(majorCircle, num) {
	let circle = majorCircle.find(".circle");

	const circleSize = num * range * 1.0606;
	const majorCircleWidth = num * range;

	circle.css({
		width: circleSize * 1.0303 + "px",
		height: circleSize * 1.0303 + "px",
		left: -(circleSize - majorCircleWidth)/2-3 + "px"
	});

	majorCircle.css({
		height: majorCircleWidth /3.2  + "px",
		width: majorCircleWidth + "px",
	})
}



$(function() {
	range = $(".arrows-wrapper").width()/20;

	init();
	numbersCheckerInit();
})
