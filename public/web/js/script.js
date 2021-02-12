$(function () {

	// side menu
	$('.menu-trigger').on('click',function(){
		if($(this).hasClass('active')){
			$(this).removeClass('active');
			$('nav').removeClass('open');
			$('.menu-overlay').removeClass('open');
		} else {
			$(this).addClass('active');
			$('nav').addClass('open');
			$('.menu-overlay').addClass('open');
		}
	});

	$('.menu-overlay').on('click',function(){
		if($(this).hasClass('open')){
			$(this).removeClass('open');
			$('.menu-trigger').removeClass('active');
			$('nav').removeClass('open');
		}
	});

	$('.menu-trigger,.menu-overlay').on('click',function(){
    	var $body = $('body');
        $body.toggleClass('open');
    });


    // mobile submenu
    $('.mb-sub-btn').click(function(){
        $(this).toggleClass("open");
        $(this).parent().next().slideToggle(200);
    });


    // dropmenu
    $(".submenu").hover(function() {
        $(this).addClass('current');
        $(this).find('ul').addClass('active');
        }, function(){
        $(this).removeClass('current');
        $(this).find('ul').removeClass('active');
    });


	// font size
	$('.btn-medium').click(function(){
		if($('.btn-large').hasClass('active')){
			$('.btn-large').removeClass('active');
		}
		if($('body').hasClass('font-large')){
			$('body').removeClass('font-large');
		}
		$(this).addClass('active');
		$('body').addClass('font-medium');
	});

	$('.btn-large').click(function(){
		if($('.btn-medium').hasClass('active')){
			$('.btn-medium').removeClass('active');
		}
		if($('body').hasClass('font-medium')){
			$('body').removeClass('font-medium');
		}
		$(this).addClass('active');
		$('body').addClass('font-large');
	});


	// pagetop
	var topBtn = $('#pagetop');
	topBtn.click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 300);
		return false;
	});


    // smartphone hover effect
    var userAgent = navigator.userAgent;
    var item = $('a,button');

    if (userAgent.indexOf("iPhone") >= 0 || userAgent.indexOf("iPad") >= 0 || userAgent.indexOf("Android") >= 0) {
        item.on("touchstart", function () {
            $(this).addClass("hover");
        });
        item.on("touchend", function () {
            $(this).removeClass("hover");
        });
    } else {
        item.hover(
            function () {
                $(this).addClass("hover");
            },
            function () {
                $(this).removeClass("hover");
            }
        );
    }

});