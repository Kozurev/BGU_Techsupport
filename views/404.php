<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 25.05.2018
 * Time: 14:59
 */

Page::instance()->setTitle("Ошибка 404");
Page::instance()->showHeader();
?>

<header class="header text-center">
    <div class="container">
        <div class="branding">
            <h1 class="logo">
                <span class="text-bold">ОШИБКА 404</span>
            </h1>
        </div>
        <div class="tagline">
            <p>Страница, которую вы ищете не существует или доступ к ней ограничен</p>
        </div>
    </div>
</header>

<?php

Page::instance()->showFooter();
