(function ($) {
    "use strict";
    
    $(document).ready(function () {
        /*---------------------------------------------------
            mainmenu
        ----------------------------------------------------*/
        $('.mainmenu').meanmenu({
            meanMenuContainer: '.mobile-menu',
            meanScreenWidth: '1199',
        });

        $(".sidebar-toggle-btn").on("click", function () {
            $(".sidebar-wrap").addClass("sidebar-opened");
//            $(".body-overlay").addClass("opened");
        });
        $(".sidebar-close-btn").on("click", function () {
            $(".sidebar-wrap").removeClass("sidebar-opened");
//            $(".body-overlay").removeClass("opened");
        });

        //===== Sticky
        $(window).on('scroll', function(event) {    
            var scroll = $(window).scrollTop();
            if (scroll < 350) {
                $(".header-bottom").removeClass("sticky");
            } else{
                $(".header-bottom").addClass("sticky");
            }
        });
           
        /*---------------------------------------------------
            slider carousel
        ----------------------------------------------------*/
            var $full = $('.hero-slider');
            if($full.length > 0){
            $(document).ready(function(){
                $(".hero-slider").owlCarousel({
                    loop:true,
                    center:true,
                    margin:20,
                    animateOut: 'fadeOut',
                    // smartSpeed:350,
                    // autoplaySpeed:3000,
                    autoplayHoverPause:true,
                    items:1,
                    autoplay: true,
                    nav: true,
                    navText: ['<i class="fas fa-long-arrow-alt-left"></i>', '<i class="fas fa-long-arrow-alt-right"></i>'],
                    responsive : {
                            0 : {
                               items:1,
                            },
                            
                            768 : {
                                 items:1,
                            },
                             991 : {
                                 items:1,
                            }
                        }
                    });
                });
            }
 

            var $event = $('.event_slider');
            if($event.length > 0){
            $(document).ready(function(){
                $(".event_slider").owlCarousel({
                    loop:true,
                    center:true,
                    margin:20,
                    smartSpeed:350,
                    autoplaySpeed:3000,
                    items:1,
                    autoplay: true,
                    nav: true,
                    navText: ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'], 
                    });
                });
            }

            var $client = $('.client-testimonial-slider');
            if($client.length > 0){
            $(document).ready(function(){
                $(".client-testimonial-slider").owlCarousel({
                    loop:true,
                    center:true,
                    margin:20,
                    items:1,
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn',
                    autoplay: true,
                    nav: true,
                    navText: ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'], 
                    });
                });
            }

            var $tabs_slider = $('.tabs_sliders');
            if($tabs_slider.length > 0){
            $(document).ready(function(){
                $(".tabs_sliders").owlCarousel({
                    loop:false,
                    center:true,
                    margin:20,
                    items:1,
                    autoplay: true,
                    nav: true,
                    navText: ['<span class="tabs-slider-nav"><i class="fas fa-angle-left"></i></span>', '<span class="tabs-slider-nav"><i class="fas fa-angle-right"></i></span>'], 
                    });
                });
            }

            var $design = $('.project_design-slider');
            if($design.length > 0){
            $(document).ready(function(){
                $(".project_design-slider").owlCarousel({
                    loop:true,
                    center:true,
                    margin:10,
                    smartSpeed:350,
                    autoplaySpeed:3000,
                    items:5,
                    autoplay: true,
                    nav: false,
                     responsive : {
                            0 : {
                               items:1,
                               center:false,
                            },
                            450 : {
                               items:2,
                               center:false,
                            },
                            
                            768 : {
                                 items:4,
                                  center:false,
                            },
                             991 : {
                                 items:5,
                            }
                        }
                    });
                });
            }

        var $slide = $('#slide-testimonal');
        if($slide.length > 0){   
            $('#slide-testimonal').owlCarousel({
                margin: 0,
                center: true,
                loop: true,
                nav: true,
                items: 3,
                autoplay:true,
                responsive: {
                0: {
                   items: 1
                },
                768: {
                   items: 2,
                },
                1000: {
                   items: 3,
                }
                }
            });
        }

        var $dev = $('.dev-slider');
        if($dev.length > 0){   
            $('.dev-slider').owlCarousel({
                margin: 0,
                center: true,
                loop: true,
                nav: true,
                items: 1,
                animateOut: 'fadeOut',
                animateIn: 'fadeIn',
                autoplay:true,
                navText: ['<i class="fas fa-caret-left"></i>', '<i class="fas fa-caret-right"></i>'], 
                });
            }



                var $owl = $('.developer-slider');
                $owl.children().each( function( index ) {
                  $(this).attr( 'data-position', index ); // NB: .attr() instead of .data()
                });

                $owl.owlCarousel({
                  center: true,
                  loop: true,
                  items: 5,
                  nav:true,
                  autoplay:true,
                  navText: ['<span><i class="fas fa-angle-left"></i></span>', '<span><i class="fas fa-angle-right"></i></span>'],
                   responsive: {
                    0: {
                       items: 1,
                    },
                     490: {
                       items: 1,
                    },
                    570: {
                       items: 3,
                    },
                    768: {
                       items: 3,
                    },
                    1000: {
                       items: 5,
                    },
                    1500: {
                       items: 5,
                    }
                }
                });

                $(document).on('click', '.owl-item>div', function() {
                  var $speed = 300;  // in ms
                  $owl.trigger('to.owl.carousel', [$(this).data( 'position' ), $speed] );
                });


     });

    
      


 
    /*---------------------------------------------------
        sticky header
    ----------------------------------------------------*/
    $(window).on('scroll', function () {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $(".header-toggle-btn").removeClass("sticky");
        } else {
            $(".header-toggle-btn").addClass("sticky");
        }
    });

        // WOW JS
         new WOW().init();
      // Elements Animation
      if($('.wow').length){
        var wow = new WOW(
          {
          boxClass:     'wow',      
          animateClass: 'animated',
          offset:       0,          
          mobile:       false,       
          live:         true       
          }
        );
        wow.init();
      }
    /*---------------------------------------------------
        preloader
    ----------------------------------------------------*/
    // $(window).on('load', function () {
    //     $('.preloader').fadeOut(500);
    // });

     /*---------------------------------------------------
                magnific popUp
        ----------------------------------------------------*/
        var $pop = $('.technology-video a');
        if($pop.length > 0){
        $('.technology-video a').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
            disableOn: 300
        });
    }

    // Scroll Area
    var $scroll = $('.scroll-area');
    if($scroll.length > 0){
        $(document).ready(function(){
            $('.scroll-area').click(function(){
                $('html').animate({
                    'scrollTop' : 0,
                },700);
                return false;
            });
            $(window).on('scroll',function(){
                var a = $(window).scrollTop();
                if(a>400){
                    $('.scroll-area').slideDown(300);
                }else{
                    $('.scroll-area').slideUp(200);
                }
            });
        });
    }

 /*---------------------------------------------------
        onePageNav
    ----------------------------------------------------*/
    var $dot = $('#nav_page');
        if($dot.length > 0){
           $('#nav_page').onePageNav({
            currentClass: 'current',
            changeHash: false,
            filter: '',
            easing: 'swing',
        }); 
         
      }

     

         //ui
        var $tab = $('#tabs_collection');
        if($tab.length > 0){
        $( function() {
            $( "#tabs_collection" ).tabs();
          } );
        }

       var $popup = $('.project_desgin-single a');
        if($popup.length > 0){
          $(document).ready(function(){
            $('.project_desgin-single a').magnificPopup({
                type: 'image',
                gallery: {
                    enabled: true
                },
            });
        });
        }

        //mixltup
        var $mix = $('.p-projects-full');
        if($mix.length > 0){
          $(document).ready(function(){
              var mixer = mixitup ('.p-projects-full')

                var mixer = mixitup('.p-projects-full');
                    var mixer = mixitup('.p-projects-full', {
                selectors: {
                    target: '.blog-item'
                },
                animation: {
                    duration:300
                }
            });

        });

        }
        // var $mix = $('#mix_work');
        // if($mix.length > 0){
        //   $(document).ready(function(){
        //       var mixer = mixitup ('#mix_work')

        //         var mixer = mixitup('#mix_work');
        //         var mixer = mixitup('#mix_work', {
        //         selectors: {
        //             target: '.blog-item'
        //         },
        //         animation: {
        //             duration:300
        //         }
        //     });

        // });

        // }

    var $marker = $('#marker');
    if($marker.length > 0){
    var marker = $('#marker'),
    current = $('.current');
    current.addClass('an_active');
    marker.css({
        bottom: -(marker.height() / 2),
        left: current.position().left,
        width: current.outerWidth(),
        display: "block"
    });

    if (Modernizr.csstransitions) {
    $('.filters_item').mouseover(function () {
        var self = $(this),
            offsetLeft = self.position().left,
            width = self.outerWidth() || current.outerWidth(),
            left = offsetLeft == 0 ? 0 : offsetLeft || current.position().left;
        $('.an_active').removeClass('an_active');
        self.addClass('an_active');
        marker.css({
            left: left,
            width: width,
        });
    });

    $('.works-filters__list').mouseleave(function () {
        $('.an_active').removeClass('an_active');
        current.addClass('an_active');
        marker.css({
            left: current.position().left,
            width: current.outerWidth()
        });
    });

    } else {
    $('.filters_item').mouseover(function () {
        var self = $(this),
            offsetLeft = self.position().left,
            width = self.outerWidth() || current.outerWidth(),
            left = offsetLeft == 0 ? 0 : offsetLeft || current.position().left;
            $('.an_active').removeClass('an_active');
            self.addClass('an_active');
            marker.stop().animate({
                left: left,
                width: width,
            }, 300);
    });

    $('.works-filters__list').mouseleave(function () {
        $('.an_active').removeClass('an_active');
        current.addClass('an_active');
        marker.stop().animate({
            left: current.position().left,
            width: current.outerWidth()
        }, 300);
    });
    };
   }


   var $page = $('#fullpage');
    if($page.length > 0){
       var slideIndexBis = 1;
        var sliding = false;
        $("#fullpage").fullpage({
            anchors: ["page1", "page2", "page3", "page4","page5","page6"],
              menu: '.pg-dots',
        }); 
    }
   $(document).bind("contextmenu", function (e) {
        e.preventDefault();
    });
  

}(jQuery));