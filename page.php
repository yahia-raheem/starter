<?php get_header(); ?>

<?php the_post() ?>
<section class="generic-page">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>