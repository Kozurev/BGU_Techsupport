<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 28.05.2018
 * Time: 12:25
 */

class Forum_C extends Controller
{
    /**
     * Форум
     */
    public function indexAction( $args )
    {
        $action = Core_Array::getValue( $_GET, "action", "" );
        $title = "Форум";   //Заголовок страницы

        /**
         *  Хлебные крошки
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
         * Описание страницы
         */
        $aPageDescription[0] = new stdClass();
        $aPageDescription[1] = new stdClass();
        $aPageDescription[2] = new stdClass();
        $aPageDescription[3] = new stdClass();
        $aPageDescription[4] = new stdClass();

        $aPageDescription[0]->description = "Уважаемые преподаватели, студенты, посетители сайта!";
        $aPageDescription[1]->description = "На этой страничке вы можете описать возникшую техническую проблему по поддерживаемым управлением электронных 
                                            образовательных технологий системам (СЭО «Пегас» и «ИнфоБелГУ: Учебный процесс»).";
        $aPageDescription[2]->description = "Просьба воспользоваться поиском для просмотра уже внесенной информации на данную страницу. Велика вероятность, 
                                            что проблема, возникшая у Вас, уже имеет решение и описывалась другими пользователями.";
        $aPageDescription[3]->description = "Если вы не нашли интересующую вас информацию, Вы можете описать возникшую ситуацию, обязательно указав 
                                            Ваши контактные данные: Ф.И.О., должность, телефон, email.";      
        $aPageDescription[4]->description = "После рассмотрения информация будет размещена на данной странице, а Вам отправлено письмо 
                                            на указанный в сообщении адрес.";


        /**
         * Задание параметров страницы
         */
        Page::instance()->setTitle( $title );
        Page::instance()->setParam( "body-class", "body-red" );
        Page::instance()->setParam( "title-first", "ФОРУМ" );
        Page::instance()->setParam( "title-second", "ТЕХНИЧЕСКОЙ ПОДДЕРЖКИ" );
        Page::instance()->setParam( "page-description", $aPageDescription );
        Page::instance()->setParam( "breadcumbs", $breadcumbsItems );
        if( $action == "" ) Page::instance()->showHeader();


        $Applications = Core::factory( "Application" );
        $Applications
            ->queryBuilder()
            ->where( "is_public", "=", "1" );


        /**
         * Если задана строка поиска то добавляются новые условия в конструктор запроса
         * при помощи класса Search
         */
        $searchingStr = Core_Array::getValue( $_GET, "searching_string", "" );

        if( $action == "search" && $searchingStr != "" )
        {
            $Applications->queryBuilder()->limit( 10 );
            Core::factory( "Search" )
                ->setModel( $Applications )
                ->appendSearchingRow( "subject" )
                ->appendSearchingRow( "description" )
                ->searchingFor( $searchingStr )
                ->updateQuery();
        }


        /**
         * Пагинация
         */
        $page = Core_Array::getValue( $args, "0", 1 );
        $totalCount = clone $Applications->queryBuilder();
        $totalCount = $totalCount->getCount();
        $offset = ( $page - 1 ) * TECH_FORUM_PAGINATION;
        $countPages = intval( $totalCount / TECH_FORUM_PAGINATION );
        if( $totalCount % TECH_FORUM_PAGINATION != 0 )  $countPages++;
        if( $countPages == 0 )  $countPages++;

        $Pagination = Core::factory( "Core_Entity" )
            ->entityName( "pagination" )
            ->addSimpleEntity( "wwwroot", DIR_ROOT )
            ->addSimpleEntity( "total_count", $totalCount )
            ->addSimpleEntity( "count_pages", $countPages )
            ->addSimpleEntity( "page", $page );


        $Applications = $Applications
            ->queryBuilder()
            ->offset( $offset )
            ->limit( TECH_FORUM_PAGINATION )
            ->orderBy( "id", "DESC" )
            ->findAll();


        /**
         * Обработчик для подсказок в поисковой строке
         * Начало>>
         */
        if( Core_Array::getValue( $_GET, "hint", 0 ) == 1 )
        {
            $hintJson = array();
            foreach ( $Applications as $app )
            {
                $item = new stdClass();
                $item->id = $app->getId();
                $item->subject = $app->subject();
                $hintJson[] = $item;
            }

            echo json_encode( $hintJson );
            exit;
        }
        /**
         * <<Конец
         * Обработчик для подсказок в поисковой строке
         */


        foreach ( $Applications as $Application )   $Application->refactorDateFormat( "d.m.Y H:i:s" );
        $Systems = Core::factory( "System" )->queryBuilder()->findAll();


        echo "<div id='content'>";
        Core::factory("Core_Entity")
            ->addSimpleEntity( "dir_root", DIR_ROOT )
            ->addSimpleEntity( "search", $searchingStr )
            ->addEntities( $Applications )
            ->addEntities( $Systems )
            ->addEntity( $Pagination )
            ->xsl( "forum/index.xsl" )
            ->show();
        echo "</div>";


        if( $action == "" ) Page::instance()->showFooter();
    }





    /**
     *  Страница конкретной заявки на форуме
     */
    public function applicationAction( $args )
    {
        $applicationId = $args[0];
        $Application = Core::factory( "Application", $applicationId );
        if( $Application == false || !$Application->isPublic() ) Router::error404();

        $ajaxAction = Core_Array::getValue( $_GET, "action", null );


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

        if( is_null( $ajaxAction ) )
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
            $breadcumbsItems[2]->title = "Форум";
            $breadcumbsItems[2]->href = DIR_ROOT . "/forum";
            $breadcumbsItems[3] = new stdClass();
            $breadcumbsItems[3]->title = $title;
            $breadcumbsItems[3]->active = 1;
            /**
             *  <<Конец
             *  Хлебные крошки
             */

            Page::instance()->setTitle( $title );
            Page::instance()->setParam( "body-class", "body-red" );
            Page::instance()->setParam( "title-first", "ЗАЯВКА" );
            Page::instance()->setParam( "title-second", "" );
            Page::instance()->setParam( "breadcumbs", $breadcumbsItems );
            Page::instance()->showHeader();
        }

        $User = User::getUser();
        if( $User == false )    $User = new stdClass();
        $Systems = Core::factory( "System" )->queryBuilder()->findAll();
        $Priorities = Core::factory( "Application_Priority" )->queryBuilder()->findAll();
        $Screenshots = Core::factory( "Application_Screenshot" )
            ->queryBuilder()
            ->where( "application_id", "=", $applicationId )
            ->findAll();

        $Comment = Core::factory( "Application_Comment" );
        $Comments = Core::factory( "Orm" )
            ->select(array("com.id", "com.text", "com.create_date", "usr.lastname", "usr.firstname"))
            ->from( $Comment->getTableName() . " AS com" )
            ->where( "application_id", "=", $applicationId )
            ->join( "mdl_user AS usr", "usr.id = com.author_id" )
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
            ->addSimpleEntity( "title", $title )
            ->addEntity( $Application )
            ->addEntity( $User, "user" )
            ->addEntities( $Systems )
            ->addEntities( $Priorities )
            ->addEntities( $Screenshots )
            ->addEntities( $Comments, "comment" )
            ->xsl( "forum/application.xsl" )
            ->show();

        if( is_null( $ajaxAction ) )   Page::instance()->showFooter();
    }


}