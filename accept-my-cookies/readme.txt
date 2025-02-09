=== Accept My Cookies ===
Contributors: sghiaseddin
Donate link: https://sghiaseddin.com
Tags: gdpr, cookies, consent, google consent mode, privacy
Requires at least: 5.6
Tested up to: 6.7.1
Stable tag: 0.4.5
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
