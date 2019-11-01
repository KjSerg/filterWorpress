<?php
/**
 * ThreeHills  functions and definitions
 *
 * @package ThreeHills
 */


function ThreeHills_scripts() {

    wp_enqueue_style( 'ThreeHills-style', get_stylesheet_uri() );

    wp_enqueue_style( 'ThreeHills-googleapis-fonts', 'https://fonts.googleapis.com/css?family=PT+Sans:400,700|Roboto+Condensed:400,700&display=swap&subset=cyrillic', array(), '1.0');

    wp_enqueue_style( 'ThreeHills-iconic-font', 'https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css', array(), '1.0');

    wp_enqueue_style( 'ThreeHills-fancyapps-css', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css', array(), '1.0');

    wp_enqueue_style( 'ThreeHills-libs-css', get_template_directory_uri() . '/assets/css/libs.min.css', array(), '1.0');

    wp_enqueue_style( 'ThreeHills-main-css', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0');

    wp_enqueue_style( 'ThreeHills-media-css', get_template_directory_uri() . '/assets/css/media.css', array(), '1.0');

    wp_enqueue_style( 'ThreeHills-fix-css', get_template_directory_uri() . '/assets/css/fix.css', array(), '1.0');

    wp_enqueue_script( 'ThreeHills-jquery-scripts', 'https://code.jquery.com/jquery-3.1.1.min.js', array(), '1.0', true );

    wp_enqueue_script( 'ThreeHills-instafeed-scripts', 'https://cdn.rawgit.com/stevenschobert/instafeed.js/master/instafeed.min.js', array(), '1.0', true );

    wp_enqueue_script( 'ThreeHills-fancyapps-scripts', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js', array(), '1.0', true );

    wp_enqueue_script( 'ThreeHills-libs-scripts', get_template_directory_uri() . '/assets/js/libs.min.js', array(), '1.0', true );

    wp_enqueue_script( 'ThreeHills-scripts', get_template_directory_uri() . '/assets/js/common.js', array(), '1.0', true );

    wp_enqueue_script( 'ThreeHills-fix-scripts', get_template_directory_uri() . '/assets/js/fix.js', array(), '1.0', true );

    wp_localize_script( 'ajax-script', 'AJAX',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

}
add_action( 'wp_enqueue_scripts', 'ThreeHills_scripts' );


add_theme_support( 'post-thumbnails' );

add_action('after_setup_theme', function(){
    register_nav_menus( array(
        'header_menu' => 'Меню в шапке'
    ) );
});

add_filter( 'get_the_archive_title', function( $title ){
    return preg_replace('~^[^:]+: ~', '', $title );
});



get_template_part('functions/helpers');