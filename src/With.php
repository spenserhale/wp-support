<?php

namespace SH\WP\Support;
use WP_Site;

class With
{
    public static function switch_site(callable $callback, WP_Site|int $site): mixed
    {
        return Wrap::switch_site($callback, $site)();
    }
}