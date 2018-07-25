<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 25.05.2018
 * Time: 13:34
 */

class Router
{

    private static $routes;

    //private static $params;


    /**
     * Перенос списка маршрутов из файла в свойство $routes
     */
    public static function setRoutes()
    {
        self::$routes = include "config/routes.php";
    }


    /**
     * Получение списка маршрутов
     * @return mixed
     */
    public static function getRoutes()
    {
        return self::$routes;
    }


    /**
     * Вывод страницы ошибка 404
     */
    public static function error404()
    {
        http_response_code(404);
        include "views/404.php";
        exit;
    }


    /**
     * Получение URI-запроса для системы техподдержки
     * Пример: исходный запрос: "/blocks/bsu_other/techsupport/list/" в "/list/"
     *
     * @return string
     */
    public static function getUrl()
    {
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";;
        $url = explode("?", $url)[0];
        $url = substr($url, strlen(DIR_ROOT));
        $url = trim($url, "/");
        return $url;
    }


    /**
     * Поиск совпадения URI-запроса с паттерном маршрута
     *
     * @return bool
     */
    public static function match()
    {
        $url = self::getUrl();

        foreach (self::$routes as $route => $params)
        {
            if(preg_match("#^".$route."$#", $url, $match))
            {
                //self::$params = $params;
                return true;
            }
        }

        return false;
    }


    /**
     * Главный метод создания страницы
     */
    public static function run()
    {
        $url = self::getUrl();

        if(explode("/", $url)[0] == "templates" || explode("/", $url)[0] == "libs")
        {
            $includeStr = ROOT."/" . $url;
            echo $includeStr;
            require $includeStr;
            return;
        }

        foreach (self::$routes as $pattern => $path)
        {
            if(preg_match("#$pattern#", $url))
            {
                $internalRoute = preg_replace("#$pattern#", $path, $url);
                $segments = explode("/", $internalRoute);
                $controllerName = array_shift($segments);
                $actionName = array_shift($segments) . "Action";
                $Controller = Core::controller($controllerName);

                if( $Controller == false )  die( "Файл контроллера не найден." );
                if( !method_exists( $Controller, $actionName ) )    die( "Отсутствует обработчик контроллера для данной страницы." );

                $Controller->$actionName($segments);
                break;
            }
        }
    }



}