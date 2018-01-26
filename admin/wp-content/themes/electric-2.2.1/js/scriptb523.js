jQuery(document).ready(function($){
"use strict";

$(".popup-form span").on("click",function(){
    $(this).parent().slideUp();
});

$(".hire-img-inner > a").on("click",function(){
    $(this).parent().find(".popup-form").slideDown();
    return false;
});
$(".cancel-now").on("click",function(){
    $(this).parent().parent().parent().slideUp();
    return false;
})

var height = $('.service').height();
$('.service').height(height+120-128);
var height2 = $('.service-boxed').height();
$('.service-boxed').height(height2+80-108);
var pagetop = $(".page-title .block .container").height();     
var pagetop2 = $(".page-title .block").innerHeight();     
var total_pagetop = pagetop+pagetop2;
jQuery(".page-title .block").css({
    "height": total_pagetop
});
var portfoliotitle = $(".portfolio-title").height();
var portfoliotitlemargin = portfoliotitle/2;
jQuery(".portfolio-title").css({
    "margin-top": -portfoliotitlemargin
});
var a = $(".portfolio-hover").height()+100;   
var b = a / 2;
jQuery(".portfolio-hover").css({
    "margin-top": -b
});
var kenburnstext = $(".kenburns-text").height();   
var textmargin = kenburnstext / 2;
jQuery(".kenburns-text").css({
    "margin-top": -textmargin
});

/*=================== Header 5 Search Toggle ===================*/ 
$("header.header5 form button").on('mouseenter', function(){
    $(this).parent().find("input").slideDown();
})
$('header.header5 form').click(function(e){
     e.stopPropagation();
});
$('html').click(function() {
    $('header.header5 form input').slideUp();
});

/*=================== Hire Us ===================*/ 
$("hire-form").fadeOut();
$('.hire-button').on("click",function(){
    $(".hire-form").fadeIn();
    return false;
});
$(".hire-form .form > span").on("click",function(){
    $(this).parent().parent().parent().fadeOut();
});

/*=================== Start Now Form ===================*/ 
var simpletext = $(".simple-text").height();
jQuery(".simple-text").css({
"height": simpletext
});    
$('.open-form').on("click",function(){
    $(this).parent().addClass('form-opened');
    $(".form").addClass('show');
    var formheight = $(".form").height();
    jQuery(".simple-text").css({
    "height": formheight
    });    
    return false;
});
$('.form > span').on("click",function(){
    $('.simple-text').removeClass('form-opened');
    $(".form").removeClass('show');
    jQuery(".simple-text").css({
        "height": simpletext
    });    
    return false;
});



/*=================== Dropdown Anmiation ===================*/ 
var drop = $('nav > ul > li > ul > li') 
$('nav > ul > li').each(function(){
    var delay = 0;
    $(this).find(drop).each(function(){
    $(this).css({transitionDelay: delay+'ms'});
    delay += 50;
    });
});  
var drop2 = $('nav  > ul > li > ul > li >  ul > li')
$('nav > ul > li > ul > li').each(function(){      
    var delay2 = 0;
    $(this).find(drop2).each(function(){
    $(this).css({transitionDelay: delay2+'ms'});
    delay2 += 50;
    });
});  

/*=================== STICKY HEADER ===================*/ 
var menu = $(".menu").height();
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();
    if (scroll >= 70) {
        $(".stick").addClass("sticky");
        if ($("header").hasClass("stick")) {
            $("body").find(".theme-layout").css({
                "padding-top":menu
            });
        };
        $("header.header5").parent().css({
            "padding-top":0
        })
    }
    else{
        $(".stick").removeClass("sticky");
        $("body").find(".theme-layout").css({
            "padding-top":0
        });
    }
}); 


