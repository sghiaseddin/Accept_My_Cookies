# Accept My Cookies

**Accept My Cookies** is a lightweight and customizable WordPress plugin that helps you comply with GDPR and other privacy regulations. It displays a user-friendly consent modal, allowing visitors to accept or reject tracking cookies. The plugin supports **Google Consent Mode** for seamless integration with Google Analytics, Ads, and Tag Manager.

---

## Features

- **GDPR Compliance**: Helps you comply with GDPR and other privacy regulations.
- **Customizable Consent Banner**: Fully customizable text, colors, and positioning.
- **Google Consent Mode**: Supports Google Consent Mode for Google Analytics, Ads, and Tag Manager.
- **Storage Options**: Choose between cookies or local storage for consent preferences.
- **Customizable Toggles**: Allow users to customize their consent preferences for specific tracking parameters.
- **Lightweight**: Minimal impact on site performance.

---

## Installation

1. Download the plugin ZIP file from the [Releases](https://github.com/sghiaseddin/accept-my-cookies/releases) page.
2. Go to your WordPress admin dashboard.
3. Navigate to **Plugins > Add New > Upload Plugin**.
4. Upload the ZIP file and click **Install Now**.
5. Activate the plugin.

---

## Configuration

After activating the plugin, follow these steps to configure it:

1. Go to **Settings > Accept My Cookies** in your WordPress admin dashboard.
2. Configure the following settings:
   - **Consent Text**: Customize the text displayed in the consent banner.
   - **Learn More URL**: Set the URL for the "Learn More" link.
   - **Google Consent Mode**: Enable Google Consent Mode and provide your Google Analytics ID.
   - **Storage Method**: Choose between cookies or local storage.
   - **Banner Appearance**: Customize the banner's position, size, colors, and delay.
3. Save your changes.

---

## Usage

Once configured, the plugin will automatically display a consent banner to your visitors. Users can:
- **Accept**: Accept all tracking cookies.
- **Customize**: Customize their consent preferences for specific tracking parameters.
- **Learn More**: Visit your privacy policy page for more information.

---

## Google Consent Mode

The plugin supports **Google Consent Mode**, allowing you to manage user consent for Google services. When enabled, the plugin will:
- Set default consent to `denied` for all tracking parameters.
- Update consent status to `granted` based on user preferences.
- Integrate seamlessly with Google Analytics, Ads, and Tag Manager.

---

## Customization

### Banner Appearance
You can customize the following aspects of the consent banner:
- **Position**: Choose from bottom, top, left, right, or center.
- **Size**: Set the banner size to tiny, normal, or wide.
- **Colors**: Customize the banner's background, text, and button colors.
- **Delay**: Set a delay (in seconds) before the banner appears.

### Tracking Parameters
You can enable or disable the following tracking parameters:
- **Analytics Storage**
- **Ad Storage**
- **Ad User Data**
- **Ad Personalization**

---

## Contributing

We welcome contributions! If you'd like to contribute to the development of **Accept My Cookies**, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and test thoroughly.
4. Submit a pull request with a detailed description of your changes.

---

## Support

If you encounter any issues or have questions, please [open an issue](https://github.com/sghiaseddin/accept-my-cookies/issues) on GitHub.

---

## License

**Accept My Cookies** is licensed under the [GPLv3](https://www.gnu.org/licenses/gpl-3.0.html) or later.

---

## Credits

- Developed by [Shayan Ghiaseddin](https://sghiaseddin.com).
- Inspired by the need for Google Consent Mode on Google Digital Marketing platforms.

---

## Changelog

### 0.6.3 ###

- Minor bug fix in stylings

### 0.6.2 ###

Fixing wordpress plugin reviewer issues:
- Tested Up To Value is Out of Date, Invalid, or Missing
- Use wp_enqueue commands
- Undocumented use of a 3rd Party / external service
- Using load_plugin_textdomain() for loading the plugin translations is not needed for WordPress.org directory since WordPress 4.6.
- Variables and options must be escaped when echo'd
- Allowing Direct File Access to plugin files

### 0.6.1 

- Getting the custom HTML
- Rendering custom HTML in the <head>

### 0.5.1 

- Credit tab added to settings

### 0.5.0

- Logging functionality has added

### 0.4.5

- Adding status to submit button in settings page
- Fixing input validator

### 0.4.3
- Adding title for consent banner
- Fixing text-domain load
- Adding Persian language glossary

### 0.3.9
- Ready to submit in Wordpress plugin's repo