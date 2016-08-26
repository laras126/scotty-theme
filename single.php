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


// get recipes with meta key

$context = Timber::get_context();
$post = Timber::query_post();
$context['post'] = $post;

if ( is_singular('book')) {
  $recipe_args = array(
    'meta_key' => 'connected_book',
    'meta_value' => $post->ID,
    'numberposts' => -1,
    'post_type' => 'recipe'
  );
  $context['related_recipes'] = Timber::get_posts($recipe_args);
}

$context['comment_form'] = TimberHelper::get_comment_form();
$context['sidebar_class'] = '-has_sidebar';

if ( function_exists( 'yoast_breadcrumb' ) ) {
    $context['breadcrumbs'] = yoast_breadcrumb('<nav id="breadcrumbs" class="main-breadcrumbs">','</nav>', false );
}

if ( post_password_required( $post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render( array( 'single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig' ), $context );
}
