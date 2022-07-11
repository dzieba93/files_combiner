<?php

namespace App\Tests\Utils\Checker;

use App\Utils\Checker\ArrayKeysExistenceChecker;
use PHPUnit\Framework\TestCase;

class ArrayKeysExistenceCheckerTest extends TestCase
{
    public function testCheckReturnTrueIfKeyExistInArray()
    {
        $arrayKeys = ['a', 'b', 'c'];
        $baseArrayKeys = ['a'];

        $arrayKeysExistenceChecker = new ArrayKeysExistenceChecker();
        $this->assertTrue($arrayKeysExistenceChecker->check($arrayKeys, $baseArrayKeys));
    }

    public function testCheckReturnFalseIfKeyNotExistInArray()
    {
        $arrayKeys = ['a', 'b', 'c'];
        $baseArrayKeys = ['x'];

        $arrayKeysExistenceChecker = new ArrayKeysExistenceChecker();
        $this->assertFalse($arrayKeysExistenceChecker->check($arrayKeys, $baseArrayKeys));
    }

    public function testCheckReturnTrueWhenParametersAreArray(): bool
    {
        $arrayKeys = ['a', 'b', 'c'];
        $baseArrayKeys = ['a', 'b', 'c'];

        $mock = $this->createMock(ArrayKeysExistenceChecker::class);
        $mock
            ->expects($this->once())
            ->method('check')
            ->with($arrayKeys, $baseArrayKeys);

        return $mock->check($arrayKeys, $baseArrayKeys);
    }

    public function testCheckReturnFalseWhenParametersAreNotArray(): bool
    {
        $arrayKeys = 'string';
        $baseArrayKeys = 'string';

        $this->expectException(\TypeError::class);

        $arrayKeysExistenceChecker = new ArrayKeysExistenceChecker();
        return $arrayKeysExistenceChecker->check($arrayKeys, $baseArrayKeys);
    }
}
