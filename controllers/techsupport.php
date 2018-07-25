<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 04.06.2018
 * Time: 13:00
 */

//namespace techsupport\controllers;


class Techsupport_C extends Controller
{
    /**
     *  Главная страница
     */
    public function indexAction( $args )
    {
        Page::instance()->setTitle( "Главная" );
        Page::instance()->setParam( "body-class", "landing-page" );
        Page::instance()->setParam( "title-big", "Служба технической поддержки управления электронных образовательных технологий" );
        Page::instance()->showHeader();

        Core::factory("Core_Entity")
            ->xsl("main_page.xsl")
            ->show();

        Page::instance()->showFooter();
    }


    /**
     *  Раздел "Регламент"
     */
    public function reglamentAction( $args )
    {
        $title = "Регламент работы техподдержки";

        /**
         *  Хлебные крошки
         *  Начало>>
         */
        $breadcumbsItems[0] = new stdClass();
        $breadcumbsItems[0]->title = "Главная";
        $breadcumbsItems[0]->href = DIR_ROOT . "/";
        $breadcumbsItems[1] = new stdClass();
        $breadcumbsItems[1]->title = $title;
        $breadcumbsItems[1]->active = 1;
        /**
         *  <<Конец
         *  Хлебные крошки
         */

        Page::instance()->setTitle( $title );
        Page::instance()->setParam( "body-class", "body-orange" );
        Page::instance()->setParam( "title-first", "РЕГЛАМЕНТ РАБОТЫ" );
        Page::instance()->setParam( "title-second", "ТЕХНИЧЕСКОЙ ПОДДЕРЖКИ" );
        Page::instance()->setParam( "breadcumbs", $breadcumbsItems );
        Page::instance()->showHeader();


        $Output = Core::factory( "Core_Entity" )
            ->xsl( "reglament.xsl" )
            ->show();

        Page::instance()->showFooter();
    }


    /**
     * Раздел "Электронная система технической поддержки"
     */
    public function chooseAction($args)
    {
        $title = "Способ решения проблемы";

        /**
         *  Хлебные крошки
         *  Начало>>
         */
        $breadcumbsItems[0] = new stdClass();
        $breadcumbsItems[0]->title = "Главная";
        $breadcumbsItems[0]->href = DIR_ROOT . "/";
        $breadcumbsItems[1] = new stdClass();
        $breadcumbsItems[1]->title = $title;
        $breadcumbsItems[1]->active = 1;
        /**
         *  <<Конец
         *  Хлебные крошки
         */

        Page::instance()->setTitle( $title );
        Page::instance()->setParam( "body-class", "body-green" );
        Page::instance()->setParam( "title-first", "ВЫБЕРИТЕ СПОСОБ" );
        Page::instance()->setParam( "title-second", "РЕШЕНИЯ ПРОБЛЕМЫ" );
        Page::instance()->setParam( "breadcumbs", $breadcumbsItems );
        Page::instance()->showHeader();

        $userRole = User::getRole();

        $Systems = Core::factory( "System" )->queryBuilder()->findAll();
        $User = User::getUser();
        if( $User == false )    $User = new stdClass();

        Core::factory("Core_Entity")
            ->addSimpleEntity( "user_role", $userRole )
            ->addEntities( $Systems )
            ->addEntity( $User, "user" )
            ->xsl( "techsupport/index.xsl" )
            ->show();

        Page::instance()->showFooter();
    }


    /**
     *  Страница "Инструкции"
     */
    public function instructionsAction( $args )
    {
        $title = "Инструкции";

        /**
         *  Хлебные крошки
         *  Начало>>
         */
        $breadcumbsItems[0] = new stdClass();
        $breadcumbsItems[0]->title = "Главная";
        $breadcumbsItems[0]->href = DIR_ROOT . "/";
        $breadcumbsItems[1] = new stdClass();
        $breadcumbsItems[1]->title = $title;
        $breadcumbsItems[1]->active = 1;
        /**
         *  <<Конец
         *  Хлебные крошки
         */

        Page::instance()->setTitle( $title );
        Page::instance()->setParam( "body-class", "body-pink" );
        Page::instance()->setParam( "title-first", "ИНСТРУКЦИИ" );
        Page::instance()->setParam( "title-second", "ПО РАБОТЕ С СИСТЕМАМИ" );
        Page::instance()->showHeader();

        Core::factory( "Core_Entity" )
            ->xsl( "instructions.xsl" )
            ->show();

        Page::instance()->showFooter();
    }



}