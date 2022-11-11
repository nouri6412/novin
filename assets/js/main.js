/***************************** show password in login js*****************************/

function showPassword() {
    var key_attr = $('.inputpassword').attr('type');
    if (key_attr != 'text') {
        $('.checkbox').addClass('show');
        $('.inputpassword').attr('type', 'text');
    } else {
        $('.checkbox').removeClass('show');
        $('.inputpassword').attr('type', 'password');
    }
}
function showPassword2() {
    var key_attr = $('.inputpassword-repetition').attr('type');
    if (key_attr != 'text') {
        $('.checkbox').addClass('show');
        $('.inputpassword-repetition').attr('type', 'text');
    } else {
        $('.checkbox').removeClass('show');
        $('.inputpassword-repetition').attr('type', 'password');
    }
}

/*************************************** slider js***************************************/

if ($("#slider-category-product").length) {
    $(".slider_category_product").owlCarousel({
        //center: true,
        // margin: 20,
        rtl: true,
        loop: true,
        // autoplay: true,
        autoplaytimeout: 4000,
        smartSpeed: 500,
        // nav: true,
        // navText: ["<i class='fas fa-chevron-right'></i>", "<i class='fas fa-chevron-left'></i>"],
        dots: true,
        lazyLoadEager: 3,
        responsive: {
            // breakpoint from 0 up
            0: {
                items: 1,
                margin: 30,
            },
            // breakpoint from 576 up
            576: {
                items: 2,
                margin: 5,
                center: false,
            },
            // breakpoint from 768 up
            768: {
                items: 3,
                margin: 20,
            },
            992: {
                items: 3,
                margin: 10,
            },
            1200: {
                items: 3,
                margin: 20,
            }
        }
    })
}

if ($("#slider-about-us").length) {
    $(".slider_about-us").owlCarousel({
        items: 1,
        rtl: true,
        loop: true,
        autoplaytimeout: 4000,
        nav: true,
        navText: ["<i class='fas fa-chevron-right'></i>", "<i class='fas fa-chevron-left'></i>"],
        // lazyLoadEager: 3,
        dots: false,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        // autoplay:true,

    })

}


/*************************************** countdown js***************************************/

if ($("#countdown-product").length) {
    const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;
    let countDown = new Date('Sep 30, 2022 00:00:00').getTime(),
        x = setInterval(function () {
            let now = new Date().getTime(),
                distance = countDown - now;
            document.getElementById('days').innerText = Math.floor(distance / (day)),
                document.getElementById('hours').innerText = Math.floor((distance % (day)) / (hour)),
                document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute))
            document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
        }, second)
}

/*************************************** slider js***************************************/

if ($("#slider-customers-comments").length) {
    $(".slider_customers_comments").owlCarousel({
        //center: true,
        // margin: 20,
        rtl: true,
        loop: true,
        // autoplay: true,
        autoplaytimeout: 4000,
        smartSpeed: 500,
        // nav: true,
        // navText: ["<i class='fas fa-chevron-right'></i>", "<i class='fas fa-chevron-left'></i>"],
        dots: true,
        lazyLoadEager: 3,
        responsive: {
            // breakpoint from 0 up
            0: {
                items: 1,
                margin: 50,
            },
            // breakpoint from 576 up
            550: {
                items: 2,
                margin: 25,
            },
            // breakpoint from 768 up
            768: {
                items: 3,
                margin: 20,
                center: true,
            },
            992: {
                items: 3,
                margin: 20,
                center: true,
            },
            1200: {
                items: 4,
                margin: 20,
            }
        }
    })
}


if ($("#slider-single-product").length) {
    $(".slider_single-product").owlCarousel({
        //center: true,
        // margin: 20,
        rtl: true,
        loop: true,
        // autoplay: true,
        autoplaytimeout: 4000,
        smartSpeed: 500,
        // nav: true,
        // navText: ["<i class='fas fa-chevron-right'></i>", "<i class='fas fa-chevron-left'></i>"],
        dots: true,
        lazyLoadEager: 3,
        responsive: {
            // breakpoint from 0 up
            0: {
                items: 1,
                margin: 50,
            },
            // breakpoint from 576 up
            550: {
                items: 2,
                margin: 25,
            },
            // breakpoint from 768 up
            768: {
                items: 3,
                margin: 20,
                center: true,
            },
            992: {
                items: 3,
                margin: 20,
                center: true,
            },
            1200: {
                items: 4,
                margin: 20,
            }
        }
    })
}

