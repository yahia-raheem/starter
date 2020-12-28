<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    $custom_logo_id = get_theme_mod('custom_logo');
    $custom_loader_id = get_theme_mod('site_loader');
    ?>
    <div class="loader">
        <div class="request-loader">
            <?php echo wp_get_attachment_image($custom_loader_id, ['120', '120'], true); ?>
        </div>
    </div>
    <!-- ----------------------------------------------------- nav start ------------------------------------------------------------ -->
    <!-- ----------------------------------------------------- nav end ------------------------------------------------------------ -->