<?php
$pageTitle = isset($template_args['title']) ? $template_args['title'] : determine_the_title(false);
$defautSubtitle = rwmb_meta('default_page_subtitle', ['object_type' => 'setting'], 'theme_mods_cm');
$defaultImage = rwmb_meta('default_page_cover', ['object_type' => 'setting'], 'theme_mods_cm');
$pageSubtitle = isset($template_args['subtitle']) ? $template_args['subtitle'] : $defautSubtitle;
$pageImage = isset($template_args['image']) ? $template_args['image'] : $defaultImage['ID'];
?>
<section class="inner-cover">
    <?php echo wp_get_attachment_image($pageImage, 'high', false, ['class' => 'bg-image']); ?>
    <div class="vail"></div>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                <h1 class="page-title"><?php echo $pageTitle; ?></h1>
                <h6 class="page-subtitle"><?php echo $pageSubtitle; ?></h6>
            </div>
        </div>
    </div>
</section>