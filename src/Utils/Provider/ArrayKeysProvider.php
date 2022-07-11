<?php

namespace App\Utils\Provider;

class ArrayKeysProvider implements AbleToProvideArrayKeys
{
    /**
     * @inheritDoc
     */
    public function provide(array $baseFile) : array
    {
        $keys = array();
        foreach ($baseFile as $key => $value) {
            $keys[] = $key;
            if (is_array($value)) {
                $keys = array_merge($keys, $this->provide($value));
            }
        }

        return $keys;
    }
}