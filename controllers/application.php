<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 04.06.2018
 * Time: 13:02
 */


class Application_C extends Controller
{

    /**
     *  Страница конкретной заявки со стороны модератора
     */
    public function detailsAction( $args )
    {
        $applicationId = $args[0];
        $Application = Core::factory( "Application", $applicationId );

        if( $Application == false ) Router::error404();
        if( !is_object( User::getUser() ) ) Router::error404();
        if( !User::isAdmin() )
            if( User::getUser()->id != $Application->performerId() )    Router::error404();

        $ajaxAction = Core_Array::getValue( $_GET, "action", null );

        /**
         * Сохранение данных заявки
         */
        if( $ajaxAction == "save" )
        {
            foreach ( $_GET as $property => $value )
            {
                if( $property != "action" )
                    $Application->$property($value);
            }
            $Application->save();
            exit;
        }

        /**
         * Удаление заявки
         */
        if( $ajaxAction == "delete" )
        {
            $Application->delete();
            exit;
        }

        /**
         * Изменение статуса: "Выполнено"
         */
        if( $ajaxAction == "done" )
        {
            $Application
                ->done( 1 )
                ->doneEnd( time() )
                ->save();
        }

        /**
         * Изменение статуса: "В процессе"
         */
        if( $ajaxAction == "in_process" )
        {
            if( $Application->doneEnd() != "" )
            {
                $Application->doneEnd( "NULL" )->done( 0 )->save();
            }
            elseif( $Application->doneStart() == "" )
            {
                $Application->doneStart( time() )->save();
            }
        }

        /**
         * Добавление комментария
         */
        if( $ajaxAction == "save_comment" )
        {
            $text = Core_Array::getValue( $_GET, "text", "" );
            $Comment = Core::factory( "Application_Comment" )
                ->authorId( User::getUser()->id )
                ->applicationId( $applicationId )
                ->text( $text );
            $Comment->save();
            echo $Comment->refactorDateFormat( "d.m.Y H:i:s" )->createDate();
            exit;
        }

        $title = "Заявка №" . $applicationId;
        $Application = Core::factory( "Application", $applicationId );
        /**
         *  Хлебные крошки
         *  Начало>>
         */
        if( $Application->doneStart() == "" )
            $type = "new";
        elseif( $Application->doneStart() != "" && $Application->doneEnd() == "" )
            $type = "performance";
        else
            $type = "all";

        switch( $type )
        {
            case "new":
                $brTitle = Core::getMessage( "BC_APPLICATION_NEW", [] );
                $href = DIR_ROOT . "/application/list/new";
                break;
            case "performance":
                $brTitle = Core::getMessage( "BC_APPLICATION_NEW", [] );
                $href = DIR_ROOT . "/application/list/performance";
                break;
            case "all":
                $brTitle = Core::getMessage( "BC_APPLICATION_NEW", [] );
                $href = DIR_ROOT . "/application/list/all";
                break;
        }

        $breadcumbsItems[0] = new stdClass();
        $breadcumbsItems[0]->title = "Главная";
        $breadcumbsItems[0]->href = DIR_ROOT . "/";
        $breadcumbsItems[1] = new stdClass();
        $breadcumbsItems[1]->title = "Способ решения проблемы";
        $breadcumbsItems[1]->href = DIR_ROOT . "/support";

        if( User::isAdmin() )
        {
            $breadcumbsItems[2] = new stdClass();
            $breadcumbsItems[2]->title = "Список заявок";
            $breadcumbsItems[2]->href = DIR_ROOT . "/application/list";
            $breadcumbsItems[3] = new stdClass();
            $breadcumbsItems[3]->title = $brTitle;
            $breadcumbsItems[3]->href = $href;
        }

        $breadcumbsItems[4] = new stdClass();
        $breadcumbsItems[4]->title = $title;
        $breadcumbsItems[4]->active = 1;
        /**
         *  <<Конец
         *  Хлебные крошки
         */


        Page::instance()->setTitle( $title );
        Page::instance()->setParam( "body-class", "" );
        Page::instance()->setParam( "title-first", "РЕДАКТИРОВАНИЕ ДАННЫХ" );
        Page::instance()->setParam( "title-second", "ЗАЯВКИ" );
        Page::instance()->setParam( "breadcumbs", $breadcumbsItems );
        Page::instance()->showHeader();


        $User = User::getUser();
        $userRole = User::getRole();

        $Performers = User::getPerformers();
        $Application->refactorDateFormat("d.m.Y H:i:s");
        $Systems = Core::factory( "System" )->queryBuilder()->findAll();
        $Priorities = Core::factory( "Application_Priority" )->queryBuilder()->findAll();
        $Roles = Core::factory( "User_Role" )->queryBuilder()->findAll();
        $Screenshots = Core::factory( "Application_Screenshot" )
            ->queryBuilder()
            ->where( "application_id", "=", $applicationId )
            ->findAll();

        $Comment = Core::factory( "Application_Comment" );
        $Comments = Core::factory( "Orm" )
            ->select(array("com.id", "com.text", "com.create_date", "usr.lastname", "usr.firstname", "ra.role_id"))
            ->from( $Comment->getTableName() . " AS com" )
            ->where( "application_id", "=", $applicationId )
            ->join( "mdl_user AS usr", "usr.id = com.author_id" )
            ->join( "mdl_bsu_techsupport_user_role_assignments AS ra", "user_id = com.author_id" )
            ->orderBy( "create_date", "ASC" )
            ->findAll();

        global $CFG;

        foreach ( $Screenshots as $Screenshot )
            $Screenshot->path = $CFG->wwwroot . "/f.php/1/techsupport/" . $Screenshot->fileName();

        foreach ( $Comments as $Comment )
        {
            $Comment->create_date = date( "d.m.Y H:i:s", $Comment->create_date );
        }

        Core::factory( "Core_Entity" )
            ->addEntity( $Application )
            ->addEntity( $User, "user" )
            ->addSimpleEntity( "user_role_id", $userRole )
            ->addEntities( $Roles )
            ->addEntities( $Systems )
            ->addEntities( $Priorities )
            ->addEntities( $Performers, "performer" )
            ->addEntities( $Screenshots )
            ->addEntities( $Comments, "comment" )
            ->xsl( "application/current.xsl" )
            ->show();

        if( is_null( $ajaxAction ) )
        {
            Page::instance()->showFooter();
        }
    }


