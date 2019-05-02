<?php

declare(strict_types=1);

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
    const PRETTY_PRINT = self::JSON_DEFAULT_UNESCAPED | JSON_PRETTY_PRINT;

    /**
     * @var bool
     */
    protected static $checkException = false;

    /**
     * Json encode
     *
     * @param array $array
     * @param int $options
     *
     * @return string
     *
     * @throws CSEHelpersJsonException
     */
    public static function encode(array $array, int $options = self::JSON_DEFAULT_UNESCAPED): string
    {
        $result = json_encode($array, $options);

        if (self::$checkException) self::errorToException();

        return $result;
    }

    /**
     * Print JSON data
     *
     * @param $data
     *
     * @return string
     *
     * @throws CSEHelpersJsonException
     */
    public static function prettyPrint($data): string
    {
        $result = json_encode($data, self::PRETTY_PRINT);

        if (self::$checkException) self::errorToException();

        return $result;
    }

    /**
     * Json decode
     *
     * @param string $json
     * @param bool $assoc
     *
     * @return mixed
     *
     * @throws CSEHelpersJsonException
     */
    public static function decode(string $json, bool $assoc = true)
    {
        $result = json_decode($json, $assoc);

        if (self::$checkException) self::errorToException();

        return $result;
    }

    /**
     * Get json data
     *
     * @param string $json
     * @param string $key
     * @param null $default
     *
     * @return string
     *
     * @throws CSEHelpersJsonException
     */
    public static function get(string $json, string $key, $default = null)
    {
        return self::decode($json)[$key] ?? $default;
    }

    /**
     * Set check Exception
     *
     * @param bool $status
     */
    public static function setCheckException(bool $status = true): void
    {
        self::$checkException = $status;
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
     * Get error msg
     *
     * @param $msg
     *
     * @return string|null
     */
    public static function getErrorMsg($msg = null): ?string
    {
        return self::isNoteError() ? null : json_last_error_msg() . (empty($msg) ? '' : ' ' . print_r($msg ,true));
    }

    /**
     * Error to exception
     *
     * @param $msg
     *
     * @throws CSEHelpersJsonException
     */
    public static function errorToException($msg = null): void
    {
        if (self::isNoteError()) return;

        throw new CSEHelpersJsonException(
            self::getErrorMsg($msg),
            json_last_error()
        );
    }
}