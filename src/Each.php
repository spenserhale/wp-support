<?php

namespace SH\WP\Support;

class Each
{

    public static function network(callable $callback, array $query = []): array
    {
        return static::item($callback, get_networks($query));
    }

    public static function page(callable $callback, array $query = []): array
    {
        return static::item($callback, get_pages($query));
    }

    public static function post(callable $callback, array $query = []): array
    {
        return static::item($callback, get_posts($query));
    }

    public static function site(callable $callback, array $query = []): array
    {
        static $default_query = [
            'number'   => 0,
            'archived' => 0,
            'deleted'  => 0,
        ];

        return static::item($callback, get_sites($query ? array_merge($default_query, $query) : $default_query));
    }

    public static function site_with_switch(callable $callback, array $query = []): array
    {
        return static::site(static fn($site) => Wrap::switch_site($callback, $site)($site), $query);
    }

    public static function permutation(callable $callback, ...$sets): array
    {
        $results      = [];
        $combinations = array_product(array_map('\count', $sets));

        for ($i = 0; $i < $combinations; $i++) {
            $args    = [];
            $divider = $combinations;
            foreach ($sets as $set) {
                $divider /= count($set);
                $index   = (int) ($i / $divider) % count($set);
                $args[]  = $set[$index];
            }

            $results[] = $callback(...$args);
        }

        return $results;
    }

    protected static function item(callable $callback, array $items): array
    {
        $results = [];
        foreach ($items as $item) {
            $results = $callback($item);
        }

        return $results;
    }
}