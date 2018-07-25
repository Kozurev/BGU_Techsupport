<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 05.06.2018
 * Time: 10:07
 */


class Application extends Application_Model
{

    public function refactorDateFormat( $format )
    {
        if( $this->create_date != null )
            $this->create_date = date( $format, $this->create_date );

        if( $this->done_start != null )
            $this->done_start = date( $format, $this->done_start );

        if( $this->done_end != null )
            $this->done_end = date( $format, $this->done_end );
    }


    public function revertDateFormat()
    {
        if( $this->create_date != null )
            $this->create_date = strtotime( $this->create_date );

        if( $this->done_start != null )
            $this->done_start = strtotime( $this->done_start );

        if( $this->done_end != null )
            $this->done_end = strtotime( $this->done_end );
    }


    public function save()
    {
        Core::notify( array( &$this ), "beforeApplicationSave" );
        parent::save();
        Core::notify( array( &$this ), "afterApplicationSave" );
    }


    public function delete( $obj = null )
    {
        Core::notify( array( &$this ), "beforeApplicationDelete" );
        parent::delete();
        Core::notify( array( &$this ), "afterApplicationDelete" );
    }



}