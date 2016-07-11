<?php

/*
 *
 * Taxonomies
 *
 */

// Same as with Custom Types, you only need the arguments and register_taxonomy function here. They are hooked into WordPress in functions.php.

$labels = array(
  'name'                       => _x( 'Recipe Types', 'Taxonomy General Name', 'text_domain' ),
  'singular_name'              => _x( 'Recipe Type', 'Taxonomy Singular Name', 'text_domain' ),
  'menu_name'                  => __( 'Recipe Type', 'text_domain' ),
  'all_items'                  => __( 'All Recipe Types', 'text_domain' ),
  'parent_item'                => __( 'Parent Recipe Type', 'text_domain' ),
  'parent_item_colon'          => __( 'Parent Recipe Type:', 'text_domain' ),
  'new_item_name'              => __( 'New Type Name', 'text_domain' ),
  'add_new_item'               => __( 'Add New Type', 'text_domain' ),
  'edit_item'                  => __( 'Edit Type', 'text_domain' ),
  'update_item'                => __( 'Update Type', 'text_domain' ),
  'view_item'                  => __( 'View Type', 'text_domain' ),
  'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
  'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
  'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
  'popular_items'              => __( 'Popular Items', 'text_domain' ),
  'search_items'               => __( 'Search Items', 'text_domain' ),
  'not_found'                  => __( 'Not Found', 'text_domain' ),
  'no_terms'                   => __( 'No items', 'text_domain' ),
  'items_list'                 => __( 'Items list', 'text_domain' ),
  'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
);
$args = array(
  'labels'                     => $labels,
  'hierarchical'               => true,
  'public'                     => true,
  'show_ui'                    => true,
  'show_admin_column'          => true,
  'show_in_nav_menus'          => true,
  'show_tagcloud'              => true,
);
// register_taxonomy( 'recipe_type', array( 'recipe' ), $args );
