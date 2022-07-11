<?php

namespace App\Tests\Utils\Provider;

use App\Utils\Provider\ArrayKeysProvider;
use PHPUnit\Framework\TestCase;

class ArrayKeysProviderTest extends TestCase
{
    public function testProvideReturnTrueWhenParameterIsAssociativeArray()
    {
        $baseFile = [
            'strategy_index' => 1,
        ];

        $mock = $this->createMock(ArrayKeysProvider::class);
        $mock
            ->expects($this->once())
            ->method('provide')
            ->with($baseFile);

        return $mock->provide($baseFile);
    }

    public function testProvideReturnFalseWhenParametersAreNotArray()
    {
        $baseFile = 123;

        $this->expectException(\TypeError::class);

        $arrayKeysProvider = new ArrayKeysProvider();
        return $arrayKeysProvider->provide($baseFile);
    }
}
