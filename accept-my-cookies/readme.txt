=== Accept My Cookies ===
Contributors: sghiaseddin
Donate link: https://sghiaseddin.com
Tags: gdpr, cookies, consent, google consent mode, privacy
Requires at least: 7.3
Tested up to: 6.8
Stable tag: 1.4.1
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Accept My Cookies displays a user-friendly consent banner, allowing visitors to accept or reject tracking cookies and it supports Google Consent Mode.

== Description ==

**Accept My Cookies** is a lightweight and customizable WordPress plugin that helps you comply with GDPR and other privacy regulations. It displays a user-friendly consent modal, allowing visitors to accept or reject tracking cookies. The plugin supports **Google Consent Mode** for seamless integration with Google Analytics, Ads, and Tag Manager.

= Key Features =
- **GDPR Compliance**: Helps you comply with GDPR and other privacy regulations.
- **Customizable Consent Banner**: Fully customizable text, colors, and positioning.
- **Google Consent Mode**: Supports Google Consent Mode for Google Analytics, Ads, and Tag Manager.
- **Storage Options**: Choose between cookies or local storage for consent preferences.
- **Customizable Toggles**: Allow users to customize their consent preferences for specific tracking parameters.
- **Lightweight**: Minimal impact on site performance.
- **Cache and CDN Compatible**: Having the option to store user choice in browser's local storage, no need to worry about interference with caching systems or CDN.

= Google Consent Mode =
The plugin supports **Google Consent Mode**, allowing you to manage user consent for Google services. When enabled, the plugin will:
- Set default consent to `denied` for all tracking parameters.
- Update consent status to `granted` based on user preferences.
- Integrate seamlessly with Google Analytics, Ads, and Tag Manager.

= Customization =
You can customize the following aspects of the consent banner:
- **Position**: Choose from bottom, top, left, right, or center.
- **Size**: Set the banner size to tiny, normal, or wide.
- **Colors**: Customize the banner's background, text, and button colors.
- **Delay**: Set a delay (in seconds) before the banner appears.

== External services ==
This plugin provide options to you to connects to Google Tag Manager in order to enable Google Consent Mode, which is used to manage user consent for Google services such as Google Analytics, Google Ads, and Google Tag Manager.

= What data is sent and when? =
- **Data Sent**: The plugin sends the user's consent preferences (e.g., analytics_storage, ad_storage, ad_user_data, ad_personalization) to Google Tag Manager (https://www.googletagmanager.com/gtag/js?id=########).
- **When**: This data is sent when the user interacts with the consent banner (e.g., accepting or rejecting cookies).

