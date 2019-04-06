<?php

use cse\helpers\Exceptions\CSEHelpersJsonException;

use cse\helpers\Json;
use PHPUnit\Framework\TestCase;

class TestJson extends TestCase
{
    /**
     * @param array $data
     * @param string $expected
     *
     * @throws CSEHelpersJsonException
     *
     * @dataProvider providerEncode
     */
    public function testEncode(array $data, string $expected): void
    {
        $this->assertEquals($expected, Json::encode($data));
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
     * @param array $data
     * @param string $expected
     *
     * @throws CSEHelpersJsonException
     *
     * @dataProvider providerPrettyPrint
     */
    public function testPrettyPrint(array $data, string $expected): void
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
                ['example' => 12345, 'example2' => 56789],
                '{' . PHP_EOL .
                '    "example": 12345,' . PHP_EOL .
                '    "example2": 56789' . PHP_EOL .
                '}'
            ],
        ];
    }

    /**
     * @param string $data
     * @param array $expected
     *
     * @throws CSEHelpersJsonException
     *
     * @dataProvider providerDecode
     */
    public function tesDecode(string $data, array $expected): void
    {
        $this->assertEquals($expected, Json::decode($data));
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
}