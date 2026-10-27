<!-- FOOTER -->
<footer>
    <div class="container">

        <div class="row g-4">

            <div class="col-lg-4">
                <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                    <img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>"
                        alt="<?php bloginfo('name'); ?>"
                        class="navbar-logo">
                </a>
                <!-- <p class="text-muted mt-3 footer-tagline">
                    <?php //bloginfo('description'); ?>
                </p> -->
            </div>

            <!-- <div class="col-lg-2">
                <h5>Shop</h5>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => '',
                    'fallback_cb'    => 'impression_beauty_footer_fallback',
                ]);
                ?>
            </div> -->

            <?php
            // Columns are edited under Footer in the admin. Until they are saved, use these defaults.
            $footer_columns = get_field('footer_columns', 'option');
            if (!$footer_columns) {
                $page_url = function ($slug) {
                    $page = get_page_by_path($slug);
                    return $page ? get_permalink($page) : '';
                };
                $footer_columns = [
                    ['heading' => 'Company', 'links' => [
                        ['label' => 'About',   'page' => $page_url('about-us'),   'url' => ''],
                        ['label' => 'Contact', 'page' => $page_url('contact-us'), 'url' => ''],
                        ['label' => 'News',    'page' => $page_url('news'),       'url' => ''],
                        ['label' => 'Support', 'page' => '', 'url' => 'mailto:' . impression_enquiry_email()],
                    ]],
                    ['heading' => 'Follow Us', 'links' => [
                        ['label' => 'Facebook',       'page' => '', 'url' => 'https://www.facebook.com/impressionfacebody'],
                        ['label' => 'Instagram',      'page' => '', 'url' => 'https://www.instagram.com/impressionfacebody/'],
                        ['label' => 'WhatsApp',       'page' => '', 'url' => 'https://wa.me/' . impression_whatsapp_number()],
                        ['label' => 'Beauty Insider', 'page' => '', 'url' => 'https://beautyinsider.sg/establishment/impression-beauty/'],
                    ]],
                    ['heading' => 'Legal', 'links' => [
                        ['label' => 'Privacy Policy', 'page' => $page_url('privacy-policy'),       'url' => ''],
                        ['label' => 'Terms',          'page' => $page_url('terms-and-conditions'), 'url' => ''],
                    ]],
                ];
            }
            ?>

            <?php foreach ($footer_columns as $column) : ?>
                <div class="col-lg-2">
                    <h5><?php echo esc_html($column['heading'] ?? ''); ?></h5>
                    <ul>
                        <?php foreach ((array) ($column['links'] ?? []) as $link) :
                            $href = !empty($link['page']) ? $link['page'] : ($link['url'] ?? '');
                            if (!$href) {
                                continue;
                            }
                            // Other websites open in a new tab.
                            $external = strpos($href, 'http') === 0 && strpos($href, home_url()) !== 0;
                            ?>
                            <li><a href="<?php echo esc_url($href); ?>"<?php echo $external ? ' target="_blank" rel="noopener"' : ''; ?>><?php echo esc_html($link['label'] ?? ''); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>

        </div>

        <div class="copyright">
            &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.
        </div>

    </div>
</footer>

<!-- Floating WhatsApp button: wa.me opens the app on phones, WhatsApp Web on desktop -->
<a href="https://wa.me/<?php echo esc_attr(impression_whatsapp_number()); ?>"
   class="whatsapp-float"
   target="_blank"
   rel="noopener"
   aria-label="Chat with us on WhatsApp">
    <svg viewBox="0 0 24 24" width="30" height="30" fill="currentColor" aria-hidden="true">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
    </svg>
</a>

<?php wp_footer(); ?>
</body>

</html>

