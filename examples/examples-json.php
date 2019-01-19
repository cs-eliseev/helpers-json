<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use cse\helpers\Exceptions\CSEHelpersJsonException;
use cse\helpers\Json;

// Example: encode
// ["example" => 12345] => {"example": 12345}
var_dump(Json::encode(["example" => 12345]));
echo PHP_EOL;

// Example: decode
// {"example": 12345} => ["example" => 12345]
var_dump(Json::decode('{"example": 12345}'));
echo PHP_EOL;

// Example: is not error
$json = [
    '{"example": 12345}',   // true
    "{'example': 12345}",   // false
    '{"example": 12345}',   // true
];

foreach ($json as $string) {
    Json::decode($string);
    var_dump(Json::isNoteError());
}
echo PHP_EOL;

// Example: error to exception
$json = [
    '{"example": 12345}',   // success
    "{'example': 12345}",   // Syntax error
    '{"example": 12345}',   // success
];

foreach ($json as $string) {
    try {
        Json::decode($string);
        Json::errorToException();
        var_dump('success');
    } catch (CSEHelpersJsonException $e) {
        var_dump($e->getMessage());
    }
}
echo PHP_EOL;