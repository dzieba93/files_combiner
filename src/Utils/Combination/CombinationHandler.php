<?php

namespace App\Utils\Combination;

class CombinationHandler implements AbleToHandleCombination
{
    /**
     * @inheritDoc
     */
    public function combinations(array $configArrays, array $arrayKeys): array
    {
        $tempArrays = [];
        $combinations = [[]];
        foreach ($configArrays as $array) {
            $tmp = [];
            foreach ($combinations as $v1) {
                foreach ($array as $v2) {
                    $tmp[] = array_merge_recursive($v1, [$v2]);
                }
            }
            $combinations = $tmp;
        }

        $this->assignArrayKeys($combinations, $tempArrays, $arrayKeys);

        return $tempArrays;
    }

    /**
     * @param array $combinations
     * @param array $tempArrays
     * @param array $arrayKeys
     */
    private function assignArrayKeys(array $combinations, array &$tempArrays, array $arrayKeys)
    {
        foreach ($combinations as $mainArrayKey => $items) {
            foreach ($items as $itemKey => $item) {
                $tempArrays[$mainArrayKey][$arrayKeys[$itemKey]] = $item;
            }
        }
    }
}