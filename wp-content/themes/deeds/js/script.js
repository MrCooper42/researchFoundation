jQuery(document).ready(function ($) {
    "use strict";

    jQuery('audio,video').mediaelementplayer();

    $(".responsive-contact a").on("click", function () {
        $(this).siblings().removeClass("active");
        $(this).addClass("active");
        if ($(this).hasClass("phone-btn")) {
            $(".responsive-phone").slideDown();
            $(".responsive-mail").slideUp();
        } else {
            $(".responsive-mail").slideDown();
            $(".responsive-phone").slideUp();
        }
    });

    var isOpen = false;
    $(".responsive-search > span").on("click", function (e) {
        if (isOpen === false) {
            $(".responsive-search > form").slideDown();
            isOpen = true;
        } else {
            isOpen = false;
            $(".responsive-search > form").slideUp();
        }
    });

    $(".responsive-btn").on("click", function () {
        $(".responsive-menu").addClass("slidein");
        return false;
    });
    $("html").on("click", function () {
        $(".responsive-menu").removeClass("slidein");
    });
    $(".responsive-menu").on("click", function (e) {
        e.stopPropagation();
    });
    $(".responsive-menu li.menu-item-has-children > a").on("click", function () {
        $(this).parent().siblings().children("ul").slideUp();
        $(this).parent().siblings().removeClass("active");
        $(this).parent().children("ul").slideToggle();
        $(this).parent().toggleClass("active");
        return false;
    });
    $(".responsive-menu > ul > li").each(function () {
        if ($(this).children('ul').length) {
            var link = $(this).children('ul').prev('a').attr('href');
            $(this).children('ul').prev('a').attr('href', 'javascript:void(0)');
            var name = $(this).children('ul').prev('a').html();
            $(this).children('ul.sub-menu').prepend('<li><a href="' + link + '">' + name + '</a></li>');
        }
    });

    /*=================== LightBox ===================*/
    var foo = $('.lightbox');
    foo.poptrox({
        usePopupNav: true,
        usePopupLoader:true,

    });


    jQuery('.top-adds').parent().parent().parent().addClass("expand");
    jQuery(function () {
        var portfolio = $('.prayers-columns');
        portfolio.isotope({
            masonry: {
                columnWidth: 1
            }
        });
    });



    var layer = jQuery('.wpb_layerslider_element').parent().attr('class');
    if (layer == 'col-md-12 column') {
        jQuery('.wpb_layerslider_element').parent().parent().parent().removeClass('container');
    }

    jQuery(".post-like").click(function () {

        var url = document.getElementById('adminurl').innerHTML;
        var heart = jQuery('.post-like a');

        // Retrieve post ID from data attribute
        var post_id = heart.data("post_id");

        // Ajax call
        jQuery.ajax({
            type: "post",
            url: url + "admin-ajax.php",
            data: "action=post-like&post_like=&post_id=" + post_id,
            success: function (count) {
                // If vote successful
                if (count != "already") {
                    heart.addClass("voted");
                    heart.siblings(".count").text(count);
                }
            }
        });

        return false;
    });

    /*** HEADER CART DROPDOWN ***/
    $('.cart-dropdown > p').click(function () {
        $(this).next("ul").slideToggle("slow");
    });

    //$('div.type-post').removeClass('sticky');

    /*** HEADER CART CLOSE BY CLICKING OUTSIDE ***/
    $('.cart-dropdown').click(function (e) {
        e.stopPropagation();
    });
    $('html').click(function () {
        $('.cart-dropdown > ul').slideUp('medium', function () {
            // Animation complete.
        });
    });

    /*** HEADER CART ITEM REMOVE ***/
    $('.cart-dropdown > ul li span.remove').click(function () {
        $(this).parent().slideUp("slow");
    });

    $('div.theme-pagination ul').removeClass('page-numbers').addClass('pagination');

    $('.audio-btn').click(function () {
        $('.audioplayer').slideUp();
        $(this).next('.audioplayer').slideDown();
        return false;
    })
    $('.cross').click(function () {
        $(this).parent().slideUp();
        $('.sermon-media li i.audio-btn').removeClass('active');
    })


    $('.sermon-media li i.audio-btn').click(function () {
        $('.sermon-media li i.audio-btn').removeClass('active');
        $(this).addClass('active');
    });

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


    /*** PASTORS CAROUSEL ***/
    $('div.pastors-carousel').parent('div').parent('div').parent('div').removeClass("container");
    $('div.pastors-carousel').parent().removeClass("col-md-12");



    /* Check width on page load*/
    if ($(window).width() < 980) {
        $('header').addClass('respsonsive-header');

        jQuery('.respsonsive-header .menu li > ul').parent().addClass("no-link");
        jQuery('.respsonsive-header .menu li.no-link > a').click(function () {
            return false;
        });

    } else {
    }

    $(window).resize(function () {
        /*If browser resized, check width again */
        if ($(window).width() < 980) {
            $('header').addClass('respsonsive-header');
        } else {
            $('header').removeClass('respsonsive-header');
        }

    });


    /*** COUNT DOWN TIMER ***/
    if ($('.count-down').length !== 0) {
        $('.count-down').countdown({
            timestamp: (new Date()).getTime() + 19 * 24 * 60 * 60 * 1000
        });
    }

    /*** STICKY HEADER ***/
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 70) {
            $(".stick").addClass("sticky");
        } else {
            $(".stick").removeClass("sticky");
        }
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
    var dropdowns = $('nav .container > ul > li > ul');
    $('nav .container > ul > li > a').click(function () {
        $(dropdowns).slideUp();
        $(this).parent().find(dropdowns).slideToggle();
    });
    var dropdowns2 = $('nav .container > ul > li > ul > li > ul');
    $('nav .container > ul > li > ul > li > a').click(function () {
        $(dropdowns2).slideUp();
        $(this).parent().find(dropdowns2).slideToggle();
    });

    $('.menu-btn').click(function () {
        $(this).next('ul').slideToggle();
        $(dropdowns).slideUp();
    });


    $('nav ul li a.has-children').click(function () {
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
    jQuery('.confirm_popup').parent().removeClass('donation-popup');
    var height = jQuery(".confirm_popup").height();
    var margin = height / 2;
    jQuery(".confirm_popup").css({
        "margin-top": -margin
    });

    $('.periods li').live('click', function () {
        var time_period = $(this).data('value');
        var amount = $("div.amount-selection  input[name='donation_amount']:checked").val();
        if (time_period != 'one_time') {
            $('div.loader-wrapper').show();
            var data = {
                'action': 'dictate_ajax_callback',
                'subaction': 'sh_get_paypal_button',
                'period': time_period
            };
            $.post(ajaxurl, data, function (responce) {
                $('div.paypal_donation_form').html(responce);
                var period = $('div.paypal_donation_form > form').find('#billing-period');
                var freq = $('div.paypal_donation_form > form').find('#billing-frequency');
                $('div.paypal_donation_form > form').find('input[name="amount"]').attr('value', amount);
                if (time_period == "dayily") {
                    $(period).val('Day');
                    $(freq).val('1');
                } else if (time_period == "weekly") {
                    $(period).val('Week');
                    $(freq).val('1');
                } else if (time_period == "fortnightly") {
                    $(period).val('SemiMonth');
                    $(freq).val('1');
                } else if (time_period == "monthly") {
                    $(period).val('Month');
                    $(freq).val('1');
                } else if (time_period == "quarterly") {
                    $(period).val('Month');
                    $(freq).val('3');
                } else if (time_period == "half_year") {
                    $(period).val('Month');
                    $(freq).val('6');
                } else if (time_period == "yearly") {
                    $(period).val('Year');
                    $(freq).val('1');
                }
                $('div.loader-wrapper').hide();
            });
        } else {
            $('div.loader-wrapper').show();
            var data = {
                'action': 'dictate_ajax_callback', //calls wp_ajax_nopriv_getbutton
                'subaction': 'sh_get_paypal_button',
                'period': time_period
            };
            $.post(ajaxurl, data, function (responce) {
                $('div.paypal_donation_form').html(responce);
                $('div.paypal_donation_form > form').find('input[name="amount"]').attr('value', amount);
                $('div.loader-wrapper').hide();
            });

        }
    });

    $("div.confirm_popup input#paypal_confirmation").live('click', function () {
        jQuery('div.loader-wrapper').show('slow');
        var data = {
            'action': 'dictate_ajax_callback', //calls wp_ajax_nopriv_confirm_order
            'subaction': 'sh_confirm_order'
        };
        $.post(ajaxurl, data, function (responce) {
            $('.confirm_popup').html(responce);
            jQuery('div.loader-wrapper').hide();
        });
        return false;
    });
});


//display_tweets accepts a JSON object
function display_tweets(tweets) {
    var statusHTML = "";
    jQuery.each(tweets, function (i, tweet) {
        //let's check to make sure we actually have a tweet
        if (tweet.text !== undefined) {
            var username = tweet.user.screen_name;
            //clean things up a bit
            var status = tweet.text.replace(/((https?|s?ftp|ssh)\:\/\/[^"\s\<\>]*[^.,;'">\:\s\<\>\)\]\!])/g, function (url) {
                return '<a href="' + url + '">' + url + '</a>';
            }).replace(/\B@([_a-z0-9]+)/ig, function (reply) {
                return reply.charAt(0) + '<a href="http://twitter.com/' + reply.substring(1) + '">' + reply.substring(1) + '</a>';
            });
            statusHTML = '<p><span>' + status + '</span> <a style="font-size:85%" href="http://twitter.com/' + username + '/statuses/' + tweet.id_str + '">' + (tweet.created_at) + '</a></p>';
            jQuery('.tweet-loader').remove();
            jQuery('.tweets-slides').append(statusHTML);
        }
    });
}

