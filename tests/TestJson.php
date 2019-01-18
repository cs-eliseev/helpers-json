<?php

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
}