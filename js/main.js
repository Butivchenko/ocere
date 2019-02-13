$(document).ready(function () {


    $('#submit_signup').click(function (event) {
        var s_email = $('[name = email]').val(),
            s_password = $('[name = last_name]').val();
        if ($('[name = terms]').prop('checked')) {
            $.post(
                "/php/sender.php",
                {
                    first_name: $('[name = first_name]').val(),
                    last_name: $('[name = last_name]').val(),
                    email: $('[name = email]').val(),
                    password: $('[name = password]').val(),
                    country: $('[name = bill_country]').val(),
                    captcha: grecaptcha.getResponse()

                },
                onAjaxSuccess
            );

            function onAjaxSuccess(data) {
                // Здесь мы получаем данные, отправленные сервером и выводим их на экран.
                // alert(data);
                var obj = jQuery.parseJSON(data);
                if (obj.success != "true") {
                    $('[name = "' + obj.error_name + '"]').addClass('trouble');
                    alert(obj.error);
                }
                else {
                    //alert("Sign up - successfull");

                    $.post(
                        "/php/send-mail.php",
                        {
                            theme: "new_user",
                            user: s_email,
                            first_name: $('[name = first_name]').val(),
                            last_name: $('[name = last_name]').val(),
                            country: $('[name = bill_country]').val()
                        });

                    $.cookie('user', s_email);
                    $.cookie('secret', obj.secret);
                    window.location.href = 'http://forms.ocere.com/dashboard.php';
                }

            }


        }
        else {
            alert('You must check terms and conditions');
            $('[name="terms"]').addClass('trouble');
        }
    });


    $('.sign-up-form input').click(function (event) {
        $(this).removeClass('trouble');
    });


    $('#login').click(function (event) {
        $.post(
            "/php/login-ver.php",
            {
                email: $('[name = email]').val(),
                password: $('[name = password]').val(),
            },
            onAjaxSuccess
        );

        function onAjaxSuccess(data) {
            var obj = jQuery.parseJSON(data);
            if (obj.success != "true") {
                $('[name = "' + obj.error_name + '"]').addClass('trouble');
                alert(obj.error);
            }
            else {
                console.log("Login - successfull");
                $.cookie('user', obj.user);
                $.cookie('secret', obj.secret);
                window.location.href = 'http://forms.ocere.com/order-approving.php';
            }
        }
    });


    $('#order-table .desc td input, [name = "Comments"]').keyup(function (event) {
        order = "{";
        i = 1;
        $('#order-table .desc:visible').each(function (index, el) {

            order_name = $($(this).find('td:nth-child(2) label')).text();
            order_anchor = $($(this).find('td:nth-child(3) input')).val();
            order_url = $($(this).find('td:nth-child(4) input')).val();
            order_price = $(this).data('price');
            order = order + '"row' + index + '": {"name":"' + order_name + '", "anchor": "' + order_anchor + '", "url": "' + order_url + '", "price": "' + order_price + '" }';

            if (i < $('#order-table .desc:visible').length) {
                order = order + ',';
            }
            i = i + 1;
        });
        summary = $('.totGBP').text();
        order = order + ',"summary":"' + summary + '"';
        order = order + '}';
        console.log(order);

        $.cookie('order', order);
        $.cookie('comment', $('[name = "Comments"]').val())
    });

    $('#open-pass').click(function (event) {
        $('.password-change').toggleClass('non-visible');
        $('#save-changes').toggleClass('non-visible');

    });

    $('#change-pass').click(function (event) {
        $.post(
            "/php/change-password.php",
            {
                old_pass: $('[name = old_pass]').val(),
                new_pass: $('[name = new_pass]').val(),
                repeat_pass: $('[name = repeat_pass]').val(),
            },
            onAjaxSuccess
        );

        function onAjaxSuccess(data) {
            var obj = jQuery.parseJSON(data);
            if (obj.success != "true") {
                $('[name = "' + obj.error_name + '"]').addClass('trouble');
                alert(obj.error);
            }
            else {
                alert("Password change - successfull");
                $.cookie('secret', obj.new);

            }
        }
    });

    $('#save-changes').click(function (event) {
        $.post(
            "/php/save-changes.php",
            {
                first_name: $('[name = first_name]').val(),
                last_name: $('[name = last_name]').val(),
                email: $('[name = email]').val(),
                country: $('[name = bill_country]').val(),
            },
            onAjaxSuccess
        );

        function onAjaxSuccess(data) {
            var obj = jQuery.parseJSON(data);
            if (obj.success != "true") {
                $('[name = "' + obj.error_name + '"]').addClass('trouble');
                alert(obj.error);
            }
            else {
                alert("Data change - successfull");
                $.cookie('user', obj.new_email);

            }
        }
    });

    function recount_table() {

        $('.first_col:visible').each(function (index, el) {
            $(this).text(index);
            $(this).attr('placeholder', '');
        });
        console.log('counted')
    }

    $('#change-view').click(function (event) {
        $('#order-table').toggleClass('table-vision');
        recount_table();
    });

    $('.form.form-new input').change(function (event) {
        setTimeout(recount_table, 100);
    });


    console.log("Launch successfull");

});


$(document).ready(function () {
    var offset = $('header').offset();
    var topPadding = 0;
    $(window).scroll(function () {
        if ($(window).scrollTop() > offset.top) {
            //$('header').stop().animate({marginTop: $(window).scrollTop() - offset.top + topPadding});
            $('header').css({'position': 'fixed', 'z-index': '100', 'width': '100%'}).fadeIn('fast');

        }
        else {
            $('header').css({'position': 'static', 'width': '100%'});
            //$('header').stop().animate({marginTop: 0});
        }
    });
});




/**
 *  Change attribute required when uploading file
 *
 */
$('form input[type=file]').change(function () {
    if ($('form input[type=file]').val() != '') {
        $('form input[name="website_url"]').attr('required', false);
        $('form textarea[name="details"]').attr('required', false);
    } else {

        $('form input[name="website_url"]').attr('required', true);
        $('form textarea[name="details"]').attr('required', true);
        var color = 'red';
    }
    $('form button[type=submit]').css('background-color', color);
});