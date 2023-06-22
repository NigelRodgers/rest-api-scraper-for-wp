<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @link https://developer.wordpress.org/themes/advanced-topics/child-themes/
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://developer.wordpress.org/plugins/}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * Create your own twentysixteen_setup() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 */
	function twentysixteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
		 * If you're building a theme based on Twenty Sixteen, use a find and replace
		 * to change 'twentysixteen' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'twentysixteen' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for custom logo.
		 *
		 *  @since Twenty Sixteen 1.2
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 240,
				'width'       => 240,
				'flex-height' => true,
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#post-thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'twentysixteen' ),
				'social'  => __( 'Social Links Menu', 'twentysixteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
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

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://wordpress.org/support/article/post-formats/
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'status',
				'audio',
				'chat',
			)
		);

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

		// Load regular editor styles into the new block-based editor.
		add_theme_support( 'editor-styles' );

		// Load default block styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom color scheme.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Dark Gray', 'twentysixteen' ),
					'slug'  => 'dark-gray',
					'color' => '#1a1a1a',
				),
				array(
					'name'  => __( 'Medium Gray', 'twentysixteen' ),
					'slug'  => 'medium-gray',
					'color' => '#686868',
				),
				array(
					'name'  => __( 'Light Gray', 'twentysixteen' ),
					'slug'  => 'light-gray',
					'color' => '#e5e5e5',
				),
				array(
					'name'  => __( 'White', 'twentysixteen' ),
					'slug'  => 'white',
					'color' => '#fff',
				),
				array(
					'name'  => __( 'Blue Gray', 'twentysixteen' ),
					'slug'  => 'blue-gray',
					'color' => '#4d545c',
				),
				array(
					'name'  => __( 'Bright Blue', 'twentysixteen' ),
					'slug'  => 'bright-blue',
					'color' => '#007acc',
				),
				array(
					'name'  => __( 'Light Blue', 'twentysixteen' ),
					'slug'  => 'light-blue',
					'color' => '#9adffd',
				),
				array(
					'name'  => __( 'Dark Brown', 'twentysixteen' ),
					'slug'  => 'dark-brown',
					'color' => '#402b30',
				),
				array(
					'name'  => __( 'Medium Brown', 'twentysixteen' ),
					'slug'  => 'medium-brown',
					'color' => '#774e24',
				),
				array(
					'name'  => __( 'Dark Red', 'twentysixteen' ),
					'slug'  => 'dark-red',
					'color' => '#640c1f',
				),
				array(
					'name'  => __( 'Bright Red', 'twentysixteen' ),
					'slug'  => 'bright-red',
					'color' => '#ff675f',
				),
				array(
					'name'  => __( 'Yellow', 'twentysixteen' ),
					'slug'  => 'yellow',
					'color' => '#ffef8e',
				),
			)
		);

		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );
	}
endif; // twentysixteen_setup()
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Sixteen 1.6
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentysixteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentysixteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentysixteen_resource_hints', 10, 2 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'twentysixteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
	/**
	 * Register Google fonts for Twenty Sixteen.
	 *
	 * Create your own twentysixteen_fonts_url() function to override in a child theme.
	 *
	 * @since Twenty Sixteen 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function twentysixteen_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Merriweather, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
			$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
		}

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Montserrat, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
			$fonts[] = 'Montserrat:400,700';
		}

		/*
		 * translators: If there are characters in your language that are not supported
		 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
			$fonts[] = 'Inconsolata:400';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg(
				array(
					'family'  => urlencode( implode( '|', $fonts ) ),
					'subset'  => urlencode( $subsets ),
					'display' => urlencode( 'fallback' ),
				),
				'https://fonts.googleapis.com/css'
			);
		}

		return $fonts_url;
	}
endif;

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '20201208' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri(), array(), '20201208' );

	// Theme block stylesheet.
	wp_enqueue_style( 'twentysixteen-block-style', get_template_directory_uri() . '/css/blocks.css', array( 'twentysixteen-style' ), '20190102' );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20170530' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20170530' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20170530' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20170530', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20170530' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20181217', true );

	wp_localize_script(
		'twentysixteen-script',
		'screenReaderText',
		array(
			'expand'   => __( 'expand child menu', 'twentysixteen' ),
			'collapse' => __( 'collapse child menu', 'twentysixteen' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Enqueue styles for the block-based editor.
 *
 * @since Twenty Sixteen 1.6
 */
