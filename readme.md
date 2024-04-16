## WP Support

![Screen Shot][product-screenshot]

WP Support is a PHP Library that contains utility classes for modern WordPress development.

<!-- GETTING STARTED -->

## Getting Started

### Installation

   ```sh
   composer require spenserhale/wp-support
   ```

## Example Usages

### Safely call WordPress admin functions

Library attempts to load the WordPress admin function if not present and gracefully fail if not found.

   ```php
   wp::activate_plugin('hello-dolly/hello.php');
   ```
### Common Iterators

Library provides common iterators for WordPress objects.

   ```php
   $new_titles = Each::post(static fn(WP_Post $post) => $post->post_title, ['category' => 'news']);
   ```

   ```php
   Each::page(static function(WP_Post $page) {
       wp::update_post_meta($page->ID, 'new_meta', 'new_value');
   }, ['post_status' => 'draft']);
   ```

### WordPress Multisite Support

Library uses names that better match the WordPress Multisite terminology that align with correct WP_Network and WP_Site objects.

   ```php
   wp::get_current_site_id(); // Returns the WP_Site ID not WP_Network ID
   ```

Switch sites with ease.
   ```php
    With::switch_site(static fn() => wp::update_option('external_data', $data), $site_id);
   ```

Get data or apply updates on all sites.

   ```php
   $versions = Each::site_with_switch(static fn(WP_Site $site) => wp::get_option('plugin_version'));
   ```


## License
The WordPress Support Library is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[product-screenshot]: images/explainer.png
