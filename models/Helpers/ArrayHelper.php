<?php

namespace app\models\Helpers;

class ArrayHelper
{
    /**
     * @param array $data
     * @param string $key
     * @return array
     * Формирование массива с заменой индекса
     */
    public static function getKeyArray(array $data, string $key) : array {
        $array = array();
        foreach ($data as $item) {
            $array[$item[$key]] = $item;
        }
        return $array;
    }

    /**
     * @param array $items
     * @param string $key
     * @return array
     * Формирование многомерного массива с заменой индекса
     */
    public static function getKeyArrays(array $items, string $key) : array {
        $array = array();
        foreach ($items as $item) {
            $array[$item[$key]][] = $item;
        }
        return $array;
    }
}