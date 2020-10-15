<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//WP cleanup
require_once('inc/wp_cleanup.php');


//styles and scripts
function theme_styles_scripts() {
    wp_enqueue_style( 'ClaroCustomStyle', get_template_directory_uri().'/css/claro.css', array(), null, 'all' );
    wp_enqueue_script( 'CustomBootstrapBundle', get_template_directory_uri().'/js/bundle.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'theme_styles_scripts' );

//register main menu
function register_my_menu() {
    register_nav_menu('main-menu',__( 'Main Menu' ));
}
add_action( 'init', 'register_my_menu' );


// This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );

// Excerpt support for posts
function my_excerpt_length($length){
    return 35;
}
add_filter('excerpt_length', 'my_excerpt_length');

function new_excerpt_more($more) {
    global $post;
    return '... [<a href="'. get_permalink($post->ID) . '">' . 'read&nbsp;&raquo;' . '</a>]';
}
add_filter('excerpt_more', 'new_excerpt_more');

// SVG upload support
function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');

//WooCommerce 
require_once('inc/woo.php');

//WYSIWG styles
function my_theme_add_editor_styles() {
    add_editor_style( '/css/claro.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );

//don't remove <p> tags
remove_filter( 'the_content', 'shortcode_unautop' );

?>