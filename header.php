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
    <!-- <div class="loader">
        <div class="request-loader">
            <div class="img-container">
                <?php echo wp_get_attachment_image($custom_loader_id, ['120', '120'], true); ?>
            </div>
        </div>
    </div> -->
    <!-- ----------------------------------------------------- nav start ------------------------------------------------------------ -->
    <div id="mySidenav" class="sidenav">
        <div class="sidebar-header">
            <h3 class="title"><?php _e('Main Menu', 'cm_theme'); ?></h3>
            <a href="javascript:void(0)" class="closebtn">&times;</a>
        </div>
        <?php
        wp_nav_menu(array(
            'theme_location'    => 'header-menu',
            'depth'             => 3,
            'container'         => false,
            'menu_class'        => 'd-flex flex-column mobile-menu',
        ));
        ?>
    </div>
    <div class="nav-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-dark">
                        <a class="navbar-brand" href="#"><?php echo wp_get_attachment_image($custom_logo_id, 'site-logo', true, ['class' => 'site-logo']); ?></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse d-none d-lg-block" id="navbarSupportedContent">
                            <?php
                            wp_nav_menu(array(
                                'theme_location'    => 'header-menu',
                                'depth'             => 3,
                                'container'         => false,
                                'menu_class'        => 'navbar-nav ml-auto navbar-nav-scroll',
                                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                                'walker'            => new WP_Bootstrap_Navwalker(),
                            ));
                            ?>
                            <a href="#" class="btn quick-request"><?php _e('Quick Request', 'cm_theme'); ?></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ----------------------------------------------------- nav end ------------------------------------------------------------ -->