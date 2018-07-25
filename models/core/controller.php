<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.05.2018
 * Time: 15:41
 */

//namespace techsupport\models\core;


class Controller
{
    public $route = [];

    public function __construct($data)
    {
        $this->route = $data;
    }
}