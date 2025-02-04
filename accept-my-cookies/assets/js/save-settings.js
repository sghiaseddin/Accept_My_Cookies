jQuery(document).ready(function ($) {
    $('.wrap #message.is-dismissible > button').on('click', function () {
        $('.wrap #message').fadeOut();
    });

    $('#accept-my-cookies-settings-form').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize the form data
        var formData = $(this).serialize();

        $('.wrap #message').addClass('notice-info').fadeIn();
        $('.wrap #message > p').text('Updating...');

        // Send the AJAX request
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: formData + '&action=accept_my_cookies_save_settings' + '&nonce=' + acceptMyCookiesSaveSettings.nonce, 
            success: function (response) {
                if (response.success) {
                    $('.wrap #message').addClass('notice-success').fadeIn();
                    $('.wrap #message').removeClass('notice-info');
                    $('.wrap #message').removeClass('notice-error');
                    $('.wrap #message > p').text(response.data);
                } else {
                    $('.wrap #message').addClass('notice-error').fadeIn();
                    $('.wrap #message').removeClass('notice-info');
                    $('.wrap #message').removeClass('notice-success');
                    $('.wrap #message > p').text(response.data);
                    console.log(response);
                }
            },
            error: function () {
                $('.wrap #message').addClass('notice-error').fadeIn();
                $('.wrap #message').removeClass('notice-info');
                $('.wrap #message').removeClass('notice-success');
            $('.wrap #message > p').text('Cannot make a connection with server. Something is wrong!');
            }
        });
    });
});
