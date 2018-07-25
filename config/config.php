<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 04.05.2018
 * Time: 11:50
 */

global $CFG;

//Приставка для названия всех таблиц тех. поддержки
$CFG->prefix = "mdl_bsu_techsupport_";

//Путь из корня директорий
define("ROOT", $CFG->dirroot . "/blocks/bsu_other/techsupport");

//Путь к проекту
define("DIR_ROOT", $CFG->wwwroot . "/blocks/bsu_other/techsupport");

//Вывод всех выполняемых SQL-запросов
define("TEST_MODE_ORM", false);

//Дирректория для загружаемых файлов
define("TECH_UPLOAD_DIR", $CFG->dataroot . "/1/techsupport");

//Кол-во выводимых заявок на странице форума
define( "TECH_FORUM_PAGINATION", 10 );