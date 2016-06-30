<?php

// If the Timber plugin isn't activated, print a notice in the admin.
if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}


// Create our version of the TimberSite object
class StarterSite extends TimberSite {

	// This function applies some fundamental WordPress setup, as well as our functions to include custom post types and taxonomies.
	function __construct() {
		add_theme_support( 'post-formats',
			array(
				'image',
				'gallery',
				'video',
				'quote',
				'link'
		) );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		add_action( 'init', array( $this, 'register_menus' ) );
		add_action( 'init', array( $this, 'register_widgets' ) );
		parent::__construct();
	}


	// Abstracting long chunks of code.

	// The following included files only need to contain the arguments and register_whatever functions. They are applied to WordPress in these functions that are hooked to init above.

	// The point of having separate files is solely to save space in this file. Think of them as a standard PHP include or require.

	function register_post_types(){
		require('lib/custom-types.php');
	}

	function register_taxonomies(){
		require('lib/taxonomies.php');
	}

	function register_menus(){
		require('lib/menus.php');
	}

	function register_widgets(){
		require('lib/widgets.php');
	}


	// Access data site-wide.

	// This function adds data to the global context of your site. In less-jargon-y terms, any values in this function are available on any view of your website. Anything that occurs on every page should be added here.

	function add_to_context( $context ) {

		// Our menu occurs on every page, so we add it to the global context.
		$context['menu'] = new TimberMenu();

		// Sidebars
		$context['footer_widgets'] = Timber::get_widgets('footer_widgets');
		$context['header_widgets'] = Timber::get_widgets('header_widgets');

		// This 'site' context below allows you to access main site information like the site title or description.
		$context['site'] = $this;

		// All Categories
		$context['cats'] = Timber::get_terms('category');

		// Posts page link
		$context['posts_page_link'] = get_permalink(get_option('page_for_posts' ));

		return $context;
	}

	// Here you can add your own fuctions to Twig. Don't worry about this section if you don't come across a need for it.
	// See more here: http://twig.sensiolabs.org/doc/advanced.html
	function add_to_twig( $twig ) {
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( 'myfoo', new Twig_Filter_Function( 'myfoo' ) );
		return $twig;
	}

}

new StarterSite();


/*
 *
 * My Functions (not from Timber)
 *
 */

// Enqueue scripts
function sd_scripts() {

	// Use jQuery from a CDN
	wp_deregister_script('jquery');
	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js', array(), null, true);

	// Enqueue our stylesheet and JS file with a jQuery dependency.
	// Note that we aren't using WordPress' default style.css, and instead enqueueing the file of compiled Sass.

	// Use minified on staging and prod, unminified on dev.
	if (WP_ENV == 'development') {
		wp_enqueue_style( 'sd-styles', get_template_directory_uri() . '/assets/css/main.css', 1.0);
		wp_enqueue_script( 'sd-js', get_template_directory_uri() . '/assets/js/build/scripts.js', array('jquery'), '1.0.0', true );
	} else {
		wp_enqueue_style( 'sd-styles', get_template_directory_uri() . '/assets/css/main.min.css', 1.0);
		wp_enqueue_script( 'sd-js', get_template_directory_uri() . '/assets/js/build/scripts.min.js', array('jquery'), '1.0.0', true );
	}
}

add_action( 'wp_enqueue_scripts', 'sd_scripts' );


// Show notice on Dev. and Staging
function sd_env_notice() {
	if (WP_ENV != 'production') {
		echo '<p class="' . WP_ENV . ' env-notice">' . WP_ENV . '</p>';
	}
}
add_action('wp_head', 'sd_env_notice');





// Move excerpt box top top of post editor
// https://wpartisan.me/tutorials/wordpress-how-to-move-the-excerpt-meta-box-above-the-editor

/**
 * Removes the regular excerpt box. We're not getting rid
 * of it, we're just moving it above the wysiwyg editor
 *
 * @return null
 */
function oz_remove_normal_excerpt() {
	remove_meta_box( 'postexcerpt' , 'post' , 'normal' );
}
add_action( 'admin_menu' , 'oz_remove_normal_excerpt' );

/**
 * Add the excerpt meta box back in with a custom screen location
 *
 * @param  string $post_type
 * @return null
 */
function oz_add_excerpt_meta_box( $post_type ) {
	if ( in_array( $post_type, array( 'post', 'recipe' ) ) ) {
		add_meta_box(
			'oz_postexcerpt',
			__( 'Excerpt', 'thetab-theme' ),
			'sd_post_excerpt_meta_box',
			$post_type,
			'after_title',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'oz_add_excerpt_meta_box' );

function sd_post_excerpt_meta_box($post) {
?>
<label class="screen-reader-text" for="excerpt"><?php _e('Excerpt') ?></label><textarea rows="1" cols="40" name="excerpt" tabindex="6" id="excerpt"><?php echo $post->post_excerpt; // textarea_escaped ?></textarea>
<p><?php _e('A sentence summary of this post. It will display at the top of each single post view as well as in loop of posts.'); ?></p>
<?php
}

/**
 * You can't actually add meta boxes after the title by default in WP so
 * we're being cheeky. We've registered our own meta box position
 * `after_title` onto which we've regiestered our new meta boxes and
 * are now calling them in the `edit_form_after_title` hook which is run
 * after the post tile box is displayed.
 *
 * @return null
 */
function oz_run_after_title_meta_boxes() {
	global $post, $wp_meta_boxes;
	# Output the `below_title` meta boxes:
	do_meta_boxes( get_current_screen(), 'after_title', $post );
}
add_action( 'edit_form_after_title', 'oz_run_after_title_meta_boxes' );