    /**
     * Страница со списком поступивших заявок со стороны модератора
     */
    public function listChooseAction( $args )
    {
        //if( !User::isAdmin() )  Router::error404();

        $title = "Список заявок";

        /**
         *  Хлебные крошки
         *  Начало>>
         */
        $breadcumbsItems[0] = new stdClass();
        $breadcumbsItems[0]->title = "Главная";
        $breadcumbsItems[0]->href = DIR_ROOT . "/";
        $breadcumbsItems[1] = new stdClass();
        $breadcumbsItems[1]->title = "Способ решения проблемы";
        $breadcumbsItems[1]->href = DIR_ROOT . "/support";
        $breadcumbsItems[2] = new stdClass();
        $breadcumbsItems[2]->title = $title;
        $breadcumbsItems[2]->active = 1;
        /**
         *  <<Конец
         *  Хлебные крошки
         */

        Page::instance()->setTitle( $title );
        Page::instance()->setParam( "body-class", "body-purple" );
        Page::instance()->setParam( "title-first", "ТИПЫ СПИСКОВ" );
        Page::instance()->setParam( "title-second", "ЗАЯВОК" );
        Page::instance()->setParam( "breadcumbs", $breadcumbsItems );
        Page::instance()->showHeader();

        Core::factory( "Core_Entity" )
            ->xsl( "application/list_types.xsl" )
            ->show();

        Page::instance()->showFooter();
    }



