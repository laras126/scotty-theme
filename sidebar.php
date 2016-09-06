<?php
/**
 * The Template for displaying all single posts
 *
 *
 * @package  WordPress
 * @subpackage  Timber
 */

$data['cats'] = Timber::get_terms('category');
Timber::render( array( 'sidebar.twig' ), $data );
