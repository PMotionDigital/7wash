<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
        <?php wp_head(); ?>
    </head>
    <?php
    	if(wp_is_mobile()) {
    		$mobile = 'mobile';
        }
    ?>
<body <?php body_class(array($mobile)); ?>>
    <header class="main-header dis-flex justify-content-center">
        <div class="dis-flex justify-content-between align-items-center col-lg-10 col-xs-11 col-lm-11">
            <div class="main-header_logo">
                <a href="#">
                    <img src="<?php bloginfo( 'template_url' ) ?>/dist/img/logo.png">
                </a>
            </div>
            <div class="main-header_nav main-nav">
                <?php wp_nav_menu([
                    'theme_location'  => 'top',
                    'container'       => 'ul',
                    'menu_class'      => 'main-nav_menu',
                ]); ?>
            </div>
        </div>
    </header>