/*=================== Responsive Header ===================*/  
$(".responsive-header > span").on("click",function(){
    $(this).next('ul').slideToggle();
    $(".responsive-header > ul > li > ul").slideUp();
    $(".responsive-header > ul > li > ul > li > ul").slideUp();
    $(".responsive-header > ul > li").removeClass('opened');
    $(".responsive-header > ul > li > ul > li").removeClass('opened');
}); 
$('.responsive-header ul li a').next('ul').parent().addClass('no-link')
$('.no-link > a').on("click",function(){
    return false;
}); 
$(".responsive-header > ul > li > a").on("click",function(){
    $(".responsive-header > ul > li > ul").slideUp();
    $(".responsive-header > ul > li").removeClass('opened');
    $(this).next('ul').slideDown();
    $(this).next('ul').parent().toggleClass('opened');
}); 
$(".responsive-header > ul > li > ul > li a").on("click",function(){
    $(".responsive-header > ul > li > ul > li > ul").slideUp();
    $(".responsive-header > ul > li > ul > li").removeClass('opened');
    $(this).next('ul').slideDown();
    $(this).next('ul').parent().toggleClass('opened');
}); 
    
/*=================== Portfolio Popup ===================*/  
/*jQuery('.portfolio').each(function() {
    jQuery('.portfolio a').on("click",function(){        
        var data = jQuery(this).data('id');
        jQuery('.popup').removeClass('active');
        jQuery('.portfolio-popup').find('#'+data).addClass('active');
        jQuery('body').addClass('stop').find('.portfolio-popup').fadeIn().addClass('fix-height animated fadeInUp');
        jQuery('html').addClass('stop');
        return false
    });
});*/
/*jQuery('.big-portfolio').each(function() {
    jQuery('.big-port-desc a').on("click",function(){        
        var data = jQuery(this).data('id');
        jQuery('.popup').removeClass('active');
        jQuery('.portfolio-popup').find('#'+data).addClass('active');
        jQuery('body').addClass('stop').find('.portfolio-popup').fadeIn().addClass('fix-height animated fadeInUp');
        jQuery('html').addClass('stop');
        return false;
    });
    jQuery('.portfolio-popup .container > span').on("click",function(){        
        jQuery('.popup').removeClass('active');
        jQuery('body').removeClass('stop').find('.portfolio-popup').fadeOut().removeClass('fix-height animated fadeInUp');
        jQuery('html').removeClass('stop');
        return false;
    });
});*/

/*=================== Pretty Photo ===================*/  
$("body a[data-rel^='prettyPhoto']").prettyPhoto({
    theme: "facebook",
});

/*=================== Ajax Contact Form ===================*/  
$('#contactform').submit(function(){
    var action = $(this).attr('action');
    $("#message").slideUp(750,function() {
    $('#message').hide();
        $('#submit')
        .after('<img src="images/ajax-loader.gif" class="loader" />')
        .attr('disabled','disabled');
    $.post(action, {
        name: $('#name').val(),
        email: $('#email').val(),
        phone: $('#phone').val(),
        comments: $('#comments').val(),
        verify: $('#verify').val()
    },
    function(data){
        document.getElementById('message').innerHTML = data;
        $('#message').slideDown('slow');
        $('#contactform img.loader').fadeOut('slow',function(){$(this).remove()});
        $('#submit').removeAttr('disabled');
        if(data.match('success') != null) $('#contactform').slideUp('slow');
        }
    );
    });
    return false;
});
$('.form-builder').submit(function(){
    var action = $(this).attr('action');
    var method = $(this).attr("method");
    $(this).find('.submit')
            .after('<img src="'+themeurl+'/images/ajax-loader.gif" class="loader" />')
    $.ajax({
            type:method,
            url: action,
            data: $(this).serialize(),
            success: function(res){
                    $('.form-builder .message').html(res);
                    $('.form-builder .message').slideDown('slow');
                    $('.form-builder img.loader').fadeOut('slow',function(){$(this).remove()});
            }
    });
    return false;
});
$('.portfolio-sec .portfolio h3 a, .big-port-desc a.read-more-btn').live('click', function(e){
	
		if($('.loader-overlay').length == 0){
			$('body').append('<div class="loader-overlay"><div class="card"><span class="spinner">Loading…</span></div></div>');
		}
		if($('.portfolio-popup').length == 0){
			$('body').append('<div class="portfolio-popup"><div class="container"><span><i class="fa fa-times"></i></span><div  id="portfolio-popup" class="popup"></div></div></div>');
		}
		var portfolio_id = $(this).attr('data-id');
		e.preventDefault();
        $.ajax({
			url: ajaxurl,
			method: 'POST',
			data: 'action=electric_ajax_callback&subaction=sh_portfolio_detail&portfolio_id='+portfolio_id,
			success: function(res){
			  jQuery('.popup').removeClass('active');
				jQuery('.portfolio-popup').find('#portfolio-popup').addClass('active');
				jQuery('body').addClass('stop').find('.portfolio-popup').fadeIn().addClass('fix-height animated fadeInUp');
				jQuery('html').addClass('stop');
				$('#portfolio-popup').html(res);
				 jQuery('.portfolio-popup .container > span').on("click",function(){        
					jQuery('.popup').removeClass('active');
					jQuery('body').removeClass('stop').find('.portfolio-popup').fadeOut().removeClass('fix-height animated fadeInUp');
					jQuery('html').removeClass('stop');
					return false
				});
				$('.loader-overlay').hide();
			}
		});
	});