/***************************** box side add to cart js*****************************/

$(".shooping-cat").click(function () {
    $(".area_add-t-cart").css({ "left": "0" });
    $(".bg-close").css({ "display": "block" });
});
$(".close_addtocart").click(function () {
    $(".area_add-t-cart").css({ "left": "-100%" });
    $(".bg-close").css({ "display": "none" });
});

$(".bg-close").click(function () {
    $(".area_add-t-cart").css({ "left": "-100%" });
    $(this).css({ "display": "none" });
});

/*************************************** tooltip js***************************************/

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

/*************************************** search js***************************************/

$("svg.bi-search").click(function () {
    $(".area_search").css({ "opacity": "1", "visibility": " visible" });
    $(".navbarr").css({ "opacity": "0", "visibility": " hidden" });
});
$(".close_search_header").click(function (e) {
    $(".area_search").css({ "opacity": "0", "visibility": "hidden" });
    $(".navbarr").css({ "opacity": "1", "visibility": " visible" });
});

/***************************************fixed menu js***************************************/

$(window).scroll(function () {
    if ($(window).scrollTop() > 600) {
        $(".area_navbar_sticky").css({ "top": "0" });
    } else {
        $(".area_navbar_sticky").css({ "top": "-100%" });
    }
});

/*************************** multilevel accordion menu mobile js ***************************/

// prevent page from jumping to top from  # href link
$('li.menu-item-has-children > a').click(function (e) {
    e.preventDefault();
});
// remove link from menu items that have children
$("li.menu-item-has-children > a").attr("href", "#");
//  function to open / close menu items
$(".menu-multi-level a").click(function () {
    var link = $(this);
    var closest_ul = link.closest("ul");
    var parallel_active_links = closest_ul.find(".active")
    var closest_li = link.closest("li");
    var link_status = closest_li.hasClass("active");
    var count = 0;
    closest_ul.find("ul").slideUp(function () {
        if (++count == closest_ul.find("ul").length)
            parallel_active_links.removeClass("active");
    });
    if (!link_status) {
        closest_li.children("ul").slideDown();
        closest_li.addClass("active");
    }
})

/*************************************** menu mobile js***************************************/

$(".icon_meni_bar i").click(function () {
    $(".menu_mobile").css({ "right": "0" });
    $(".bg-close").css({ "display": "block" });
});
$(".close_menu_mobile").click(function () {
    $(".menu_mobile").css({ "right": "-100%" });
    $(".bg-close").css({ "display": "none" });
});
$(".bg-close").click(function () {
    $(".menu_mobile").css({ "right": "-100%" });
    $(this).css({ "display": "none" });
});



$("#radio-color-1").click(function () {
    var empty = $('#colorOptionText').text();
    var span = "قرمز";
    if (empty === " ") {
        $("#colorOptionText").append(span);
    }
    else {
        return
    }
});
$(window, document, undefined).ready(function () {

    $('.input').blur(function () {
        var $this = $(this);
        if ($this.val())
            $this.addClass('used');
        else
            $this.removeClass('used');
    });
});
$('#tab1').on('click', function () {
    $('#tab1').addClass('login-shadow');
    $('#tab2').removeClass('signup-shadow');
});

$('#tab2').on('click', function () {
    $('#tab2').addClass('signup-shadow');
    $('#tab1').removeClass('login-shadow');
});

/****************************** scroll link ******************************/

$('.scrollTo').click(function () {

    $('html, body').animate({
        scrollTop: $($(this).attr('href')).offset().top
    }, 500);
    return false;
});

/****************************** count up ******************************/

