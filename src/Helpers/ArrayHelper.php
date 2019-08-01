<?php

declare(strict_types = 1);

namespace AnyTests\Helpers;

class ArrayHelper
{
    /**
     * @param array $data
     * @param string $indexStart = `choice_`
     * @return array
     */

    public static function getElementsIndexStart(array $data, string $indexStart): array
    {
        $result = [];

        foreach ($data as $key => $value)
        {
            if(strpos($key, $indexStart) !== 0)
            {
                continue;
            }

            $result[$key] = $value;
        }

        return $result;
    }
}