<?php /*  Template Name: Home page */ ?>
<?php get_header(); ?>

<section class="container-fluid bg-fluid bg-main d-flex flex-column">
    <div class="row justify-content-center p-5" >
        <div class="col-12 col-md-6 txt-white py-5">
            <?php
            // Start the loop.
            if( have_posts() ) :
            while ( have_posts() ) : the_post();
            ?>
            <h1 class="txt-normal pb-3">
                <?php echo get_field('banner_header'); ?>
            </h1>
            <?php the_content();?>
            <?php
            // End the loop.
            endwhile;
            endif;
            wp_reset_postdata();
            wp_reset_query();
            ?>
        </div>
        <div class="col-12 col-md-6 d-flex justify-content-end align-items-end">
            <?php
            //small banner with one product (random choose from products with "Main page banner" atribute set to true)
            $args = array(
                'posts_per_page'   => 1,
                'orderby'          => 'rand',
                'post_type'        => 'product',
                'meta_key' => '_thumbnail_id',
                /*'meta_query' => array(
                    array(
                        'key' => 'main_page_banner',
                        'value' => '1',
                        'compare' => '='
                    )
                )*/
             ); 
            
            $random_products = get_posts( $args );
            if($random_products ) :
                foreach ( $random_products as $post ) : setup_postdata( $post ); ?>
                    <a href="<?php the_permalink(); ?>" class="a-block">
                    <div class="home-ban d-flex">
                        <div class="w-75 bg-white d-flex justify-content-center align-items-center">
                            <div class="pl-2 w-40">
                                <?php
                                $img = get_the_post_thumbnail_url(get_the_ID(),'thumbnail');
                                if($img){
                                    ?>
                                    <img src="<?php echo $img; ?>" alt="<?php echo the_title();?>" class="img-fluid img-contain">
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="p-3 w-60">
                                <!--<div class="txt-grey txt-smaller">Newest arrival</div>-->
                                <?php the_title(); ?>
                            </div>
                        </div>
                        <div class="w-25 bg-pink big-arrow d-flex justify-content-center align-items-center">
                            &rangle;
                        </div>
                        </div>
                     </a>
                <?php 
                endforeach;
            endif;
            wp_reset_postdata();    
            ?>
        </div> 
    </div>
    <div class="row home-menu-row">
    <?php
        //Home page small menu under the banner
        $HomePageNav = wp_get_nav_menu_items('HomePageSmallCategories');
        if($HomePageNav){
            foreach ( $HomePageNav as $navItem ) { 
                ?>
                <div class="col-6 col-md home-menu-col">
                    <a href="<?php echo $navItem->url; ?>" title="<?php echo $navItem->title; ?>" class="home-menu p-3">
                        <?php echo $navItem->title; ?>
                    </a>
                </div>
                <?php
            }
        }
    ?>
    </div>
</section>

<?php
    //Home page big categories
    $HomePageNav = wp_get_nav_menu_items('HomePageLargeCategories');
    if($HomePageNav){
        $i=0;
        foreach ( $HomePageNav as $navItem ) {
            $i++;
            $category_id = $navItem->object_id;
            $bg = get_field('cat_bg', 'product_cat_'.$category_id);
            $flex_direction = "flex-row-reverse";
            $bg_class = "home-cat-white";
            $btn_class = "btn-black";
            if($i % 2 == 0){ 
                $flex_direction = "flex-row";
                $bg_class = "home-cat-pink";
                $btn_class = "btn-white";
            }
            ?>
            <section class="container-fluid px-4 pt-4">
                <div class="row bg-fluid d-flex <?php echo $flex_direction; ?>"  style="background-image: url(<?php echo $bg ?>);">
                    <div class="col-12 col-md-4 col-lg-3 <?php echo $bg_class; ?> p-5">
                        <h2 class="txt-black txt-bold mt-5"><?php echo $navItem->title; ?></h2>
                        <p><?php echo get_field('home_desc', 'product_cat_'.$category_id); ?></p>
                        <a href="<?php echo $navItem->url; ?>" title="<?php echo $navItem->title; ?>" class="<?php echo $btn_class; ?> my-1 my-md-5">View collection<span></span></a>
                    </div>
                    <div class="col-12 col-md-8 col-lg-9">
                        <?php
                        $args = array(
                            'posts_per_page'   => 3,
                            'orderby'          => 'rand',
                            'post_type'        => 'product',
                            'post_status' => 'publish',
                            'meta_key' => '_thumbnail_id',
                            'tax_query' => array(
                                array(
                                    'taxonomy'      => 'product_cat',
                                    'field' => 'term_id', 
                                    'terms'         => $category_id,
                                    'operator'      => 'IN'
                                ),
                                /*array(
                                    'taxonomy' => 'product_visibility',
                                    'field'    => 'term_id',
                                    'terms'    => 'featured',
                                    'operator' => 'IN',
                                )*/
                            )
                        ); 

                        $random_products = get_posts( $args );
                        if($random_products ) :
                            ?>
                            <div class="row h-100 justify-content-center align-items-center ">
                            <?php
                            foreach ( $random_products as $post ) : setup_postdata( $post ); 
                            ?>
                                <div class="col-12 col-md-4">
                                    <a href="<?php the_permalink(); ?>">
                                    <div class="row bg-white p-1 p-lg-5">
                                        <div class="col-4 col-md-12 text-center p-1 m-auto">
                                            <?php
                                            $img = get_the_post_thumbnail_url(get_the_ID(),'medium');
                                            if(!$img){
                                                $img = '/wp-content/uploads/woocommerce-placeholder-300x225.png';
                                            }
                                            ?>
                                            <img src="<?php echo $img; ?>" alt="<?php echo the_title();?>" class="img-fluid home-cat-logo">
                                        </div>
                                        <div class="col-8 col-md-12 text-center my-auto home-cat-title">
                                            <?php the_title(); ?>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            <?php
                            endforeach;
                            ?>
                            </div>
                            <?php
                        endif;
                        wp_reset_postdata();    
                        ?>
                    </div>
                </div>
            </section>
            <?php
        }
    }
?>

<section class="container-fluid px-4 pt-4">
        <div class="bg-footer p-4 w-100">
            <div class="footer-boder px-0 py-2 p-md-5 w-100">
                <div class="col-12 col-md-10 col-lg-8 mx-auto">
                    <h3 class="py-2 py-md-5 text-center">Sign up to our newsletter!</h3>
                    <?php echo do_shortcode( '[contact-form-7 id="95" title="Contact form 1"]' ); ?>
                </div>
            </div>
        </div>
</section>



<?php get_footer(); ?>
