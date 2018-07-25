<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 27.06.2018
 * Time: 11:48
 */


class Statistic_C extends Controller
{

    public function indexAction( $args )
    {
        if( !User::isAdmin() )  Router::error404();

        $ajaxAction =   Core_Array::getValue( $_GET, "action", null );
        $priorityId =   Core_Array::getValue( $_GET, "priorityId", 0 );
        $systemId =     Core_Array::getValue( $_GET, "systemId", 0 );
        $performerId =  Core_Array::getValue( $_GET, "performerId", 0 );

        /**
         * Формирование временного периода в формате:
         * "Y-m-d": для input-ов
         * unix: для параметров поиска заявок
         */
        $dateFormat =       "Y-m-d";
        $defaultDateTo =    date( $dateFormat );
        $defaultDateFrom =  date($dateFormat, strtotime($defaultDateTo . " -1 month") );

        $calendarDateFrom = Core_Array::getValue($_GET, "date_from", $defaultDateFrom );
        $calendarDateTo =   Core_Array::getValue($_GET, "date_to", $defaultDateTo );

        $unixDateFrom = strtotime( $calendarDateFrom );
        $unixDateTo =   strtotime( $calendarDateTo . " + 1 day" );


        $title = "Статистика";
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
        Page::instance()->setParam( "body-class", "body-green" );
        Page::instance()->setParam( "title-first", "СТАТИСТИКА" );
        Page::instance()->setParam( "breadcumbs", $breadcumbsItems );
        Page::instance()->showHeader();


        $Systems = Core::factory( "System" )->queryBuilder()->findAll();
        $Priorities = Core::factory( "Application_Priority" )->queryBuilder()->findAll();
        $Performers = User::getPerformers();

        $Applications = Core::factory( "Application" );
        $Applications
            ->queryBuilder()
            ->where( "create_date", ">=", $unixDateFrom )
            ->where( "create_date", "<=", $unixDateTo );

        if( $priorityId != 0 )      $Applications->queryBuilder()->where( "priority_id", "=", $priorityId );
        if( $systemId != 0 )        $Applications->queryBuilder()->where( "system_id", "=", $systemId );
        if( $performerId != 0 )     $Applications->queryBuilder()->where( "performer_id", "=", $performerId );

        $Apps = $Applications->queryBuilder()->findAll();
        foreach ( $Apps as $Application )   $Application->refactorDateFormat("d.m.Y H:i:s");


        Core::factory( "Core_Entity" )
            ->addSimpleEntity( "date_from", $calendarDateFrom )
            ->addSimpleEntity( "date_to", $calendarDateTo )
            ->addSimpleEntity( "priority_id", $priorityId )
            ->addSimpleEntity( "system_id", $systemId )
            ->addSimpleEntity( "performer_id", $performerId )
            ->addEntities( $Apps )
            ->addEntities( $Performers, "performer" )
            ->addEntities( $Priorities )
            ->addEntities( $Systems )
            ->xsl( "statistic/index.xsl" )
            ->show();

        /**
         * Формирование таблицы
         * Используемые функции в данном блоке объявлены в /libs/functions.php
         * Начало>>
         */
        foreach ( $Apps as $app )   $app->revertDateFormat();
        $performerDone = array();
        $num = 0;

        echo "<section class='cards-section text-center'>
                <div class='container'>";
                    $table = new html_table();
                    $table->attributes['class'] = "table table-bordered";
                    $table->head = array('№', 'Исполнитель', 'Кол-во адресованых сообщений', 'Кол-во исполненных обращений',
                        'Выполненные в срок регламента', 'Выполненные не в срок регламента'/*, 'Система', 'Уровень приоритета'*/);

                    foreach ( $Apps as $app )
                    {
                        if( in_array($app->performerId(), $performerDone) ) continue;

                        $num++;
                        $performerDone[] = $app->performerId();
                        $performerFIO = getPerformer( $app->performerId(), $Performers, "data" );
                        $countAdressApps = countAdresserApps( $app->performerId(), $Apps );
                        $countDoneApps = countDoneApps( $app->performerId(), $Apps );
                        $countDoneAppsInTime = countDoneAppsInTime( $app->performerId(), $Apps, $Priorities );
                        $countAdressAppsNotInTime = $countDoneApps - $countDoneAppsInTime;

                        $table->data[] = array(
                            $num,
                            $performerFIO,
                            $countAdressApps,
                            $countDoneApps,
                            $countDoneAppsInTime,
                            $countAdressAppsNotInTime
                        );
                    }

                    echo html_writer::table($table);

                    echo "<a class='btn btn-green' id='export'>Импорт в Excel</a>";

        echo "  </div>
             </section>";
        /**
         * <<Конец
         * Формирование таблицы
         */

        if( $ajaxAction == "download_table" )
        {
            global $CFG;
            require_once $CFG->dirroot . "/blocks/bsu_other/_budget/lib.php";
            print_table_to_excel( $table );
        }

        if( $ajaxAction == null )
            Page::instance()->showFooter();
    }


}