//$(".responsive-header > ul > li").each(function(){
//    var responsivemenu = $(this).children('a').eq(0);
//    $(this).children("ul ").prepend("<li><a href='"+responsivemenu[0]['href']+"'>"+responsivemenu[0]['innerHTML']+"</a></li>");
//});

$(".responsive-header > ul > li").each(function () {
    
    if ($(this).children('.mega-menu').length) {
        var parent_menu = this;
        var dropdown = '';
        var mega = $(this).children('.mega-menu');
       
        $(this).children('a').attr('href', '#');
        
        $(mega).find('ul').each(function (index, element) {
          
            $(this).children('li').children('a').children('i').remove();
            dropdown += $(this).html();
        });
        
        $(parent_menu).append('<ul>'+dropdown+'</ul>');
        $(mega).remove();
    }
    else {
        if($(this).children('ul').length){
            var responsivemenu = $(this).children('a').eq(0);
            $(this).children('a').attr('href', '#');
            var element = responsivemenu[0]['innerHTML'];
            $(this).children("ul").prepend("<li><a href='" + responsivemenu[0]['href'] + "'>" + element + "</a></li>");
        }
    }
});

/*=================== Side Header ===================*/ 

$(".side-menu > ul > li").each(function () {
    
    if ($(this).children('.mega-menu').length) {
        var parent_menu = this;
        var dropdown = '';
        var mega = $(this).children('.mega-menu');
        $(this).addClass('has-child');
        $(this).children('a').attr('href', '#');
        
        $(mega).find('ul').each(function (index, element) {
          
            $(this).children('li').children('a').children('i').remove();
            dropdown += $(this).html();
        });
        
        $(parent_menu).append('<ul>'+dropdown+'</ul>');
        $(mega).remove();
    }
    else {
        var responsivemenu = $(this).children('a').eq(0);
        $(this).children('a').attr('href', '#');
        var element = responsivemenu[0]['innerHTML'];
        $(this).children("ul").prepend("<li><a href='" + responsivemenu[0]['href'] + "'>" + element + "</a></li>");
    }
});

$(".menu-open > span").on("click",function(){
    $(this).parent().parent().toggleClass("opened");
    $(".side-menu li ul").slideUp();
});
$('.side-header').click(function(e){
     e.stopPropagation();
});
$('html').click(function() {
    $(".side-header").removeClass("opened");
    $(".side-menu li ul").slideUp();
});

$(".side-menu li ul").parent().addClass("has-child");
$(".side-menu li.has-child > a").on("click",function(){
    $(this).attr('href', 'javascript:void(0)');
});
$(".has-child").on("click",function(){
    $(this).find("ul").slideToggle();
});
var drop = $('.menu-open > ul > li') 
$('.menu-open > ul').each(function(){
    var delay = 200;
    $(this).find(drop).each(function(){
    $(this).css({transitionDelay: delay+'ms'});
    delay += 100;
    });
});  


