// JavaScript Document
"use strict"; 

// zero carousel four-column

(function(){
  // setup your carousels as you normally would using JS
  // or via data attributes according to the documentation
  // http://getbootstrap.com/javascript/#carousel
  //$('#carousel-columns').carousel({ interval: 4000 });
  // you can add here how many you want
}());

(function(){
  $('.four-column .item').each(function(){
    var itemToClone = $(this);

    for (var i=1;i<4;i++) {
      itemToClone = itemToClone.next();

      // wrap around if at end of item collection
      if (!itemToClone.length) {
        itemToClone = $(this).siblings(':first');
      }

      // grab item, clone, add marker class, add to collection
      itemToClone.children(':first-child').clone()
        .addClass("cloneditem-"+(i))
        .appendTo($(this));
    }
  });
}());


// zero carousel testimonials
(function(){
  // setup your carousels as you normally would using JS
  // or via data attributes according to the documentation
  // http://getbootstrap.com/javascript/#carousel
  $('#testimonials-list').carousel({ interval: 4000 });
  // you can add here how many you want
}());

(function(){
  $('.testimonials .item').each(function(){
    var itemToClone = $(this);

    for (var i=1;i<2;i++) {
      itemToClone = itemToClone.next();

      // wrap around if at end of item collection
      if (!itemToClone.length) {
        itemToClone = $(this).siblings(':first');
      }

      // grab item, clone, add marker class, add to collection
      itemToClone.children(':first-child').clone()
        .addClass("cloneditem-"+(i))
        .appendTo($(this));
    }
  });
}());


// toggle class on scroll
$(window).scroll(function() {
    if ($(this).scrollTop() > 47){  
        
		$("#header-logo").attr("src","files/images/logo.png");
		$("#menu-bar").attr("class","container");
		$("#menu-cover").attr("class","middle");
	  $('header .middle').addClass("sticky");
    $('main').addClass("main_active");
		
    }
    else{
        
		$("#header-logo").attr("src","files/images/logo-white.png");
		$("#menu-bar").attr("class","middle");
		$("#menu-cover").attr("class","container");
		$('header .middle').removeClass("sticky");
     $('main').removeClass("main_active");
    }
});


$('.carousel').on('slide.carousel', function () {
  
})

// carousel swipe
$(".carousel").swipe({

  swipe: function(event, direction, distance, duration, fingerCount, fingerData) {

    if (direction == 'left') $(this).carousel('next');
    if (direction == 'right') $(this).carousel('prev');
  },
  allowPageScroll:"vertical"
});


//  bootstrap accordion adding active class
(function() {
  $(".panel").on("show.bs.collapse hide.bs.collapse", function(e) {
    if (e.type=='show'){
      $(this).addClass('active');
    }else{
      $(this).removeClass('active');
    }
  });  
}).call(this);


//  bootstrap tooltip
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

//  bootstrap popover
$(function () {
  $('[data-toggle="popover"]').popover()
})


// enable scroll content
    $(function(){
      $('#scroll-content').slimscroll();
    });

// scroll to the top	

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

	$('.scrollup').on("click", function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });
	
$(document).ready(function(){
	$(".password_show_button").mouseup(function(){
		$(".password_show").attr("type", "password");
	});
	$(".password_show_button").mousedown(function(){
		$(".password_show").attr("type", "text");
	});
});

$(function () {
	$('#datetimepicker1').datepicker();
});

function ChangeText(oFileInput, sTargetID) {
   
    document.getElementById(sTargetID).value = oFileInput.value;
}