<?php
add_theme_support('post-thumbnails');
add_theme_support('custom-logo');
add_theme_support('menus');
// Add default posts and comments RSS feed links to head.
add_theme_support('automatic-feed-links');
/*
* Let WordPress manage the document title.
* By adding theme support, we declare that this theme does not use a
* hard-coded <title> tag in the document head, and expect WordPress to
* provide it for us.
*/
add_theme_support('title-tag');

/*
* Switch default core markup for search form, comment form, and comments
* to output valid HTML5.
*/
add_theme_support(
    'html5',
    array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    )
);
/*
* Enable support for Post Formats.
*
* See: https://codex.wordpress.org/Post_Formats
*/
add_theme_support(
    'post-formats',
    array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    )
);
function _themename_customization($wp_customize)
{
    $wp_customize->add_section('social_media_section', array('title' => 'Social Media',));
    $wp_customize->add_setting('facebook', array('default' => '',));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'facebook_control',
        array(
            'label' => 'Facebook',
            'section' => 'social_media_section',
            'settings' => 'facebook',
        )
    ));
    $wp_customize->add_setting('twitter', array('default' => '',));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'twitter_control',
        array(
            'label' => 'Twitter',
            'section' => 'social_media_section',
            'settings' => 'twitter',
        )
    ));
    $wp_customize->add_setting('linked_in', array('default' => '',));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'linked_in_control',
        array(
            'label' => 'Linked In',
            'section' => 'social_media_section',
            'settings' => 'linked_in',
        )
    ));
    $wp_customize->add_setting('insta', array('default' => '',));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'insta_control',
        array(
            'label' => 'Instagram',
            'section' => 'social_media_section',
            'settings' => 'insta',
        )
    ));
    $wp_customize->add_setting('youtube', array('default' => '',));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'youtube_control',
        array(
            'label' => 'Youtube',
            'section' => 'social_media_section',
            'settings' => 'youtube',
        )
    ));

    $wp_customize->add_setting('site_loader', array(
        'default' => '',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options'
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control(
        $wp_customize,
        'site_loader',
        array(
            'label' => 'Site Loader',
            'section' => 'title_tagline',
            'settings' => 'site_loader',
        )
    ));

    $wp_customize->add_setting('show_love', array(
        'default'    => true,
        'capability' => 'edit_theme_options'
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'show_love',
        array(
            'label'      => 'Show Love',
            'section'    => 'title_tagline',
            'settings'   => 'show_love',
            'type'       => 'checkbox',
            'description' => 'Check this box to show us, at cloudmaize, your love. and on behalf of us here, thank you for being a valued customer.'
        )
    ));
}
add_action('customize_register', '_themename_customization');

function footer_custom_menu($theme_location)
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
                if (isset($menu_items[$count + 1]) && $parent_id == $menu_items[$count + 1]->menu_item_parent) {
                    $menu_list .= '<div class="col-lg-3 col-md-6 col-sm-12">' . "\n";
                    $menu_list .= '<h5 class="col-title">' . $title . '</h5>' . "\n";
                    $menu_list .= '<ul class="footer-nav">' . "\n";
                } else {
                    $menu_list .= '<div class="col-lg-3 col-md-6 col-sm-12">' . "\n";
                    $menu_list .= '<h5 class="col-title">No Title</h5>' . "\n";
                    $menu_list .= '<ul class="footer-nav">' . "\n";
                    $menu_list .= '<li>';
                    $menu_list .= '<i class="fas fa-less-than"></i>';
                    $menu_list .= '<a class="nav-link" href="' . $link . '">' . $title . '</a>' . "\n";
                    $menu_list .= '</li>';
                    $menu_list .= '</ul>' . "\n";
                }
            }

            if ($parent_id == $menu_item->menu_item_parent) {

                if (!$submenu) {
                    $submenu = true;
                }
                $menu_list .= '<li>';
                $menu_list .= '<i class="fas fa-less-than"></i>';
                $menu_list .= '<a class="nav-link" href="' . $link . '">' . $title . '</a>' . "\n";
                $menu_list .= '</li>';


                if ($menu_items[$count + 1]->menu_item_parent != $parent_id && $submenu) {
                    $menu_list .= '</ul>' . "\n";
                    $submenu = false;
                } else {
                }
            }

            if ((isset($menu_items[$count + 1]) && $menu_items[$count + 1]->menu_item_parent != $parent_id) || !isset($menu_items[$count + 1])) {
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

function determine_the_title($echo=true)
{
    $result = '';
    if (is_single()) {
        $post = get_queried_object();
        $postType = get_post_type_object(get_post_type($post));
        if (is_tax($post->taxonomy, $post->term_id) && !property_exists($post, 'post_title')) {
            $result = esc_html($post->name);
        } elseif (property_exists($post, 'post_title')) {
            $result = esc_html($post->post_title);
        } elseif ($postType) {
            $result = esc_html($postType->labels->name);
        }
    } elseif (is_tax()) {
        $postType = get_queried_object();
        $result = esc_html($postType->name);
    } elseif (is_archive()) {
        $postType = get_queried_object();
        $result = esc_html($postType->labels->name);
    } elseif (is_page()) {
        $result = get_the_title();
    }
    if ($echo) {
        echo $result;
    } else {
        return $result;
    }
}

add_action('get_header', 'my_filter_head');

function my_filter_head()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
}

function my_pagination($max_num_of_pages)
{
    $big = 999999999;
    $pagination = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $max_num_of_pages,
        'show_all' => true,
        'prev_text' => '<i class="fas fa-arrow-left"></i>' . 'Prev',
        'next_text' => 'Next' . '<i class="fas fa-arrow-right"></i>'
    ));
    return $pagination;
}

function theme_lang_switcher()
{
    $languages = icl_get_languages('skip_missing=1');
    if (1 < count($languages)) {
        $menu = '<div class="dropdown-menu" aria-labelledby="dropdownLang">';
        foreach ($languages as $l) {
            if (!$l['active']) {
                $menu .= '<a class="dropdown-item" href="' . $l['url'] . '"><img src="' . $l['country_flag_url'] . '" height="12" alt="' . $l['language_code'] . '" width="18" class="lang-flag flag-desktop" />' . $l['translated_name'] . '</a>';
            }
        }
        $menu .= '</div>';
        echo $menu;
    }
}


add_action('widgets_init', '_themename_register_widgets');

function _themename_register_widgets()
{
    require_once get_template_directory() . '/widgets/class-wp-widget-custom-categories.php';
    register_widget('My_Widget_Custom_Categories');
}
