<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 06.06.2018
 * Time: 10:17
 */


class Application_Screenshot extends Core_Entity
{
    protected $id;
    protected $application_id;
    protected $file_name;

    public function __construct(){}


    public function getId()
    {
        return $this->id;
    }


    public function applicationId( $val = null )
    {
        if(is_null( $val )) return $this->application_id;
        $this->application_id = intval( $val );
        return $this;
    }


    public function fileName( $val = null )
    {
        if( is_null( $val ) )   return $this->file_name;

        if( strlen( $val ) > 45 )
            die(
                Core::getMessage("TOO_LARGE_VALUE", array("fileName", "Application_Screenshot", 45))
            );

        $this->file_name = strval( $val );
        return $this;
    }


    public function save()
    {
        Core::notify( array( &$this ), "beforeApplicationScreenshotSave" );
        parent::save();
        Core::notify( array( &$this ), "afterApplicationScreenshotSave" );
    }


    public function delete( $obj = null )
    {
        Core::notify( array( &$this ), "beforeApplicationScreenshotDelete" );
        parent::delete();
        Core::notify( array( &$this ), "afterApplicationScreenshotDelete" );
    }


}