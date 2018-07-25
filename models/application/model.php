<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 05.06.2018
 * Time: 10:25
 */


class Application_Model extends Core_Entity
{
    protected $id;
    protected $subject;
    protected $description;
    protected $fio;
    protected $email;
    protected $email_notification = 0;
    protected $system_id;
    protected $priority_id = 0;
    protected $performer_id = 0;
    protected $done = 0;
    protected $is_public = 0;
    protected $create_date = null;
    protected $done_start = null;
    protected $done_end = null;


    public function __construct(){}


    public function getId()
    {
        return $this->id;
    }


    public function doneStart( $val = null )
    {
        if( is_null( $val ) )   return $this->done_start;
        $this->done_start = intval( $val );
        return $this;
    }


    public function doneEnd( $val = null )
    {
        if( is_null( $val ) )   return $this->done_end;
        if( $val == "NULL" || $val == "null" )
            $this->done_end = $val;
        else
            $this->done_end = intval( $val );
        return $this;
    }


    public function createDate( $val = null )
    {
        if( is_null( $val ) )   return $this->create_date;
        $this->create_date = intval( $val );
        return $this;
    }


    public function subject( $val = null )
    {
        if( is_null( $val ) )   return $this->subject;
        if( strlen( $val ) > 255 )  
            die( Core::getMessage( "TOO_LARGE_VALUE", array("subject", "Application", 255) ) );
        $this->subject = strval( $val );
        return $this;
    }


    public function description( $val = null )
    {
        if( is_null( $val ) )   return $this->description;
        $this->description = strval( $val );
        return $this;
    }


    public function fio( $val = null )
    {
        if( is_null( $val ) )   return $this->fio;
        if( strlen( $val ) > 255 )
            die( Core::getMessage( "TOO_LARGE_VALUE", array("fio", "Application", 255) ) );
        $this->fio = strval( $val );
        return $this;
    }


    public function email( $val = null )
    {
        if( is_null( $val ) )   return $this->email;
        if( strlen( $val ) > 45 )
            die( Core::getMessage( "TOO_LARGE_VALUE", array("email", "Application", 45) ) );
        $this->email = strval( $val );
        return $this;    
    }


    public function emailNotification( $val = null )
    {
        if( is_null( $val ) )   return $this->email_notification;
        if( $val == true )      $this->email_notification = 1;
        elseif( $val == false ) $this->email_notification = 0;
        return $this;
    }


    public function systemId( $val = null )
    {
        if( is_null( $val ) )   return $this->system_id;
        $this->system_id = intval( $val );
        return $this;
    }


    public function priorityId( $val = null )
    {
        if( is_null( $val ) )   return $this->priority_id;
        $this->priority_id = intval( $val );
        return $this;
    }


    public function performerId( $val = null )
    {
        if( is_null( $val ) )   return $this->performer_id;
        $this->performer_id = intval( $val );
        return $this;
    }


    public function done( $val = null )
    {
        if( is_null( $val ) )   return $this->done;
        if( $val == true )      $this->done = "1";
        elseif( $val == false ) $this->done = "0";
        return $this;
    }


    public function isPublic( $val = null )
    {
        if( is_null( $val ) )   return $this->is_public;
        if( $val == true )      $this->is_public = 1;
        elseif( $val == false ) $this->is_public = 0;
        return $this;
    }


}