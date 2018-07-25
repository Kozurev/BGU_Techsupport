<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.03.2018
 * Time: 15:18
 */

class Core_Array
{
    public static function getValue($arr, $key, $default = null)
    {
        if(isset($arr[$key]) && $arr[$key] != "")
        {
            $val = $arr[$key];
            return $val;
        }
        else return $default;
    }
}