function header_event(selector, timer, zone) {
    var e = new Date(timer);
    e.setDate(e.getDate());

    var dd = e.getDate();
    var mm = e.getMonth() + 1;
    var y = e.getFullYear();

    var h = e.getHours();
    var m = e.getMinutes();
    var s = e.getSeconds();

    var futureFormattedDate = mm + "/" + dd + "/" + y + " " + h + ":" + m + ":" + s;

    jQuery(selector).downCount({
        date: futureFormattedDate,
        offset: zone, });
}
jQuery(document).ready(function ($) {
    $("body").find("select").each(function () {
        if ($(this).attr('name') == 'archive-dropdown')
        {
            $(this).minimalect({
                theme: "bubble",
                onchange: function (value, text) {
                    window.location.href = value;
                }
            });
        }
    });

    $("select").minimalect({
        theme: "bubble",
        placeholder: "Select"
    });
    $('#donate').minimalect("destroy");
});


jQuery(window).load(function () {
    var $portfolio = jQuery('.masonary-product');
    $portfolio.isotope({
        masonry: {
            columnWidth: 1}
    });


    var $optionSets = jQuery('#options .option-set'),
            $optionLinks = $optionSets.find('a');
    $optionLinks.click(function () {
        var $this = jQuery(this);
        // don't proceed if already selected
        if ($this.hasClass('selected')) {
            return false;
        }
        var $optionSet = $this.parents('.option-set');
        $optionSet.find('.selected').removeClass('selected');
        $this.addClass('selected');

        // make option object dynamically, i.e. { filter: '.my-filter-class' }
        var options = {},
                key = $optionSet.attr('data-option-key'),
                value = $this.attr('data-option-value');
        // parse 'false' as false boolean
        value = value === 'false' ? false : value;
        options[key] = value;
        if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
            // changes in layout modes need extra logic
            changeLayoutMode($this, options)
        } else {
            // otherwise, apply new options
            $portfolio.isotope(options);
        }

        return false;
    });
});