Links to Service Policies:
[Google Tag Manager Terms of Service](https://marketingplatform.google.com/about/tag-manager/use-policy/)
[Google Privacy Policy](https://policies.google.com/privacy)

= Why is this necessary? =
Google Consent Mode is required to ensure that no tracking occurs without user consent, helping you comply with GDPR and other privacy regulations. The plugin does not send any personally identifiable information (PII) to Google.

== Installation ==

1. Download the plugin ZIP file from the WordPress plugin directory.
2. Go to your WordPress admin dashboard.
3. Navigate to **Plugins > Add New > Upload Plugin**.
4. Upload the ZIP file and click **Install Now**.
5. Activate the plugin.

== Configuration ==

After activating the plugin, follow these steps to configure it:

1. Go to **Settings > Accept My Cookies** in your WordPress admin dashboard.
2. Configure the following settings:
   - **Consent Text**: Customize the text displayed in the consent banner.
   - **Learn More URL**: Set the URL for the "Learn More" link.
   - **Google Consent Mode**: Enable Google Consent Mode and provide your Google Analytics ID.
   - **Storage Method**: Choose between cookies or local storage.
   - **Banner Appearance**: Customize the banner's position, size, colors, and delay.
3. Save your changes.

== Frequently Asked Questions ==

= What is Google Consent Mode? =
Google Consent Mode allows you to manage user consent for Google services like Analytics, Ads, and Tag Manager. It ensures that no tracking occurs without user consent. [Set up consent mode on websites](https://developers.google.com/tag-platform/security/guides/consent?consentmode=basic)

= I've installed and setup the plugin, but Google property still doesn't show consent signals. What do I do? =
Ensure you are using the correct Google Analytics ID (e.g., G-XXXXXXXXXX). Test the consent implementation using [Google Tag Assistant](https://tagassistant.google.com) to verify that consent signals are being sent correctly. Note that it may take up to 24 hours for Google Analytics to collect and display the consent data in your reports. If issues persist, double-check your plugin settings and ensure Google Consent Mode is enabled.

= I've created a new property in Google Analytic and saved the ID (e.g., G-XXXXXXXXXX) in the plugin settings. But the test wizard shows the script is not embeded in the page. What is wrong? =
Ensure you are using the correct Google Analytics ID (e.g., G-XXXXXXXXXX) and purge the caching system on your host and CDN. Then skip the test wizard in the Google Analytics property creation and move forward to main page of Analytics. There you will see the tracking is working.

= Consent banner is poping up on every page, even after visitor accept one. What is wrong here? =
You probably has chosen "Cookies" as Storage Method in the settigs page. You might have also set caching system. This means the caching system has cached the pages with consent banner poping up state. I recommend changing Storage Method to "Local Storage", so the visitor decision on consents would be checked after page load by getting the associated key form local storage and using JavaScript.

= Can I customize the consent banner? =
Yes, the consent banner is fully customizable. You can change its text, colors, position, size, and delay.

== Screenshots ==

1. Consent Banner - The customizable consent banner displayed to users.
2. Google Analytics - Track responsibly.
3. Gtag Test - Best practice in implementation
4. Receiving Consent Signals
5. Plugin Settings - General
6. Plugin Settings - Google Property
7. Plugin Settings - Styling

== Changelog ==

== 1.4.0 ==

- Extract information from .log file
- And show as line chart in Logging tab

= 1.3.1 =

- Bug fix with showing Clarity toggle
- Bug fix with adding opacity to hex colors

= 1.3.0 =

- Microsoft Clarity has added as an option to consent banner

= 1.2.1 =

- Passed the test with Wordpress 6.8

= 1.2.0 =

- Reduced exposed options as js object to only those needed
- Restructured the classes dependency 

= 1.1.0 =

- Logging bug fixed to log all parameters with consent options
- Cookies must be check by JavaScript too, to make work on caching systems on
- Minor change in Persian translation 

= 1.0.3 =

- Minor bug fix in initial language detection

= 1.0.0 =

- Release to Wordpress Plugin Repository

= 0.6.4 =

- Bug fix in stylings
- Bug fix in default custom html value
- Adding and editing Persian translation

= 0.6.3 =

- Minor bug fix in stylings

= 0.6.2 =

Fixing wordpress plugin reviewer issues:
- Tested Up To Value is Out of Date, Invalid, or Missing
- Use wp_enqueue commands
- Undocumented use of a 3rd Party / external service
- Using load_plugin_textdomain() for loading the plugin translations is not needed for WordPress.org directory since WordPress 4.6.
- Variables and options must be escaped when echo'd
- Allowing Direct File Access to plugin files

= 0.6.1 =

- Getting the custom HTML
- Rendering custom HTML in the <head>

= 0.5.1 =

- Credit tab added to settings

= 0.5.0 =

- Logging functionality has added

= 0.4.5 =

- Adding status to submit button in settings page
- Fixing input validator

= 0.4.3 =

- Adding title for consent banner
- Fixing text-domain load
- Adding Persian language glossary

= 0.3.9 =

- Submiting the plugin to Wordpress plugin's repo

== Upgrade Notice ==

= 0.4.3 =

- Adding title for consent banner
- Fixing text-domain load
- Adding Persian language glossary

== License ==

**Accept My Cookies** is licensed under the [GPLv3](https://www.gnu.org/licenses/gpl-3.0.html) or later.

== Credits ==

- Developed by [Shayan Ghiaseddin](https://sghiaseddin.com).
- Inspired by the need for Google Consent Mode on Google Digital Marketing platforms.
