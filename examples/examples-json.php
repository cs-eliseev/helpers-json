<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.php';

use cse\base\CseExceptions;
use cse\helpers\Exceptions\CSEHelpersJsonException;
use cse\helpers\Json;

// Example: encode
$label = 'Encode: ';
// ['example' => 12345] => {"example": 12345}
var_dump($label . Json::encode(['example' => 12345]));
echo PHP_EOL;

// Example: petty print
$label = 'Petty print: ';
// ["example" => 12345, "example2" => 56789] => {"example": 12345, "example2": 56789}
var_dump($label . Json::prettyPrint(['example' => 12345, 'example2' => 56789]));
// test => "test"
var_dump($label . Json::prettyPrint('test'));
echo PHP_EOL;

// Example: decode
$label = 'Decode: ';
// {"example": 12345} => ["example" => 12345]
echo $label . PHP_EOL;
var_dump(Json::decode('{"example": 12345}'));
echo PHP_EOL;

// Example: get
$label = 'Get: ';
// {"example": 12345} => 12345
var_dump($label . Json::get('{"example": 12345}', 'example'));
// {"example": 12345} => 56789
var_dump($label . Json::get('{"example": 12345}', 'example2', 56789));
echo PHP_EOL;

// Example: set
$label = 'Set: ';
// {"example": 12345} => {"example": 12345, "example2": 56789}
var_dump($label . Json::set('{"example": 12345}', 'example2', 56789));
// {"example": 12345} => {"example": 56789}
var_dump($label . Json::set('{"example": 12345}', 'example', 56789));
echo PHP_EOL;

// Example: error to exception
$json = [
    '{"example": 12345}',   // success
    "{'example': 12345}",   // Syntax error
    '{"example": 12345}',   // success
];

// Example: is not error
$label = 'Is not error: ';
foreach ($json as $string) {
    Json::decode($string);
    var_dump($label . Json::isNoteError());
}
echo PHP_EOL;

// Example: get error msg
$label = 'Get error msg: ';
foreach ($json as $string) {
    Json::decode($string);
    var_dump($label . Json::getErrorMsg('(json)'));
}
echo PHP_EOL;

// Example: error to exception status
$label = 'Error to exception status: ';
foreach ($json as $string) {
    try {
        Json::decode($string);
        Json::errorToException();
        var_dump($label . 'success');
    } catch (CSEHelpersJsonException $e) {
        var_dump($label . $e->getMessage());
    }
}
echo PHP_EOL;

// Example: exception set check exception
$label = 'Exception set check exception: ';
Json::setCheckException();
foreach ($json as $string) {
    try {
        Json::decode($string);
        var_dump($label . 'success');
    } catch (CSEHelpersJsonException $e) {
        var_dump($label . $e->getMessage());
    }
}
echo PHP_EOL;

// Example: check instance CseExceptions
$label = 'Check instance CseExceptions: ';
foreach ($json as $string) {
    try {
        Json::decode($string);
        var_dump($label . 'success');
    } catch (CseExceptions $e) {
        var_dump($label . $e->getMessage());
    }
}
echo PHP_EOL;