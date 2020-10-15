<?php /* Template Name: About us */ ?>
<?php get_header(); ?>

<section class="container-fluid pt-5 bg-grey">
    <div class="container-content80 mx-auto pos-rel">
        <?php
        // Start the loop.
        if( have_posts() ) :
        while ( have_posts() ) : the_post();
        ?>
            <div class="row">
                <div class="col-12 col-md-8 d-flex flex-column justify-content-center align-content-center">
                    <h2 class="txt-bold mb-5"><?php the_title(); ?></h2>
                    <?php the_content(); ?>
                </div>
                <div class="col-12 col-md-4">
                    <?php
                    $img = get_the_post_thumbnail_url( $post_id, 'full' );
                    if($img){
                        ?>
                        <img src="<?php echo $img; ?>" alt="<?php echo get_the_title();?>" class="img-fluid w-100">
                        <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        $order_text = get_post_custom_values($key = 'orders');
        $bargain_text = get_post_custom_values($key = 'bargain');
        $retailers_text = get_post_custom_values($key = 'retailers');
        // End the loop.
        endwhile;
        endif;
        wp_reset_postdata();
        wp_reset_query();
        ?>
        <div class="d-flex justify-content-between">
            <a href="/category/summer/" class="btn-black m-1 m-md-5">Summer <span></span></a>
            <a href="/category/winter/" class="btn-black m-1 m-md-5">Winter <span></span></a>
        </div>
    </div>
</section>



<section class="container-fluid pt-5 py-5">
    <div class="container-content80 mx-auto">
        <h2 class="txt-bold mb-3">Our People</h2>
    </div>
</section>
<section class="container-fluid pt-5 section-border">
    <div class="team-content px-2 px-md-0  mx-auto">
        <div class="row m-0 justify-content-center">
            <?php 
            $args = array( 'post_type' => 'team', 'posts_per_page' => -1, 'orderby'=>'menu_order');
            $the_query = new WP_Query($args);
            if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); 
                $img = get_the_post_thumbnail_url( $post_id, 'full' );
                ?>
                <div class="col-12 col-md-4 p-2 d-flex justify-content-center">
                    <div class="team-member-container">
                        <img src="<?php echo $img; ?>" alt="<?php echo get_the_title(); ?>" class="img-fluid">
                        <div class="text-left mt-3">
                            <h5 class="txt-bold"><?php the_title(); ?></h5>
                            <div class=""><?php the_content(); ?></div>
                        </div>
                    </div>
                </div>
            <?php endwhile; else: ?>
                <p>Sorry, no posts matched your criteria.</p>
            <?php 
            wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>


<section class="container-fluid py-5 section-border">
    <div class="container-content80 mx-auto py-1 py-md-5">
        <h2 class="txt-bold mb-5">Custom Orders</h2>
        <?php
            echo $order_text[0];
        ?>
    </div>
</section>

<section class="container-fluid py-5 section-border">
    <div class="container-content80 mx-auto py-1 py-md-5">
        <h2 class="txt-bold mb-5">Quality Bargain</h2>
        <?php
            echo $bargain_text[0];
        ?>
        <div class="text-right">
            <a href="/category/bargain/" class="btn-black m-1 m-md-5">View Clearance <span></span></a>
        </div>
    </div>
</section>

<section class="container-fluid py-5">
    <div class="container-content80 mx-auto py-1 py-md-5">
        <?php
            echo $retailers_text[0];
        ?>

    </div>
</section>

<?php get_footer(); ?>


