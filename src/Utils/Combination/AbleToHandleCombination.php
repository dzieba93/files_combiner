<?php

namespace App\Utils\Combination;

interface AbleToHandleCombination
{
    /**
     * Make all possible combinations between arrays
     * @param array $configArrays
     * @param array $arrayKeys
     * @return array
     */
    public function combinations(array $configArrays,  array $arrayKeys): array;
}