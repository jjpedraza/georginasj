<?php
/**
 * Describe child theme functions
 *
 * @package Easy Store
 * @subpackage Easy Shop
 * 
 */

/*-------------------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'easy_shop_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function easy_shop_setup() {
    
    //Added image size
    //add_image_size( 'easy-shop-horizontal-thumb', 580, 195, true );

    $easy_shop_theme_info = wp_get_theme();
    $GLOBALS['easy_shop_version'] = $easy_shop_theme_info->get( 'Version' );
}
endif;

add_action( 'after_setup_theme', 'easy_shop_setup' );

/*-------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Register Google fonts for News Portal Lite.
 *
 * @return string Google fonts URL for the theme.
 * @since 1.0.0
 */
if ( ! function_exists( 'easy_shop_fonts_url' ) ) :
    function easy_shop_fonts_url() {

        $fonts_url = '';
        $font_families = array();

        /*
         * Translators: If there are characters in your language that are not supported
         * by Roboto, translate this to 'off'. Do not translate into your own language.
         */
        if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'easy-shop' ) ) {
            $font_families[] = 'Roboto:300,400,400i,500,700';
        }

        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/*-------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Managed the theme default color
 */
function easy_shop_customize_register( $wp_customize ) {
		global $wp_customize;

		$wp_customize->get_setting( 'easy_store_primary_theme_color' )->default = '#FA5555';

        $wp_customize->get_setting( 'easy_store_secondary_theme_color' )->default = '#E63737';

	}

add_action( 'customize_register', 'easy_shop_customize_register', 20 );

/*-------------------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue child theme styles and scripts
 */
add_action( 'wp_enqueue_scripts', 'easy_shop_scripts', 20 );

