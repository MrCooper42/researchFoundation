jQuery(document).ready(function ($) {
    "use strict";

    $('ul#navigate li').each(function () {
        $(this).mouseenter(function () {
            $(this).find('ul#mouseshower').slideDown(300);
        });
        $(this).mouseleave(function () {
            $(this).find('ul#mouseshower').slideUp(300);
        });
    });

    $('div#overlay').click(function () {
        $('div#view_box').fadeOut(500);
        $(this).fadeOut(500);
    });

    $('ul#navigate li').each(function () {
        $(this).find('ul#mouseshower li a#sh_view').click(function () {
            var id = $(this).data('val');

            var url = document.getElementById('ad_url').innerHTML;
            var url2 = document.getElementById('admn_url').innerHTML;
            var datastring = 'id=' + id + '&action=get_messaage';

            $.ajax({
                type: "POST",
                url: url + "admin-ajax.php",
                data: datastring,
                beforeSend: function () {
                    var height = $('body').height();
                    var width = $('body').width();
                    $('div#overlay').css({
                        'background': 'rgba(255, 255, 255,0.80)',
                        'position': 'fixed',
                        'z-index': '99999',
                        'top': '0',
                        'left': '0',
                    });
                    $('div#overlay').height(100 + '%');
                    $('div#overlay').width(100 + '%');
                    $('div#overlay').fadeIn(500);
                    $('div#overlay_img').fadeIn(500);

                },
                success: function (responseText) {
                    $('div#overlay_img').fadeOut(500);
                    $('div#view_box').html('');
                    $('div#view_box').fadeIn(500);
                    $('div#view_box').append(responseText);
                    //$("html, body").animate({ scrollTop: 0 }, "slow");
                },
            });
            return false;
        });
    });

    $('ul#navigate li').each(function () {
        $(this).find('ul#mouseshower li a#sh_reply').click(function () {
            var id = $(this).data('val');

            var url = document.getElementById('ad_url').innerHTML;
            var url2 = document.getElementById('admn_url').innerHTML;
            var datastring = 'id=' + id + '&action=send_messaage';

            $.ajax({
                type: "POST",
                url: url + "admin-ajax.php",
                data: datastring,
                beforeSend: function () {
                    var height = $('body').height();
                    var width = $('body').width();
                    $('div#overlay').css({
                        'background': 'rgba(255, 255, 255,0.80)',
                        'position': 'fixed',
                        'z-index': '99999',
                        'top': '0',
                        'left': '0',
                    });
                    $('div#overlay').height(100 + '%');
                    $('div#overlay').width(100 + '%');
                    $('div#overlay').fadeIn(500);
                    $('div#overlay_img').fadeIn(500);

                },
                success: function (responseText) {
                    $('div#overlay_img').fadeOut(500);
                    $('div#view_box').html('');
                    $('div#view_box').fadeIn(500);
                    $('div#view_box').append(responseText);
                    //$("html, body").animate({ scrollTop: 0 }, "slow");
                },
            });
            return false;
        });
    });

    $('ul#navigate li').each(function () {
        $(this).find('ul#mouseshower li a#sh_delete').click(function () {

            if (confirm("Are you sure?")) {
                var id = $(this).data('val');
                var li = $(this).parents('li');

                var url = document.getElementById('ad_url').innerHTML;
                var datastring = 'id=' + id + '&action=delete_messaage';

                $.ajax({
                    type: "POST",
                    url: url + "admin-ajax.php",
                    data: datastring,
                    success: function (responseText) {
                        if (responseText == 1)
                        {
                            li.css({
                                'background': 'red',
                            });
                            li.fadeOut(800);
                        }
                    },
                });
                return false;
            }

            else {
                return false;
            }
        });

    });

    $('ul#navigate li').each(function () {
        $(this).find('ul#mouseshower li a#sh_approve').click(function () {

            var id = $(this).data('val');
            var li = $(this).parents('li');

            var url = document.getElementById('ad_url').innerHTML;
            var datastring = 'id=' + id + '&action=approve_messaage';

            $.ajax({
                type: "POST",
                url: url + "admin-ajax.php",
                data: datastring,
                beforeSend: function () {
                    var height = $('body').height();
                    var width = $('body').width();
                    $('div#overlay').css({
                        'background': 'rgba(255, 255, 255,0.80)',
                        'position': 'fixed',
                        'z-index': '99999',
                        'top': '0',
                        'left': '0',
                    });
                    $('div#overlay').height(100 + '%');
                    $('div#overlay').width(100 + '%');
                    $('div#overlay').fadeIn(500);
                    $('div#overlay_img').fadeIn(500);

                },
                success: function (responseText) {
                    $('div#overlay_img').fadeOut(500);
                    $('div#view_box').html('');
                    $('div#view_box').fadeIn(500);
                    $('div#view_box').append(responseText);
                    //$("html, body").animate({ scrollTop: 0 }, "slow");
                },
            });
            return false;

        });

    });
});
