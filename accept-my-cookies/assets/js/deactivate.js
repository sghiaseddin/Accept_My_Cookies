(function ($) {
    $(document).ready(function () {
        // Handle the deactivate link click
        $('tr[data-slug="accept-my-cookies"] .deactivate a').on('click', function (e) {
            e.preventDefault(); // Prevent the default deactivation behavior

            // Show a confirmation dialog
            if (confirm('Do you want to remove all options and preferences related to Accept My Cookies?')) {
                // Send an AJAX request to perform cleanup
                $.ajax({
                    url: ajaxurl, // WordPress AJAX URL
                    type: 'POST',
                    data: {
                        action: 'accept_my_cookies_cleanup',
                        nonce: acceptMyCookiesCleanup.nonce // Pass the nonce
                    },
                    success: function (response) {
                        console.log(response);
                        console.log('Cleanup was successful.');
                        // Redirect to the deactivation URL after cleanup
                        window.location.href = $(e.target).attr('href');
                    },
                    error: function () {
                        alert('Cleanup failed. Please try again.');
                    }
                });
            } else {
                // If the user cancels, redirect to the deactivation URL without cleanup
                window.location.href = $(e.target).attr('href');
            }
        });
    });
})(jQuery);