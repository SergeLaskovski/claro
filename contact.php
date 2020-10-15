<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>


<section class="container-fluid bg-fluid bg-contact">
</section>

<section class="container-fluid py-5 ">
    <div class="col-12 col-md-8 col-lg-6 mx-auto py-5 text-center">
        <h3 class="txt-bold">We’d love to hear from you!</h3>
        <hr class="hr-short">
        <p>If you have any questions for us, or simply want to say hi, get in touch with us! Fill out the form below and we’ll be in touch with you shortly. Alternatively, give us a call.</p>
    </div>
</section>

<section class="container-fluid pt-5 ">
    <div class="container-content80 mx-auto">
        <?php
        // Start the loop.
        if( have_posts() ) :
        while ( have_posts() ) : the_post();
        ?>
            <div class="row">
                <div class="col-12 col-md-4">
                    <?php the_content(); ?>
                </div>
                <div class="col-12 col-md-8 contact-contact">
                    <?php echo do_shortcode( '[contact-form-7 id="138" title="Contact page"]' ); ?>
                </div>
            </div>
        <?php
        endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
        ?>
    </div>
</section>

<?php get_footer(); ?>
