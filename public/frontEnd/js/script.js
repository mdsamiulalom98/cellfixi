jQuery(document).ready(function () {
    "use strict";

        // main slider
        $(".main-slider").owlCarousel({
            items: 1,
            loop: true,
            dots: true,
            autoplay: true,
            nav: false,
            autoplayHoverPause: false,
            margin: 0,
            mouseDrag: true,
            smartSpeed: 1000,
            autoplayTimeout: 5000,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',

            // navText: ["<i class='fa-solid fa-angle-double-left'></i>",
            //     "<i class='fa-solid fa-angle-double-right'></i>"
            // ],

           
        });
        // brand slider
    $("#brandCarousel").owlCarousel({
        items: 5,
        loop: true,
        dots: false,
        autoplay: true,
        nav: true,
        autoplayHoverPause: false,
        margin: 0,
        mouseDrag: true,
        smartSpeed: 1000,
        autoplayTimeout: 5000,
        navText: ["<i class='fa-solid fa-angle-double-left'></i>",
            "<i class='fa-solid fa-angle-double-right'></i>"
        ],
        responsive: {
            0: {
                items: 2,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 5,
                nav: false
            }
        }
    });
    $(".achievement-carousel").owlCarousel({
        items: 4,
        loop: true,
        dots: false,
        autoplay: true,
        nav: true,
        autoplayHoverPause: false,
        margin: 0,
        mouseDrag: true,
        smartSpeed: 1000,
        autoplayTimeout: 5000,
        navText: ["<i class='fa-solid fa-angle-double-left'></i>",
            "<i class='fa-solid fa-angle-double-right'></i>"
        ],
        responsive: {
            0: {
                items: 2,
                nav: false
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 4,
                nav: false
            }
        }
    });
    $(".country-carousel").owlCarousel({
        items: 4,
        loop: true,
        dots: false,
        autoplay: true,
        nav: true,
        autoplayHoverPause: true,
        margin: 10,
        mouseDrag: true,
        smartSpeed: 1000,
        autoplayTimeout: 5000,
        navText: ["<i class='fa-solid fa-angle-double-left'></i>",
            "<i class='fa-solid fa-angle-double-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 4,
                nav: false
            }
        }
    });
    // brand slider
    $("#testimonialCarousel").owlCarousel({
        items: 3,
        loop: true,
        dots: false,
        autoplay: true,
        nav: true,
        autoplayHoverPause: true,
        margin: 20,
        mouseDrag: true,
        smartSpeed: 1000,
        autoplayTimeout: 5000,
        navText: ["<i class='fa-solid fa-angle-double-left'></i>",
            "<i class='fa-solid fa-angle-double-right'></i>"
        ],
        responsive: {
            0: {
                items: 1,
                nav: false
            },
            600: {
                items: 2,
                nav: false
            },
            1000: {
                items: 3,
                nav: false
            }
        }
    });
    $('.select2').select2();

})
