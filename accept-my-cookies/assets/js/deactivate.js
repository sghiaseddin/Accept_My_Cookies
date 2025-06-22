(function ($) {
    $(document).ready(function () {
        // Define modal markup
        const acceptMyCookiesDeactivateModalHtml = '<div class="accept-my-cookies-deactivate-modal-wrapper"' +
        ' style="display:none;">' +
        '<div class="accept-my-cookies-deactivate-modal">' +
        '<h3>Confirm Deactivation</h3>' +
        '<p>Do you want to remove all options and preferences related to this plugin?</p>' +
        '<div class="accept-my-cookies-options">' +
        '<button class="accept-my-cookies-remove-data button button-primary">Remove Data & Deactivate</button>' +
        '<button class="accept-my-cookies-deactivate button button-primary">Deactivate Only</button>' +
        '<button class="accept-my-cookies-cancel button">Cancel</button>' +
        '</div>' +
        '</div></div>';

        // Append modal to the body
        $(document.body).append(acceptMyCookiesDeactivateModalHtml);

        // Handle clicks on the modal wrapper (outside of the modal)
        $('.accept-my-cookies-deactivate-modal-wrapper').on('click', function (e) {
            // Check if the click is outside the modal content
            if (!$(e.target).closest('.accept-my-cookies-deactivate-modal').length) {
                $('.accept-my-cookies-deactivate-modal-wrapper').fadeOut();
            }
        });

        // Handle the deactivate link click
        $('tr[data-plugin="accept-my-cookies/accept-my-cookies.php"] .deactivate a').on('click', function (e) {
            e.preventDefault(); // Prevent the default deactivation behavior

            // Show the modal
            $('.accept-my-cookies-deactivate-modal-wrapper').fadeIn();

            // Handle Remove data and deactivation button clicks
            $('.accept-my-cookies-deactivate-modal .accept-my-cookies-remove-data').click(function () {
                // Trigger deactivation with data removal
                $.ajax({
                    url: ajaxurl, // WordPress AJAX URL
                    type: 'POST',
                    data: {
                        action: 'accept_my_cookies_cleanup',
                        nonce: acceptMyCookiesCleanup.nonce // Pass the nonce
                    },
                    success: function (response) {
                        console.log('Cleanup was successful.');
                        // Redirect to the deactivation URL after cleanup
                        window.location.href = $(e.target).attr('href');
                    },
                    error: function () {
                        alert('Cleanup failed. Please try again.');
                    }
                });
            });

            // Handle deactivation button
            $('.accept-my-cookies-deactivate-modal .accept-my-cookies-deactivate').click(function () {
                // Proceed with normal deactivation without data removal
                window.location.href = $(e.target).attr('href');
            });

            // Handel Cancel button
            $('.accept-my-cookies-deactivate-modal .accept-my-cookies-cancel').click(function () {
                $('.accept-my-cookies-deactivate-modal-wrapper').fadeOut();
            });
        });
    });
})(jQuery);