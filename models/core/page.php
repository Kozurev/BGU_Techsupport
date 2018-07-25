<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 28.05.2018
 * Time: 9:37
 */

//namespace techsupport\models\core;


class Page
{
    private static $_instance = null;
    private static $title;      //Заголовок страницы
    //private static $css = [];   //список подключаемых css-файлов
    //private static $js = [];    //список подключаемых js-файлов
    private static $templateId = 1; //id подключаемого макета
    private static $params = [];    //кастомные параметры страницы

    private function __construct(){}
    private function __clone(){}


    /**
     * Реализация шаблона проетирования "Singleton"
     * Возвращает новый объект страницы, если метод вызывается первый раз
     * либо уже существующий объект
     *
     * @return Page
     */
    static public function instance()
    {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }

        return self::$_instance;
    }


    /**
     * Метод устанавливает заголовок (<title>) страницы
     *
     * @param $title - заголовок тсраницы
     * @return null
     */
    public function setTitle($title)
    {
        self::$title = $title;
        return self::$_instance;
    }


    /**
     * Метод возвращает заголовок (<title>) страницы
     *
     * @return mixed
     */
    public function getTitle()
    {
        return self::$title;
    }


    /**
     * Вывод "шапки" макета
     */
    public function showHeader( $id = null )
    {
        $id == null 
            ?   $templateId = self::$templateId
            :   $templateId = $id;

        include "templates/template" . $templateId . "/header.php";
    }


    /**
     * Вывод "футера" макета
     */
    public function showFooter( $id = null )
    {
        $id == null 
            ?   $templateId = self::$templateId
            :   $templateId = $id;

        include "templates/template" . $templateId . "/footer.php";
    }


    /**
     * Задание id подключаемого макета
     *
     * @param $id
     */
    public function setTemplateId( $id )
    {
        self::$templateId = $id;
    }


    /**
     * Задание пользовательских параметров страницы
     *
     * @param $key   - название параметра
     * @param $value - значения параметра
     */
    public function setParam( $key, $value )
    {
        self::$params[$key] = $value;
    }


    /**
     * Получение значения пользовательского параметра по его имени
     *
     * @param $key - название установленного параметра
     * @param string $default - возвращаемое значение по умолчанию, если не существует параметра с указанным именем
     * @return mixed|null
     */
    public function getParam( $key, $default = "" )
    {
        return Core_Array::getValue( self::$params, $key, $default );
    } 


//    static public function getTemplatePath()
//    {
//        //TODO: Подумать над динамическим подключением scc&js
//    }


}