<?php


class Core
{
    static private $observers = [];

    private function __construct(){}
    private function __clone(){}


    /**
     * Метод добавления
     * @param $event - название события
     * @param $handler - безымянная функция (обработчик)
     */
    static public function attach($event, $handler)
    {
        self::$observers[$event][] = $handler;
    }


    /**
     * Удаление последнего добавленного наблюдателя для события
     * @param $event - название события
     */
    static public function detach($event)
    {
        foreach (self::$observers as $name => $observers)
            if($name == $event)
                array_pop(self::$observers[$name]);
    }


    static public function notify($args, $event)
    {
        foreach (self::$observers as $name => $observers)
            if($name == $event)
                foreach ($observers as $name => $function)
                {
                    $function($args);
                }
    }


    /**
     * Создние объекта
     * @param $className - название класса объекта
     * @return bool|null
     */
    static public function factory($className, $id = null)
    {//
    	//Формирование пути к файлу класса
    	$segments = explode("_", $className);
    	$filePath = ROOT . "/models";
    	$obj = null;

    	foreach ($segments as $segment)
    		$filePath .= "/".lcfirst($segment);

    	//Подключение модели
    	if(file_exists($filePath."/model.php") && !class_exists($className."_Model"))
    	{
    		 include_once $filePath."/model.php";
    	}

    	//Подключение файла с методами
    	if(file_exists($filePath.".php") && !class_exists($className))
    	{
    	    include_once $filePath.".php";
    	}
    	
    	//Создание объекта класса
    	if(class_exists($className))
    		$obj = new $className;
    	else
    		return false;

        if(is_numeric($id) && $id != 0)
        {
            return $obj->queryBuilder()
                ->where("id", "=", "$id")
                ->find();
        }
        else
            return $obj;
    }


    static public function controller($className, $constructData = null)
    {
        //Формирование пути к файлу класса
        $segments = explode("_", $className);
        $className .= "_C";
        $model = $className . "_Model";
        $filePath = ROOT . "/controllers";
        $obj = null;

        foreach ($segments as $segment)
            $filePath .= "/".lcfirst($segment);

        //Подключение файла с методами
        if(file_exists($filePath.".php") && !class_exists($className))
        {
            include_once $filePath.".php";
        }

        //Создание объекта класса
        if(class_exists($className))
            $obj = new $className($constructData);
        else
            return false;

        return $obj;
    }


    /**
     * Получение шаблона строки с передаваемыми параметрами
     * @param $sMessageName - название получаемой строки
     * @param $aMessageParams - передаваемые параметры в строку
     */
    public static function getMessage($sMessageName, $aMessageParams = array())
    {
        ini_set('display_errors','Off');
        $aStrings = include ROOT . "/config/messages/ru/messages.php";

        if(isset($aStrings[$sMessageName]))
        {
            return $aStrings[$sMessageName];
        }
        else
        {
            return $aStrings["UNDEFIND_STRING_NAME"];
        }

        ini_set('display_errors','Off');
    }


    /**
     * Метод для работы с ORM библиотекой
     * отменяет обрамление значения в одинарные ковычки, используется для метода where
     * @param $val
     * @return stdClass
     */
    public static function unchanged( $val )
    {
        $output = new stdClass();
        $output->type = "unchanged";
        $output->val = $val;
        return $output;
    }


}