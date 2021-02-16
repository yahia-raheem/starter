<?php
// Fields data.
if ( empty( $attributes['data'] ) ) {
	return;
}

// Unique HTML ID if available.
$id = 'itc-' . ( $attributes['id'] ?? '' );
if ( ! empty( $attributes['anchor'] ) ) {
	$id = $attributes['anchor'];
}

// Custom CSS class name.
$class = 'itc-block ' . ( $attributes['className'] ?? '' );
if ( ! empty( $attributes['align'] ) ) {
	$class .= " align{$attributes['align']}";
}
?>
<div id="<?= $id ?>" class="<?= $class ?>">
	<?php $image = mb_get_block_field( 'logo' ); ?>
    <div class="img-container">
		<?php echo wp_get_attachment_image($image['ID'], 'thumbnail', true); ?>
    </div>
	<div class="data-container">
		<h4 class="title"><?php mb_the_block_field( 'title' ) ?></h4>
		<p class="content"><?php mb_the_block_field( 'content' ) ?></p>
	</div>
</div>