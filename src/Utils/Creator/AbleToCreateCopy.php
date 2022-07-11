<?php

namespace App\Utils\Creator;

interface AbleToCreateCopy
{
    /**
     * Create copies array structure with all possible combinations temp array
     * @param array $tempArray
     * @param array $baseFile
     * @param array $finalArray
     * @return void
     */
    public function create(array $tempArray, array &$baseFile, array &$finalArray);
}