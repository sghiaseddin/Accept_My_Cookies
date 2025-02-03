jQuery(document).ready(function ($) {
    $('#accept-my-cookies-settings-form').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Serialize the form data
        var formData = $(this).serialize();

        // Send the AJAX request
        $.ajax({
            url: ajaxurl,
            type: 'POST',
            data: formData + '&action=accept_my_cookies_save_settings' + '&_ajax_nonce=' + acceptMyCookiesSaveSettings.nonce,
            success: function (response) {
                if (response.success) {
                    alert('Settings saved successfully!');
                } else {
                    alert('Failed to save settings.');
                }
            },
            error: function () {
                alert('An error occurred while saving settings.');
            }
        });
    });
});