<?php

namespace SH\WP\Support;

use SH\WP\Support\Traits\Admin_Functions;
use SH\WP\Support\Traits\Json_Functions;
use SH\WP\Support\Traits\Site_Functions;

/**
 * Class wp
 *
 * @package SH\WP\Support
 *
 * @method static mixed update_network_option(int $network_id, string $key, mixed $value): bool|WP_Error
 */
class wp
{
    use Admin_Functions;
    use Json_Functions;
    use Site_Functions;

    public static function __callStatic(string $name, array $arguments): mixed
    {
        try {
            return $name(...$arguments);
        } catch (\Throwable $e) {
            return null;
        }
    }
}