/*** Document Ready Function ***/
jQuery(document).ready(function($){
	
	"use strict";



	/*** Donate Box Move Up and Down Function ***/
	$(".donate-updown").click(function(){
		$(".donate").toggleClass("down");
	});	
	
	/*** Main Page Toggles Function ***/
	var Panels = $('.accordions > dd').hide();
	var Panel1 = $('.accordions > dd.opened').show();
	var quest = $('.accordions > dt a');
	
	$('.accordions > dt a').click(function() {
		var $this = $(this);
		var $target =  $this.parent('dt').next('dd');
	
		if(!$target.hasClass('active')){
			Panel1.removeClass('active').slideUp();
			Panels.removeClass('active').slideUp();
			$target.addClass('active').slideDown();
			quest.removeClass('activate');
			$this.addClass('activate');
		}
		return false;
	});

	$(function() {
		$('.accordions > dt:first-child a').addClass('activate');
	});


	
	
	/*** Side Bar Toggles Function ***/
	$(".sidebar-widget li").click(function(){
		$('.sub-list', this).slideToggle();
		return false;
	});
	
	$(".dustbin").click(function(){
		$(this).parent().parent().parent().slideUp();
	});
	
	
	/*** Responsive Menu Function ***/
		$('.ipadMenu').change(function(){
			var loc = $('option:selected', this).val();
			document.location.href = loc;
		});
	
	
	/*** Side Panel Functions ***/
	$(".panel-icon").click(function(){
		$(".side-panel").toggleClass("show");
	});	
	

	$(".list").click(function(){
        $(".grid").removeClass("active");
        $(".view-style").removeClass("grid-view");
        $(".view-style").addClass("list-view");
		$(this).addClass("active");
	});	
	$(".grid").click(function(){
        $(".list").removeClass("active");
        $(".view-style").removeClass("list-view");
        $(".view-style").addClass("grid-view");
		$(this).addClass("active");
		
	});	

	
var nav = $('.sticky');
$(window).scroll(function () {
	if ($(this).scrollTop() > 80) {
			nav.addClass("stick");
	}
	else {
			nav.removeClass("stick");
	}
});
/*** Toggle Header ***/
$(".open-header").click(function(){
	$("header .container").slideToggle();
});	


	
	
	$(".boxed-style").click( function(){
		$(".theme-layout").addClass("boxed");
		$("body").addClass('bg-body1');
	});
	$(".full-style").click( function(){
		$(".theme-layout").removeClass("boxed");
		$("body").removeClass('bg-body1');
		$("body").removeClass('bg-body2');
		$("body").removeClass('bg-body3');
		$("body").removeClass('bg-body4');
		$("body").removeClass('bg-body5');
		$("body").removeClass('bg-body6');
		$("body").removeClass('bg-body7');
		$("body").removeClass('bg-body8');
		$("body").removeClass('bg-body9');
		$("body").removeClass('bg-body10');
	});
	$(".pat1").click( function(){
		$("body").addClass('bg-body1');
		$("body").removeClass('bg-body2');
		$("body").removeClass('bg-body3');
		$("body").removeClass('bg-body4');
		$("body").removeClass('bg-body5');
		$("body").removeClass('bg-body6');
		$("body").removeClass('bg-body7');
		$("body").removeClass('bg-body8');
		$("body").removeClass('bg-body9');
		$("body").removeClass('bg-body10');
	});
	$(".pat2").click( function(){
		$("body").removeClass('bg-body1');
		$("body").addClass('bg-body2');
		$("body").removeClass('bg-body3');
		$("body").removeClass('bg-body4');
		$("body").removeClass('bg-body5');
		$("body").removeClass('bg-body6');
		$("body").removeClass('bg-body7');
		$("body").removeClass('bg-body8');
		$("body").removeClass('bg-body9');
		$("body").removeClass('bg-body10');
	});
	$(".pat3").click( function(){
		$("body").removeClass('bg-body1');
		$("body").removeClass('bg-body2');
		$("body").addClass('bg-body3');
		$("body").removeClass('bg-body4');
		$("body").removeClass('bg-body5');
		$("body").removeClass('bg-body6');
		$("body").removeClass('bg-body7');
		$("body").removeClass('bg-body8');
		$("body").removeClass('bg-body9');
		$("body").removeClass('bg-body10');
	});
	$(".pat4").click( function(){
		$("body").removeClass('bg-body1');
		$("body").removeClass('bg-body2');
		$("body").removeClass('bg-body3');
		$("body").addClass('bg-body4');
		$("body").removeClass('bg-body5');
		$("body").removeClass('bg-body6');
		$("body").removeClass('bg-body7');
		$("body").removeClass('bg-body8');
		$("body").removeClass('bg-body9');
		$("body").removeClass('bg-body10');
	});
	$(".pat5").click( function(){
		$("body").removeClass('bg-body1');
		$("body").removeClass('bg-body2');
		$("body").removeClass('bg-body3');
		$("body").removeClass('bg-body4');
		$("body").addClass('bg-body5');
		$("body").removeClass('bg-body6');
		$("body").removeClass('bg-body7');
		$("body").removeClass('bg-body8');
		$("body").removeClass('bg-body9');
		$("body").removeClass('bg-body10');
	});
	$(".pat6").click( function(){
		$("body").removeClass('bg-body1');
		$("body").removeClass('bg-body2');
		$("body").removeClass('bg-body3');
		$("body").removeClass('bg-body4');
		$("body").removeClass('bg-body5');
		$("body").addClass('bg-body6');
		$("body").removeClass('bg-body7');
		$("body").removeClass('bg-body8');
		$("body").removeClass('bg-body9');
		$("body").removeClass('bg-body10');
	});
	$(".pat7").click( function(){
		$("body").removeClass('bg-body1');
		$("body").removeClass('bg-body2');
		$("body").removeClass('bg-body3');
		$("body").removeClass('bg-body4');
		$("body").removeClass('bg-body5');
		$("body").removeClass('bg-body6');
		$("body").addClass('bg-body7');
		$("body").removeClass('bg-body8');
		$("body").removeClass('bg-body9');
		$("body").removeClass('bg-body10');
	});
	$(".pat8").click( function(){
		$("body").removeClass('bg-body1');
		$("body").removeClass('bg-body2');
		$("body").removeClass('bg-body3');
		$("body").removeClass('bg-body4');
		$("body").removeClass('bg-body5');
		$("body").removeClass('bg-body6');
		$("body").removeClass('bg-body7');
		$("body").addClass('bg-body8');
		$("body").removeClass('bg-body9');
		$("body").removeClass('bg-body10');
	});
	$(".pat9").click( function(){
		$("body").removeClass('bg-body1');
		$("body").removeClass('bg-body2');
		$("body").removeClass('bg-body3');
		$("body").removeClass('bg-body4');
		$("body").removeClass('bg-body5');
		$("body").removeClass('bg-body6');
		$("body").removeClass('bg-body7');
		$("body").removeClass('bg-body8');
		$("body").addClass('bg-body9');
		$("body").removeClass('bg-body10');
	});
	$(".pat10").click( function(){
		$("body").removeClass('bg-body1');
		$("body").removeClass('bg-body2');
		$("body").removeClass('bg-body3');
		$("body").removeClass('bg-body4');
		$("body").removeClass('bg-body5');
		$("body").removeClass('bg-body6');
		$("body").removeClass('bg-body7');
		$("body").removeClass('bg-body8');
		$("body").removeClass('bg-body9');
		$("body").addClass('bg-body10');
	});
	
	
		
	
	/*** Carousel Function ***/
	$('#slider2').tinycarousel(
	{
		display: 1,
		interval: true
	});
	$('#slider3').tinycarousel(
	{
		display: 1,
		interval: true
	});
	
	$('#slider4').tinycarousel(
	{
		display: 1,
		interval: false
	});
	
	$('#slider5').tinycarousel(
	{
		display: 1,
		interval: false
	});


	
	/*** Service Toggle Function ***/
	$('.toggle:first').addClass("activate");
	
	$(".toggle").mouseenter(function(){
		$(".toggle").removeClass("activate");
		$(this).addClass("activate");
	});	
	
	
	/*** Round Carousel ***/
	if($('ul.round').length !== 0){
		$('ul.round').roundabout();
	}
	
	


	/*** Make An Appointment Toggle Function ***/
	$(".make-app").click(function(){
		$(".make-app").toggleClass("click");
		$(".make-app-form").slideToggle(500);
	});	
	$(".make-app").click(function(){
		$(".make-app-toggle").toggleClass("border");
	});	
	



	
	

	
	/*** Slider Function ***/
	if ($('#camera_wrap_1').length !== 0){
	$('#camera_wrap_1').camera({
		height: '38%',
		thumbnails: true,
		time: 12000,
		transPeriod: 1000
	});
	}
	

	
$(".checkout-block-title").click(function(){
	$(this).toggleClass("active-block");
	$(this).next(".checkout-block-content").slideToggle();
});	

var payment = $('.payment-desc');
$(".payment-method").click(function(){
	$(this).next(payment).slideDown();
});	


$(".testimonial").parent().parent().parent().addClass('container visible'); 
/*** TESTIMONIAL CAROUSEL SELECTION ***/	
var testimonials = $('.testimonial-carousel li');
$(".testimonial-carousel li").click( function(){
	$(testimonials).removeClass("active");
});	

$(".search-doctor").parent().parent().parent().addClass('visible'); 
$(".logo-carousel").parent().parent().parent().parent().addClass('gray'); 
$(".welcome-sec").parent().parent().parent().parent().addClass('blur'); 
$(".spa-carousel").parent().parent().parent().addClass('visible'); 
$(".banners").parent().parent().parent().parent().addClass('blackish moveup'); 
$(".fancy-gallery").parent().parent().parent().addClass('full').parent().addClass('gallery-sec'); 


$('.menu-btn').click(function(){
	$(this).next('header.side-header').toggleClass('slidein');
});


$('.side-header #menu ul li a').next('ul').parent().addClass('no-link')
$('.no-link > a').click(function(){
	return false;
});	

$(".side-header #menu > ul > li > a").click(function(){
	$(".side-header #menu > ul > li > ul").slideUp();
	$(".side-header #menu  > ul > li").removeClass('opened');
	$(this).next('ul').slideDown();
	$(this).next('ul').parent().toggleClass('opened');
});	
$(".side-header #menu  > ul > li > ul > li a").click(function(){
	$(".side-header #menu  > ul > li > ul > li > ul").slideUp();
	$(".side-header #menu  > ul > li > ul > li").removeClass('opened');
	$(this).next('ul').slideDown();
	$(this).next('ul').parent().toggleClass('opened');
});	
	
  $('.side-header #menu  > ul > li > ul > li a' , '.side-header #menu > ul > li > a').click(function(e){
     e.stopPropagation();
  });
  $('html').click(function() {
	$(".side-header #menu > ul > li > ul").slideUp();
	$(".side-header #menu  > ul > li > ul > li > ul").slideUp();
	$(".side-header #menu  > ul > li").removeClass('opened');
	$(".side-header #menu  > ul > li > ul > li").removeClass('opened');
      // Animation complete.
    });


var megamenu = $('.mega-menu').width()+60;
var margin = megamenu / 2;
$('.mega-menu').css({
	"margin-left": -margin
});


$(".mega-menu ul li ul").parent().addClass("has-child");

$("#menu ul li").mouseenter(function(){
	$(".mega-menu", this).fadeIn(250);
});
$("#menu ul li").mouseleave(function(){
	$(".mega-menu", this).fadeOut(250);
});


$(".responsive-header > span").click(function(){
	$(this).next('ul').slideToggle();
	$(".responsive-header > ul > li > ul").slideUp();
	$(".responsive-header > ul > li > ul > li > ul").slideUp();
	$(".responsive-header > ul > li").removeClass('opened');
	$(".responsive-header > ul > li > ul > li").removeClass('opened');
});	

$('.responsive-header ul li a').next('ul').parent().addClass('no-link')
$('.no-link > a').click(function(){
	return false;
});	


$(".responsive-header > ul > li > a").click(function(){
	$(".responsive-header > ul > li > ul").slideUp();
	$(".responsive-header > ul > li").removeClass('opened');
	$(this).next('ul').slideDown();
	$(this).next('ul').parent().toggleClass('opened');
});	
$(".responsive-header > ul > li > ul > li a").click(function(){
	$(".responsive-header > ul > li > ul > li > ul").slideUp();
	$(".responsive-header > ul > li > ul > li").removeClass('opened');
	$(this).next('ul').slideDown();
	$(this).next('ul').parent().toggleClass('opened');
});	


/*=================== Accordion ===================*/   
$(function() {
$('.fancy-toggle .content').hide();
$('.fancy-toggle h2:first').addClass('active').next().slideDown(500).parent().addClass("activate");
$('.fancy-toggle h2').click(function() {
    if($(this).next().is(':hidden')) {
        $('.fancy-toggle h2').removeClass('active').next().slideUp(500).parent().removeClass("activate");
        $(this).toggleClass('active').next().slideDown(500).addClass('animated zoomIn').parent().toggleClass("activate");
    }
});
});



});/*** Document Ready Function Ends ***/




