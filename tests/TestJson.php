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
     * @dataProvider providerEncode
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
                ['test' => 12345, 'test' => 56789],
                '{"example": 12345, "example": 56789}'
            ],
        ];
    }

    /**
     * @param string $data
     * @param array $expected
     *
     * @dataProvider providerDecode
     */
    public function tesDecode(string $data, array $expected): void
    {
        $this->assertArraySubset($expected, Json::decode($data));
    }

    /**
     * @return array
     */
    public function providerDecode(): array
    {
        return [
            [
                '{"test": 12345}',
                'test' => 12345
            ],
        ];
    }

    /**
     * @param string $data
     * @param bool $expected
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

    public function testErrorToException(): void
    {
        $this->expectException(CSEHelpersJsonException::class);

        Json::decode("{'test': 12345}");
        Json::errorToException();
    }
}