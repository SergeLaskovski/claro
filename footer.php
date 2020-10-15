

<hr class="footer-shadow mt-5">


<footer class="container-fluid py-5 mt-3 footer-shadow">
    <div class="container-content px-2 px-md-0  mx-auto">
        <div class="row m-0 py-5 px-0 justify-content-start txt-grey footer-nav">
            <div class="col-12 col-md-6 pt-0 px-0">
                <div class="col-12 col-md-8 px-0">
                    <div class="mb-3"><img src="<?php echo get_template_directory_uri(); ?>/img/claro-logo.png" alt="Claro" class="nav-logo img-fluid"></div>
                    <p>We are New Zealand’s leading headwear suppliers in both summer and winter products. We trend towards the surf and sportswear markets but also take note of boutique local trends coming out of smaller independent manufacturers.</p>
                </div>
            </div>
            <div class="col-6 col-md-2 pt-5 pt-md-0">
                <h5 class="txt-bold txt-upper txt-black mb-3">Quick Links</h5>
                <?php

                $footerNav = wp_get_nav_menu_items('FooterMenu');
                if($footerNav){
                    foreach ( $footerNav as $navItem ) { 
                        ?>
                        <a href="<?php echo $navItem->url; ?>"><?php echo $navItem->title; ?></a><br>
                        <?php
                    }
                }

                ?>
            </div>
            <div class="col-6 col-md-2 pt-5 pt-md-0">
                <h5 class="txt-bold txt-upper txt-black mb-3">About us</h5>
                <a href="/category/about/">About</a><br>
                <a href="/category/contact/">Contact</a><br>
            </div>
            <div class="col-12 col-md-2 pt-5 pt-md-0">
                <h5 class="txt-bold txt-upper txt-black mb-3">Follow us</h5>
                <a href="https://www.facebook.com/pages/Claro-Design/917388991726247" >Facebook</a><br>
                <a href="" >Instagram</a><br>
            </div>
        </div>
    </div>
</footer>


<section class="container-fluid footer-copy">
    <div class="container-content px-2 px-md-0 pt-3 pb-3 mx-auto">
        Copyright <?php echo date('Y'); ?> Claro &mdash; Designed & Developed by&nbsp;<a href="https://thewebguys.co.nz" class="a-black" title="The Web Guys. Design, development, SEO">The Web Guys</a>
    </div>
</section>

<?php wp_footer(); ?>

</body>
</html>


