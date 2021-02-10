<?php

function _themename_assets()
{
    wp_deregister_script('jquery');
    if (apply_filters('wpml_is_rtl', NULL)) {
        wp_enqueue_style('_themename-stylesheet-rtl', get_stylesheet_directory_uri() . '/dist/css/bundle-rtl.css', array(), '1.0.0', 'all');
        wp_enqueue_script('_themename-scripts-rtl', get_stylesheet_directory_uri() . '/dist/js/bundle-rtl.js', array('jquery'), '1.0.0', true);
    } else {
        wp_enqueue_style('_themename-stylesheet', get_stylesheet_directory_uri() . '/dist/css/bundle.css', array(), '1.0.0', 'all');
        wp_enqueue_script('_themename-scripts', get_stylesheet_directory_uri() . '/dist/js/bundle.js', array('jquery'), '1.0.0', true);
    }
}
add_action('wp_enqueue_scripts', '_themename_assets');

function _themename_functions()
{
    require_once get_template_directory() . '/functions/class-wp-bootstrap-navwalker.php';
    require_once get_template_directory() . '/functions/helpers.php';
    # require_once get_template_directory() . '/functions/woo-helpers.php';
}
add_action('after_setup_theme', '_themename_functions');

function register_menu()
{
    register_nav_menus(array(
        'header-menu' => 'Header Menu',
        'footer-menu' => 'Footer Menu',
    ));
}
add_action('init', 'register_menu');


# function blog_archive_query( $query ) {
#     if ( is_post_type_archive('blog') && $query->is_main_query() && !is_admin() ) {
#         $query->query_vars['posts_per_page'] = 10;
# 	}
# }
# add_action("pre_get_posts", "blog_archive_query");


# function sidebar_widgets_init()
# {
# 
#     register_sidebar(array(
#         'name'          => 'Footer Widget Area',
#         'id'            => 'footer_widget_area',
#         'before_widget' => '<div id="%1$s" class="col-lg-3 col-md-6 col-sm-12 %2$s" >',
#         'after_widget'  => '</div>',
#         'before_title'  => '<h5 class="sec-title marked">',
#         'after_title'   => '</h5>',
#     ));
# }
# add_action('widgets_init', 'sidebar_widgets_init');

# add_filter('mb_settings_pages', function ($settings_pages) {
#     $settings_pages[] = array(
#         'id'               => 'theme-sp',
#         'option_name'      => 'theme_mods_theme',
#         'menu_title'       => 'Theme Settings',
#         'position'         => 2,
#         'style'            => 'no-boxes',
#         'columns'          => 1,
#         'tabs'             => [
#             'general_settings' => 'General Settings',
#         ],
#         'tab_style'        => 'left'
#     );
#     return $settings_pages;
# });
