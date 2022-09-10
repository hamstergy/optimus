var swiper = new Swiper(".main-slider", {
  slidesPerView: 1,
  loop:true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});

var brands = new Swiper(".brands-init", {
  slidesPerView: 6,
 spaceBetween: 30,
  loop:false,
  navigation: {
    nextEl: "#brend-next",
    prevEl: "#brend-prev",
  },
  breakpoints: {
 
     1024: {
           slidesPerView: 6,
           spaceBetween: 30
         },
         680: {
           slidesPerView: 4.2,
           centeredSlides: false,
           spaceBetween: 10,
         },
         320: {
           slidesPerView: 2.2,
           spaceBetween: 10,
         },
         
       }
});
var rewiews = new Swiper(".rew-slider", {
  slidesPerView: 3,
  spaceBetween: 15,
  centeredSlides: true,
  loop:true,
  navigation: {
    nextEl: "#n-next",
    prevEl: "#n-prev",
  },
  breakpoints: {
 
    1024: {
      slidesPerView: 3,
      spaceBetween: 15
    },
    680: {
      slidesPerView: 2.2,
      centeredSlides: false,
      spaceBetween: 10,
    },
    320: {
      slidesPerView: 1.2,
      centeredSlides: false,
      spaceBetween: 10,
    },
    
  }
});

var newsslider = new Swiper(".news-init", {
  slidesPerView: 3,
  spaceBetween: 30,
  loop:true,
  navigation: {
    nextEl: "#news_next",
    prevEl: "#news_prev",
  },
  breakpoints: {
 
    1024: {
      slidesPerView: 3,
      spaceBetween: 15
    },
    680: {
      slidesPerView: 2.2,
      centeredSlides: false,
      spaceBetween: 10,
    },
    320: {
      slidesPerView: 1.2,
      centeredSlides: false,
      spaceBetween: 10,
    },
    
  }
});

  /*Акоррдион*/
  $(function() {
	var Accordion = function(el, multiple) {
		this.el = el || {};
		this.multiple = multiple || false;

		// Variables privadas
		var links = this.el.find('.faq-header');
		// Evento
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
	}

	Accordion.prototype.dropdown = function(e) {
		var $el = e.data.el;
			$this = $(this),
			$next = $this.next();

		$next.slideToggle();
		$this.parent().toggleClass('active');

		if (!e.data.multiple) {
			$el.find('.faq-content').not($next).slideUp().parent().removeClass('active');
			$el.find('.faq-list').not($next).slideUp().parent().removeClass('active');
		};
	}	

	var accordion = new Accordion($('.faq-list'), false);
});


$(document).ready(function() {
	$('.open-popup-link').magnificPopup({
		type: 'inline',

		fixedContentPos: false,
		fixedBgPos: true,

		overflowY: 'auto',

		closeBtnInside: true,
		preloader: false,
		
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in'
	});
});



$(".menu-side ul li:has(ul), .mobile-side ul li:has(ul)").addClass("parent");
$(function(){
  $('.toggle-mnu').on('click' , function (){
   $(this).toggleClass("on");
   $('body').toggleClass("on");
   $('.opacity').toggleClass("on");
  
$('.mobile-side').toggleClass('small',500, function(){

  if ($(this).css('display') === 'none') {
    $(this).removeAttr('style');
    
  }
  
});

  });
  
  });



    $(function(){
      var children=$('.mobile-side li a').filter(function(){return $(this).nextAll().length>0})
      
      $('<span class="toChild"></span>').insertAfter(children)
      $('.mobile-side .toChild').click(function (e) {
        if ($('.toChild').hasClass('open')) {
          $(this).removeClass('open');
        } else {
           $(this).addClass('open');
        }
        $(this).next().slideToggle(300);
          return false;
      });
    })