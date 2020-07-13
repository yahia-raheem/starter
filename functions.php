<?php
add_theme_support('post-thumbnails');
add_theme_support( 'custom-logo' );

function _themename_assets() {
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/dist/assets/fontawesome/css/all.min.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( '_themename-stylesheet', get_template_directory_uri() . '/dist/css/bundle.css', array(), '1.0.0', 'all' );
    wp_enqueue_script( '_themename-scripts', get_template_directory_uri() . '/dist/js/bundle.js', array('jquery'), '1.0.0', true );
}
add_action('wp_enqueue_scripts', '_themename_assets');

function register_menu()
{
    register_nav_menus(array(
        'header-menu' => 'Header Menu',
        'footer-menu' => 'Footer Menu',
    ));
}
add_action('init', 'register_menu');

function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

add_filter( 'mb_settings_pages', function ( $settings_pages ) {
    $settings_pages[] = array(
        'id'               => 'riwaq-sp',
        'option_name'      => 'theme_mods_riwaq',
        'menu_title'       => 'Theme Options',
        'parent'           => 'themes.php',
        'customizer'       => true,
        'customizer_only'  => true,
    );
    return $settings_pages;
} );

add_filter( 'ninja_forms_render_options', function($options,$settings){
    if( $settings['key'] == 'listselect_1589983621434' ){
        $args = array(
            'post_type' => 'course',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'posts_per_page' => 100,
            'post_status' => 'publish'
        );
        $the_query = new WP_Query( $args ); 
        if ( $the_query->have_posts() ){
            global $post;
            while ( $the_query->have_posts() ){
                $the_query->the_post();
                $options[] = array('label' => get_the_title( ), 'value' => get_the_ID());
            }
            wp_reset_postdata(); 
        }
    }
    return $options;
},10,2);


