# WordPress Critters Plugin

A custom WordPress plugin for managing memorial entries, tribute pages, and condolence messages.  
This plugin allows administrators to add, update, and manage memorial records while visitors can submit condolence messages.

---

## Features

- Create and manage memorial/tribute entries
- Store personal details and obituary information
- Allow visitors to submit condolence messages
- Admin panel for managing records
- Color customization settings
- Captcha support for form submissions
- Custom database tables for storing data

---

## Installation

1. Download or clone this repository.
2. Upload the plugin folder to the WordPress directory:

/wp-content/plugins/

3. Go to **WordPress Admin → Plugins**.
4. Activate the **Critters Plugin**.

---

## Plugin Structure

critters-plugin/
│
├── critters.php
├── css/
│ └── style.css
│
├── js/
│ └── custom.js
│
├── src/
│ ├── functions.php
│ └── admin/
│ ├── critters_services.php
│ ├── Update_critter.php
│ ├── critter_details.php
│ ├── condolence_messages.php
│ ├── mourning_letter.php
│ ├── Colour_change_settings.php
│ └── captcha_file.php

---

## Database Tables

This plugin automatically creates the following tables when activated:

- `wp_critters_form_details`
- `wp_critters_form_response`
- `wp_change_color`

These tables store memorial information, visitor responses, and plugin settings.

---

## Technologies Used

- PHP
- WordPress Plugin API
- MySQL
- JavaScript
- CSS

---

## Use Case

This plugin is useful for:

- Memorial websites
- Funeral service websites
- Tribute pages
- Collecting condolence messages from visitors

---

## Author

Developed by **Nasreen Shah**

WordPress Developer with experience in custom plugin development, WooCommerce customization, and Shopify development.

---

## License

This project is open-source and available under the MIT License.
