<?php

namespace SH\WP\Support\Traits;

use WP_Error;

trait Admin_Functions
{
    protected const PLUGIN_PHP_FILEPATH = ABSPATH.'wp-admin/includes/plugin.php';
    protected const UPGRADE_PHP_FILEPATH = ABSPATH.'wp-admin/includes/upgrade.php';

    /** @see activate_plugin() */
    public static function activate_plugin(string $plugin, string $redirect = '', bool $network_wide = false, bool $silent = false): ?WP_Error
    {
        return self::admin_function_call('\activate_plugin', static::PLUGIN_PHP_FILEPATH, [$plugin, $redirect, $network_wide, $silent]);
    }

    /** @see wp_upgrade() */
    public static function upgrade(...$args): ?WP_Error
    {
        return self::admin_function_call('\wp_upgrade', static::UPGRADE_PHP_FILEPATH, $args);
    }

    /** @see \dbDelta() */
    public static function db_delta(string $queries = '', bool $execute = true)
    {
        return self::admin_function_call('\dbDelta', static::UPGRADE_PHP_FILEPATH, [$queries, $execute]);
    }

    protected static function admin_function_call(string|callable $function, string $file, array $arguments): mixed
    {
        $loaded = self::admin_function_load($function, $file);
        if ($loaded instanceof WP_Error) {
            return $loaded;
        }

        return $function(...$arguments);
    }

    protected static function admin_function_load(string|callable $function, string $file): ?WP_Error
    {
        if (function_exists($function)) {
            return null;
        }

        if ( ! is_file($file)) {
            return new WP_Error(
                'missing_file',
                'The WordPress admin include file is missing.',
                ['file' => $file]
            );
        }

        require_once $file;
        if ( ! function_exists($function)) {
            return new WP_Error(
                'missing_function',
                'The WordPress admin function is missing.',
                ['file' => $file, 'function' => $function]
            );
        }

        return null;
    }
}