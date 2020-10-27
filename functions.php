<?php

add_theme_support('post-thumbnails');

register_nav_menus(array(
    'top'    => 'Top menu'
));

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
   add_theme_support( 'woocommerce' );
}     

// woocommerce

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs' );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display' );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products' );

add_filter( 'woocommerce_product_add_to_cart_text', 'custom_add_to_cart_price', 20, 2 ); // Shop and other archives pages
add_filter( 'woocommerce_product_single_add_to_cart_text', 'custom_add_to_cart_price', 20, 2 ); // Single product pages
function custom_add_to_cart_price( $button_text, $product ) {
    // Variable products
    if( $product->is_type('variable') ) {
        // shop and archives
        if( ! is_product() ){
            $product_price = wc_price( wc_get_price_to_display( $product, array( 'price' => $product->get_variation_price() ) ) );
            return $button_text . ' - From ' . strip_tags( $product_price );
        } 
        // Single product pages
        else {
            return $button_text;
        }
    } 
    // All other product types
    else {
        $product_price = wc_price( wc_get_price_to_display( $product ) );
        return $button_text . ' - Just ' . strip_tags( $product_price );
    }
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
