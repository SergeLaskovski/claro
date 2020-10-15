<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="developer" content="The Web Guys. Serge Laskovski">
<meta name="keywords" content="Claro, claro design, clothes, gifts, souvenir, jandals, hats">
    <meta name="description" content="Claro. A Merchant you can fall in love with">
<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" sizes="16x16" type="image/ico">
    <title>Claro Design</title>
    <?php wp_head(); ?>
</head>
<body  <?php body_class() ?>>

<!--Menu-->
<section class="menu-placeholder p-0 m-0">
    CLARO
</section>
<nav class="navbar navbar-expand-lg sticky-top navbar-fixed-top px-5">
    <a href="/"><img src="<?php echo get_template_directory_uri(); ?>/img/claro-logo.png" alt="Claro" class="nav-logo img-fluid"></a>
    <div class="d-flex d-lg-none align-items-center justify-content-end mob-items">
        <div class="cart-mob">
            <a href="<?php echo get_permalink( woocommerce_get_page_id( 'myaccount' ) ); ?>" title="My account" class="d-block d-lg-none">
                <i class="fa fa-user"></i>
            </a>
        </div>
        <div class="cart-mob"><?php echo do_shortcode("[woo_cart_but]"); ?></div>
        <button class="hamburger hamburger--spring d-block d-lg-none" type="button"  data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <?php
            global $post;
            $thePostID = $post->ID;
            $theCategoryId = get_queried_object()->term_id;
            $primaryNav = wp_get_nav_menu_items('MainMenu');
            if($primaryNav){
                foreach ( $primaryNav as $navItem ) { 
                    if($thePostID == $navItem->object_id || $theCategoryId == $navItem->object_id) { 
                        ?>

                            <li class="nav-item nav-selected"><?php echo $navItem->title; ?></li>
                        <?php
                    }
                    else{
                        ?>

                        <a href="<?php echo $navItem->url; ?>" title="<?php echo $navItem->title; ?>">
                            <li class="nav-item"><?php echo $navItem->title; ?></li>
                        </a>

                        <?php
                    }

                }
                ?>
                <div class="d-block d-lg-none"><?php echo do_shortcode('[wcas-search-form]'); ?></div>
                <?php
            }
            ?>

                        <li class=" d-none d-lg-inline my-auto cart-lg">

                        <a href="#collapseSearch" class="a-block pr-2" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="false" aria-controls="collapseSearch">
                            <i class="fa fa-search"></i>
                        </a>

                        </li>
                        <li class=" d-none d-lg-inline my-auto cart-lg">

                            <?php echo do_shortcode("[woo_cart_but]"); ?>

                        </li>
                        <li class=" d-none d-lg-inline my-auto">
                            <?php
                            
                            if(is_user_logged_in()){
                                ?>
                                <a href="<?php echo get_permalink( woocommerce_get_page_id( 'myaccount' ) ); ?>" class="btn-woo-login">My account</a>
                                <?php
                            } else {
                                ?>
                                <a href="/login" class="btn-woo-login">Sign in/up</a>
                                <?php
                            }
                            
                            ?>
                            
                        </li>
        </ul>
    </div> 

    <?php
        echo (is_user_logged_in() ? '<span class="menu-user">Hi, '.wp_get_current_user()->user_login.'!</span>' : ''); 
    ?>
</nav>
<section class="searchbar p-2 collapse" id="collapseSearch">
    <?php echo do_shortcode('[wcas-search-form]'); ?>
</section>
<!--End Menu-->