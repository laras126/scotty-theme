<?php

/*
 *
 * Custom Post Types
 *
 */

// Note that you only need the arguments and register_post_type function here. They are hooked into WordPress in functions.php.

$labels = array(
  'name'                  => _x( 'Recipes', 'Post Type General Name', 'text_domain' ),
  'singular_name'         => _x( 'Recipe', 'Post Type Singular Name', 'text_domain' ),
  'menu_name'             => __( 'Recipes', 'text_domain' ),
  'name_admin_bar'        => __( 'Recipe', 'text_domain' ),
  'archives'              => __( 'Recipe Archives', 'text_domain' ),
  'parent_item_colon'     => __( 'Parent Recipe:', 'text_domain' ),
  'all_items'             => __( 'All Recipes', 'text_domain' ),
  'add_new_item'          => __( 'Add New Recipe', 'text_domain' ),
  'add_new'               => __( 'Add New', 'text_domain' ),
  'new_item'              => __( 'New Recipe', 'text_domain' ),
  'edit_item'             => __( 'Edit Recipe', 'text_domain' ),
  'update_item'           => __( 'Update Recipe', 'text_domain' ),
  'view_item'             => __( 'View Recipe', 'text_domain' ),
  'search_items'          => __( 'Search Recipe', 'text_domain' ),
  'not_found'             => __( 'Not found', 'text_domain' ),
  'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
  'featured_image'        => __( 'Featured Image', 'text_domain' ),
  'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
  'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
  'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
  'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
  'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
  'items_list'            => __( 'Items list', 'text_domain' ),
  'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
  'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
);
$rewrite = array(
  'slug' => 'recipes',
  'with_front' => false
);
$args = array(
  'label'                 => __( 'Recipe', 'text_domain' ),
  'description'           => __( 'Recipe Description', 'text_domain' ),
  'labels'                => $labels,
  'supports'              => array( 'title', 'thumbnail', 'revisions', ),
  'taxonomies'            => array( 'category', 'post_tag', 'recipe_type' ),
  'hierarchical'          => false,
  'public'                => true,
  'show_ui'               => true,
  'show_in_menu'          => true,
  'menu_position'         => 5,
  'menu_icon'             => 'dashicons-carrot',
  'show_in_admin_bar'     => true,
  'show_in_nav_menus'     => true,
  'can_export'            => true,
  'has_archive'           => true,
  'exclude_from_search'   => false,
  'publicly_queryable'    => true,
  'capability_type'       => 'post',
  'rewrite'               => $rewrite
);
register_post_type( 'recipe', $args );


$book_labels = array(
  'name'                  => _x( 'Library', 'Post Type General Name', 'sd' ),
  'singular_name'         => _x( 'Book', 'Post Type Singular Name', 'sd' ),
  'menu_name'             => __( 'Books', 'sd' ),
  'name_admin_bar'        => __( 'Book', 'sd' ),
  'archives'              => __( 'Book Archives', 'sd' ),
  'parent_item_colon'     => __( 'Parent Book:', 'sd' ),
  'all_items'             => __( 'All Books', 'sd' ),
  'add_new_item'          => __( 'Add New Book', 'sd' ),
  'add_new'               => __( 'Add New', 'sd' ),
  'new_item'              => __( 'New Book', 'sd' ),
  'edit_item'             => __( 'Edit Book', 'sd' ),
  'update_item'           => __( 'Update Book', 'sd' ),
  'view_item'             => __( 'View Book', 'sd' ),
  'search_items'          => __( 'Search Book', 'sd' ),
  'not_found'             => __( 'Not found', 'sd' ),
  'not_found_in_trash'    => __( 'Not found in Trash', 'sd' ),
  'featured_image'        => __( 'Featured Image', 'sd' ),
  'set_featured_image'    => __( 'Set featured image', 'sd' ),
  'remove_featured_image' => __( 'Remove featured image', 'sd' ),
  'use_featured_image'    => __( 'Use as featured image', 'sd' ),
  'insert_into_item'      => __( 'Insert into item', 'sd' ),
  'uploaded_to_this_item' => __( 'Uploaded to this item', 'sd' ),
  'items_list'            => __( 'Books list', 'sd' ),
  'items_list_navigation' => __( 'Books list navigation', 'sd' ),
  'filter_items_list'     => __( 'Filter items list', 'sd' ),
);
$book_rewrite = array(
  'slug'                  => 'library',
  'with_front'            => false,
  'pages'                 => true,
  'feeds'                 => true,
);
$book_args = array(
  'label'                 => __( 'Book', 'sd' ),
  'description'           => __( 'Book Description', 'sd' ),
  'labels'                => $book_labels,
  'supports'              => array( 'title', 'excerpt', 'thumbnail', 'trackbacks', 'revisions', ),
  'taxonomies'            => array( 'category', 'post_tag' ),
  'hierarchical'          => false,
  'public'                => true,
  'show_ui'               => true,
  'show_in_menu'          => true,
  'menu_position'         => 5,
  'menu_icon'             => 'dashicons-book-alt',
  'show_in_admin_bar'     => true,
  'show_in_nav_menus'     => false,
  'can_export'            => true,
  'has_archive'           => true,
  'exclude_from_search'   => false,
  'publicly_queryable'    => true,
  'rewrite'               => $book_rewrite,
  'capability_type'       => 'post',
);
register_post_type( 'book', $book_args );

