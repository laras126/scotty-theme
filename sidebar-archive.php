<?php
/**
 * The Template for displaying all single posts
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 */

$data['title'] = post_type_archive_title( '', false );
$data['cats'] = Timber::get_terms('category');
Timber::render( array( 'sidebar-archive.twig' ), $data );