(function ($) {
    $.fn.countTo = function (options) {
        options = options || {};

        return $(this).each(function () {
            // set options for current element
            var settings = $.extend({}, $.fn.countTo.defaults, {
                from: $(this).data('from'),
                to: $(this).data('to'),
                speed: $(this).data('speed'),
                refreshInterval: $(this).data('refresh-interval'),
                decimals: $(this).data('decimals')
            }, options);

            // how many times to update the value, and how much to increment the value on each update
            var loops = Math.ceil(settings.speed / settings.refreshInterval),
                increment = (settings.to - settings.from) / loops;

            // references & variables that will change with each update
            var self = this,
                $self = $(this),
                loopCount = 0,
                value = settings.from,
                data = $self.data('countTo') || {};

            $self.data('countTo', data);

            // if an existing interval can be found, clear it first
            if (data.interval) {
                clearInterval(data.interval);
            }
            data.interval = setInterval(updateTimer, settings.refreshInterval);

            // initialize the element with the starting value
            render(value);

            function updateTimer() {
                value += increment;
                loopCount++;

                render(value);

                if (typeof (settings.onUpdate) == 'function') {
                    settings.onUpdate.call(self, value);
                }

                if (loopCount >= loops) {
                    // remove the interval
                    $self.removeData('countTo');
                    clearInterval(data.interval);
                    value = settings.to;

                    if (typeof (settings.onComplete) == 'function') {
                        settings.onComplete.call(self, value);
                    }
                }
            }

            function render(value) {
                var formattedValue = settings.formatter.call(self, value, settings);
                $self.html(formattedValue);
            }
        });
    };

    $.fn.countTo.defaults = {
        from: 0,               // the number the element should start at
        to: 0,                 // the number the element should end at
        speed: 1000,           // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,           // the number of decimal places to show
        formatter: formatter,  // handler for formatting the value before rendering
        onUpdate: null,        // callback method for every time the element is updated
        onComplete: null       // callback method for when the element finishes updating
    };

    function formatter(value, settings) {
        return value.toFixed(settings.decimals);
    }
}(jQuery));

jQuery(function ($) {
    // custom formatting example
    $('.count-number').data('countToOptions', {
        formatter: function (value, options) {
            return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
        }
    });

    // start all the timers
    $('.timer').each(count);

    function count(options) {
        var $this = $(this);
        options = $.extend({}, options || {}, $this.data('countToOptions') || {});
        $this.countTo(options);
    }
});

/****************************** modal login signup forgot_password ******************************/

jQuery(document).ready(function ($) {
    var $form_modal = $('.cd-user-modal'),
        $form_login = $form_modal.find('#cd-login'),
        $form_signup = $form_modal.find('#cd-signup'),
        $form_forgot_password = $form_modal.find('#cd-reset-password'),
        $form_modal_tab = $('.cd-switcher'),
        $tab_login = $form_modal_tab.children('li').eq(0).children('a'),
        $tab_signup = $form_modal_tab.children('li').eq(1).children('a'),
        $forgot_password_link = $form_login.find('.cd-form-bottom-message a'),
        $back_to_login_link = $form_forgot_password.find('.cd-form-bottom-message a'),
        $main_nav = $('.main-nav');

    //open modal
    $main_nav.on('click', function (event) {

        if ($(event.target).is($main_nav)) {
            // on mobile open the submenu
            $(this).children('ul').toggleClass('is-visible');
        } else {
            // on mobile close submenu
            $main_nav.children('ul').removeClass('is-visible');
            //show modal layer
            $form_modal.addClass('is-visible');
            //show the selected form
            ($(event.target).is('.cd-signup')) ? signup_selected() : login_selected();
        }

    });

    //close modal
    $('.cd-user-modal').on('click', function (event) {
        if ($(event.target).is($form_modal) || $(event.target).is('.cd-close-form')) {
            $form_modal.removeClass('is-visible');
        }
    });
    //close modal when clicking the esc keyboard button
    $(document).keyup(function (event) {
        if (event.which == '27') {
            $form_modal.removeClass('is-visible');
        }
    });

    //switch from a tab to another
    $form_modal_tab.on('click', function (event) {
        event.preventDefault();
        ($(event.target).is($tab_login)) ? login_selected() : signup_selected();
    });

    //hide or show password
    $('.hide-password').on('click', function () {
        var $this = $(this),
            $password_field = $this.prev('input');

        ('password' == $password_field.attr('type')) ? $password_field.attr('type', 'text') : $password_field.attr('type', 'password');
        ('Hide' == $this.text()) ? $this.text('Show') : $this.text('Hide');
        //focus and move cursor to the end of input field
        $password_field.putCursorAtEnd();
    });

    //show forgot-password form 
    $forgot_password_link.on('click', function (event) {
        event.preventDefault();
        forgot_password_selected();
    });

    //back to login from the forgot-password form
    $back_to_login_link.on('click', function (event) {
        event.preventDefault();
        login_selected();
    });

    function login_selected() {
        $form_login.addClass('is-selected');
        $form_signup.removeClass('is-selected');
        $form_forgot_password.removeClass('is-selected');
        $tab_login.addClass('selected');
        $tab_signup.removeClass('selected');
    }

    function signup_selected() {
        $form_login.removeClass('is-selected');
        $form_signup.addClass('is-selected');
        $form_forgot_password.removeClass('is-selected');
        $tab_login.removeClass('selected');
        $tab_signup.addClass('selected');
    }
    function forgot_password_selected() {
        $form_login.removeClass('is-selected');
        $form_signup.removeClass('is-selected');
        $form_forgot_password.addClass('is-selected');
    }
    //REMOVE THIS - it's just to show error messages 
    $form_login.find('input[type="submit"]').on('click', function (event) {
        event.preventDefault();
        $form_login.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
    });
    $form_signup.find('input[type="submit"]').on('click', function (event) {
        event.preventDefault();
        $form_signup.find('input[type="email"]').toggleClass('has-error').next('span').toggleClass('is-visible');
    });
});

