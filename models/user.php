<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 28.05.2018
 * Time: 18:19
 */


class User extends Core_Entity
{

    /**
     * Если пользователь авторизован тогда возвращает информацию об
     * этом пользователе, если нет - возвращает false
     *
     * @return bool or stdClass
     */
    static public function getUser()
    {
        global $USER;
        if( $USER->id == 0 )  return false;
        return $USER;
    }


    /**
     * Проверка на принадлежность авторизованного
     * пользователя к роли "Администратор" (модератор)
     *
     * @return bool
     */
    static public function isAdmin()
    {
        $User = self::getUser();
        if( $User == false )  return false;

        $AdminAssignment = Core::factory( "User_Role_Assignment" )
            ->queryBuilder()
            ->where( "user_id", "=", $User->id )
            ->where( "role_id", "=", 1 )
            ->find();

        if( $AdminAssignment == false ) return false;
        else return true;
    }


    /**
     * Проверка на принадлежность авторизованного
     * пользователя к роли "Исполнитель"
     *
     * @return bool
     */
    static public function isPerformer()
    {
        $User = self::getUser();
        if( $User == false )    return false;

        $PerformerAssignment = Core::factory( "User_Role_Assignment" )
            ->queryBuilder()
            ->where( "user_id", "=", $User->id )
            ->where( "role_id", "=", 2 )
            ->find();

        if( $PerformerAssignment == false ) return false;
        else return true;
    }


    /**
     * Возвращает id роли пользователя
     * из таблицы "user_roles"
     *
     * @return int
     */
    static public function getRole()
    {
        $User = self::getUser();
        if( $User == false )    return 0;

        $RoleAssignment = Core::factory( "User_Role_Assignment" )
            ->queryBuilder()
            ->select( "role_id" )
            ->where( "user_id", "=", $User->id )
            ->find();

        if( $RoleAssignment == false )  return 0;
        return $RoleAssignment->roleId();
    }


    /**
     * Возвращает список исполнителей
     *
     * @return array
     */
    static public function getPerformers()
    {
        $UserIds = Core::factory( "Orm" )
            ->select( "user_id" )
            ->from( "mdl_bsu_techsupport_user_role_assignments" )
            ->where( "role_id", "=", 2 )
            ->findAll();

        $aUserList = array();

        foreach ( $UserIds as $id )
        {
            $User = Core::factory( "Orm" )
                ->select( array("id", "firstname", "lastname") )
                ->from( "mdl_user" )
                ->where( "id", "=", $id->user_id )
                ->find();

            if( $User != false )    $aUserList[] = $User;
        }

        return $aUserList;
    }




}