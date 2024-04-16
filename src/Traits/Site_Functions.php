<?php

namespace SH\WP\Support\Traits;

trait Site_Functions
{
    /**
     * Retrieve the current site ID.
     *
     * @return int Site ID.
     */
    public static function get_current_site_id(): int {
        return get_current_blog_id();
    }

    /**
     * Switch the current site.
     *
     * @param int $site_id Site ID.
     */
    public static function switch_to_site(int $site_id): void
    {
        switch_to_blog($site_id);
    }

    /**
     * Restore the current site, after calling switch_to_site().
     *
     * @return bool True on success, false if we're already on the current blog.
     */
    public static function restore_current_site(): bool {
        return restore_current_blog();
    }
}