function easy_shop_scripts() {
    
    global $easy_shop_version;
    
    wp_enqueue_style( 'easy-shop-google-font', easy_shop_fonts_url(), array(), null );
    
    wp_dequeue_style( 'easy-store-style' );
    
    wp_dequeue_style( 'easy-store-responsive-style' );
    
	wp_enqueue_style( 'easy-store-parent-style', get_template_directory_uri() . '/style.css', array(), esc_attr( $easy_shop_version ) );
    
    wp_enqueue_style( 'easy-store-parent-responsive', get_template_directory_uri() . '/assets/css/es-responsive.css', array(), esc_attr( $easy_shop_version ) );
    
    wp_enqueue_style( 'easy-shop-style', get_stylesheet_uri(), array(), esc_attr( $easy_shop_version ) );
    
    $get_categories = get_categories( array( 'hide_empty' => 1 ) );
    
    $easy_shop_primary_theme_color = get_theme_mod( 'easy_store_primary_theme_color', '#0D88D2' );
    $easy_shop_secondary_theme_color = get_theme_mod( 'easy_store_secondary_theme_color', '#0D88D2' );
    
    $output_css = '';
    

    $output_css .= ".edit-link .post-edit-link,.reply .comment-reply-link,.widget_search .search-submit,.widget_search .search-submit,.woocommerce .price-cart:after,.woocommerce ul.products li.product .price-cart .button:hover,.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover,.woocommerce a.button.alt:hover,.woocommerce button.button.alt:hover,.woocommerce input.button.alt:hover,.woocommerce .added_to_cart.wc-forward:hover,.woocommerce ul.products li.product .onsale, .woocommerce span.onsale,.woocommerce #respond input#submit.alt.disabled,.woocommerce #respond input#submit.alt.disabled:hover,.woocommerce #respond input#submit.alt:disabled,.woocommerce #respond input#submit.alt:disabled:hover,.woocommerce #respond input#submit.alt[disabled]:disabled,.woocommerce #respond input#submit.alt[disabled]:disabled:hover,.woocommerce a.button.alt.disabled,.woocommerce a.button.alt.disabled:hover,.woocommerce a.button.alt:disabled,.woocommerce a.button.alt:disabled:hover,.woocommerce a.button.alt[disabled]:disabled,.woocommerce a.button.alt[disabled]:disabled:hover,.woocommerce button.button.alt.disabled,.woocommerce button.button.alt.disabled:hover,.woocommerce button.button.alt:disabled,.woocommerce button.button.alt:disabled:hover,.woocommerce button.button.alt[disabled]:disabled,.woocommerce button.button.alt[disabled]:disabled:hover,.woocommerce input.button.alt.disabled,.woocommerce input.button.alt.disabled:hover,.woocommerce input.button.alt:disabled,.woocommerce input.button.alt:disabled:hover,.woocommerce input.button.alt[disabled]:disabled,.woocommerce input.button.alt[disabled]:disabled:hover,.woocommerce-info, .woocommerce-noreviews, p.no-comments,#masthead .site-header-cart .cart-con.tents:hover,.es-main-menu-wrapper .mt-container,#site-navigation ul.sub-menu,#site-navigation ul.children,.easy_store_slider .es-slide-btn a:hover,.woocommerce-active .es-product-buttons-wrap a:hover,.woocommerce-active ul.products li.product .button:hover,.easy_store_testimonials .es-single-wrap .image-holder::after,.easy_store_testimonials .lSSlideOuter .lSPager.lSpg > li:hover a,.easy_store_testimonials .lSSlideOuter .lSPager.lSpg > li.active a,.cta-btn-wrap a,.main-post-wrap .post-date-wrap,.list-posts-wrap .post-date-wrap,.entry-content-wrapper .post-date-wrap,.widget .tagcloud a:hover,#es-scrollup,.easy_store_social_media a,.is-sticky .es-main-menu-wrapper, #masthead .site-header-cart .cart-contents:hover,.es-top-header-wrap{ background: ". esc_attr( $easy_shop_primary_theme_color ) ."}\n";
    
    $output_css .= "a,.entry-footer a:hover,.comment-author .fn .url:hover,.commentmetadata .comment-edit-link,#cancel-comment-reply-link,#cancel-comment-reply-link:before,.logged-in-as a,.widget a:hover,.widget a:hover::before,.widget li:hover::before,.woocommerce .woocommerce-message:before,.woocommerce div.product p.price ins,.woocommerce div.product span.price ins,.woocommerce div.product p.price del,.woocommerce .woocommerce-info:before,.woocommerce .star-rating span::before,.woocommerce-account .woocommerce .woocommerce-MyAccount-navigation ul a:hover,.woocommerce-account .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a:hover,.es-top-header-wrap .item-icon,.promo-items-wrapper .item-icon-wrap,.main-post-wrap .blog-content-wrapper .news-title a:hover,.list-posts-wrap .blog-content-wrapper .news-title a:hover,.entry-content-wrapper .entry-title a:hover,.blog-content-wrapper .post-meta span:hover, .blog-content-wrapper .post-meta span a:hover,.entry-content-wrapper .post-meta span:hover,.entry-content-wrapper .post-meta span a:hover,#footer-navigation ul li a:hover,.custom-header .breadcrumb-trail.breadcrumbs ul li a,.es-product-title-wrap a:hover .woocommerce-loop-product__title { color: ". esc_attr( $easy_shop_primary_theme_color ) ."}\n";
    
    $output_css .= ".navigation .nav-links a,.bttn,button,input[type='button'],input[type='reset'],input[type='submit'],.widget_search .search-submit,.woocommerce form .form-row.woocommerce-validated .select2-container,.woocommerce form .form-row.woocommerce-validated input.input-text,.woocommerce form .form-row.woocommerce-validated select,.tagcloud a:hover { border-color: ". esc_attr( $easy_shop_primary_theme_color ) ."}\n";
    
    $output_css .= ".comment-list .comment-body { border-top-color: ". esc_attr( $easy_shop_primary_theme_color ) ."}\n";
    
    $output_css .= "@media (max-width: 768px){.es-main-menu-wrapper #site-navigation { background: ". esc_attr( $easy_shop_primary_theme_color ) ."}}\n";
    
    $output_css .= ".navigation .nav-links a:hover,.bttn:hover,button,input[type='button']:hover,input[type='reset']:hover,input[type='submit']:hover,.home .es-home-icon a,.es-home-icon a:hover,#site-navigation ul li.current-menu-item>a,#site-navigation ul li:hover>a,#site-navigation ul li.current_page_ancestor>a,.es-wishlist-btn,.es-slide-btn a,.es-slider-section .lSAction a:hover,.easy_store_featured_products .carousel-nav-action .carousel-controls:hover,.woocommerce span.onsale, .woocommerce ul.products li.product .onsale,.es-product-buttons-wrap a.add_to_wishlist:hover,.easy_store_call_to_action .cta-btn-wrap a:hover,.easy_store_social_media a:hover,#masthead .is-sticky #site-navigation ul li.current-menu-item > a, #masthead .is-sticky #site-navigation ul li:hover > a, #masthead .is-sticky #site-navigation ul li.current_page_ancestor > a { background: ". esc_attr( $easy_shop_secondary_theme_color ) ."}\n";        
    
    $output_css .= "a:hover,a:focus,a:active,.woocommerce .price_label,.woocommerce.single-product div.product .price,.easy_store_advance_product_search .woocommerce-product-search .searchsubmit:hover,.price,.woocommerce ul.products li.product .price,.easy_store_categories_collection .es-coll-link,.easy_store_testimonials .es-single-wrap .post-author,.cta-content span,.custom-header .breadcrumb-trail.breadcrumbs ul li a:hover{ color: ". esc_attr( $easy_shop_secondary_theme_color ) ."}\n";
    
    $output_css .= ".navigation .nav-links a:hover,.bttn:hover,button,input[type='button']:hover,input[type='reset']:hover,input[type='submit']:hover,.easy_store_featured_products .carousel-nav-action .carousel-controls:hover{ border-color: ". esc_attr( $easy_shop_secondary_theme_color ) ."}\n";
    
    $output_css .= "@media (max-width: 768px){.es-main-menu-wrapper .menu-toggle:hover { background: ". esc_attr( $easy_shop_secondary_theme_color ) ."}}\n";
    
    $output_css .= "#es-scrollup{ border-bottom-color: ". esc_attr( $easy_shop_secondary_theme_color ) ."}\n";
    
    $output_css .= "#masthead #site-navigation ul li.current-menu-item > a, #masthead #site-navigation ul li:hover > a, #masthead #site-navigation ul li.current_page_ancestor > a,.es-main-menu-wrapper .menu-toggle:hover{ color: ". esc_attr( $easy_shop_secondary_theme_color ) ." !important}\n";
    
    $output_css .= "@media (max-width: 768px){ body #masthead #site-navigation ul li.current-menu-item > a, body #masthead #site-navigation ul li:hover > a, body #masthead #site-navigation ul li.current_page_ancestor > a{ background: ". esc_attr( $easy_shop_secondary_theme_color ) ." !important}}\n";
                
    $refine_output_css = easy_store_css_strip_whitespace( $output_css );

    wp_add_inline_style( 'easy-shop-style', $refine_output_css );
    
}