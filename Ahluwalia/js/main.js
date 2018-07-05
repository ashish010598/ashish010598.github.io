(function($) {
	"use strict"
	
	// Preloader
	$(window).on('load', function() {
		$("#preloader").delay(600).fadeOut();
	});

	// Fixed Nav
	var topHeader = $('#top-navbar');
	$(window).on('scroll', function() {
		var wScroll = $(this).scrollTop();
		wScroll > topHeader.height() ? $('#main-navbar').addClass('fixed-navbar') : $('#main-navbar').removeClass('fixed-navbar');
	});

	// Home Area Height
	function homeHeight () {
		$('#home').css({'height': $(window).height() - $('#header').height()});
	}
	$(window).on('resize', function() {
		homeHeight();
	});
	homeHeight();
	
	// Mobile Search button toggle
	$('.search-toggle-btn').on('click',function(){
		$('.navbar-search').toggleClass('navbar-search-collapsed');
	});

	 // Mobile Nav button toggle
	$('.navbar-toggle-btn').on('click',function(e){
		$(this).toggleClass('toggle-btn-collapsed')
		$('.main-navbar').toggleClass('main-navbar-collapsed');
	});
	
	// Mobile dropdown
	$('.main-navbar .has-dropdown a').on('click',function() {
		$(this).parent().toggleClass('dropdown-collapsed');
	});

	
	// Portfolio slider
	$('#portfolio-slider').owlCarousel({
		loop:true,
		margin:0,
		dots : false,
		nav: true,
		navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		autoplay : false,
		responsive:{
			0: {
				items:1
			},
			480: {
				items:2,
			},
			992:{
				items:4
			}
		}
	});
	
	// Testimonial slider
	$('#testimonial-slider').owlCarousel({
		items:1,
		loop:true,
		margin:15,
		dots : true,
		nav: false,
		autoplay : true,
	});
	
	// Partners slider
	$('#partners-slider').owlCarousel({
		loop:true,
		margin:15,
		dots : false,
		nav: true,
		navText : ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
		autoplay : true,
		responsive:{
			0:{
				items:2
			},
			480:{
				items:4
			},
			992:{
				items:6
			}
		}
	});
	
	
	// magnificPopup
	$('.portfolio').magnificPopup({
		delegate: '.lightbox',
		type: 'image'
	});
	
	
	// keep accordion open
	$('.accordion .panel-heading a').on('click',function(e){
		if($(this).parents('.panel').children('.panel-collapse').hasClass('in')){
			e.stopPropagation();
		}
		e.preventDefault()
	});


})(jQuery);