    /**
     * Список заявок
     * @param $args
     */
    public function listAction( $args )
    {
        if( !User::isAdmin() )  Router::error404();
        $Applications = Core::factory( "Application" );
        $ajaxAction = Core_Array::getValue( $_GET, "action", null );

        $listType = $args[0];
        switch( $listType )
        {
            case "new":
                $title = Core::getMessage( "BC_APPLICATION_NEW", [] );
                $bodyClass = "body-green";
                $Applications->queryBuilder()->where( "done_start", "IS", Core::unchanged( "NULL" ) );
                break;
            case "performance":
                $title = Core::getMessage( "BC_APPLICATION_PERFORMANCE", [] );
                $bodyClass = "body-primary";
                $Applications->queryBuilder()->where( "done_start", "IS NOT", Core::unchanged( "NULL" ) )->where( "done_end", "IS", Core::unchanged( "NULL" ) );
                break;
            case "all":
                $title = Core::getMessage( "BC_APPLICATION_ALL", [] );
                $bodyClass = "body-orange";
                break;
            default:
                Router::error404();
        }


        /**
         * Установление периода даты за последний месяц по умолчанию
         */
        $dateFormat = "Y-m-d";
        $defaultDateTo = date( $dateFormat );
        $defaultDateFrom = date($dateFormat, strtotime($defaultDateTo . " -1 month") );

        $calendarDateFrom = Core_Array::getValue($_GET, "date_from", $defaultDateFrom );
        $calendarDateTo = Core_Array::getValue($_GET, "date_to", $defaultDateTo );

        $unixDateFrom = strtotime( $calendarDateFrom );
        $unixDateTo = strtotime( $calendarDateTo . " + 1 day" );

        $Applications
            ->queryBuilder()
            ->where( "create_date", ">=", $unixDateFrom )
            ->where( "create_date", "<=", $unixDateTo );


        if( $ajaxAction == null )
        {
            /**
             *  Хлебные крошки
             *  Начало>>
             */
            $breadcumbsItems[0] = new stdClass();
            $breadcumbsItems[0]->title = "Главная";
            $breadcumbsItems[0]->href = DIR_ROOT . "/";
            $breadcumbsItems[1] = new stdClass();
            $breadcumbsItems[1]->title = "Способ решения проблемы";
            $breadcumbsItems[1]->href = DIR_ROOT . "/support";
            $breadcumbsItems[2] = new stdClass();
            $breadcumbsItems[2]->title = "Типы списков заявок";
            $breadcumbsItems[2]->href = DIR_ROOT . "/application/list";
            $breadcumbsItems[3] = new stdClass();
            $breadcumbsItems[3]->title = $title;
            $breadcumbsItems[3]->active = 1;
            /**
             *  <<Конец
             *  Хлебные крошки
             */

            Page::instance()->setTitle( $title );
            Page::instance()->setParam( "body-class", $bodyClass );
            Page::instance()->setParam( "title-first", "СПИСОК" );
            Page::instance()->setParam( "title-second", "ЗАЯВОК" );
            Page::instance()->setParam( "breadcumbs", $breadcumbsItems );
            Page::instance()->showHeader();
        }


        $appTableName = Core::factory( "Application" )->getTableName();
        $sysTableName = Core::factory( "System" )->getTableName();

        $Applications = $Applications
            ->queryBuilder()
            ->select( array($appTableName . ".id", "subject", "fio", "done", "create_date", "done_start", "done_end", "title") )
            ->join( $sysTableName, $appTableName . ".system_id = " . $sysTableName . ".id" )
            ->orderBy( "create_date", "DESC" )
            ->findAll();

        foreach ( $Applications as $Application )   $Application->refactorDateFormat("d.m.Y H:i:s");

        Core::factory( "Core_Entity" )
            ->addSimpleEntity( "date_from", $calendarDateFrom )
            ->addSimpleEntity( "date_to", $calendarDateTo )
            ->addSimpleEntity( "dataroot", DIR_ROOT )
            ->addEntities( $Applications )
            ->xsl( "application/applications_list.xsl" )
            ->show();


        if( $ajaxAction == null )
            Page::instance()->showFooter();
    }



