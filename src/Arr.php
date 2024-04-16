<?php

namespace SH\WP\Support;

class Arr
{
    public static function recursive_str_replace(array $array, array|string $search, array|string $replace): array
    {
        return array_map(
            static fn($value) => match (true) {
                is_array($value) => static::recursive_str_replace($value, $search, $replace),
                is_string($value) => str_replace($search, $replace, $value),
                default => $value,
            },
            $array
        );
    }

    /**
     * @param  array<object>  $array
     *
     * @return array<object>
     */
    public static function transform_property(array $array, string $property, callable $callback): array
    {
        foreach ($array as $item) {
            $item->{$property} = $callback($item->{$property});
        }

        return $array;
    }
}