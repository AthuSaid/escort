"use strict";
jQuery(document).ready(function ($) {


    //==========================================
    //for Preloader
    //=========================================

    $(window).load(function () {
        $("#loading").fadeOut(500);        
    });


    //==========================================
    // Mobile menu
    //=========================================
    $('#navbar-menu').find('a[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: (target.offset().top - 80)
                }, 500);
                if ($('.navbar-toggle').css('display') != 'none') {
                    $(this).parents('.container').find(".navbar-toggle").trigger("click");
                }
                return false;
            }
        }
    });



    //==========================================
    // wow
    //=========================================

    var wow = new WOW({
        mobile: false 
    });
    wow.init();


// =========================================
// magnificPopup
// =========================================

    $('.popup-img').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });

    $('.video-link').magnificPopup({
        type: 'iframe'
    });


// =========================================
//      featured slider
// =========================================       

/*
    $('.featured_slider').slick({
        centerMode: true,
        dote: true,
        centerPadding: '60px',
        slidesToShow: 3,
        speed: 1500,
        index: 2,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    arrows: false,
                    centerMode: true,
                    centerPadding: '40px',
                    slidesToShow: 1
                }
            }
        ]
    });
*/
   
// =========================================
// Counter
// =========================================   

    //fCountHomeResume();
    /*$('.statistic-counter').counterUp({
        delay: 10,
        time: 2000
    });*/



// =========================================
// Scroll Up
// =========================================   

    $(window).scroll(function () {
        if ($(this).scrollTop() > 600) {
            $('.scrollup').fadeIn('slow');
        } else {
            $('.scrollup').fadeOut('slow');
        }
    });
    $('.scrollup').click(function () {
        $("html, body").animate({scrollTop: 0}, 1000);
        return false;
    });


// =========================================
// About us accordion 
// =========================================   

    $("#faq_main_content").collapse({
        accordion: true,
        open: function () {
            this.addClass("open");
            this.css({height: this.children().outerHeight()});
        },
        close: function () {
            this.css({height: "0px"});
            this.removeClass("open");
        }
    });

// =========================================
// Team Skillbar active js
// =========================================   


    jQuery('.teamskillbar').each(function () {
        jQuery(this).find('.teamskillbar-bar').animate({
            width: jQuery(this).attr('data-percent')
        }, 5000);
    });

    //End
    

 // =========================================
 // Update Nav Notification
 // =========================================   

    $('.counter-notify').on('click', function(){    	
    	$.ajax({
            url: $urlProj + "_actions/notify.php",
            type: 'GET',
            data: {mtd: 'read'},
            dataType: "html",
            success: function (data) {
            	var json = $.parseJSON(data);
            	if(json.ret == true){            		
            		$('.counter-notify').html('');
            	}
            },
            cache: false        
        });
    });
    
    
    $('.search-field').keydown(function(e){
    	if (e.keyCode == 13){
	    	var searchValue = $('.search-field').val();
	    	$.ajax({
	            url: $urlProj + "_actions/search.php",
	            type: 'POST',	
	            data: {criteria: searchValue},
	            dataType: "html",
	            success: function (data) {
	            	var json = $.parseJSON(data);
	            	if (json.ret == true){            		
	            		location.href = $urlProj + "search";
	            	}
	            },
	            cache: false        
	        });
    	}
    });
    

});


function removeImg(hash) {
	if (confirm('Deseja remover esta foto?'))
	{
		$.ajax({
            url: $urlProj + "_actions/photo.php",
            type: 'GET',
            data: {mtd: 'delete', hash: hash},
            dataType: "html",
            success: function (data) {
            	var json = $.parseJSON(data);
            	if(json.ret == true){            		
            		$('.grid').isotope('remove', $('.hash_' + hash));
            		location.reload(); //FIX BUG jQuery Isotope Redistribute Items on Grid
            	}
            },
            cache: false        
        });		
	}
}

function enableItem(hash) {
	if (!$('#opt' + hash).is(':checked'))
		var active = '0';
	else
		var active = '1';
	$.ajax({
        url: $urlProj + "_actions/photo.php",
        type: 'GET',
        data: {mtd: 'update', active: active, hash: hash},
        dataType: "html",
        success: function (data) {
        	var json = $.parseJSON(data);
        	if(json.ret == true){            		
        		console.log(hash + ' com status ' + active);
        	}
        },
        cache: false        
    });
}


function setItemValue(title, descr, hash) {
	if (title != '' || descr != ''){
		$.ajax({
	        url: $urlProj + "_actions/photo.php",
	        type: 'GET',
	        data: {mtd: 'update', title: title, descr: descr, hash: hash},
	        dataType: "html",
	        success: function (data) {
	        	var json = $.parseJSON(data);
	        	if(json.ret == true){            		
	        		console.log(hash + ' atualizado!');
	        	}
	        },
	        cache: false        
	    });	
	}
}

// =========================================
//  Portfolio Isotop with Infinity Scroll
// =========================================   

$(function () {
	
	// Initialize Infinity Scroll
	//var win = $(window);
	//var scrollEnd = false;
	
    // Initialize Isotope
    var $notes = $(".grid").isotope({
        itemSelector: ".grid-item"
    });

    // On filter button click
    $(".filters-button-group .button").on("click", function (e) {
        var $this = $(this);

        // Prevent default behaviour
        e.preventDefault();

        // Toggle the active class on the correct button
        $(".filters-button-group .button").removeClass("is-checked");
        $this.addClass("is-checked");

        // Get the filter data attribute from the button
        $notes.isotope({
            filter: $this.attr("data-filter")
        });

    });
        
     
    $(".search-field").autocomplete({
      source: function(request, response){
        $.ajax({
          url: $urlProj + "_actions/autocomplete.php",
          dataType: "jsonp",
          data: {
        	  term: request.term
          },
          success: function(data) {
        	  response(data);
          }
        });
      },
      minLength: 3,
      select: function(event, ui) {
    	  console.log( "Selected: " + ui.item.value + " aka " + ui.item.id );
      }
    });          
});