<?php

namespace SH\WP\Support;

class Serialize
{
    public static function recursive_replace(
        string $data,
        array|string $search,
        array|string $replace,
        array $options = []
    ): mixed {
        if (! str_contains($data, $search)) {
            return $data;
        }

        $isSerialized = is_serialized($data);

        $value = $isSerialized ? unserialize(trim($data), $options) : $data;

        $value = match (true) {
            is_array($value) => Arr::recursive_str_replace($value, $search, $replace),
            is_string($value) => str_replace($search, $replace, $value),
            default => $value,
        };

        return $isSerialized ? serialize($value) : $value;
    }
}