JSON CSE HELPERS
=======

The helpers allows you to JSON processing. Encode, decode, check error, throw exception - all this is available in this library.

Project repository: https://github.com/cs-eliseev/helpers-json

```php
$json = [
    '{"example": 12345}',   // success
    "{'example': 12345}",   // Syntax error
    '{"example": 12345}',   // success
];

foreach ($json as $item) {
    try {
        Json::decode($item);
        Json::errorToException();
        var_dump('success');
    } catch (CSEHelpersJsonException $e) {
        var_dump($e->getMessage());
    }
}
```

***

## Introduction

CSE HELPERS is a collection of several libraries with simple functions written in PHP for people.

Despite using PHP as the main programming language for the Internet, its functions are not enough. JSON CSE HELPERS used method: encode, decode, check error, throw exception.

CSE HELPERS was created for the rapid development of web applications.

**CSE Helpers projec:**
* [Word CSE helpers](https://github.com/cs-eliseev/helpers-word)
* [Json CSE helpers](https://github.com/cs-eliseev/helpers-json)
* [Cookie CSE helpers](https://github.com/cs-eliseev/helpers-cookie)
* [Request CSE helpers](https://github.com/cs-eliseev/helpers-request)
* [Session CSE helpers](https://github.com/cs-eliseev/helpers-session)
* [Date CSE helpers](https://github.com/cs-eliseev/helpers-date)

Below you will find some information on how to init library and perform common commands.

## Install

You can find the most recent version of this project [here](https://github.com/cs-eliseev/helpers-json).

### Composer

Execute the following command to get the latest version of the package:
```
composer require cse/helpers-json
```

Or file composer.json should include the following contents:
```
{
    "require": {
        "cse/helpers-json": "*"
    }
}
```

### Git

Clone this repository locally:
```
git clone https://github.com/cs-eliseev/helpers-json.git
```

### Download

[Download the latest release here](https://github.com/cs-eliseev/helpers-json/archive/master.zip).

## Usage

The class consists of static methods that are conveniently used in any project. See example [examples-json.php](https://github.com/cs-eliseev/helpers-json/blob/master/examples/examples-json.php).

**Encode**

Example:
```php
Json::encode(["example" => 12345]);
// {"example": 12345}
```

**Decode**

Example:
```php
Json::encode('{"example": 12345}');
// ['example' => 12345]
```

**Check error last json transform**

Example:
```php
Json::decode('{"example": 12345}');
Json::isNoteError();
// true
Json::decode("{'example': 12345}");
Json::isNoteError();
// false
```

**Error to exception**

Example:
```php
try {
    Json::decode("{'example': 12345}");
    Json::errorToException();
} catch (CSEHelpersJsonException $e) {
    var_dump($e->getMessage());
}
// Syntax error
```


## License

See the [LICENSE.md](https://github.com/cs-eliseev/helpers-json/blob/master/LICENSE.md) file for licensing details.