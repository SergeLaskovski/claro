<?php get_header(); ?>

<section class="container-fluid pt-5">
    <div class="container-content80 mx-auto">
        <?php
        // Start the loop.
        if( have_posts() ) :
        while ( have_posts() ) : the_post();
        ?>
                    <h2 class="txt-bold mb-5"><?php the_title(); ?></h2>
                    <?php the_content(); ?>
        <?php
        endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
        ?>
    </div>
</section>

<?php get_footer(); ?>
