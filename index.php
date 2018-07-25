<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 25.05.2018
 * Time: 13:32
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../../../config.php";
require_once "models/core/database.php";
require_once "config/config.php";
require_once "libs/functions.php";
require_once "models/core/router.php";
require_once "models/core/orm.php";
require_once "models/core/core.php";
require_once "models/core/array.php";
require_once "models/core/controller.php";
require_once "models/core/entity/model.php";
require_once "models/core/entity.php";
require_once "models/core/page.php";
require_once "models/user.php";
require_once "observers/observers.php";

global $PAGE, $OUTPUT, $DB, $USER, $SITE, $CFG;

//require_login();

Router::setRoutes();
Router::run();
