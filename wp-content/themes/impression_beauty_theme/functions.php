<?php

// ──────────────────────────────────────────────
// Theme Setup
// ──────────────────────────────────────────────
function impression_beauty_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ] );

    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'impression_beauty_theme' ),
        'footer'  => __( 'Footer Navigation',  'impression_beauty_theme' ),
    ] );
}
add_action( 'after_setup_theme', 'impression_beauty_setup' );


// ──────────────────────────────────────────────
// Enqueue Styles & Scripts
// ──────────────────────────────────────────────
function impression_beauty_enqueue_assets() {

    // Google Fonts – Poppins
    wp_enqueue_style(
        'impression-google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    // Bootstrap 5.3.3 CSS
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        [],
        '5.3.3'
    );

    // Theme main stylesheet (load after bootstrap so overrides apply)
    wp_enqueue_style(
        'impression-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [ 'bootstrap' ],
        filemtime( get_template_directory() . '/assets/css/main.css' )
    );

    // Bootstrap 5.3.3 JS bundle (footer)
    wp_enqueue_script(
        'bootstrap-bundle',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        [],
        '5.3.3',
        true
    );

    // Custom JS (footer, depends on bootstrap)
    wp_enqueue_script(
        'impression-main-js',
        get_template_directory_uri() . '/assets/js/main.js',
        [ 'bootstrap-bundle' ],
        '1.0.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'impression_beauty_enqueue_assets' );


// ──────────────────────────────────────────────
// Bootstrap Nav Walker
// Only overrides start_lvl/end_lvl so the submenu <ul> gets
// Bootstrap's 'dropdown-menu' class. All <li>/<a> classes are
// still applied by the filters below via the parent start_el().
// Passing an INSTANCE to wp_nav_menu() is what makes
// $args->walker an object so has_children is readable in filters.
// ──────────────────────────────────────────────
class Impression_Beauty_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '<ul class="dropdown-menu">';
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        $output .= '</ul>';
    }
}

// ──────────────────────────────────────────────
// Bootstrap Nav Classes (primary menu only)
// ──────────────────────────────────────────────

// <li> classes: nav-item, dropdown (when has children), ms-lg-3 (for btn items)
add_filter( 'nav_menu_css_class', function( $classes, $item, $args, $depth ) {
    if ( ! isset( $args->theme_location ) || $args->theme_location !== 'primary' ) {
        return $classes;
    }

    if ( $depth === 0 ) {
        $classes[] = 'nav-item';
        if ( $args->walker->has_children ) {
            $classes[] = 'dropdown';
        }
        if ( in_array( 'btn-beauty', (array) $item->classes, true ) ) {
            $classes[] = 'ms-lg-3';
        }
    }

    return $classes;
}, 10, 4 );

// <a> attributes: nav-link / dropdown-toggle / btn btn-beauty / dropdown-item
add_filter( 'nav_menu_link_attributes', function( $atts, $item, $args, $depth ) {
    if ( ! isset( $args->theme_location ) || $args->theme_location !== 'primary' ) {
        return $atts;
    }

    if ( $depth === 0 ) {
        if ( in_array( 'btn-beauty', (array) $item->classes, true ) ) {
            $atts['class'] = 'btn btn-beauty';
        } elseif ( $args->walker->has_children ) {
            $atts['class']          = 'nav-link dropdown-toggle';
            $atts['data-bs-toggle'] = 'dropdown';
            $atts['aria-expanded']  = 'false';
        } else {
            $atts['class'] = 'nav-link';
        }
    } else {
        $atts['class'] = 'dropdown-item';
    }

    return $atts;
}, 10, 4 );

// Fallback nav when no menu is assigned in WP admin
function impression_beauty_nav_fallback() {
    echo '<ul class="navbar-nav ms-auto align-items-lg-center">';
    echo '<li class="nav-item"><a class="nav-link" href="' . esc_url( home_url( '/' ) ) . '">Shop</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="#">Skin Care</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="#">Makeup</a></li>';
    echo '<li class="nav-item"><a class="nav-link" href="#">Best Sellers</a></li>';
    echo '<li class="nav-item ms-lg-3"><a class="btn btn-beauty" href="#">Shop Now</a></li>';
    echo '</ul>';
}

// Fallback footer nav
function impression_beauty_footer_fallback() {
    echo '<ul>';
    echo '<li><a href="#">Skin Care</a></li>';
    echo '<li><a href="#">Makeup</a></li>';
    echo '<li><a href="#">Beauty Care</a></li>';
    echo '<li><a href="#">Best Sellers</a></li>';
    echo '</ul>';
}


add_action('init', 'register_my_acf_blocks');
function register_my_acf_blocks()
{
    register_block_type(__DIR__ . '/blocks/about-hero');
}