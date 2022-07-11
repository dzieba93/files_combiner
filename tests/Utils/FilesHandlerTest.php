<?php

namespace App\Tests\Utils;

use App\Utils\Combination\CombinationHandler;
use App\Utils\FilesHandler;
use PHPUnit\Framework\TestCase;

class FilesHandlerTest extends TestCase
{
    public function testhandleCountOfCombinationsisEqualCountProvidedDataMultiplier()
    {
        $mock = $this->createMock(FilesHandler::class);

        $mock->configArrays = [
            'strategy_index' => [1, 2, 3, 4, 5],
            'threshold' => [0.1, 0.2]
        ];

        $arraysElementsCount = [];

        foreach ($mock->configArrays as $items) {
            $arraysElementsCount[] = count($items);
        }

        $multiplies = 1;

        foreach ($arraysElementsCount as $item) {
            $multiplies *= $item;
        }

        $arrayKeys = array_keys($mock->configArrays);
        $tempArrays = (new CombinationHandler())->combinations($mock->configArrays, $arrayKeys);

        $this->assertEquals($multiplies, count($tempArrays));
    }
}
