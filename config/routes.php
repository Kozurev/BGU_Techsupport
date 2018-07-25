<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 25.05.2018
 * Time: 14:05
 */

return array(
    
    "application/list/([0-9-]+)" => "application/details/$1",
    "application/list/([a-z-]+)" => "application/list/$1",
    "application/list" => "application/listChoose",
    "application/performer" => "application/performer",
    "application/upload" => "application/upload",
    "application/save" => "application/save",

    "forum/page/([0-9-]+)" => "forum/index/$1",
    "forum/([0-9-]+)" => "forum/application/$1",
    "forum" => "forum/index",

    "statistic" => "statistic/index",
    "support" => "techsupport/choose",
    "instructions" => "techsupport/instructions",
    "reglament" => "techsupport/reglament",
    "" => "techsupport/index"
);