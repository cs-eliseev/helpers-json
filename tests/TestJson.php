<?php

use cse\base\CseExceptions;
use cse\helpers\Json;
use cse\helpers\Exceptions\CSEHelpersJsonException;
use PHPUnit\Framework\TestCase;

class TestJson extends TestCase
{
    /**
     * @param array $array
     * @param string $expected
     *
     * @throws CSEHelpersJsonException
     *
     * @dataProvider providerEncode
     */
    public function testEncode(array $array, string $expected): void
    {
        $this->assertEquals($expected, Json::encode($array));
    }

    /**
     * @return array
     */
    public function providerEncode(): array
    {
        return [
            [
                ['test' => 12345],
                '{"test":12345}'
            ],
        ];
    }

    /**
     * @param $data
     * @param string $expected
     *
     * @throws CSEHelpersJsonException
     *
     * @dataProvider providerPrettyPrint
     */
    public function testPrettyPrint($data, string $expected): void
    {
        $this->assertEquals($expected, Json::prettyPrint($data));
    }

    /**
     * @return array
     */
    public function providerPrettyPrint(): array
    {
        return [
            [
                ['текст' => 12345, 'текст2' => 56789],
                '{' . "\n" .
                '    "текст": 12345,' . "\n" .
                '    "текст2": 56789' . "\n" .
                '}'
            ],
            [
                'test',
                '"test"'
            ],
        ];
    }

    /**
     * @param string $json
     * @param array $expected
     *
     * @throws CSEHelpersJsonException
     *
     * @dataProvider providerDecode
     */
    public function tesDecode(string $json, array $expected): void
    {
        $this->assertEquals($expected, Json::decode($json));
    }

    /**
     * @return array
     */
    public function providerDecode(): array
    {
        return [
            [
                '{"test": 12345}',
                ['test' => 12345]
            ],
        ];
    }

    /**
     * @param string $json
     * @param string $key
     * @param $default
     * @param $expected
     *
     * @throws CSEHelpersJsonException
     *
     * @dataProvider providerGet
     */
    public function tesGet(string $json, string $key, $default, $expected): void
    {
        $this->assertEquals($expected, Json::get($json, $key, $default));
    }

    /**
     * @return array
     */
    public function providerGet(): array
    {
        return [
            [
                '{"test": 12345}',
                'test2',
                56789,
                56789
            ],
            [
                '{"test": 12345}',
                'test',
                null,
                12345
            ],
        ];
    }

    /**
     * @param string $data
     * @param bool $expected
     *
     * @throws CSEHelpersJsonException
     *
     * @dataProvider providerIsNotError
     */
    public function testIsNotError(string $data, bool $expected): void
    {
        Json::decode($data);
        $this->assertEquals($expected, Json::isNoteError());
    }

    /**
     * @return array
     */
    public function providerIsNotError(): array
    {
        return [
            [
                '{"test": 12345}',
                true
            ],
            [
                "{'test': 12345}",
                false
            ],
        ];
    }

    /**
     * @param string $data
     * @param null|string $msg
     * @param null|string $expected
     *
     * @throws CSEHelpersJsonException
     *
     * @dataProvider providerGetErrorMsg
     */
    public function testGetErrorMsg(string $data, ?string $msg, ?string $expected): void
    {
        Json::decode($data);
        $this->assertEquals($expected, Json::getErrorMsg($msg));
    }

    /**
     * @return array
     */
    public function providerGetErrorMsg(): array
    {
        return [
            [
                '{"test": 12345}',
                null,
                null
            ],
            [
                "{'test': 12345}",
                null,
                'Syntax error'
            ],
            [
                "{'test': 12345}",
                '(test)',
                'Syntax error (test)'
            ],
        ];
    }

    /**
     * @throws CSEHelpersJsonException
     */
    public function testErrorToException(): void
    {
        $this->expectException(CSEHelpersJsonException::class);

        Json::decode("{'test': 12345}");
        Json::errorToException();
    }

    /**
     * @throws CSEHelpersJsonException
     */
    public function testSetCheckException(): void
    {
        $this->expectException(CSEHelpersJsonException::class);

        Json::setCheckException();
        Json::decode("{'test': 12345}");
    }

    /**
     * @throws CSEHelpersJsonException
     */
    public function testCheckCseExceptions(): void
    {
        $this->expectException(CseExceptions::class);

        Json::setCheckException();
        Json::decode("{'test': 12345}");
    }
}