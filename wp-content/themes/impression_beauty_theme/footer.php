<!-- FOOTER -->
<footer>
    <div class="container">

        <div class="row g-4">

            <div class="col-lg-4">
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img
                        src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>"
                        alt="<?php bloginfo( 'name' ); ?>"
                        class="navbar-logo"
                    >
                </a>
                <p class="text-muted mt-3 footer-tagline">
                    <?php bloginfo( 'description' ); ?>
                </p>
            </div>

            <!-- <div class="col-lg-2">
                <h5>Shop</h5>
                <?php
                wp_nav_menu( [
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => '',
                    'fallback_cb'    => 'impression_beauty_footer_fallback',
                ] );
                ?>
            </div> -->

            <div class="col-lg-2">
                <h5>Company</h5>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/about' ) ); ?>">About</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Blog</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>

            <div class="col-lg-2">
                <h5>Legal</h5>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/privacy-policy' ) ); ?>">Privacy Policy</a></li>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Returns</a></li>
                </ul>
            </div>

            <div class="col-lg-2">
                <h5>Follow Us</h5>
                <ul>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">TikTok</a></li>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Pinterest</a></li>
                </ul>
            </div>

        </div>

        <div class="copyright">
            &copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved.
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
