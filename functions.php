<?php

add_theme_support('post-thumbnails');

register_nav_menus(array(
    'top'    => 'Top menu'
));

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
   add_theme_support( 'woocommerce' );
}        

// settings site

if (function_exists('acf_add_options_page')) {
    $option_page = acf_add_options_page(
        array(
            'page_title' => 'Контактные данные',
            'menu_title' => 'Контактные данные',
            'menu_slug'  => 'contacts',
            'capability' => 'edit_posts',
            'redirect'   => false
        )
    );
}

// автообновление версии файлов

function enqueue_versioned_script($handle, $src = false, $deps = array(), $in_footer = false)
{
    wp_enqueue_script($handle, get_template_directory_uri() . $src, $deps, filemtime(get_template_directory() . $src), $in_footer);
}

function enqueue_versioned_style($handle, $src = false, $deps = array(), $media = 'all')
{
    wp_enqueue_style($handle, get_template_directory_uri() . $src, $deps = array(), filemtime(get_template_directory() . $src), $media);
}

function themename_scripts()
{
    enqueue_versioned_style('my-theme-style', $theme_uri . '/dist/css/style.bundle.css');
    enqueue_versioned_script('my-theme-script', $theme_uri . '/dist/js/bundle.js', array('jquery'), true);
}

add_action('wp_enqueue_scripts', 'themename_scripts');
