<?php

namespace App\Utils\Converter;

class ArrayConverter implements AbleToConvertArray
{
    /**
     * @inheritDoc
     */
    public function convertToOneDimensionalArray(array $config, array &$configArrays) : void
    {
        foreach ($config as $configKey => $items) {
            if (is_array($items) && count($items) !== count($items, COUNT_RECURSIVE)) {
                $this->convertToOneDimensionalArray($items, $configArrays);
            } else {
                if (is_array($items)) {
                    $configArrays[$configKey] = array_values($items);
                } else {
                    $configArrays[$configKey] = [$items];
                }
            }
        }
    }
}