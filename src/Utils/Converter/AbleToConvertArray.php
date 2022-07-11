<?php

namespace App\Utils\Converter;

interface AbleToConvertArray
{
    /**
     * Convert multidimensional array into one dimensional
     * @param array $config
     * @param array $configArrays
     * @return void
     */
    public function convertToOneDimensionalArray(array $config, array &$configArrays) : void;
}