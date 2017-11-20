<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21/11/17
 * Time: 8:51 AM
 */

class ArrayHelper
{
    /**
     * Get only the values from a multi-dimensional array
     *
     * @param $arr array to get values from
     *
     * @return array
     */
    public static function array_values_multi($arr)
    {
        $result = array();
        foreach ($arr as $index => $value){
            if(is_array($value))
            {
                $result = array_merge($result, self::array_values_multi($value));
            } else {
                $result[] = $value;
            }
        }
        return $result;
    }
}