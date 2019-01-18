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
                'test' => 12345,
                '{"test": 12345}'
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
}