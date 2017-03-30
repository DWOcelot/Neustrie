//LAUNCH JS FOUNDATION
$(document).foundation();

///////////////////////////////////////////////////////////////////////////
//SLICKNAV
$(function(){
	$('#menu').slicknav();
});

//slicknav menu click smooth scroll
$(document).on('click', ".slicknav_nav .scroll", function(e) {
    e.preventDefault();
    var h = $('#menu').outerHeight();
    if (!$('#menu').is(":visible")) {
        h = $('.slicknav_menu .slicknav_btn').outerHeight();
    }
    var link = this;
    $.smoothScroll({
        offset: -h,
        scrollTarget: link.hash
    });
    if(link = "a[href='#contact']" && $('.contactForm:hidden')) {
      $('.contactForm').slideDown('slow');
    }
});

//SMOOTH SCROLL TO ANCHOR FROM MENU TOP
$('#menu li').on('click', 'a', function(event){
    event.preventDefault();

    var target = $(event.target);
    if(target.is("a[href='#contact']") && $('.contactForm:hidden')) {
    	$('.contactForm').slideDown('slow');
    }

    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top + 'px'
    }, "slow");
});


/////////////////////////////////////////////////////////////////////////////
// PROGRESS BAR
var bar = $('#progress-bar');

$(window).scroll(function(e) {
    var x = $(window).scrollTop() / ($(document).height() - $(window).height()) * 100;
    bar.css('background', '-webkit-linear-gradient(left, white '+ x +'%, black '+ x +'%)');
});

///////////////////////////////////////////////////////////////////////
//TOGGLE CONTACT FORM
$('#toggleContactForm').click(function(event){
    event.preventDefault();

    $('.contactForm').slideToggle('slow', () => {
        $('body').animate({
        	scrollTop: $(this).offset().top + 'px'
        }, "slow");
    });
});

//LEAVE CONTACT FORM OPEN IF ERROR IN FORM
if($('.contactForm').data('error')) {

  $('.contactForm').slideToggle('slow', () => {
    $('body', 'html').animate({
        scrollTop: $('.contactForm').offset().top + 'px'
      }, "slow");
  });

}
//console.log($('.contactForm').data('error'));

//////////////////////////////////////////////////////////////////////////
//BACKTOTOP APPEAR ON SCROLL & MOVE ON BOTTOM PAGE
$(window).scroll(function() {
   if($(window).scrollTop() > 100) {
   		$('#backToTop').css({
				"opacity": 1
			});
   } else {
   		$('#backToTop').css("opacity", 0);
   }

	 var bottomPageFooter = $(window).height() + $(window).scrollTop() >= $(document).height() - $('#footer').height()

	 if(bottomPageFooter) {
		 $('#backToTop').css({
			 "padding": "5px",
			 "right": ".2em",
			 //"bottom": ".2em"
		 })
	 } else {
	 	$('#backToTop').css({
			"padding": "13px",
			"right": "1em",
			"bottom": "1em"
		})
	 }
});

////////////////////////////////////////////////////////////////////
// SLICKSLIDER
$(document).ready(function(){
  $('.slickslider').slick({
		arrows: true,
		prevArrow: '<button type="button" class="slick-prev slick-arrow"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>',
		nextArrow: '<button type="button" class="slick-next slick-arrow"><i class="fa fa-arrow-down" aria-hidden="true"></i></button>',
		autoplay: true,
		autoplaySpeed: 5500,
		vertical: true,
		verticalSwiping: true
	});
});

//bounce animations slick-arrows
$('.slickslider').hover(function() {
	$('.slick-prev, .slick-next').toggleClass('animated flipInX');
});

//youtube player with api
var player;
function onYouTubeIframeAPIReady() {
  player = new YT.Player('youtube-video', {
      events: {
        //'onReady': onPlayerReady,
        'onStateChange': onPlayerStateChange
      }
  });
}

// Pause slickslider on youtube video with api
function onPlayerStateChange(event) {
	//console.log(arguments);
  if(event.data == YT.PlayerState.PLAYING) {
		$('.slickslider').slick('slickPause');
	} else if (event.data == YT.PlayerState.PAUSED || event.data == YT.PlayerState.ENDED) {
		$('.slickslider').slick('slickPlay');
	}
}

///////////////////////////////////////////////////////////////////////
//SCROLL TO TOP
$("#backToTop").on('click', function(e) {
	e.preventDefault();

	$('html, body').animate({ scrollTop: 0}, 'slow');

	if($('.contactForm:visible')) {
		$('.contactForm').slideUp('slow');
	}

  if($('.slicknav_nav:hidden')) {
    $('#menu').slicknav('close');
  }
});
