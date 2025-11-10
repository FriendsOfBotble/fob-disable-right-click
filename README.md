# FOB Disable Right Click

A Botble CMS plugin to disable right-click, text selection, and developer console on your website to protect your content.

![FOB Disable Right Click](./art/screenshot.png)

## Features

- **Disable Right Click**: Prevent users from using right-click context menu
- **Disable Text Selection**: Prevent users from selecting and copying text
- **Disable Developer Console**: Automatically reload page when DevTools/Console is opened
- **Keyboard Shortcut Blocking**: Block common shortcuts like F12, Ctrl+Shift+I, Ctrl+U, etc.
- **Multi-language Support**: Translations available in 42 languages

## Requirements

- Botble CMS 7.6.0 or higher
- PHP 8.2 or higher

## Installation

### Install via Admin Panel

Go to the **Admin Panel** and click on the **Plugins** tab. Click on the "Add new" button, find the **FOB Disable Right Click** plugin and click on the "Install" button.

### Install manually

1. Download the plugin from the [Botble Marketplace](https://marketplace.botble.com/products/FriendsOfBotble/fob-disable-right-click).
2. Extract the downloaded file and upload the extracted folder to the `platform/plugins` directory.
3. Go to **Admin** > **Plugins** and click on the **Activate** button.

## Configuration

Navigate to **Admin Panel → Settings → Disable Right Click** to configure:

1. **Disable Right Click** (Enabled by default)
   - Prevents right-click context menu
   - Blocks keyboard shortcuts (F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U, etc.)

2. **Disable Text Selection** (Disabled by default)
   - Prevents text selection with mouse
   - Prevents text copying

3. **Disable Developer Console** (Disabled by default)
   - Detects when DevTools/Console is opened
   - Automatically reloads the page when detected

## How It Works

The plugin injects JavaScript code into your website's frontend that:

- Intercepts right-click events and prevents the context menu
- Blocks keyboard shortcuts commonly used to inspect page source
- Applies CSS styles to prevent text selection
- Monitors browser window size and console access to detect DevTools
- Only runs on public pages (not in admin panel)

## Important Notes

⚠️ **This is a client-side protection** and can be bypassed by experienced users. It serves as a deterrent for casual users but should not be relied upon as the sole method of content protection.

For better content protection, consider:
- Watermarking images
- Using proper copyright notices
- Implementing server-side security measures
- Using CDN protection services

## Screenshot

![Settings Page](art/screenshot.png)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email friendsofbotble@gmail.com instead of using the issue tracker.

## Credits

-   [Friends Of Botble](https://github.com/FriendsOfBotble)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