/****************************** fancybox photo ******************************/

// add all to same gallery
$(".gallery a").attr("data-fancybox", "mygallery");
// assign captions and title from alt-attributes of images:
$(".gallery a").each(function () {
    $(this).attr("data-caption", $(this).find("img").attr("alt"));
    $(this).attr("title", $(this).find("img").attr("alt"));
});

/********************************** slider js**********************************/

if ($(".slider_singlePost").length) {
    $(".slider_singlePost").owlCarousel({
        items: 3,
        //center: true,
        // margin: 20,
        rtl: true,
        loop: true,
        // autoplay: true,
        autoplaytimeout: 4000,
        smartSpeed: 500,
        // nav: true,
        // navText: ["<i class='fas fa-chevron-right'></i>", "<i class='fas fa-chevron-left'></i>"],
        dots: true,
        lazyLoadEager: 3,
        responsive: {
            // breakpoint from 0 up
            0: {
                items: 1,
                margin: 30,
            },
            // breakpoint from 576 up
            576: {
                items: 2,
                margin: 20,
                center: false,
            },
            // breakpoint from 768 up
            768: {
                items: 2,
                margin: 30,
            },

            992: {
                items: 2,
                margin: 30,
            },

            1200: {
                items: 2,
                margin: 30,
            }
        }
    })
}

if ($(".slider-Related-posts").length) {
    $(".slider-Related-posts").owlCarousel({
        items: 3,
        //center: true,
        // margin: 20,
        rtl: true,
        loop: true,
        // autoplay: true,
        autoplaytimeout: 4000,
        smartSpeed: 500,
        // nav: true,
        // navText: ["<i class='fas fa-chevron-right'></i>", "<i class='fas fa-chevron-left'></i>"],

        dots: true,

        lazyLoadEager: 3,
        responsive: {
            // breakpoint from 0 up
            0: {
                items: 1,
                margin: 30,


            },
            // breakpoint from 576 up
            576: {
                items: 2,
                margin: 5,
                center: false,


            },
            // breakpoint from 768 up
            850: {
                items: 3,
                margin: 5,

            },

            992: {
                items: 2,
                margin: 15,

            },

            1200: {
                items: 3,
                margin: 15,

            }
        }
    })
}

if ($("#slider-blog").length) {
    $(".slider_blog").owlCarousel({
        //center: true,
        margin: 25,
        rtl: true,
        loop: true,
        // autoplay: true,
        autoplaytimeout: 4000,
        smartSpeed: 500,
        // nav: true,
        // navText: ["<i class='fas fa-chevron-right'></i>", "<i class='fas fa-chevron-left'></i>"],
        slideBy: 2,
        dots: true,
        lazyLoadEager: 3,
        responsive: {
            // breakpoint from 0 up
            0: {
                items: 1,
            },
            // breakpoint from 576 up
            576: {
                items: 2,
            },
            // breakpoint from 768 up
            850: {
                items: 2,
            },
            992: {
                items: 3,
                center: true,
            },

            1200: {
                items: 3,
                center: true,
            }
        }
    })
}
/********************************** slidtoggle comment form**********************************/

$('.box-btn-comment .button-outline').click(function (e) {
    e.preventDefault();
    $('.area-comment-post').slideToggle();

});


/*************************************** scroll to top ***************************************/

$(window).scroll(function () {
    if ($(window).scrollTop() > 200) {
        $("a.scroll-To-top").css({ "visibility": " visible", "transform": "translateY(0)" });
    } else {
        $("a.scroll-To-top").css({ "visibility": " hidden", "transform": "translateY(2rem)" });
    }
});

