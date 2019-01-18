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
