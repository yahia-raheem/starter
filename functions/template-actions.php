<?php
add_action('get_innercover', 'get_innercover', 10, 3);

function get_innercover($title=null, $subtitle=null, $image=null)
{
    hm_get_template_part(
        'templates/content-innercover',
        [
            'title' => $title ? $title : null,
            'subtitle' => $subtitle ? $subtitle : null,
            'image' => $image ? $image : null
        ]
    );
}

function get_latest_blogs($classes, $numPosts)
{
    $recent_posts = wp_get_recent_posts(array(
        'post_type' => 'blog',
        'numberposts' => $numPosts,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'post__not_in' => array(get_the_ID()),
        'suppress_filters' => false
    ), OBJECT);

    if ($recent_posts) {
        foreach ($recent_posts as $one) {
            hm_get_template_part('templates/content-blog-archive-block', ['blog' => $one->ID, 'classes' => $classes]);
        }
    }
    wp_reset_query();
}
