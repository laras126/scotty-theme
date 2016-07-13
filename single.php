<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

// for use in single.php (where $post is available)

// start of the tax_query arguments
$args = array(
  'tax_query' => array( 'relation' => 'AND' ),
  'post_type' => 'recipe'
);

// get current post categories
$categories = wp_get_object_terms( $post->ID, 'recipe_type', array( 'fields' => 'ids' ) );

$args['tax_query'][] = array(
  'taxonomy' => 'recipe_type',
  'field'    => 'id',
  'terms'    => $categories,
);

// }

// get current post tags
$tags = wp_get_object_terms( $post->ID, 'post_tag', array( 'fields' => 'ids' ) );

// if ( !empty( $tags ) ) {
//   $args['tax_query'][] = array(
//     'taxonomy' => 'post_tag',
//     'field'    => 'id',
//     'terms'    => $tags,
//     'operator' => 'NOT IN'
//   );
// }

// the query
$related_query = new WP_Query( $args );



$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;
$context['comment_form'] = TimberHelper::get_comment_form();
$context['sidebar_class'] = '-has_sidebar';

$context['related_recipes'] = Timber::get_posts($related_query);

if ( function_exists( 'yoast_breadcrumb' ) ) {
    $context['breadcrumbs'] = yoast_breadcrumb('<nav id="breadcrumbs" class="main-breadcrumbs">','</nav>', false );
}

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
