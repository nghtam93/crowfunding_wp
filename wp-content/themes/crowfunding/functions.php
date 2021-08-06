<?php


/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since v1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 800;
}


/**
 * General Theme Settings.
 *
 * @since v1.0
 */
if ( ! function_exists( 'crowfunding_setup_theme' ) ) :
	function crowfunding_setup_theme() {
		// Make theme available for translation: Translations can be filed in the /languages/ directory.
		load_theme_textdomain( 'crowfunding', get_template_directory() . '/languages' );

		// Theme Support.
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
				'navigation-widgets',
			)
		);

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );
		// Add support for full and wide alignment.
		add_theme_support( 'align-wide' );
		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Default Attachment Display Settings.
		update_option( 'image_default_align', 'none' );
		update_option( 'image_default_link_type', 'none' );
		update_option( 'image_default_size', 'large' );

		// Custom CSS-Styles of Wordpress Gallery.
		add_filter( 'use_default_gallery_style', '__return_false' );

	}
	add_action( 'after_setup_theme', 'crowfunding_setup_theme' );

	// Disable Block Directory: https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/filters/editor-filters.md#block-directory
	remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );
	remove_action( 'enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory' );
endif;




/**
 * Init Widget areas in Sidebar.
 *
 * @since v1.0
 */
function crowfunding_widgets_init() {
	// Area 3.
	register_sidebar(
		array(
			'name'          => 'Home Page',
			'id'            => 'home_page',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
	
	// Area 1.
	register_sidebar(
		array(
			'name'          => 'Primary Widget Area (Sidebar)',
			'id'            => 'primary_widget_area',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Area 2.
	register_sidebar(
		array(
			'name'          => 'Secondary Widget Area (Header Navigation)',
			'id'            => 'secondary_widget_area',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Area 3.
	register_sidebar(
		array(
			'name'          => 'Third Widget Area (Footer)',
			'id'            => 'third_widget_area',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	
}
add_action( 'widgets_init', 'crowfunding_widgets_init' );



/**
 * Nav menus.
 *
 * @since v1.0
 */
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
			'main-menu'   => 'Main Navigation Menu',
			'mobile-menu' => 'Mobile Menu',
			'footer-menu' => 'Footer Menu',
		)
	);
}

// Custom Nav Walker: wp_bootstrap_navwalker().
$custom_walker = get_template_directory() . '/inc/wp_bootstrap_navwalker.php';
if ( is_readable( $custom_walker ) ) {
	require_once $custom_walker;
}

$custom_walker_footer = get_template_directory() . '/inc/wp_bootstrap_navwalker_footer.php';
if ( is_readable( $custom_walker_footer ) ) {
	require_once $custom_walker_footer;
}

$custom_post_types = get_template_directory() . '/inc/post_types.php';
if ( is_readable( $custom_post_types ) ) {
	require_once $custom_post_types;
}

$custom_theme_widgets = get_template_directory() . '/inc/theme_widgets.php';
if ( is_readable( $custom_theme_widgets ) ) {
	require_once $custom_theme_widgets;
}

$custom_theme_apis = get_template_directory() . '/inc/theme_apis.php';
if ( is_readable( $custom_theme_apis ) ) {
	require_once $custom_theme_apis;
}


/**
 * Loading All CSS Stylesheets and Javascript Files.
 *
 * @since v1.0
 */
function crowfunding_scripts_loader() {
	$theme_version = wp_get_theme()->get( 'Version' );

	$header_css = [
		'bootstrap' => 'assets/libs/bootstrap/css/bootstrap.min.css',
		'animate' 	=> 'assets/css/animate.min.css',
		'icomoon' 	=> 'assets/libs/icomoon/style.css',
		'rangeSlider' 	=> 'assets/libs/ion-rangeSlider/css/ion.rangeSlider.min.css',
		'flickity' 	=> 'assets/libs/flickity/flickity.min.css',
		'main' 	=> 'assets/css/main.css',
	];

	$header_js = [
		'jquery' => 'assets/js/jquery.min.3.5.1.js',
		'flickity' => 'assets/libs/flickity/flickity.pkgd.min.js',
	];


	$footer_js = [
		'bootstrap' => 'assets/libs/bootstrap/js/bootstrap.bundle.min.js',
		'rangeSlider' => 'assets/libs/ion-rangeSlider/js/ion.rangeSlider.min.js',
		'wow' => 'assets/js/wow.min.js',
		'main' => 'assets/js/main.js',
	];



	// 1. Styles.
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css', array(), $theme_version, 'all' );

	foreach ($header_css as $key => $value) {
		wp_enqueue_style( $key, get_template_directory_uri() .'/'. $value, array(), $theme_version, 'all' );
	}


	// 2. Scripts.
	wp_enqueue_script( 'axios', '//unpkg.com/axios/dist/axios.min.js', array(), $theme_version, false );
	//wp_enqueue_script( 'vue', '//cdn.jsdelivr.net/npm/vue@2', array(), $theme_version, false );
	wp_enqueue_script( 'vue', '//cdn.jsdelivr.net/npm/vue@2/dist/vue.js', array(), $theme_version, false );

	foreach ($header_js as $key => $value) {
		wp_enqueue_script( $key, get_template_directory_uri() .'/'. $value, array(), $theme_version, false );
	}
	foreach ($footer_js as $key => $value) {
		wp_enqueue_script( $key, get_template_directory_uri() .'/'. $value, array(), $theme_version, true );
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'crowfunding_scripts_loader' );
