<?php

namespace SH\WP\Support;

use WP_Site;

class Wrap
{
    public static function switch_site(callable $callback, WP_Site|int $site): callable
    {
        $site_id = is_object($site) ? $site->blog_id : $site;

        return static function (... $args) use ($callback, $site_id): mixed {
            $was_switched = $GLOBALS['switched'] ?? false;

            $current_id = wp::get_current_site_id();

            $to_switch = $site_id !== $current_id;
            if ($to_switch) {
                wp::switch_to_site($site_id);
            }

            $result = $callback(... $args);
            if ($to_switch) {
                if($was_switched) {
                    wp::switch_to_site($current_id);
                } else {
                    wp::restore_current_site();
                }
            }

            return $result;
        };
    }
}