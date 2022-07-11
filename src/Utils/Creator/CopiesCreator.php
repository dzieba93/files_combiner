<?php

namespace App\Utils\Creator;

class CopiesCreator implements AbleToCreateCopy
{
    /**
     * @param array $tempArray
     * @param array $baseFile
     * @param array $finalArray
     */
    public function create(array $tempArray, array &$baseFile, array &$finalArray)
    {
        foreach ($baseFile as $baseKey => $basic) {
            if (key_exists($baseKey, $tempArray) && !is_array($basic)) {
                $finalArray[$baseKey] = $tempArray[$baseKey];
                unset($tempArray[$baseKey]);
            } else {
                if (is_array($basic)) {
                    $finalArray[$baseKey] = [];
                    $this->create($tempArray, $basic, $finalArray[$baseKey]);
                } else {
                    $finalArray[$baseKey] = $basic;
                }
            }
        }
    }
}