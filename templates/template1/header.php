<?php
/**
 * Created by PhpStorm.
 * User: Kozurev Egor
 * Date: 28.05.2018
 * Time: 9:30
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo Page::instance()->getTitle();?></title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--    <link rel="shortcut icon" href="../../index.php">-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!-- Global CSS -->
    <link rel="stylesheet" href="<?=DIR_ROOT?>/templates/template1/assets/plugins/bootstrap/css/bootstrap.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="<?=DIR_ROOT?>/templates/template1/assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=DIR_ROOT?>/templates/template1/assets/plugins/elegant_font/css/style.css">

    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="<?=DIR_ROOT?>/templates/template1/assets/css/styles.css">
    <link id="theme-style" rel="stylesheet" href="<?=DIR_ROOT?>/templates/template1/assets/css/custom.css">

    <link rel="shortcut icon" href="<?=DIR_ROOT?>/templates/template1/assets/images/favicon.ico" type="image/x-icon">

    <script type="text/javascript" src="<?=DIR_ROOT?>/templates/template1/assets/plugins/jquery.min.js"></script>

</head>

<body class="<?=Page::instance()->getParam( "body-class", "" )?>">

    <div class="loader" style="display: none"></div>

    <div id="fb-root"></div>
        <div class="page-wrapper">

        <?php
        Core::factory( "Core_Entity" )
            ->addSimpleEntity( "title-big", Page::instance()->getParam( "title-big" ) )
            ->addSimpleEntity( "title-first", Page::instance()->getParam( "title-first" ) )
            ->addSimpleEntity( "title-second", Page::instance()->getParam( "title-second" ) )
            ->addEntities( Page::instance()->getParam( "page-description" ), "page-description" )
            ->addEntities( Page::instance()->getParam( "breadcumbs" ), "breadcumb" )
            ->xsl( "header.xsl" )
            ->show();
        ?>