function theme_customization($wp_customize) {
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

function header_custom_menu($theme_location)
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
                    $menu_list .= '<li class="nav-item dropdown">' . "\n";
                    $menu_list .= '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . "\n";
                    $menu_list .= $title . '</a>' . "\n";
                    $menu_list .= '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">' . "\n";
                } else {
                    $menu_list .= '<li class="nav-item">' . "\n";
                    $menu_list .= '<a class="nav-link" href="' . $link . '">' . $title . '</a>' . "\n";
                }
            }

            if ($parent_id == $menu_item->menu_item_parent) {

                if (!$submenu) {
                    $submenu = true;
                }

                $menu_list .= '<a class="dropdown-item" href="' . $link . '">' . $title . '</a>' . "\n";


                if ($menu_items[$count + 1]->menu_item_parent != $parent_id && $submenu) {
                    $menu_list .= '</div>' . "\n";
                    $submenu = false;
                } else {
                }

            }

            if ($menu_items[$count + 1]->menu_item_parent != $parent_id) {
                $menu_list .= '</li>' . "\n";
                $submenu = false;
            }

            $count++;
        }

    } else {
        $menu_list = '<!-- no menu defined in location "' . $theme_location . '" -->';
    }
    echo $menu_list;
}

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
                if ($parent_id == $menu_items[$count + 1]->menu_item_parent) {
                    $menu_list .= '<div class="col-lg-2 col-md-4 col-sm-6 col-12">' . "\n";
                    $menu_list .= '<h5 class="sec-title">' . $title . '</h5>' . "\n";
                    $menu_list .= '<nav class="nav flex-column">' . "\n";
                } else {
                    $menu_list .= '<div class="col-lg-2 col-md-4 col-sm-6 col-12">' . "\n";
                    $menu_list .= '<h5 class="sec-title">No Title</h5>' . "\n";
                    $menu_list .= '<nav class="nav flex-column">' . "\n";
                    $menu_list .= '<a class="nav-link active" href="' . $link . '">' . $title . '</a>' . "\n";
                    $menu_list .= '</nav>' . "\n";
                }
            }

            if ($parent_id == $menu_item->menu_item_parent) {

                if (!$submenu) {
                    $submenu = true;
                }

                $menu_list .= '<a class="nav-link active" href="'. $link .'">'. $title .'</a>' . "\n";


                if ($menu_items[$count + 1]->menu_item_parent != $parent_id && $submenu) {
                    $menu_list .= '</nav>' . "\n";
                    $submenu = false;
                } else {
                }

            }

            if ($menu_items[$count + 1]->menu_item_parent != $parent_id) {
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
function determine_the_title() {
    if(is_single()){
        $post = get_queried_object();
        $postType = get_post_type_object(get_post_type($post));
        if ($postType) {
            echo esc_html($postType->labels->name);
        }
    }elseif(is_tax()){
        $postType = get_queried_object();
        echo esc_html($postType->name);
    }elseif(is_archive()){
        $postType = get_queried_object();
        echo esc_html($postType->labels->name);
    }elseif(is_page()){
        the_title();
    }
}
function responsive_image($attachment_id, $size = 'medium' , $auto_output = false) {
    $image = wp_get_attachment_image_src( $attachment_id, $size );
 
    if ( ! $image ) {
        return false;
    }
 
    if ( ! is_array( $image_meta ) ) {
        $image_meta = wp_get_attachment_metadata( $attachment_id );
    }
 
    $image_src  = $image[0];
    $size_array = array(
        absint( $image[1] ),
        absint( $image[2] ),
    );
 
    $img_srcset = wp_calculate_image_srcset( $size_array, $image_src, $image_meta, $attachment_id );

    if ($auto_output == false) {
        return [
            'srcset' => $img_srcset,
            'src' => $image_src,
        ];
    } else {
        $output =  'data-srcset="' . $img_srcset .'" data-src="' . $image_src . '" data-sizes="auto"';
        echo $output;
    }

}
# recieves an array of id and sizes and outputs some data attributes to change images accordingly
# example:
# $imageIds = [
#     [
#         'id' => mobile image id,
#         'size' => 'mobile'
#     ],
#     [
#         'id' => desktop image id,
#         'size' => 'desktop'
#     ],
# ];
function det_responsive_images($attachment_ids, $size = 'medium' , $auto_output = true) {
    $output = 'data-sizes="auto"';
    $outputArray = [];
    foreach($attachment_ids as $one) {
        $image = wp_get_attachment_image_src( $one['id'], $size );
 
        if ( ! $image ) {
            return false;
        }

        $image_meta = wp_get_attachment_metadata( $one['id'] );
        $image_src  = $image[0];
        $size_array = array(
            absint( $image[1] ),
            absint( $image[2] ),
        );
        $img_srcset = wp_calculate_image_srcset( $size_array, $image_src, $image_meta, $one['id'] );

        if ($auto_output == false) {
            $outputArray []= [
                'srcset' => $img_srcset,
                'src' => $image_src,
            ];
        } else {
            $output .=  'data-srcset-' . $one['size'] . '="' . $img_srcset .'" data-src-' . $one['size'] . '="' . $image_src . '"';
        }
    }
    if ($auto_output == false) {
        return $outputArray;
    } else {
        echo $output;
    }

}


add_action('get_header', 'my_filter_head');

function my_filter_head() {
  remove_action('wp_head', '_admin_bar_bump_cb');
}

function blog_archive_query( $query ) {
    if ( is_post_type_archive('blog') && $query->is_main_query() && !is_admin() ) {
		if( isset($_GET['find']) && !empty($_GET['find']) ) {
            $query->query_vars['s'] = $_GET['find'];
        }
        $query->query_vars['posts_per_page'] = 4;
	}
}
add_action("pre_get_posts", "blog_archive_query");

function course_archive_query( $query ) {
    if ( is_post_type_archive('course') && $query->is_main_query() && !is_admin() ) {
        $query->query_vars['posts_per_page'] = 8;
	}
}
add_action("pre_get_posts", "course_archive_query");

add_action('wp_enqueue_scripts', 'nwd_modern_jquery');
function nwd_modern_jquery() {
    global $wp_scripts;
    if(is_admin()) return;
    $wp_scripts->registered['jquery-core']->src = get_stylesheet_directory_uri() .'/dist/vendor/jquery.min.js';
    $wp_scripts->registered['jquery']->deps = ['jquery-core'];
}

function my_pagination() {
    $pagination = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'show_all' => true,
        'prev_text' => '<i class="fas fa-arrow-left"></i>' . 'Prev',
        'next_text' => 'Next' . '<i class="fas fa-arrow-right"></i>'
    ) );
    echo $pagination;
}