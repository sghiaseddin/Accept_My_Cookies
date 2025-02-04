jQuery(document).ready(function ($) {
    // Check if the user has already consented
    function hasUserConsented() {
        const storageMethod = acceptMyCookiesData.options.storage_method;

        if (storageMethod === 'cookies') {
            // Check cookies (handled in PHP)
            return false; // PHP will handle this
        } else {
            // Check local storage
            const consent = localStorage.getItem('accept_my_cookies_consent');
            return consent === 'true'; // Return true if consent is granted
        }
    }

    // Show the consent banner after a delay
    function showBannerAfterDelay() {
        const delaySeconds = acceptMyCookiesData.options.banner_delay_seconds;

        setTimeout(function () {
            if (!hasUserConsented()) {
                $('#accept-my-cookies-banner').fadeIn();
            }
        }, delaySeconds * 1000); // Convert seconds to milliseconds
    }

    // Handle "Accept" button click
    $(document).on('click', '.accept-my-cookies-banner__button--accept', function () {
        setConsent(true);
        hideBanner();
    });

    // Handle "Customize" button click
    $(document).on('click', '.accept-my-cookies-banner__button--customize', function () {
        // TODO: Implement customization logic
        console.log('Customize button clicked');
    });

    // Set consent preference
    function setConsent(consent) {
        const storageMethod = acceptMyCookiesData.options.storage_method;

        if (storageMethod === 'cookies') {
            const expirationDays = acceptMyCookiesData.options.cookie_expiration_days;
            document.cookie = `accept_my_cookies_consent=${consent}; max-age=${expirationDays * 86400}; path=/`;
        } else {
            localStorage.setItem('accept_my_cookies_consent', consent);
        }

        // Trigger Google Consent Mode if enabled
        if (acceptMyCookiesData.options.google_consent_mode_enabled) {
            updateGoogleConsentMode(consent);
        }
    }

    // Hide the consent banner
    function hideBanner() {
        $('#accept-my-cookies-banner').fadeOut();
    }

    // Update Google Consent Mode
    function updateGoogleConsentMode(consent) {
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': 'update_consent',
            'analytics_storage': consent ? 'granted' : 'denied',
            'ad_storage': consent ? 'granted' : 'denied',
            'ad_user_data': consent ? 'granted' : 'denied',
            'ad_personalization': consent ? 'granted' : 'denied'
        });
    }

    // Initialize the banner
    function initBanner() {
        if (!hasUserConsented()) {
            showBannerAfterDelay();
        }
    }

    // Start the banner initialization
    initBanner();
});