// Define dataLayer and the gtag function.
window.dataLayer = window.dataLayer || [];
function gtag() { dataLayer.push(arguments); }

// Define the parameters that admin decided to track
const consentParameters = [];
if (acceptMyCookiesData.options['analytics_storage']) {
    consentParameters.push('analytics_storage');
}
if (acceptMyCookiesData.options['ad_storage']) {
    consentParameters.push('ad_storage');
}
if (acceptMyCookiesData.options['ad_user_data']) {
    consentParameters.push('ad_user_data');
}
if (acceptMyCookiesData.options['ad_personalization']) {
    consentParameters.push('ad_personalization');
}

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
const storageMethod = acceptMyCookiesData.options['storage_method'];
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