function twentysixteen_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'twentysixteen-block-editor-style', get_template_directory_uri() . '/css/editor-blocks.css', array(), '20201208' );
	// Add custom fonts.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'twentysixteen_block_editor_styles' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ) . substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ) . substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ) . substr( $color, 2, 1 ) );
	} elseif ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array(
		'red'   => $r,
		'green' => $g,
		'blue'  => $b,
	);
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Block Patterns.
 */
require get_template_directory() . '/inc/block-patterns.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 840 <= $width ) {
		$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';
	}

	if ( 'page' === get_post_type() ) {
		if ( 840 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	} else {
		if ( 840 > $width && 600 <= $width ) {
			$sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		} elseif ( 600 > $width ) {
			$sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10, 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return array The filtered attributes for the image markup.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		} else {
			$attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
		}
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Modifies tag cloud widget arguments to display all tags in the same font size
 * and use list format for better accessibility.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array The filtered arguments for tag cloud widget.
 */
function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest']  = 1;
	$args['smallest'] = 1;
	$args['unit']     = 'em';
	$args['format']   = 'list';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );










function create_dropped_call_array(){
	$dropped_calls_string = "302, 324, 624, 641, 674, 701, 744, 768, 864, 952, 962, 1056, 1142, 1205, 1226, 1262, 1337, 1356, 1394, 1406, 1413, 1426, 1448, 1467, 1480, 1502, 1506, 1507, 1508, 1509, 2001, 2099, 2102, 2238, 2275, 2306, 2308, 2309, 2311, 2315, 2316, 2318, 2319, 2320, 2322, 2323, 2325, 2327, 2329, 2330, 2331, 2332, 2335, 2336, 2337, 2338, 2339, 2340, 2341, 2342, 2343, 2344, 2345, 2346, 2347, 2348, 2349, 2350, 2352, 2353, 2355, 2357, 2358, 2359, 2360, 2361, 2362, 2363, 2364, 2365, 2366, 2367, 2368, 2369, 2370, 2371, 2372, 2373, 2374, 2375, 2376, 2377, 2378, 2379, 2381, 2382, 2383, 2384, 2385, 2387, 2388, 2389, 2390, 2391, 2392, 2393, 2394, 2395, 2396, 2397, 2398, 2399, 2400, 2401, 2402, 2403, 2410, 2414, 2418, 2419, 2420, 2421, 2424, 2433, 2445, 2454, 2584, 2607, 2611, 2652, 2663, 2695, 2701";
	$droppedCallsArray = explode(', ', $dropped_calls_string);
	update_option( 'droppedCallsArray', $droppedCallsArray, '', 'yes' ); //changed add_option to update to redo
}
//create_dropped_call_array();

//add previous and next item to array
function previous_iteration_offset(){
	$droppedCalls = get_option( 'droppedCallsArray' );
	$i = 0;
	foreach ($droppedCalls as $currentDroppedCall) {
		if ($droppedCalls[$i + 1] != ($currentDroppedCall + 1)){
			$droppedCalls[] = $currentDroppedCall + 1;
			$droppedCalls[] = $currentDroppedCall + 2;
		}
			
		$i++;
	}
	sort($droppedCalls);
	update_option('droppedCallsArray', $droppedCalls );
}
//previous_iteration_offset();

function change_scraper_log_to_array() {
	$scraperLogItem = array (
		'date' => date('Y-m-d H:i:s'),
		'status' => 'OK',
		'executionTime' => 1

	);
	$scraperLogArray[0] = $scraperLogItem;
	update_option( 'scraperLog', $scraperLogArray ); //
}
//change_scraper_log_to_array();













add_filter( 'cron_schedules', 'wpshout_add_cron_interval' );
function wpshout_add_cron_interval( $schedules ) {
    $schedules['everyminute'] = array(
            'interval'  => 60, // time in seconds
            'display'   => 'Every Minute'
    );
    return $schedules;
}



//add_action('wp', 'scraperJob');
function scraperJob() {
	if(!wp_next_scheduled( "scraperRep")){
		wp_schedule_event( (current_time('timestamp')), 'everyminute', "scraperRep" );
	}
}

add_action ( "scraperRep", 'scraper_setup');

function runScraper () {
	
}



//custom action hook
function scraper_hook() {
	do_action('scraper_hook');
}
add_action('scraper_hook', 'scraper_setup', 7);
function scraper_setup() {

	//wp requires
	require_once(ABSPATH . 'wp-admin/includes/media.php');
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	require_once(ABSPATH . 'wp-admin/includes/image.php');
	require_once( ABSPATH . '/wp-admin/includes/taxonomy.php');
	/*replace examplesite.com with your website */
	$response = wp_remote_get( 'https://examplesite.com/wp-json/wp/v2/posts?_embed&per_page=3');
	$posts = json_decode( wp_remote_retrieve_body( $response));
	$responseMessage =wp_remote_retrieve_response_message( $response );

	

	//echo '<div class="latest-posts">';
	//print_r( $responseMessage); //http response code. Will show 'OK' for 200
	//print_r( $catResponseMessage); //category response
	//echo '<h1>Rest Atempt At '.date('Y-m-d H:i:s').'</h1>';


	//initializing scraper options
	//this will be changed to an array
	$logString = "Time: &nbsp;&nbsp; Current Iteration: &nbsp;&nbsp; HTTP Response: &nbsp;&nbsp; Time Taken:<br>\n";
		add_option( 'scraperLog', $logString, '', 'yes' );
		add_option( 'scraperIterationCount', 0, '', 'yes' );

	if((get_option('scraperIterationCount') > -1) && get_option('scraperLog')!= "Time: &nbsp;&nbsp; Current Iteration: &nbsp;&nbsp; HTTP Response: &nbsp;&nbsp; Time Taken:<br>\n" ){
		$totalExecutionTime = microtime(true);
		
		//cleanup dropped calls
		
		$currentIteration = get_option( 'scraperIterationCount' );
		$droppedCallsArray = get_option( 'droppedCallsArray' );

		//$currentPage = $droppedCallsArray[ $currentIteration ]; //this is for running through failed http calls
		$currentPage = $currentIteration;
		//Random user agents
		// https://elwpin.com/2017/06/10/random-user-agents-for-wordpress-remote-requests/

		function random_user_agent(){
			$agents=array(
				'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2',
				'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
				'Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)',
				'Mozilla/5.0 (Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko',
				'Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14',
				'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A'
			);
			 
			$chose=rand(0,5);
			return $agents[$chose];
		}
		
		$response = wp_remote_get( "https://examplesite.com/wp-json/wp/v2/posts?_embed&per_page=20&page=".$currentPage, array('user-agent'=>random_user_agent()));
		//$response = wp_remote_get( "https://examplesite.com/wp-json/wp/v2/posts?_embed&per_page=3&page=5", array('user-agent'=>random_user_agent()));
		$posts = json_decode( wp_remote_retrieve_body( $response));
		$responseMessage =wp_remote_retrieve_response_message( $response );
		
		

		//loop through up to 100 posts retrieved via rest and insert them into new site


		foreach($posts as $post ) {
			if ( 'publish' !== get_post_status ( $post->id ) || ('publish' === get_post_status ( $post->id ) && 'post' !== get_post_type( $post->id ) ) ) { //create post if post with this id doesn't exist. Second conditional post id may exist already in media.

				//reformat $post->date string. REST returns something like "2021-03-07T11:31:15" so need to remove the 'T' and return something like "2021-03-07 11:31:15"
				$date_str = $post->date;
				$regex_pattern = '/T/i';
				$date_str = preg_replace($regex_pattern, ' ', $date_str); 

				//do same as above for gmt date. (future advice: create function to reformat if needed)
				$gmt_str = $post->date_gmt;
				$gmt_str = preg_replace( $regex_pattern, ' ', $gmt_str);

				$post_data = array(
					'post_title'    => $post->title->rendered,
					'post_content'  => $post->content->rendered,
					'import_id'     => $post->id,
					'post_status'   => 'publish',
					'post_type'     => 'post',
					'post_author'   => '1',
					'post_date'     => $date_str,
					'post_date_gmt' => $gmt_str,
					'post_slug'		=> $post->slug

				);

				//set category

				$oldCatCount = 0;
				$newCurrentPostCategoriesArray= array(); //will get category id from rest and place matching local id in the array.
				foreach ($post->categories as $oldCategory){
					$args = array(
						'hide_empty' => false, // also retrieve terms which are not used yet (with 0 post count)
						'meta_query' => array(
							array(
							'key'       => 'oldCatID',
							'value'     => $oldCategory,
							'compare'   => '='
							)
						),
						'taxonomy'  => 'category',
					);
					$terms = get_terms( $args );
					
					$newCurrentPostCategoriesArray[$oldCatCount] = $terms[0]->term_id;
					$oldCatCount++;
					//echo "<br><br><br>current term ID: ".$terms[0]->term_id." old term ID: ".$oldCategory;
				}
				$post_data['post_category'] = $newCurrentPostCategoriesArray; 
				
				
				wp_insert_post( $post_data );    
				media_sideload_image( $post->_embedded->{'wp:featuredmedia'}{'0'}->source_url, $post->id, $post->_embedded->{'wp:featuredmedia'}{'0'}->title->rendered );
				$attachments = get_posts(array('numberposts' => '1', 'post_parent' => $post->id, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC'));


				if(sizeof($attachments) > 0){
					// set image as the post thumbnail
					set_post_thumbnail($post->id, $attachments[0]->ID);
				}  
			}
		}




		$totalExecutionTime = round(microtime(true) - $totalExecutionTime, 2 );
		//$logString = get_option('scraperLog').date('Y-m-d H:i:s')." UTC &nbsp;&nbsp;|&nbsp;&nbsp; $currentPage &nbsp;&nbsp;|&nbsp;&nbsp; $responseMessage &nbsp;&nbsp;|&nbsp;&nbsp; $totalExecutionTime &nbsp;&nbsp;|&nbsp;&nbsp; ".wp_count_posts()->publish."<br>\n";
		
		$scraperLogItem = array (
			'date' => date('Y-m-d H:i:s'),
			'status' => $responseMessage,
			'executionTime' => $totalExecutionTime,
			'currentPage' => $currentPage,
			'postCount' => wp_count_posts()->publish
	
		);
		$scraperLogArray = get_option('scraperLog');
		$scraperLogArray[] = $scraperLogItem;



		update_option( 'scraperLog', $scraperLogArray );
		update_option( 'scraperIterationCount', get_option('scraperIterationCount') + 1 );
		
		//echo get_option( 'scraperLog' );

	}else{
		//first time running set up categories
		
		$catResponse = wp_remote_get( 'https://examplesite.com/wp-json/wp/v2/categories?per_page=30');
		$categories = json_decode( wp_remote_retrieve_body( $catResponse));
		$CatresponseMessage =wp_remote_retrieve_response_message( $catResponse );


		//Categories loop. wp_insert_category automatically checks if term already exists but ideally loop only needs to run once. Fix later

		// //Loop through all categories retrieved via REST and insert them in site
		$categories_array=array();
		foreach ($categories as $category) {
			
			$category_data = array(
				'cat_name'          => $category->name, //category name eg "Africa"
				'category_nicename' => $category->slug, //slug eg "africa"
			);
			$category_id = wp_insert_category( $category_data ); //create category on new site
				
			add_term_meta( $category_id, 'oldCatID', $category->id, true ); 
		}

		//Temporary for testing: checking retrieval of meta

		// foreach ( get_categories(array( 'hide_empty' => false )) as $category ) :
		// 	$catID = $category->cat_ID;
		// 	$oldIDs = get_term_meta( $catID, 'oldCatIDs', true );
		// 	echo $category->name.' id: '.$catID.'&nbsp;old: '.implode(', ', $oldIDs).'<br>';
		// endforeach;
		

		$logString = "<p>Categories have been set up</p>\n"."Time: &nbsp;&nbsp; Current Iteration: &nbsp;&nbsp; HTTP Response: &nbsp;&nbsp; Time Taken:<br>\n";
		update_option( 'scraperLog', $logString );
		update_option( 'scraperIterationCount', 1 );



		
	}
}

