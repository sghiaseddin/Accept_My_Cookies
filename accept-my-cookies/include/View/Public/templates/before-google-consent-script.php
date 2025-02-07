<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

ob_start();
?>
    // Define dataLayer and the gtag function.
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }

    // Define the parameters that admin decided to track
    const consentParameters = [];
    <?php
    if ($this->options['analytics_storage']) {
        echo "consentParameters.push('analytics_storage');\n";
    }
    if ($this->options['ad_storage']) {
        echo "consentParameters.push('ad_storage');\n";
    }
    if ($this->options['ad_user_data']) {
        echo "consentParameters.push('ad_user_data');\n";
    }
    if ($this->options['ad_personalization']) {
        echo "consentParameters.push('ad_personalization');\n";
    }
    ?>

    // Set default consent to 'denied' for all parameters
    const defaultConsent = {};
    consentParameters.forEach(param => {
        defaultConsent[param] = 'denied';
    });
    gtag('consent', 'default', defaultConsent);

    // Consent handler function
    function updateConsent(parameter, consentStatus) {
        gtag('consent', 'update', {
            [parameter]: consentStatus,
        });
    }

    // Check and handle consent
    const storageMethod = '<?php echo esc_js($this->options['storage_method']); ?>';
    const consentKey = 'accept_my_cookies_consent';

    // Function to update consent based on stored values
    function updateStoredConsent() {
        consentParameters.forEach(param => {
            let storedValue;
            if (storageMethod === 'cookies') {
                const cookie = document.cookie.split('; ').find(row => row.startsWith(param));
                storedValue = cookie ? cookie.split('=')[1] : 'false';
            } else {
                storedValue = localStorage.getItem(param) || 'false';
            }

            if (storedValue === 'false') {
                // updateConsent(param, 'denied');
            } else {
                updateConsent(param, 'granted');
            }
        });
    }
<?php
return ob_get_clean();