    /**
     * Страница исполнителя
     */
    public function performerAction( $args )
    {
        if( !User::isPerformer() )  Router::error404();
        $Applications = Core::factory( "Application" );
        $title = "Страница разработчика";

        /**
         *  Хлебные крошки
         *  Начало>>
         */
        $breadcumbsItems[0] = new stdClass();
        $breadcumbsItems[0]->title = "Главная";
        $breadcumbsItems[0]->href = DIR_ROOT . "/";
        $breadcumbsItems[1] = new stdClass();
        $breadcumbsItems[1]->title = "Способ решения проблемы";
        $breadcumbsItems[1]->href = DIR_ROOT . "/support";
        $breadcumbsItems[2] = new stdClass();
        $breadcumbsItems[2]->title = $title;
        $breadcumbsItems[2]->active = 1;
        /**
         *  <<Конец
         *  Хлебные крошки
         */

        Page::instance()->setTitle( $title );
        Page::instance()->setParam( "body-class", "body-purple" );
        Page::instance()->setParam( "title-first", "СПИСОК" );
        Page::instance()->setParam( "title-second", "ЗАЯВОК" );
        Page::instance()->setParam( "breadcumbs", $breadcumbsItems );
        Page::instance()->showHeader();


        /**
         * Установление периода даты за последний месяц по умолчанию
         */
        $dateFormat = "Y-m-d";
        $defaultDateTo = date( $dateFormat );
        $defaultDateFrom = date($dateFormat, strtotime($defaultDateTo . " -1 month") );

        $calendarDateFrom = Core_Array::getValue($_GET, "date_from", $defaultDateFrom );
        $calendarDateTo = Core_Array::getValue($_GET, "date_to", $defaultDateTo );

        $unixDateFrom = strtotime( $calendarDateFrom );
        $unixDateTo = strtotime( $calendarDateTo . " + 1 day" );

        $User = User::getUser();

        $Applications
            ->queryBuilder()
            ->where( "create_date", ">=", $unixDateFrom )
            ->where( "create_date", "<=", $unixDateTo )
            ->where( "performer_id", "=", $User->id );

        $appTableName = Core::factory( "Application" )->getTableName();
        $sysTableName = Core::factory( "System" )->getTableName();

        $Applications = $Applications
            ->queryBuilder()
            ->select( array($appTableName . ".id", "subject", "fio", "done", "create_date", "done_start", "done_end", "title") )
            ->join( $sysTableName, $appTableName . ".system_id = " . $sysTableName . ".id" )
            ->orderBy( "create_date", "DESC" )
            ->findAll();

        foreach ( $Applications as $Application )   $Application->refactorDateFormat("d.m.Y H:i:s");

        Core::factory( "Core_Entity" )
            ->addSimpleEntity( "date_from", $calendarDateFrom )
            ->addSimpleEntity( "date_to", $calendarDateTo )
            ->addSimpleEntity( "dataroot", DIR_ROOT )
            ->addEntities( $Applications )
            ->xsl( "application/performer_list.xsl" )
            ->show();

        Page::instance()->showFooter();
    }



    /**
     * Обработчик сохранения данных заявки
     */
    public function saveAction( $args )
    {
        if( Core_Array::getValue( $_POST, "ajax", 0 ) == 0 )
        {
            Router::error404();
        }

        $systemId =     Core_Array::getValue( $_POST, "systemId", 0 );
        $subject =      Core_Array::getValue( $_POST, "subject", "" );
        $description =  Core_Array::getValue( $_POST, "description", "" );
        $fio =          Core_Array::getValue( $_POST, "fio", "" );
        $email =        Core_Array::getValue( $_POST, "email", "" );
        $emailNotif =   Core_Array::getValue( $_POST, "email_notification", 0 );

        $Application = Core::factory( "Application" )
            ->subject( $subject )
            ->description( $description )
            ->fio( $fio )
            ->systemId( $systemId )
            ->email( $email )
            ->emailNotification( $emailNotif );

        $Application->save();

        global $CFG;
        $uploadDir = TECH_UPLOAD_DIR;

        if( isset( $_FILES["screenshots"] ) )
        {
            foreach ( $_FILES["screenshots"]["error"] as $key => $error )
            {
                if ( $error == UPLOAD_ERR_OK ) {
                    $tmp_name = $_FILES["screenshots"]["tmp_name"][$key];
                    $name = uniqid() . ".jpg";

                    Core::factory( "Application_Screenshot" )
                        ->applicationId( $Application->getId() )
                        ->fileName( $name )
                        ->save();

                    move_uploaded_file( $tmp_name, $uploadDir . "/" . $name );
                }
            }
        }

    }






}