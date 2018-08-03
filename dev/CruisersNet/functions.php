<?php

/**
 * Cruisers' Net Setup
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 */
 
if ( ! function_exists( 'cnet_setup' ) ) :
function cnet_setup() {

	// add theme support
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );

}
endif; // end cnet_setup
add_action( 'after_setup_theme', 'cnet_setup' );

// custom functions
include_once('includes/custom-functions.php');

// custom filters
include_once('includes/filters.php');

// load all required theme files
include_once('includes/loader.php');


function wpa_107371_meta_query( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    // only change the query on a custom taxonomy
    // can check for a specific taxonomy if desired
    if ( is_tax('cnet_regions_marinas') ) {
        //define our meta query
              $meta_query = array(
                    'key'=>'not_a_marina',
                    'value'=>'no',
                    'compare'=>'!=',
                );
         $query->set('meta_query',$meta_query);
        return;
    }

}
//add_action( 'pre_get_posts', 'wpa_107371_meta_query' );