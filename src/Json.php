<?php

declare(strict_types = 1);

namespace cse\helpers;
use cse\helpers\Exceptions\CSEHelpersJsonException;

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

    /**
     * Print JSON data
     *
     * @param $data
     * @return string
     */
    public static function prettyPrint($data)
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    /**
     * Json decode
     *
     * @param string $data
     * @param bool $as_array
     * @return mixed
     */
    public static function decode(string $data, bool $as_array = true)
    {
        return json_decode($data, $as_array);
    }

    /**
     * Check error last json transform
     *
     * @return bool
     */
    public static function isNoteError(): bool
    {
        return empty(json_last_error());
    }

    /**
     * error to exception (CSEHelpersJsonException)
     *
     * @param null $msg
     * @throws CSEHelpersJsonException
     */
    public static function errorToException($msg = null): void
    {
        if (self::isNoteError()) return;

        throw new CSEHelpersJsonException(
            json_last_error_msg() . (empty($msg) ? '' : ' ' . print_r($msg ,1)),
            json_last_error()
        );
    }
}