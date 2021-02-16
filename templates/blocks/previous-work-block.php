<?php
// Fields data.
if (empty($attributes['data'])) {
    return;
}

// Unique HTML ID if available.
$id = 'pwb-' . ($attributes['id'] ?? '');
if (!empty($attributes['anchor'])) {
    $id = $attributes['anchor'];
}

// Custom CSS class name.
$class = 'pwb-block ' . ($attributes['className'] ?? '');
if (!empty($attributes['align'])) {
    $class .= " align{$attributes['align']}";
}
?>
<div id="<?= $id ?>" class="row <?= $class ?>">
    <?php foreach (mb_get_block_field('block') as $one) : ?>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="block-container">
                <div class="img-container">
                    <a href="<?php echo $one['url']; ?>" class="clickable-image" target="_blank"></a>
                    <?php echo wp_get_attachment_image($one['image'], 'high', true, ['class' => 'bg-image']); ?>
                </div>
                <div class="data-container">
                    <h4 class="title"><a href="<?php echo $one['url']; ?>" target="_blank"><?php echo $one['title']; ?></a></h4>
                    <p class="content"><?php echo $one['subtitle']; ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>