<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php 
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $custom_logo_id , 'medium' );
    ?>
    <div class="loader">
        <div class="request-loader">
            <img data-src="" class="lazyload" />
        </div>
    </div>
    <!-- ----------------------------------------------------- nav start ------------------------------------------------------------ -->
    <!-- ----------------------------------------------------- nav end ------------------------------------------------------------ -->