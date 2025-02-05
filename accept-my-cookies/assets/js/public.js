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
        setConsent(true, false);
        hideBanner();
    });

    // Handle "Customize" button click
    $(document).on('click', '.accept-my-cookies-banner__button--customize', function () {
        // Show toggles
        $('.accept-my-cookies-banner__toggle').prop('disabled', false);
        $('.accept-my-cookies-banner__toggle').prop('checked', false);
        $('#accept-my-cookies-banner__toggles').fadeIn();
        $('.accept-my-cookies-banner__button--acceptall').show();
        $('.accept-my-cookies-banner__button--customize').hide();
    });

    // Handle "Accept All" button click
    $(document).on('click', '.accept-my-cookies-banner__button--acceptall', function () {
        // Enable all toggles
        $('.accept-my-cookies-banner__toggle').prop('checked', true);

        setConsent(true, true);
        hideBanner();
    });
    
    // Set consent preference
    function setConsent(consent, acceptAll = false) {
        const storageMethod = acceptMyCookiesData.options.storage_method;

        // Determine consent values for each parameter
        const consentParameters = [
            'analytics_storage',
            'ad_storage',
            'ad_user_data',
            'ad_personalization',
        ];

        var consentValues = {};
        for (const param of consentParameters) {
            if ($(`.accept-my-cookies-banner__toggle[data-consent-type="${param}"]`).length) {
                consentValues[param] = acceptAll || getToggleValue(param);
            }
        }
        
        // Store consent in cookies or local storage
        if (storageMethod === 'cookies') {
            const expirationDays = acceptMyCookiesData.options.cookie_expiration_days;
            document.cookie = `accept_my_cookies_consent=${consent}; max-age=${expirationDays * 86400}; path=/`;
            for (const [key, value] of Object.entries(consentValues)) {
                document.cookie = `${key}=${value}; max-age=${expirationDays * 86400}; path=/`;
            }
        } else {
            localStorage.setItem('accept_my_cookies_consent', consent);
            for (const [key, value] of Object.entries(consentValues)) {
                localStorage.setItem(key, value);
            }
        }

        // Trigger Google Consent Mode if enabled
        if (acceptMyCookiesData.options.google_consent_mode_enabled) {
            updateGoogleConsentMode(consentValues);
        }
    }

    // Get the value of a toggle
    function getToggleValue(consentType) {
        const toggle = $(`.accept-my-cookies-banner__toggle[data-consent-type="${consentType}"]`);
        return toggle.prop('checked');
    }

    // Hide the consent banner
    function hideBanner() {
        $('#accept-my-cookies-banner').fadeOut();
    }

    // Update Google Consent Mode
    function updateGoogleConsentMode(consentValues) {
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': 'update_consent',
            'analytics_storage': consentValues.analytics_storage ? 'granted' : 'denied',
            'ad_storage': consentValues.ad_storage ? 'granted' : 'denied',
            'ad_user_data': consentValues.ad_user_data ? 'granted' : 'denied',
            'ad_personalization': consentValues.ad_personalization ? 'granted' : 'denied',
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