<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 15.06.2018
 * Time: 16:26
 */


/**
 * При создании нового комментария устанавливается дата и время его создания
 * а также отправка письма по электронной почте автору заявки
 */
Core::attach( "beforeApplicationCommentSave", function( $args ){
    $Comment = $args[0];

    if( $Comment->getId() == null )
        $Comment->createDate( time() );

    //TODO: проверить отправку писем на mail на боевом сервере и, если что, настроить это дело
    $Application = Core::factory( "Application", $Comment->applicationId() );
    if( $Application != false && $Application->email() != "" && $Application->emailNotification() == 1 )
    {
        $message = "На ваше обращение в техническую поддержку НИУ \"БелГУ\" был добавлен комментарий: <br/>";
        $message .= $Comment->text();
        $codeFormat = "Content-Type: text/html; charset=UTF-8";
        mail( $Application->email(), "Техническая поддержка НИУ \"БелГУ\"", $message, $codeFormat );
    }
} );


/**
 * При создании нового обращения устанавливается дата создания заявки
 */
Core::attach( "beforeApplicationSave", function( $args ){
    $Application = $args[0];

    if( $Application->createDate() == null )
    {
        $Application->createDate( time() );
    }
} );


/**
 * При удалении заявки удаляются также все комментарии и скриншотоы
 */
Core::attach( "beforeApplicationDelete", function( $args ){
    $Application = $args[0];
    $applicationId = $Application->getId();

    if( $applicationId != null )
    {
        $Comments = Core::factory( "Application_Comment" )
            ->where( "application_id", "=", $applicationId )
            ->findAll();

        if( count( $Comments ) > 0 )
        {
            foreach ( $Comments as $Comment )
            {
                $Comment->delete();
            }
        }

        $Screenshots = Core::factory( "Application_Screenshot" )
            ->where( "application_id", "=", $applicationId )
            ->findAll();

        if( count( $Screenshots ) > 0 )
        {
            foreach ( $Screenshots as $Screenshot )
            {
                $Screenshot->delete();
            }
        }
    }
} );


/**
 * Удаление изображения
 */
Core::attach( "beforeApplicationScreenshotDelete", function( $args ){
    global $CFG;

    $applicationId = $args[0]->applicationId();
    $fileName = $args[0]->fileName();
    $file = TECH_UPLOAD_DIR . $applicationId . "/" . $fileName;

    if ( file_exists( $file ) )
    {
        unlink( $file );
    }
} );