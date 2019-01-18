<?php

declare(strict_types=1);

namespace cse\helpers;

/**
 * Class Json
 *
 * @package cse\helpers
 */
class Json
{
    const JSON_DEFAULT_UNESCAPED = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

    /**
     * Json encode
     *
     * @param array $data
     * @param int $options
     * @return string
     */
    public static function encode(array $data, int $options = self::JSON_DEFAULT_UNESCAPED): string
    {
        return json_encode($data, $options);
    }
}