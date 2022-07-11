<?php

namespace App\Tests\Utils\Converter;

use App\Utils\Converter\ArrayConverter;
use PHPUnit\Framework\TestCase;

class ArrayConverterTest extends TestCase
{
    public function testConvertReturnTrueWhenParametersAreArray()
    {
        $arrayKeys = ['a', 'b', 'c'];
        $baseArrayKeys = ['a', 'b', 'c'];

        $mock = $this->createMock(ArrayConverter::class);
        $mock
            ->expects($this->once())
            ->method('convertToOneDimensionalArray')
            ->with($arrayKeys, $baseArrayKeys);

        return $mock->convertToOneDimensionalArray($arrayKeys, $baseArrayKeys);
    }

    public function testConvertReturnFalseWhenParametersAreNotArray()
    {
        $arrayKeys = 'string';
        $baseArrayKeys = 'string';

        $this->expectException(\TypeError::class);

        $arrayConverter = new ArrayConverter();
        $arrayConverter->convertToOneDimensionalArray($arrayKeys, $baseArrayKeys);
    }
}
