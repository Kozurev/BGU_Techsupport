<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 28.05.2018
 * Time: 17:22
 */

//namespace techsupport\models\user;


class User_Role extends Core_Entity
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