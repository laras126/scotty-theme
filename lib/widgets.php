<?php

/*
 *
 * Widgets and Sidebars
 *
 */

// Register your widgets and sidebars here.

$header_widgets = array(
  'name' => __( 'Header Widgets', 'scotty' ),
  'id' => 'header_widgets',
  'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'scotty' ),
  'before_widget' => '<li id="%1$s" class="widget %2$s">',
  'after_widget'  => '</li>',
  'before_title'  => '<h2 class="widgettitle">',
  'after_title'   => '</h2>'
);

$footer_widgets = array(
  'name' => __( 'Footer Widgets', 'scotty' ),
  'id' => 'footer_widgets',
  'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'scotty' ),
  'before_widget' => '<li id="%1$s" class="widget %2$s">',
  'after_widget'  => '</li>',
  'before_title'  => '<h2 class="widgettitle">',
  'after_title'   => '</h2>'
);

register_sidebar($header_widgets);
register_sidebar($footer_widgets);

