<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 19.06.2018
 * Time: 19:43
 */

class Application_Comment extends Core_Entity
{
    protected $id;
    protected $create_date;
    protected $author_id;
    protected $application_id;
    protected $text;


    public function getId()
    {
        return $this->id;
    }

    public function createDate( $val = null )
    {
        if( is_null( $val ) )   return $this->create_date;
        $this->create_date = intval( $val );
        return $this;
    }

    public function authorId( $val = null )
    {
        if( is_null( $val ) )   return $this->author_id;
        $this->author_id = intval( $val );
        return $this;
    }

    public function applicationId( $val = null )
    {
        if( is_null( $val ) )   return $this->application_id;
        $this->application_id = intval( $val );
        return $this;
    }

    public function text( $val = null )
    {
        if( is_null( $val ) )   return $this->text;
        $this->text = strval( $val );
        return $this;
    }


    public function save()
    {
        Core::notify( array( &$this ), "beforeApplicationCommentSave" );
        parent::save();
        Core::notify( array( &$this ), "afterApplicationCommentSave" );
    }


    public function delete( $obj = null )
    {
        Core::notify( array( &$this ), "beforeApplicationCommentDelete" );
        parent::delete();
        Core::notify( array( &$this ), "afterApplicationCommentDelete" );
    }


    public function refactorDateFormat( $format )
    {
        $this->create_date = date( $format, $this->create_date );
        return $this;
    }

}