<?php

namespace App\Utils\Checker;

interface AbleToCheckKeyExistence
{
    /**
     * Check if least one key from $arrayKeys(param-configs) array exist in $baseArrayKeys
     * @param array $arrayKeys
     * @param array $baseArrayKeys
     * @return bool
     */
    public function check(array $arrayKeys, array $baseArrayKeys): bool;
}