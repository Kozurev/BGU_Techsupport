<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 28.05.2018
 * Time: 17:43
 */

//namespace techsupport\models\user\role;


class User_Role_Assignment extends Core_Entity
{
    protected $id;
    protected $user_id;
    protected $role_id;

    public function __construct(){}


    public function getId()
    {
        return $this->id;
    }


    public function userId($val = null)
    {
        if(is_null($val))   return $this->user_id;
        $this->user_id = intval($val);
        return $this;
    }


    public function roleId($val = null)
    {
        if(is_null($val))   return $this->role_id;
        $this->role_id = intval($val);
        return $this;
    }
}