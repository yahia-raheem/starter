<?php
add_theme_support('post-thumbnails');

function _themename_assets() {
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/dist/assets/fontawesome/css/all.min.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( '_themename-stylesheet', get_template_directory_uri() . '/dist/css/bundle.css', array(), '1.0.0', 'all' );
    wp_enqueue_script( '_themename-scripts', get_template_directory_uri() . '/dist/js/bundle.js', array('jquery'), '1.0.0', true );
}
add_action('wp_enqueue_scripts', '_themename_assets');

function theme_customization($wp_customize) {
    // social media
    $wp_customize->add_section('social_media_section', array('title' => 'Social Media', ));
    $wp_customize->add_setting('facebook', array('default' => '', ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'facebook_control',
        array(
            'label' => 'Facebook',
            'section' => 'social_media_section',
            'settings' => 'facebook',
        )));
    $wp_customize->add_setting('twitter', array('default' => '', ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'twitter_control',
        array(
            'label' => 'Twitter',
            'section' => 'social_media_section',
            'settings' => 'twitter',
        )));
    $wp_customize->add_setting('linked_in', array('default' => '', ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'linked_in_control',
        array(
            'label' => 'Linked In',
            'section' => 'social_media_section',
            'settings' => 'linked_in',
        )));
    $wp_customize->add_setting('insta', array('default' => '', ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'insta_control',
        array(
            'label' => 'Instagram',
            'section' => 'social_media_section',
            'settings' => 'insta',
        )));
    $wp_customize->add_setting('youtube', array('default' => '', ));
    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'youtube_control',
        array(
            'label' => 'Youtube',
            'section' => 'social_media_section',
            'settings' => 'youtube',
        )));
}
add_action('customize_register', 'theme_customization');

function register_menu()
{
    register_nav_menus(array(
        'header-left' => 'Left Header Menu',
        'header-right' => 'Right Header Menu',
        'footer-main' => 'Footer Main Menu',
        'footer-sec' => 'Copyright Footer',
    ));
}

add_action('init', 'register_menu');

function clean_custom_menu($theme_location)
{
    if (($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location])) {
        $menu = get_term($locations[$theme_location], 'nav_menu');
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        $menu_list = " ";

        $count = 0;
        $submenu = false;

        foreach ($menu_items as $menu_item) {

            $link = $menu_item->url;
            $title = $menu_item->title;

            if (!$menu_item->menu_item_parent) {
                $parent_id = $menu_item->ID;
                if ($parent_id == $menu_items[$count + 1]->menu_item_parent) {
                    $menu_list .= '<div class="col-lg-2 col-md-3 col-sm-4 col-6">' . "\n";
                    $menu_list .= '<h5 class="menu-title">' . $title . '</h5>' . "\n";
                    $menu_list .= '<ul class="footer-menu">' . "\n";
                } else {
                    $menu_list .= '<div class="col-lg-2 col-md-3 col-sm-4 col-6">' . "\n";
                    $menu_list .= '<ul class="footer-menu">' . "\n";
                    $menu_list .= '<li><a href="' . $link . '">' . $title . '</a></li>' . "\n";
                }
            }

            if ($parent_id == $menu_item->menu_item_parent) {

                if (!$submenu) {
                    $submenu = true;
                }

                $menu_list .= '<li>' . "\n";
                $menu_list .= '<a href="' . $link . '">' . $title . '</a>' . "\n";
                $menu_list .= '</li>' . "\n";


                if ($menu_items[$count + 1]->menu_item_parent != $parent_id && $submenu) {
                    $menu_list .= '</ul>' . "\n";
                    $submenu = false;
                } else {
                }

            }

            if ($menu_items[$count + 1]->menu_item_parent != $parent_id) {
                $menu_list .= '</ul>' . "\n";
                $menu_list .= '</div>' . "\n";
                $submenu = false;
            }

            $count++;
        }

    } else {
        $menu_list = '<!-- no menu defined in location "' . $theme_location . '" -->';
    }
    echo $menu_list;
}