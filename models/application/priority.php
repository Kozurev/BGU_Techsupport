<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 05.06.2018
 * Time: 10:24
 */

//namespace techsupport\models\application;


class Application_Priority extends Core_Entity
{
	protected $id;
	protected $title;
	protected $hours;

	public function __construct(){}

	public function getId()
	{
		return $this->id;
	}

	public function title($val = null)
	{
		if(is_null($val))	return $this->title;
		if(strlen($val) > 255)  die(Core::getMessage("TOO_LARGE_VALUE", array("title", "Application_Priority", 255)));
		$this->title = strval($val);
		return $this;
	}

	public function hours($val = null)
	{
		if(is_null($val))	return $this->hours;
		$this->hours = intval($val);
		return $this;
	}

}