function counter(field, date) {
    jQuery('#' + field).downCount({
        date: date,
        offset: +10
    });
}
function new_counter(field, timer, zone) {
    var e = new Date(timer);
    e.setDate(e.getDate());

    var dd = e.getDate();
    var mm = e.getMonth() + 1;
    var y = e.getFullYear();

    var h = e.getHours();
    var m = e.getMinutes();
    var s = e.getSeconds();

    var futureFormattedDate = mm + "/" + dd + "/" + y + " " + h + ":" + m + ":" + s;
    jQuery(field).downCount({
        date: futureFormattedDate,
        offset: zone
    });
}
jQuery(document).ready(function ($) {
    $('.periods li').live('click', function () {
        $('.periods li').removeClass("select");
        $(this).addClass("select");
    });
    $('input[name="donation_amount"]').live('click', function () {
        var value = $(this).val();
        $('input[name="donation_amout"]').val(value);
        if ($('div.payment-choices').children('a.paypal_tab').hasClass('active')) {
            $('div.paypal_donation_form > form').find('input[name="amount"]').val(value);
        }
    });
    $('.payment-choices a').live('click', function () {
        var tab = $(this).data('tab');
        $('.payment-choices a').each(function () {
            $(this).removeClass('active');
        });
        $('.payment-method div').each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $('#' + tab).addClass('active');
        return false;
    });
    $('a.donation_module').on('click', function () {
        var data = 'action=sh_model_popup';
        jQuery.ajax({
            type: "post",
            url: ajaxurl,
            data: data,
            beforeSend: function () {
                $('div.loader-wrapper').fadeIn('slow');
            },
            success: function (response) {
                $('div.model-response').empty();
                $('div.model-response').html(response);
                $('div.loader-wrapper').fadeOut('slow');
                $('div.model-response').fadeIn('slow');
                $('div#myModal').modal('show');
            }
        });
    });

    // stripe donation
    $('button#stripe-checkout').live('click', function () {
        var parent = $('div.donation-popup');
        var button = $(this);
        var msg = $('div.donation_errors');
        $(this).prop('disabled', true);
        jQuery('div.loader-wrapper').fadeIn('slow');
        if (STRIPE_PUBLISHABLE_KEY != '')
        {
            Stripe.setPublishableKey(STRIPE_PUBLISHABLE_KEY);
            var stripeResponseHandler = function (status, response) {
                jQuery('div.loader-wrapper').fadeIn('slow');
                if (response.error)
                {
                    $(msg).empty();
                    $('div.loader-wrapper').fadeOut('slow');
                    $(msg).html('<div class="alert alert-info">' + response.error.message + '</div>');
                    $(msg).show();
                    $('html,body').animate({scrollTop: $(msg).offset().top + -150}, 'slow');
                    setTimeout(function () {
                        $(msg).fadeOut('slow');
                    }, 5000);
                    $(button).prop('disabled', false);
                } else {
                    jQuery('<input>', {
                        'type': 'hidden',
                        'name': 'stripeToken',
                        'value': response.id,
                        'id': 'payment_access_tocken'
                    }).appendTo(parent);
                    jQuery('div.loader-wrapper').fadeIn('slow');
                    var token = response.id;
                    var trans_id = response.card.id;
                    var ammount = $(button).parent().prev().prev().prev().prev().prev().children('div').children('input').val();
                    var currency = $(parent).find('div#donation_currency').html();
                    var data = 'trans_id=' + trans_id + '&amount=' + ammount + '&currency=' + currency + '&token=' + token + '&action=sh_donation_by_stripe';
                    $.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: data,
                        cache: false,
                        dataType: "json",
                        beforeSend: function () {
                            jQuery('div.loader-wrapper').fadeIn('slow');
                        },
                        success: function (response) {
                            $(button).prop('disabled', false);
                            var session_id = response.session;
                            after_process(session_id);
                        }
                    });
                }
            };
            var alerts = [];
            var amount = $('input[name="donation_amout"]').val();
            var card_num = jQuery(parent).find('#stripe_card_no').val();
            var card_exp_mth = jQuery(parent).find('#stripe-card-expiry-month').val();
            var card_exp_year = jQuery(parent).find('#stripe-card-expiry-year').val();
            var card_cvc = jQuery(parent).find('#stripe-verify-num').val();
            if (amount === '') {
                alerts.push(var_before + ' ' + wst_card_amount);
            }
            if (card_num === '') {
                alerts.push(var_before + ' ' + wst_card_nub);
            }
            if (card_exp_mth === '') {
                alerts.push(var_before + ' ' + wst_card_cem);
            }
            if (card_exp_year === '') {
                alerts.push(var_before + ' ' + wst_card_cey);
            }
            if (card_cvc === '') {
                alerts.push(var_before + ' ' + wst_card_cvc);
            }
            if (alerts.length === 0) {
                if ($('input#payment_access_tocken').length && $('input#payment_access_tocken').val().length) {
                    $(msg).empty();
                    $(msg).show();
                    $(msg).html('<div class="alert alert-info">' + invalid_token + '</div>');
                    $(button).prop('disabled', false);
                    jQuery('div.loader-wrapper').fadeOut('slow');
                } else {
                    var tocken = Stripe.createToken({
                        number: card_num,
                        cvc: card_cvc,
                        exp_month: card_exp_mth,
                        exp_year: card_exp_year
                    }, stripeResponseHandler);
                }
            } else {
                $(this).prop('disabled', false);
                $(msg).empty();
                $(msg).show();
                var newHTML = jQuery.map(alerts, function (value) {
                    return ("<div class=\"alert alert-warning\" role=\"alert\">" + value + "</div>");
                });
                jQuery(msg).html(newHTML.join(""));
                $('html,body').animate({scrollTop: $(msg).offset().top + -150}, 'slow');
                setTimeout(function () {
                    $(msg).fadeOut('slow');
                }, 5000);
            }
        } else {
            $(this).prop('disabled', false);
            jQuery('div.loader-wrapper').fadeOut('slow');
            $(msg).empty();
            $(msg).html('<div class="alert alert-warning">' + STRIPE_ERROR + '</div>');
            $(msg).show();
            $('html,body').animate({scrollTop: $(msg).offset().top + -150}, 'slow');
            setTimeout(function () {
                $(msg).fadeOut('slow');
            }, 5000);
        }
        jQuery('div.loader-wrapper').fadeOut('slow');
        return false;
    });
    // braintree donation
    $('button#braintree-checkout').live('click', function () {
        var parent = $('div.donation-popup');
        var button = $(this);
        var msg = $('div.donation_errors');
        $(this).prop('disabled', true);
        jQuery('div.loader-wrapper').fadeIn('slow');
        var alerts = [];
        var amount = $('input[name="donation_amout"]').val();
        var card_num = jQuery(parent).find('#braintree_card_no').val();
        var card_exp_mth = jQuery(parent).find('#braintree-card-expiry-month').val();
        var card_exp_year = jQuery(parent).find('#braintree-card-expiry-year').val();
        var card_cvc = jQuery(parent).find('#braintree-verify-num').val();
        var donor_name = $(parent).find('#donor_name').val();
        var donor_email = $(parent).find('#donor_email').val();
        if (amount === '') {
            alerts.push(var_before + ' ' + wst_card_amount);
        }
        if (card_num === '') {
            alerts.push(var_before + ' ' + wst_card_nub);
        }
        if (card_exp_mth === '') {
            alerts.push(var_before + ' ' + wst_card_cem);
        }
        if (card_exp_year === '') {
            alerts.push(var_before + ' ' + wst_card_cey);
        }
        if (card_cvc === '') {
            alerts.push(var_before + ' ' + wst_card_cvc);
        }
        if (alerts.length === 0) {
            if ($('input#payment_access_tocken').length && $('input#payment_access_tocken').val().length) {
                $(msg).empty();
                $(msg).show();
                $(msg).html('<div class="alert alert-info">' + invalid_token + '</div>');
                $(button).prop('disabled', false);
                jQuery('div.loader-wrapper').fadeOut('slow');
            } else {
                var ammount = $(button).parent().prev().prev().prev().prev().prev().children('div').children('input').val();
                var currency = $(parent).find('div#donation_currency').html();
                var data = 'f_name=' + donor_name + '&email' + donor_email + '&card_no=' + card_num + '&mnth=' + card_exp_mth + '&exp_year=' + card_exp_year + '&cvc=' + card_cvc + '&amount=' + ammount + '&currency=' + currency + '&action=sh_donation_by_braintree';
                $.ajax({
                    type: "POST",
                    url: ajaxurl,
                    data: data,
                    cache: false,
                    dataType: "json",
                    beforeSend: function () {
                        jQuery('div.loader-wrapper').fadeIn('slow');
                    },
                    success: function (response) {
                        $(button).prop('disabled', false);
                        if (response.msg) {
                            $(msg).empty();
                            $(msg).html(response.msg);
                            $(msg).show();
                            jQuery('div.loader-wrapper').fadeOut('slow');
                        } else {
                            var session_id = response.session;
                            after_process(session_id);
                        }
                    }
                });
            }
        } else {
            $(this).prop('disabled', false);
            $(msg).empty();
            $(msg).show();
            var newHTML = jQuery.map(alerts, function (value) {
                return ("<div class=\"alert alert-warning\" role=\"alert\">" + value + "</div>");
            });
            jQuery(msg).html(newHTML.join(""));
            $('html,body').animate({scrollTop: $(msg).offset().top + -150}, 'slow');
            setTimeout(function () {
                $(msg).fadeOut('slow');
            }, 5000);
            jQuery('div.loader-wrapper').fadeOut('slow');
        }
        return false;
    });
    // 2checkout donation
    $('button#checkout2-checkout').live('click', function () {
        var parent = $('div.donation-popup');
        var button = $(this);
        var msg = $('div.donation_errors');
        $(this).prop('disabled', true);
        jQuery('div.loader-wrapper').fadeIn('slow');
        TCO.loadPubKey(MODE, function () {
            if (CHECKOUT2_PUBLIC_KEY != '')
            {
                var errorCallback = function (data) {
                    if (data.errorCode === 200) {
                        tokenRequest();
                    } else {
                        $(msg).empty();
                        $('div.loader-wrapper').fadeOut('slow');
                        $(msg).html('<div class="alert alert-warning">' + data.errorMsg + '</div>');
                        $(msg).show();
                        $('html,body').animate({scrollTop: $(msg).offset().top + -150}, 'slow');
                        setTimeout(function () {
                            $('div.loader-wrapper').fadeOut('slow');
                        }, 5000);
                        $(button).prop('disabled', false);
                        return false;
                    }
                };
                var successCallback = function (data) {
                    jQuery('div.loader-wrapper').fadeIn('slow');
                    jQuery('<input>', {
                        'type': 'hidden',
                        'name': 'checkout2Token',
                        'value': data.response.token.token,
                        'id': 'checkout2_payment_access_tocken'
                    }).appendTo(parent);
                    jQuery('div.loader-wrapper').fadeIn('slow');
                    var token = data.response.token.token;
                    var amount = $(button).parents('form').find('input[name="donation_amout"]').val();
                    var cur_symbol = $(parent).find('div#donation_currency').html();
                    var data = 'currency=' + cur_symbol + '&token=' + token + '&amount=' + amount + '&action=sh_donation_by_checkout';
                    $.ajax({
                        type: "POST", url: ajaxurl,
                        data: data,
                        cache: false,
                        dataType: "json",
                        beforeSend: function () {
                            jQuery('div.loader-wrapper').fadeIn('slow');
                        },
                        success: function (response) {
                            $(button).prop('disabled', false);
                            var session_id = response.session;
                            after_process(session_id);
                        }
                    });
                };
                var alerts = [];
                var amount = $(button).parents('form').find('input[name="donation_amout"]').val();
                var card_num = jQuery(parent).find('#checkout2_card_no').val();
                var card_exp_mth = jQuery(parent).find('#checkout2-card-expiry-month').val();
                var card_exp_year = jQuery(parent).find('#checkout2-card-expiry-year').val();
                var card_cvc = jQuery(parent).find('#checkout2-verify-num').val();
                if (amount === '') {
                    alerts.push(var_before + ' ' + wst_card_amount);
                }
                if (card_num === '') {
                    alerts.push(var_before + ' ' + wst_card_nub);
                }
                if (card_exp_mth === '') {
                    alerts.push(var_before + ' ' + wst_card_cem);
                }
                if (card_exp_year === '') {
                    alerts.push(var_before + ' ' + wst_card_cey);
                }
                if (card_cvc === '') {
                    alerts.push(var_before + ' ' + wst_card_cvc);
                }
                if (alerts.length === 0) {
                    if ($('input#checkout2_payment_access_tocken').length && $('input#checkout2_payment_access_tocken').val().length) {
                        $(msg).empty();
                        $(msg).show();
                        $(msg).html('<div class="alert alert-info">' + invalid_token + '</div>');
                        $(button).prop('disabled', false);
                        jQuery('div.loader-wrapper').fadeOut('slow');
                    } else {
                        var ammount = $(button).parent().prev().prev().prev().prev().prev().children('div').children('input').val();
                        var cur_symbol = $(parent).find('div#donation_currency').html();
                        var args = {
                            sellerId: CHECKOUT2_Account_No,
                            publishableKey: CHECKOUT2_PUBLIC_KEY,
                            ccNo: card_num,
                            cvv: card_cvc,
                            expMonth: card_exp_mth,
                            expYear: card_exp_year
                        };
                        TCO.requestToken(successCallback, errorCallback, args);
                    }
                } else {
                    $(button).prop('disabled', false);
                    $(msg).empty();
                    $(msg).show();
                    var newHTML = jQuery.map(alerts, function (value) {
                        return ("<div class=\"alert alert-warning\" role=\"alert\">" + value + "</div>");
                    });
                    jQuery(msg).html(newHTML.join(""));
                    $('html,body').animate({scrollTop: $(msg).offset().top + -150}, 'slow');
                    setTimeout(function () {
                        $(msg).fadeOut('slow');
                    }, 5000);
                }

            } else {
                $(this).prop('disabled', false);
                jQuery('div.loader-wrapper').fadeOut('slow');
                $(msg).empty();
                $(msg).html('<div class="alert alert-warning">' + STRIPE_ERROR + '</div>');
                $(msg).show();
                $('html,body').animate({scrollTop: $(msg).offset().top + -150}, 'slow');
                setTimeout(function () {
                    $(msg).fadeOut('slow');
                }, 5000);
            }
        });
        jQuery('div.loader-wrapper').fadeOut('slow');
        return false;
    });
    function after_process(session) {
        if (session !== '') {
            var parent = $('div.donation-popup');
            var msg = $(parent).find('div.donation_errors');
            var donor_name = $(parent).find('#donor_name').val();
            var donor_email = $(parent).find('#donor_email').val();
            var data = 'id=' + session + '&donor_name=' + donor_name + '&donor_email=' + donor_email + '&action=sh_save_donation_data';
            jQuery.ajax({
                type: "post",
                url: ajaxurl,
                data: data,
                beforeSend: function () {
                    jQuery('div.loader-wrapper').fadeIn('slow');
                },
                success: function (response) {
                    jQuery('div.loader-wrapper').fadeOut('slow');
                    $(msg).empty();
                    $(msg).html(response);
                    $(msg).show();
                    jQuery('div.loader-wrapper').fadeOut('slow');
                    $('html,body').animate({scrollTop: $(msg).offset().top + -150}, 'slow');
                }
            });
            return false;
        }
    }
});
