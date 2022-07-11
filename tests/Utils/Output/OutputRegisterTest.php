<?php

namespace App\Tests\Utils\Output;

use App\Utils\Output\OutputRegister;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;

class OutputRegisterTest extends TestCase
{
    public function testOutputRegisterReturnTrueWhenParameterIsArray()
    {
        $copiesArray = [];
        $mock = $this->createMock(OutputRegister::class);
        $mock
            ->expects($this->once())
            ->method('registerOutputs')
            ->with($copiesArray);

        return $mock->registerOutputs($copiesArray);
    }

    public function testOutputRegisterReturnFalseWhenParametersAreNotArray()
    {
        $copiesArray = 123;

        $this->expectException(\TypeError::class);

        $arrayKeysProvider = new OutputRegister();
        $arrayKeysProvider->registerOutputs($copiesArray);
    }

    public function testOutputRegisterCallAtLeastOneTimeDumFileMethod()
    {
        $copiesArray[0] = [
            'test' => 1,
            'test_2' => 2
        ];

        $fileSystemMock = $this->createMock(Filesystem::class);
        $outputRegister = new OutputRegister($fileSystemMock);

        $fileSystemMock
            ->expects($this->atLeast(1))
            ->method('dumpFile');

        $outputRegister->registerOutputs($copiesArray);
    }
}
