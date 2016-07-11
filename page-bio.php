<?php
/**
 * Template Name: Bio Page
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
Timber::render( 'page-bio.twig', $context );
