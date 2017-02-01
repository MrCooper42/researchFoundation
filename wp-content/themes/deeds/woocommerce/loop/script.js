jQuery(document).ready(function ($) {
    "use strict";

    jQuery('div.theme-pagination ul').addClass('pagination');
//Pretty Photo For Our Portfolio
    jQuery("body a[data-rel^='prettyPhoto']").prettyPhoto({
        theme: "facebook",
    });

    $('.audio-btn').click(function () {
        $('.audioplayer').slideUp();
        $(this).next('.audioplayer').slideDown();
        return false;
    })
    $('.cross').click(function () {
        $(this).parent().slideUp();
    })


    /*** ACCORDIONS ***/
    $(function () {
        $('#toggle .content').hide();
        $('#toggle h2:first').addClass('active').next().slideDown(500).parent().addClass("activate");
        $('#toggle h2').click(function () {
            if ($(this).next().is(':hidden')) {
                $('#toggle h2').removeClass('active').next().slideUp(500).parent().removeClass("activate");
                $(this).toggleClass('active').next().slideDown(500).parent().toggleClass("activate");
            }
        });
    });



    /*** CART PAGE PRODUCT DELETE ***/
    $('.cart-product .dustbin').click(function () {
        $(this).parent().parent().parent().slideUp();
    });

    /*** BILLING ADDRESS AND SHIPPING ADDRESS ***/
    $('.billing-add').click(function () {
        $('.billing-address').slideDown(1000);
        $('.shipping-address').slideUp(1000);
    });
    $('.shipping-add').click(function () {
        $('.shipping-address').slideDown(1000);
        $('.billing-address').slideUp(1000);
    });

    /*** CHECKOUT PAGE BLOCKS ***/
    $('.checkout-block h5').click(function () {
        $(this).toggleClass('closed');
        $(this).next('.checkout-content').slideToggle();
    });



    /*** STICKY HEADER ***/
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 50) {
            $(".stick").addClass("sticky");
        }
        else {
            $(".stick").removeClass("sticky");
        }
    });


    /* Check width on page load*/
    if ($(window).width() < 980) {
        $('header').addClass('respsonsive-header');
    }
    else {
    }

    $(window).resize(function () {
        /*If browser resized, check width again */
        if ($(window).width() < 980) {
            $('header').addClass('respsonsive-header');
        }
        else {
            $('header').removeClass('respsonsive-header');
        }

    });



    /*** WIDE AND BOXED LAYOUT ***/
    $('.boxed').click(function () {
        $('.theme-layout').addClass("boxed");
        $('body').css('background-image', 'url(images/pat1.png)');
        return false;
    });
    $('.wide').click(function () {
        $('.theme-layout').removeClass("boxed");
        $('body').css('background-image', 'none');
        return false;
    });


    $('.pattern1').on('click', function () {
        $('body').css('background-image', 'url(images/pat1.png)');
    })
    $('.pattern2').on('click', function () {
        $('body').css('background-image', 'url(images/pat2.png)');
    })
    $('.pattern3').on('click', function () {
        $('body').css('background-image', 'url(images/pat3.png)');
    })
    $('.pattern4').on('click', function () {
        $('body').css('background-image', 'url(images/pat4.png)');
    })
    $('.pattern5').on('click', function () {
        $('body').css('background-image', 'url(images/pat5.png)');
    })


    /*** RESPONSIVE VERSION HEADER ***/
    var dropdowns = $('header.respsonsive-header nav .container > ul > li > ul');
    $('header.respsonsive-header nav .container > ul > li > a').click(function () {
        $(dropdowns).slideUp();
        $(this).parent().find(dropdowns).slideToggle();
    });
    var dropdowns2 = $('header.respsonsive-header nav .container > ul > li > ul > li > ul');
    $('header.respsonsive-header nav .container  > ul > li > ul > li > a').click(function () {
        $(dropdowns2).slideUp();
        $(this).parent().find(dropdowns2).slideToggle();
    });

    $('li.menu-item-has-children > a').addClass('has-children');

    $('.menu-btn').click(function () {
        $(this).next('nav').slideToggle();
        $(dropdowns).slideUp();
    });


    $('header.respsonsive-header nav a.has-children').click(function () {
        return false;
    });




    /*** AJAX CONTACT FORM ***/
    $('#contactform').submit(function () {
        var action = $(this).attr('action');
        $("#message").slideUp(750, function () {
            $('#message').hide();
            $('#submit')
                    .after('<img src="images/ajax-loader.gif" class="loader" />')
                    .attr('disabled', 'disabled');
            $.post(action, {
                name: $('#name').val(),
                email: $('#email').val(),
                comments: $('#comments').val(),
                verify: $('#verify').val()
            },
            function (data) {
                document.getElementById('message').innerHTML = data;
                $('#message').slideDown('slow');
                $('#contactform img.loader').fadeOut('slow', function () {
                    $(this).remove()
                });
                $('#submit').removeAttr('disabled');
                if (data.match('success') != null)
                    $('#contactform').slideUp('slow');

            }
            );
        });
        return false;
    });

});