/*************************************** input type number cart ***************************************/

document.addEventListener('DOMContentLoaded', function () {
    var inputs = document.getElementsByClassName('input-number-wrapper')

    function incInputNumber(input, step) {
        var val = +input.value
        if (isNaN(val)) val = 0
        val += step
        input.value = val > 1 ? val : 1
        // If you need to change the input value in the DOM :
        // var newValue = val > 0 ? val : 0;
        // input.setAttribute("value", newValue);
    }

    Array.prototype.forEach.call(inputs, function (el) {
        var input = el.getElementsByTagName('input')[0]

        el.getElementsByClassName('increase')[0].addEventListener('click', function () { incInputNumber(input, 1) })
        el.getElementsByClassName('decrease')[0].addEventListener('click', function () { incInputNumber(input, -1) })
    })
})

/*************************************** slidtoggle forms checkout ***************************************/

$(document).ready(function () {
    $('#link-coupon').click(function (e) {
        e.preventDefault();
        $('.area-coupon').slideToggle(300);

    });

    $('#createaccount').click(function () {

        $('.area-create-account').slideToggle(300);

    });

    $('#input-shipping').click(function () {

        $('.area-formShippingFields').slideToggle(300);

    });

    $('#payment-text2, #payment-text3').collapse('hide');

    $('input[name="inlineRadioOptions"]').change(function () {
        if ($('#inlineRadio1').is(":checked")) {
            $('#payment-text1').collapse('show');
        } else {
            $('#payment-text1').collapse('hide');
        }

        if ($('#inlineRadio2').is(":checked")) {
            $('#payment-text2').collapse('show');
        } else {
            $('#payment-text2').collapse('hide');
        }

        if ($('#inlineRadio3').is(":checked")) {
            $('#payment-text3').collapse('show');
        } else {
            $('#payment-text3').collapse('hide');
        }

    });

});


/************************************ sidebar blog drawer  ************************************/

$(document).ready(function () {

    $(".btn.sidebar-toggle").click(function () {
        $(".sidebar-drawer").css({ "left": "0" });
        $(".bg-close").css({ "display": "block" });
    });
    $(".close-sidebar-drawer").click(function () {
        $(".sidebar-drawer").css({ "left": "-100%" });
        $(".bg-close").css({ "display": "none" });
    });

    $(".bg-close").click(function () {
        $(".sidebar-drawer").css({ "left": "-100%" });
        $(this).css({ "display": "none" });
    });

});







/************************************ parallax image ************************************/

console.clear()
$(document).ready(function () {
    $(window).scroll(
        function () {
            aniTrigger()
        }
    );
    $(window).mousemove(function (evt) {
        $('.box-5').each(function () {
            $(this).css("transform", 'translate3d(' + -evt.pageX / 18 + 'px,' + -evt.pageY / 18 + 'px,0px)')
        });
    });


    $(window).mousemove(function (evt) {
        $('.box-4').each(function () {
            $(this).css("transform", 'translate3d(' + -evt.pageX / 25 + 'px,' + -evt.pageY / 25 + 'px,0px)')
        });
    });

    $(window).mousemove(function (evt) {
        $('.box-3').each(function () {
            $(this).css("transform", 'translate3d(' + -evt.pageX / 18 + 'px,' + -evt.pageY / 18 + 'px,0px)')
        });
    });


    $(window).mousemove(function (evt) {
        $('.box-2').each(function () {
            $(this).css("transform", 'translate3d(' + -evt.pageX / 25 + 'px,' + -evt.pageY / 25 + 'px,0px)')
        });
    });



    $(window).mousemove(function (evt) {
        $('.box-1').each(function () {
            $(this).css("transform", 'translate3d(' + -evt.pageX / 35 + 'px,' + -evt.pageY / 35 + 'px,0px)')
        });
    });




});


function aniTrigger() {
    var position = $('.container.top').offset().top;
    var scroll = $(window).scrollTop();
    if (scroll > position * 2.6) {
        $('.container.top').addClass('fadeOut')
    } else {
        $('.container.top').removeClass('fadeOut')
    };
}

function close_box_plan() {
    $('#bg-white').css('display', 'none');
}

