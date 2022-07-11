<?php

namespace App\Tests\Utils\Combination;

use App\Utils\Combination\CombinationHandler;
use PHPUnit\Framework\TestCase;

class CombinationHandlerTest extends TestCase
{
    public function testCombinationReturnTrueWhenParameterIsArray()
    {
        $configArrays = ['a', 'b', 'c'];
        $arrayKeys = ['a', 'b', 'c'];
        $mock = $this->createMock(CombinationHandler::class);
        $mock
            ->expects($this->once())
            ->method('combinations')
            ->with($configArrays, $arrayKeys);

        return $mock->combinations($configArrays, $arrayKeys);
    }

    public function testCombinationWillReturnAtLeastOneTimeAssignArrayKeysMethod()
    {
        $configArrays = ['a', 'b', 'c'];
        $arrayKeys = ['a', 'b', 'c'];
        $mock = $this->createMock(CombinationHandler::class);
        $mock
            ->expects($this->atLeast(1))
            ->method('assignArrayKeys')
            ->with(['a'], ['b'], ['c']);

        return $mock->combinations($configArrays, $arrayKeys);
    }

    public function testCombinationReturnFalseWhenParametersAreNotArray()
    {
        $configArrays = 123;
        $arrayKeys = 456;

        $this->expectException(\TypeError::class);

        $combinationHandler = new CombinationHandler();
        $combinationHandler->combinations($configArrays, $arrayKeys);
    }

    public function testCombinationWillReturnArray()
    {
        $configArrays = [
            'strategy_index' => [1, 2, 3, 4, 5]
        ];
        $arrayKeys = ['strategy_index'];

        $combinationHandler = new CombinationHandler();

        $results = $combinationHandler->combinations($configArrays, $arrayKeys);
        $this->assertIsArray($results);
    }
}
