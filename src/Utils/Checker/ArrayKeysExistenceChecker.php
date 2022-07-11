<?php

namespace App\Utils\Checker;

class ArrayKeysExistenceChecker implements AbleToCheckKeyExistence
{
    /**
     * @inheritDoc
     */
    public function check(array $arrayKeys, array $baseArrayKeys): bool
    {
        $atLeastOneExist = false;
        foreach ($arrayKeys as $configKey) {
            if (in_array($configKey, $baseArrayKeys)) {
                $atLeastOneExist = true;
                break;
            }
        }

        return $atLeastOneExist;
    }
}