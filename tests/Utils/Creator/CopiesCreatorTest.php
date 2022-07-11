<?php

namespace App\Tests\Utils\Creator;

use App\Utils\Creator\CopiesCreator;
use PHPUnit\Framework\TestCase;

class CopiesCreatorTest extends TestCase
{
    public function testCreateReturnTrueWhenParameterIsArray()
    {
        $tempArray = ['a', 'b', 'c'];
        $baseFile = ['a', 'b', 'c'];
        $finalArray = ['a', 'b', 'c'];
        $mock = $this->createMock(CopiesCreator::class);
        $mock
            ->expects($this->once())
            ->method('combinations')
            ->with($tempArray, $baseFile, $finalArray);

        return $mock->combinations($tempArray, $baseFile, $finalArray);
    }

    public function testCreateReturnFalseWhenParameterIsArray()
    {
        $tempArray = 123;
        $baseFile = 456;
        $finalArray = 789;

        $this->expectException(\TypeError::class);

        $copiesCreator = new CopiesCreator();
        $copiesCreator->create($tempArray, $baseFile, $finalArray);
    }
}
