(function($) {
    $(document).ready(function() {
        "use strict";
        $('#btn-control').on('slide.bs.carousel', function(e) {
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
                    } else {
                        $('.carousel-item').eq(0).appendTo('.carousel-inner');
                    }
                }
            }
        });
        // Auto hieght cho textarea
        $('textarea').each(function() {
            this.setAttribute('style', 'height:42px;overflow-y:hidden;');
        }).on('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        // Auto scroll lên top
        $(window).scroll(function() {
            if ($(this).scrollTop() >= 50) { // If page is scrolled more than 50px
                $('#return-to-top').fadeIn(200); // Fade in the arrow
            } else {
                $('#return-to-top').fadeOut(200); // Else fade out the arrow
            }
        });
        $('#return-to-top').click(function() { // When arrow is clicked
            $('body,html').animate({
                scrollTop: 0 // Scroll to top of body
            }, 500);
        });

        // Go back and go forward cho iframe
        $('#btn-backward').on('click', function(e){
            e.preventDefault();
            window.history.back();
        });
        $('#btn-forward').on('click', function(e){
            e.preventDefault();
            window.history.back();
        });

        // Hiệu ứng slider cho owlcourse
        var owlfrontpage = $('#frontpage-course-slider');
        var owlcourse = $('#news-slider6');
        var owlnewestcourse = $('#newest-course-slider');
        var owlallcourse = $('#all-course-slider');
        var owlnews = $('#news-slider');
        var owlrequiredcourse = $('#requiredcourse-slider');
        var owlrequiredpositioncourse = $('#requiredcourse-position-slider');
        var owlsuggestcourse = $('#suggest-course-slider');
        var owluserplancourse = $('#course-userplan-slider');
        owlfrontpage.owlCarousel({
            loop: false,
            margin: 10,
            lazyLoad: true,
            // autoplay:true,
            autoplayTimeout: 5000,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 4,
                },
                // 1400:{
                //     items:5, 
                // }
            }

        });
        owlcourse.owlCarousel({
            loop: false,
            margin: 10,
            lazyLoad: true,
            // autoplay:true,
            autoplayTimeout: 5000,
            responsiveClass: true,
           responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: 4,
                },
                1200: {
                    items: 5,
                },
                1350: {
                    items: 6,
                }
            }

        });
        owlnewestcourse.owlCarousel({
            loop: false,
            margin: 10,
            lazyLoad: true,
            // autoplay:true,
            autoplayTimeout: 5000,
            responsiveClass: true,
           responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: 4,
                },
                1200: {
                    items: 5,
                },
                1350: {
                    items: 6,
                }
            }

        });
        owlallcourse.owlCarousel({
            loop: false,
            margin: 10,
            lazyLoad: true,
            // autoplay:true,
            autoplayTimeout: 5000,
            responsiveClass: true,
           responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: 4,
                },
                1200: {
                    items: 5,
                },
                1350: {
                    items: 6,
                }
            }

        });
        owlnews.owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            lazyLoad: true,
            navText: [$('.am-next'), $('.am-prev')],
            autoplay: true,
            autoplayTimeout: 20000,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 1,
                },
                1000: {
                    items: 1,
                }
            }

        });
        owlrequiredcourse.owlCarousel({
            loop: false,
            margin: 10,
            lazyLoad: true,
            // autoplay:true,
            autoplayTimeout: 5000,
            responsiveClass: true,
           responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: 4,
                },
                1200: {
                    items: 5,
                },
                1350: {
                    items: 6,
                }
            }

        });
        owlsuggestcourse.owlCarousel({
            loop: false,
            margin: 10,
            lazyLoad: true,
            // autoplay:true,
            autoplayTimeout: 5000,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: 4,
                },
                1200: {
                    items: 5,
                },
                1350: {
                    items: 6,
                }
            }

        });
        owlrequiredpositioncourse.owlCarousel({
            loop: false,
            margin: 10,
            lazyLoad: true,
            // autoplay:true,
            autoplayTimeout: 5000,
            responsiveClass: true,
           responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: 4,
                },
                1200: {
                    items: 5,
                },
                1350: {
                    items: 6,
                }
            }

        });
        owluserplancourse.owlCarousel({
            loop: false,
            margin: 10,
            lazyLoad: true,
            // autoplay:true,
            autoplayTimeout: 5000,
            responsiveClass: true,
           responsive: {
                0: {
                    items: 1,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: 4,
                },
                1200: {
                    items: 5,
                },
                1350: {
                    items: 6,
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