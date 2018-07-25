<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 04.06.2018
 * Time: 15:05
 */

//namespace techsupport\models;


class System extends Core_Entity
{
    protected $id;
    protected $title;

    public function __construct(){}

    public function getId()
    {
        return $this->id;
    }

    public function title($val = null)
    {
        if(is_null($val))   return $this->title;
        $this->title = strval($val);
        return $this;
    }
}