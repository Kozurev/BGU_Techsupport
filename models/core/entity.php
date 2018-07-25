<?php
/**
*	Класс, реализующий XML-сущьности
*	Простой тэг имеет значение и не может иметь вложенных XMK-сущьностей
*	Сложный тэг не имеет значнеия но может иметь вложенные XML-сущьности
*/
class Core_Entity extends Core_Entity_Model
{

    /**
     * Получение названия таблицы объекта по названию класса
     *
     * @return string
     */
    public function databaseTableName()
    {
        global $CFG;
        return $CFG->prefix . mb_strtolower( get_class( $this ) ) . "s";
    }

    /**
     * Возвращает название таблицы для данного объекта
     * хз что это и зачем, просто хвост со старой системы
     *
     * @return string
     */
    public function getTableName()
    {
        if(method_exists($this, "databaseTableName"))
            return $this->databaseTableName();
        else
            return get_class($this);
    }


    /**
     *	Формирует из не пустых свойств объекта ассоциативный массив
     *
     *	@return array
     */
    public function getObjectProperties()
    {
        $result = array();
        $aVars = get_object_vars($this);
        $aForbidden = array("open", "close");
        foreach ($aVars as $key => $value)
        {
            if((is_string($value) || is_numeric($value)) && !in_array($key, $aForbidden))
                $result[$key] = $value;
        }
        return $result;
    }


    /**
     * Возвращает конструктор запроса (Orm) для объекта
     *
     * @return null|Orm
     */
    public function queryBuilder()
    {
        if( $this->Orm == null )
        {
            $this->Orm = new Orm();
            $this->Orm->tableName = $this->getTableName();
            $this->Orm->class = get_class( $this );
        }
        return $this->Orm;
    }


    /**
     * Сеттер для св-ва id объекта
     *
     * @param $val
     */
    public function setId($val)
    {
        $this->id = intval( $val );
    }


    /**
     * Метод сохранения объекта (записи в таблице)
     * INSERT - выполняется если это новый объект (id == null)
     * UPDATE - выполняется если это существующий объект ( id != null )
     */
    public function save()
    {
        $this->queryBuilder()->save($this);
        $this->Orm = new Orm();
    }


    /**
     * Метод удаления объекта (записи в таблице)
     * выполняется в случае если это существующий объект (id != null)
     */
    public function delete()
    {
        $this->queryBuilder()->delete($this);
        $this->Orm = new Orm();
    }


	/**
	*	Конвертирует, к примеру, "Structure_Item" в "structure_item"
	*	@param $name - название модели, которое необходимо отконвертировать
	*	@return string - название модели без больших букв
	*/
	protected function renameModelName($intputName)
	{
		$aSegments = explode("_", $intputName);
		$outputName = "";

		foreach ($aSegments as $segment) 
		{
			if($outputName == "") $outputName .= lcfirst($segment);
			else $outputName .= "_" . lcfirst($segment);
		}

		return $outputName;
	}


	/**
	*	Добавление дочерней сущьности в XML
    *
	*	@param $obj - добавляемая дочерняя сущьность
	*/
	public function addEntity($obj, $tag = null)
	{
		if(!is_null($tag)) 	
		{
		    if(method_exists($obj, "custom_tag"))
			    $obj->custom_tag($tag);
            elseif(get_class($obj) == "stdClass")
                $obj->custom_tag = $tag;
		}
		

		if($this->aEntityVars["value"] == "")	 
			$this->childrenObjects[] = $obj;
		else
			echo "Невозможно добавыить элемент к простой XML-сущьности";

		return $this;
	}


	/**
	*	Добавление массива дочерних сущьностей в XML
    *
	*	@param $aoChilren - массив объектов
	*/
	public function addEntities($aoChilren, $tags = null)
	{
		if(is_array($aoChilren) && count($aoChilren) > 0)
		foreach ($aoChilren as $oChild) 
		{
			if(is_object($oChild)) 	$this->addEntity($oChild, $tags);
		}
		return $this;
	}


    /**
     * Добавление "простой" сущьности - только название и значение
     *
     * @param $name
     * @param $value
     * @return $this
     */
	public function addSimpleEntity($name, $value)
    {
        $NewEntity = Core::factory( "Core_Entity" );
        $NewEntity->entityName( $name );
        $NewEntity->entityValue( $value );
        $this->addEntity($NewEntity);
        return $this;
    }


	/**
	*	Преобразование объекта в XML-сущьность
	*	так же выполняется рекурсивное преобразование дочерних сущьностей
    *
	*	@param $obj - объект, который необходимо преобразовать в XML-сущьность
	*	@param $xmlUbj - объект конечной XML-сущьности
	*/
	public function createEntity($obj, $xmlObj)
	{
		$xml = $xmlObj;

		//Формирование названия тэга
		$tagName = "";
		$objClass = explode("_", get_class($obj));

		if(get_class($obj) == "Core_Entity")
		{
			if($obj->aEntityVars["value"] != "") 
				//Формирование простого тэга
				return $xml->createElement($obj->aEntityVars["name"], $obj->aEntityVars["value"]);
			else 
				$tagName = $obj->aEntityVars["name"];
		}
		else
		{
			if(isset($obj->aEntityVars["custom_tag"]) && $obj->aEntityVars["custom_tag"] != "")
			{
				$tagName = $obj->aEntityVars["custom_tag"];
			}
			elseif(isset($obj->custom_tag) && $obj->custom_tag != "")
            {
                $tagName = $obj->custom_tag;
            }
			else 	$tagName = $this->renameModelName(get_class($obj));
		}

		//Создание тэга
		$objTag = $xml->createElement($tagName);
		//Получение значений свойств от объекта
		$objData = get_object_vars($obj);

		/*
		*	Преобразование объекта в XML сущьность
		*/
		foreach ($objData as $key => $val) 
		{
			if(is_array($val) && $key != "childrenObjects") continue;
			if(is_object($val)) continue;

			//Если переменная представляет из себя массив дочерних сущьностей
			if($key == "childrenObjects")
			{
				foreach($val as $childObject)
				{
					$objChildTag = $this->createEntity($childObject, $xml);
					$objTag->appendChild($objChildTag);
				}
			}
			elseif($val !== "" && !is_null($val))
			{
				$objTag->appendChild($xml->createElement($key, strval($val)));
			}
		}
		
		return $objTag;
	}


	public function show( $type = 1 )
	{
		if($this->aEntityVars["xslPath"] == "") die("Не указан путь к XSL шаблону");

		$xmlText = '<?xml version="1.0" encoding="utf-8"?>
		<?xml-stylesheet type="text/xsl" href="'.$this->aEntityVars["xslPath"].'"?>';

		$xmlText .= '<'.$this->aEntityVars["name"].'></'.$this->aEntityVars["name"].'>';

		$xml = new DOMDocument();
		$xml->loadXML($xmlText);

		$rootTag = $xml->getElementsByTagName($this->aEntityVars["name"])->item(0);

		foreach ($this->childrenObjects as $obj) 
		{
			$rootTag->appendChild($this->createEntity($obj, $xml));
		}

		//$xml->save("xml.xml");

		// Объект стиля
		$xsl = new DOMDocument();
		$xsl->load($this->aEntityVars["xslPath"]);  

		// Создание парсера
		$proc = new XSLTProcessor();

		// Подключение стиля к парсеру
		$proc->importStylesheet($xsl);

		// Обработка парсером исходного XML-документа
		$parsed = $proc->transformToXml($xml);

		// Вывод результирующего кода
		if( $type == 1 )    echo $parsed;
		else return $parsed;
	}		

}