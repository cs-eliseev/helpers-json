[English](https://github.com/cs-eliseev/helpers-json/blob/master/README.md) | Русский

JSON CSE HELPERS
=======

[![Travis (.org)](https://img.shields.io/travis/cs-eliseev/helpers-json.svg?style=flat-square)](https://travis-ci.org/cs-eliseev/helpers-json)
[![Codecov](https://img.shields.io/codecov/c/github/cs-eliseev/helpers-json.svg?style=flat-square)](https://codecov.io/gh/cs-eliseev/helpers-json)
[![Scrutinizer code quality](https://img.shields.io/scrutinizer/g/cs-eliseev/helpers-json.svg?style=flat-square)](https://scrutinizer-ci.com/g/cs-eliseev/helpers-json/?branch=master)

[![Packagist](https://img.shields.io/packagist/v/cse/helpers-json.svg?style=flat-square)](https://packagist.org/packages/cse/helpers-json)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg?style=flat-square)](https://packagist.org/packages/cse/helpers-json)
[![Packagist](https://img.shields.io/packagist/l/cse/helpers-json.svg?style=flat-square)](https://github.com/cs-eliseev/helpers-json/blob/master/LICENSE.md)
[![GitHub repo size](https://img.shields.io/github/repo-size/cs-eliseev/helpers-json.svg?style=flat-square)](https://github.com/cs-eliseev/helpers-json/archive/master.zip)

Данная библиотек позволяет удобно работать с JSON данными. Доступны методы для кодирования, декодирования вызова исключений и др.

Репозиторий проекта: https://github.com/cs-eliseev/helpers-json

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


## Описание проекта

CSE HELPERS - это набор из небольших библиотек с простыми функциями написанных на PHP специально для вас.

Несмотря на повсеместное использование PHP в качестве основного языка для WEB разработки, его зачастую недостаточно. JSON CSE HELPERS, позволит вам довольно просто использовать методы для кодирования, декодирования, проверки на ошибки, вызов исключения и прочее.

CSE HELPERS создан для быстрой разработки веб-приложений.

**Список библиотек CSE Helpers:**
* [Array CSE helpers](https://github.com/cs-eliseev/helpers-arrays)
* [Cookie CSE helpers](https://github.com/cs-eliseev/helpers-cookie)
* [Date CSE helpers](https://github.com/cs-eliseev/helpers-date)
* [Email CSE helpers](https://github.com/cs-eliseev/helpers-email)
* [IP CSE helpers](https://github.com/cs-eliseev/helpers-ip)
* [Json CSE helpers](https://github.com/cs-eliseev/helpers-json)
* [Math Converter CSE helpers](https://github.com/cs-eliseev/helpers-math-converter)
* [Phone CSE helpers](https://github.com/cs-eliseev/helpers-phone)
* [Request CSE helpers](https://github.com/cs-eliseev/helpers-request)
* [Session CSE helpers](https://github.com/cs-eliseev/helpers-session)
* [Word CSE helpers](https://github.com/cs-eliseev/helpers-word)

Ниже представлена информация об установке и перечне команд с примерами их использования.


## Установка

Самая последняя версия проекта доступна [здесь](https://github.com/cs-eliseev/helpers-json).

### Composer

Чтобы установить последнюю версию проекта, выполните следующую команду в терминале:
```shell
composer require cse/helpers-json
```

Или добавьте следующее содержимое в файл composer.json:
```json
{
    "require": {
        "cse/helpers-json": "*"
    }
}
```

### Git

Добавить этот репозиторий локально можно следующим образом:
```shell
git clone https://github.com/cs-eliseev/helpers-json.git
```

### Скачать

[Скачать последнюю версию проекта можно здесь](https://github.com/cs-eliseev/helpers-json/archive/master.zip).

## Использование

Данный класс использует статические методы, которые удобно использовать в любом проекте. Смотрите пример [examples-json.php](https://github.com/cs-eliseev/helpers-json/blob/master/examples/examples-json.php).


**Кодирование**

Пример:
```php
Json::encode(['example' => 12345]);
// {"example": 12345}
```

**Форматирование json представление**

Пример:
```php
Json::prettyPrint(['example' => 12345, 'example2' => 56789]);
// {
//    "example": 12345,
//    "example": 56789
// }
```

**Декадирование**

Пример:
```php
Json::decode('{"example": 12345}');
// ['example' => 12345]
```


**Проверка на ошибки**

Пример:
```php
Json::decode('{"example": 12345}');
Json::isNoteError();
// true
Json::decode("{'example': 12345}");
Json::isNoteError();
// false
```

**Получить текст ошибки**

Пример:
```php
Json::decode('{"example": 12345}');
Json::getErrorMsg();
// NULL
Json::decode("{'example': 12345}");
Json::getErrorMsg();
// Syntax error
```

Добавить сообщение:
```php
Json::decode("{'example': 12345}");
Json::getErrorMsg('- Example');
// Syntax error - Example
```

**Превратить ошибку в исключение**

Пример:
```php
try {
    Json::decode("{'example': 12345}");
    Json::errorToException();
} catch (CSEHelpersJsonException $e) {
    var_dump($e->getMessage());
}
// Syntax error
```

Добавить сообщение:
```php
try {
    Json::decode("{'example': 12345}");
    Json::errorToException('(JSON)');
} catch (CSEHelpersJsonException $e) {
    var_dump($e->getMessage());
}
// Syntax error (JSON)
```

**Вызывать исключения при ошибках**

Пример:
```php
class Default
{
    public function example(): void
    {
        Json::encode('{"example": 12345}');
    }
}

class ExceptionTrue
{
    public function example(): void
    {
        Json::setCheckException();
        Json::encode("{'example': 12345}");
    }
}

class ExceptionFalse
{
    public function example(): void
    {
        Json::setCheckException(false);
        Json::encode("{'example': 12345}");
    }
}

$default = new Default();
$e_true = new ExceptionTrue();
$e_false = new ExceptionFalse();

try {
    $default->example();
} catch (CSEHelpersJsonException $e) {
    var_dump($e->getMessage());
}

try {
    $e_true->example();
} catch (CSEHelpersJsonException $e) {
    var_dump($e->getMessage());
}
// Syntax error

try {
    $default->example();
} catch (CSEHelpersJsonException $e) {
    var_dump($e->getMessage());
}
// Syntax error

try {
    $e_false->example();
} catch (CSEHelpersJsonException $e) {
    var_dump($e->getMessage());
}

try {
    $default->example();
} catch (CSEHelpersJsonException $e) {
    var_dump($e->getMessage());
}
```


## Тестирование и покрытие кода

PHPUnit используется для модульного тестирования. Данные тесты гарантируют, что методы класса выполняют свою задачу.

Подробную документацию по PHPUnit можно найти по адресу: https://phpunit.de/documentation.html.

Чтобы запустить тесты выполните:
```bash
phpunit PATH/TO/PROJECT/tests/
```

Чтобы сформировать отчет о покрытии тестами кода, необходимо выполнить следующую команду:
```bash
phpunit --coverage-html ./report PATH/TO/PROJECT/tests/
```

Чтобы использовать настройки по умолчанию, достаточно выполнить:
```bash
phpunit --configuration PATH/TO/PROJECT/phpunit.xml
```


## Вклад в общее дело

Вы можите поддержать данный проект [здесь](https://www.paypal.me/cseliseev/10usd). 
Вы также можете помочь, внеся свой вклад в проект или сообщив об ошибках.
Даже высказывать свои предложения по функциям - это здорово. Все, что поможет, высоко ценится.


## Лицензия

CSE HELPERS JSON это PHP-библиотека с открытым исходным кодом распространяемая по лицензии MIT. Для получения более подробной информации, пожалуйста, ознакомьтесь с [лицензионным файлом](https://github.com/cs-eliseev/helpers-json/blob/master/LICENSE.md).

***

> GitHub [@cs-eliseev](https://github.com/cs-eliseev)