jQuery(document).ready(function ($) {
    $('.wrap #message.is-dismissible > button').on('click', function () {
        $('.wrap #message').fadeOut();
    });

    $('#accept-my-cookies-settings-form').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize the form data
        var formData = $(this).serialize();

        // include unchecked checkboxes with value 0
        $('#accept-my-cookies-settings-form input[type=checkbox]').each( function(el) {
            if ( $(this).prop('checked') === false ) {
                formData += '&' + $(this).attr('name') + '=0';
            }            
        });

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

    // Sync color inputs with associated text input
    $('input[type="color"]').on('change', function () {
        $(this).prev('input[type="text"]').val($(this).val());
    });
});
