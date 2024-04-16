<?php

namespace SH\WP\Support\Traits;

trait Json_Functions
{
    /** @see wp_send_json_success */
    public static function send_json_success($data = null, ?int $status_code = null, int $options = 0): never
    {
        wp_send_json_success($data, $status_code, $options);

        exit;
    }
}