function fun_prev_step(obj) {
    if ($('#order-home-step').val() == 5) {
        //  obj.attr('href', obj.attr('data-href'));

        $('#order-home-step').val(4);
        $('#btn-next-step').html('مرحله بعدی');
        $('#btn-next-step').removeClass('btn-success');
        $('#btn-next-step').addClass('btn-primary');
        $('.breadcrumb-item-step5').css('display', 'none');
        $('#select-ghab-panel').css('display', 'none');
        $('.select-ghab-panel-option').css('display', 'block');
        $('#head-option-title').html(' آپشن های طراحی ');
        $('#head-option-p').css('display', 'block');

    }
    else if ($('#order-home-step').val() == 4) {
        window.location.href = obj.attr('data-href');
    }
}

function change_select_option_extra(obj) {
    if (obj.attr('data-type') == 'textarea') {
        if (obj.val() == 1) {
            $('#' + obj.attr('data-target')).css('display', 'block');
        }
        else {
            $('#' + obj.attr('data-target')).css('display', 'none');
        }
    }
    var price = parseInt($('#sum-price-option').attr('data-price'));
    if (obj.val() == 1) {
        price = price + parseInt(obj.attr('data-price'));
    }
    else {
        price = price - parseInt(obj.attr('data-price'));
    }
    if (price < 0) {
        price = 0;
    }

    $('#sum-price-option').attr('data-price', price);
    $('#sum-price-option').html(price + ' ' + 'ریال');
}

function change_img_box_plan(obj) {

    $('#bg-white-box-plan-img').attr('src', obj.attr('data-img'));
    $('#bg-white-box-plan-img').attr('data-href', obj.attr('data-href'));
    $('#bg-white').css('display', 'block');
    $('.selected h3').removeClass('text-danger');
    $('.selected h3').addClass('text-black');
    $('.selected').removeClass('selected');
    obj.addClass('selected');
    $('.selected h3').addClass('text-danger');
    $('.selected h3').removeClass('text-black');
}

function change_img_box_plan_select() {
    $('#btn-next-step').attr('href', $('#bg-white-box-plan-img').attr('data-href'));
    close_box_plan();
    scroll_top_monitor();
}

function scroll_top_monitor()
{
    $("HTML, BODY").animate ({      // Animate method
        scrollTop: $('#btn-next-step').offset().top-200    // Scroll top method.
        }, 500);   
}



function check_plan_selected(obj) {

    if ($('#order-home-step').val() == 4) {
        $('#order-home-step').val(5);
        $('#btn-prev-step').attr('href', '#');
        $('#btn-next-step').html('تکمیل سفارش');
        $('#head-option-title').html('انتخاب قاب ');
        $('#head-option-p').css('display', 'none');
        $('#btn-next-step').removeClass('btn-primary');
        $('#btn-next-step').addClass('btn-success');
        $('.breadcrumb-item-step5').css('display', 'block');
        $('#select-ghab-panel').css('display', 'block');
        $('.select-ghab-panel-option').css('display', 'none');


    }
    else if ($('#order-home-step').val() == 5) {
        negarenovi_order_finish();
    }
    else if ($('#order-home-step').val() == 3 && $('#box-upload-image-file img').length > 1) {
        var plan_selected = $('#plan-uploaded-img').attr('data-media-id');
        $('#box-upload-image-file img').each(function (i, obj) {
            if ($(obj).attr('id') != "plan-uploaded-img") {
                plan_selected+=","+$(obj).attr('data-media-id');
            }
        });

        $('#btn-next-step').attr('href', $('#plan-uploaded-img').attr('data-href') + '&plan_selected=' + plan_selected + '&plan_selected_type=1');
    }
    else if (obj.attr('href') == '#') {
        alert("گزینه ای انتخاب نشده است");
    }
}

function close_upload_image_remove(obj) {
    if ($('#' + obj.attr('data-target')).attr('id') == 'plan-uploaded-img') {
        $('#plan-uploaded-img').attr('data-state', 0);
        $('#' + obj.attr('data-target')).attr('src', $('#' + obj.attr('data-target')).attr('data-src'));
    }
    else {
        obj.parent().remove();
    }
}


function ghab_selected_panel(select) {
    if (select == 0) {
        $('#ghab-selected-panel').css('display', 'none');
        $('#ghab-uploaded-img-value').val(0);
        $('#select-ghab-panel').css('display', 'none');

    }
    else {
        $('#ghab-selected-panel').css('display', 'block');
    }
}

function btn_share(obj) {
    window.location.href = obj.attr('data-href');
}


/************************************ ************************************/






