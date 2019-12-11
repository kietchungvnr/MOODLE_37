(function($) {
    $(document).ready(function () {
        "use strict";
        $('#btn-control').on('slide.bs.carousel', function (e) {

            var $e = $(e.relatedTarget);
            var idx = $e.index();
            var itemsPerSlide = 4;
            var totalItems = $('.carousel-item').length;

            if (idx >= totalItems - (itemsPerSlide - 1)) {
                var it = itemsPerSlide - (totalItems - idx);
                for (var i = 0; i < it; i++) {
                // append slides to end
                if (e.direction === "left") {
                    $('.carousel-item').eq(i).appendTo('.carousel-inner');
                }
                else {
                    $('.carousel-item').eq(0).appendTo('.carousel-inner');
                }
            }
        }
    });
         $(window).scroll(function() {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
        });
        $('#return-to-top').click(function() {      // When arrow is clicked
            $('body,html').animate({
                scrollTop : 0                       // Scroll to top of body
            }, 500);
        });

        var owlcourse = $('#news-slider6');
        var owlnews = $('#news-slider');
        var owlrequiredcourse = $('#requiredcourse-slider');
        var owlrequiredpositioncourse = $('#requiredcourse-position-slider');
        var owlsuggestcourse = $('#suggest-course-slider');
        var owluserplancourse = $('#course-userplan-slider');
        owlcourse.owlCarousel({
            loop:false,
            margin:10,
            lazyLoad:true,
            autoplay:true,
            autoplayTimeout:5000,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:2,
                },
                1000:{
                    items:4, 
                }
            }

        });
        owlnews.owlCarousel({
            loop:false,
            margin:10,
            nav:true,
            lazyLoad:true,
            navText: [$('.am-next'),$('.am-prev')],
            autoplay:true,
            autoplayTimeout:20000,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:1,
                },
                1000:{
                    items:1, 
                }
            }

        });
        owlrequiredcourse.owlCarousel({
            loop:false,
            margin:10,
            lazyLoad:true,
            // autoplay:true,
            autoplayTimeout:5000,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:2,
                },
                1000:{
                    items:4, 
                },
                1450:{
                    items:5, 
                }
            }

        });
        owlsuggestcourse.owlCarousel({
            loop:false,
            margin:10,
            lazyLoad:true,
            // autoplay:true,
            autoplayTimeout:5000,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:2,
                },
                1000:{
                    items:4, 
                },
                1450:{
                    items:5, 
                }
            }

        });
        owlrequiredpositioncourse.owlCarousel({
            loop:false,
            margin:10,
            lazyLoad:true,
            // autoplay:true,
            autoplayTimeout:5000,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:2,
                },
                1000:{
                    items:4, 
                },
                1450:{
                    items:5, 
                }
            }

        });
        owluserplancourse.owlCarousel({
            loop:false,
            margin:10,
            lazyLoad:true,
            // autoplay:true,
            autoplayTimeout:5000,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                },
                600:{
                    items:2,
                },
                1000:{
                    items:4, 
                },
                1450:{
                    items:5, 
                }
            }

        });
        // owl.on('mousewheel', '.owl-stage', function (e) {
        //     if (e.deltaY>0) {
        //         owl.trigger('next.owl');
        //     } else {
        //         owl.trigger('prev.owl');
        //     }
        //     e.preventDefault();
        // });
    });

})(jQuery);