jQuery('.blog-post img').each(function(){
  var title = jQuery(this).attr('title');
  if( title == 'Image Alignment 1200x400' ){
   jQuery(this).parent('div').attr('style', '');
  }
});
/*=================== Hire Section Z-index ===================*/   
var z_index = 2;
$(".hire-me").closest("section").css({
    "z-index":z_index
});



/*=================== Cart Page Close ===================*/   
$(".cart-table .close").on("click",function(){
    $(this).parent().parent().slideUp();
});

/*=================== Accordion ===================*/   
$(function() {
$('.toggle .content').hide();
$('.toggle h2:first').addClass('active').next().slideDown(500).parent().addClass("activate");
$('.toggle h2').click(function() {
    if($(this).next().is(':hidden')) {
        $('.toggle h2').removeClass('active').next().slideUp(500).removeClass('animated zoomIn').parent().removeClass("activate");
        $(this).toggleClass('active').next().slideDown(500).addClass('animated zoomIn').parent().toggleClass("activate");
    }
});
});


/*=================== Login Form Popup ===================*/   
$(".login-btn").on("click",function(){
    $(".login-popup").fadeToggle();
    $(this).toggleClass("active");
    $(this).parent().toggleClass("z_index")
    return false;
});

$(".shopping-cart li > span").live("click",function(){
    $(this).parent().slideUp();
});
$(".shopping-btn").live("click",function(){
    $(".shopping-cart").toggleClass("show");
    $(this).toggleClass("active");
    return false;
});
$('.shopping-cart').live('click',function(e){
     e.stopPropagation();
});
$('html').live('click',function() {
    $('.shopping-cart').removeClass("show");
    $(".shopping-btn").removeClass("active");
});

$(window).scroll(function() {    
    var scroll = $(window).scrollTop();
    if (scroll >= 70) {
        $(".sticky-btns").addClass("move-up");
        $(".shopping-cart").addClass("move-up");
    }
    else{
        $(".sticky-btns").removeClass("move-up");
        $(".shopping-cart").removeClass("move-up");
    }
});


    $('form.login-form').live('submit', function(e){
		
        $('form.login-fom .message').html('');
		var redirect_url = $(this).children('.redirect_url').val();
		var action = $(this).attr('action'); 
        $.ajax({
            type: 'POST',
            dataType:'json',
            url: action,
            data: $(this).serialize(),
            success: function(data){
                $('form.login-form .message').html(data.message);
                if (data.loggedin == true){
                    window.location.href = redirect_url;
                }
            }
        });
        e.preventDefault();
    });
	
    $('form.registration-form').live('submit', function(e){	
        //$('form.registration-form .message').show().text(wst_login_form_object.loadingmessage);
		var action = $(this).attr('action');
		
		$.ajax({
			type: 'POST',
			dataType:'json',
			url: action,
			data: $(this).serialize(),
			success: function(data){
                            $('form.registration-form .message').html(data.message);
			}
		});
		 
        e.preventDefault();
    });

});/*=== Document.Ready Ends Here ===*/ 		
jQuery(window).load(function(){
    /*** PARALLAX INITIALIZATION ***/   
    jQuery('.parallax').scrolly({bgParallax: true});
    jQuery('.service-parallax').scrolly({bgParallax: true});
});/*=== Window.Load Ends Here ===*/         
jQuery(document).ready(function ($) {
    $('form.newsletter-form').on('submit', function () {
        var action = $(this).attr('action');
        var msg = $(this).children('.msg');
        var button_id = $(this).children('input.submit');
        $(msg).empty();
        jQuery.ajax({
            type: "post",
            url: action,
            data: $(this).serialize(),
            beforeSend: function () {
                $(button_id).after('<img src="' + themeurl + '/images/ajax-loader.gif" class="loader" />').attr('disabled', 'disabled');
            },
            success: function (respnse) {
                $('form.newsletter-form img.loader').fadeOut('slow', function () {
                    $(this).remove();
                });
                $(button_id).removeAttr('disabled');
                $(msg).html(respnse);
            }
        });
        return false;
    });
});