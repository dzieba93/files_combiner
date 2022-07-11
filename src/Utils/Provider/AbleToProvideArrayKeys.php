<?php

namespace App\Utils\Provider;

interface AbleToProvideArrayKeys
{
    /**
     * Provide all array keys from $baseFile array
     * @param array $baseFile
     * @return array
     */
    public function provide(array $baseFile): array;
}