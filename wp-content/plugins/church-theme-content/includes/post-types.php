<?php
/**
 * Register Post Types
 *
 * @package    Church_Theme_Content
 * @subpackage Functions
 * @copyright  Copyright (c) 2013, churchthemes.com
 * @link       https://github.com/churchthemes/church-theme-content
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @since      0.9
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**********************************
 * SERMON
 **********************************/

/**
 * Register sermon post type
 *
 * @since 0.9
 */
function ctc_register_post_type_sermon() {

	// Arguments
	$args = array(
		'labels' => array(
			'name'					=> _x( 'بیانات', 'post type general name', 'church-theme-content' ),
			'singular_name'			=> _x( 'بیان', 'post type singular name', 'church-theme-content' ),
			'add_new' 				=> _x( 'نیا ڈالیے', 'sermon', 'church-theme-content' ),
			'add_new_item' 			=> __( 'نیا بیان', 'church-theme-content' ),
			'edit_item' 			=> __( 'بیان بدلیے', 'church-theme-content' ),
			'new_item' 				=> __( 'نیا بیان', 'church-theme-content' ),
			'all_items' 			=> __( 'تمام بیانات', 'church-theme-content' ),
			'view_item' 			=> __( 'بیان کھولیے', 'church-theme-content' ),
			'search_items' 			=> __( 'بیانات میں ڈھوندیے', 'church-theme-content' ),
			'not_found' 			=> __( 'بیان نہ ملا', 'church-theme-content' ),
			'not_found_in_trash' 	=> __( 'حزف شدہ بیان نہ ملا', 'church-theme-content' )
		),
		'public' 		=> ctc_feature_supported( 'sermons' ),
		'has_archive' 	=> ctc_feature_supported( 'sermons' ),
		'rewrite'		=> array(
			'slug' 			=> 'sermons',
			'with_front' 	=> false,
			'feeds'			=> ctc_feature_supported( 'sermons' )
		),
		'supports' 		=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'author', 'revisions' ), // 'editor' required for media upload button (see Meta Boxes note below about hiding)
		'taxonomies' 	=> array( 'ctc_sermon_topic', 'ctc_sermon_book', 'ctc_sermon_series', 'ctc_sermon_speaker', 'ctc_sermon_tag' ),
		'menu_icon'		=> 'dashicons-video-alt3'
	);
	$args = apply_filters( 'ctc_post_type_sermon_args', $args ); // allow filtering
		
	// Registration
	register_post_type(
		'ctc_sermon',
		$args
	);

}

add_action( 'init', 'ctc_register_post_type_sermon' ); // register post type
 
/**********************************
 * EVENT
 **********************************/

/**
 * Register event post type
 *
 * @since 0.9
 */
function ctc_register_post_type_event() {

	// Arguments
	$args = array(
		'labels' => array(
			'name'					=> _x( 'مجالس', 'post type general name', 'church-theme-content' ),
			'singular_name'			=> _x( 'مجلس', 'post type singular name', 'church-theme-content' ),
			'add_new' 				=> _x( 'نیا ڈالیے', 'event', 'church-theme-content' ),
			'add_new_item' 			=> __( 'نیی مجلس', 'church-theme-content' ),
			'edit_item' 			=> __( 'مجلس کو بدلیے', 'church-theme-content' ),
			'new_item' 				=> __( 'نیے مجلس', 'church-theme-content' ),
			'all_items' 			=> __( 'تمام مجالس', 'church-theme-content' ),
			'view_item' 			=> __( 'مجلس کو دیکھیے', 'church-theme-content' ),
			'search_items' 			=> __( 'مجالس مین ڈھونڈیے', 'church-theme-content' ),
			'not_found' 			=> __( 'مجلس نہ ملی', 'church-theme-content' ),
			'not_found_in_trash' 	=> __( 'محذوف شدھ مجلس نہ ملی', 'church-theme-content' )
		),
		'public' 		=> ctc_feature_supported( 'events' ),
		'has_archive' 	=> ctc_feature_supported( 'events' ),
		'rewrite'		=> array(
			'slug' 			=> 'events',
			'with_front'	=> false,
			'feeds'			=> ctc_feature_supported( 'events' ),
		),
		'supports' 		=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'author', 'revisions' ),
		'menu_icon'		=> 'dashicons-calendar'
	);
	$args = apply_filters( 'ctc_post_type_event_args', $args ); // allow filtering
	
	// Registration
	register_post_type(
		'ctc_event',
		$args
	);
	
}

add_action( 'init', 'ctc_register_post_type_event' ); // register post type

/**********************************
 * LOCATION
 **********************************/

/**
 * Register location post type
 *
 * @since 0.9
 */
function ctc_location_post_type() {

	// Arguments
	$args = array(
		'labels' => array(
			'name'					=> _x( 'مقامات', 'post type general name', 'church-theme-content' ),
			'singular_name'			=> _x( 'مقام', 'post type singular name', 'church-theme-content' ),
			'add_new' 				=> _x( 'نیا ڈالیے', 'location', 'church-theme-content' ),
			'add_new_item' 			=> __( 'نیا مقام', 'church-theme-content' ),
			'edit_item' 			=> __( 'مقام بدلیے', 'church-theme-content' ),
			'new_item' 				=> __( 'نیا مقام', 'church-theme-content' ),
			'all_items' 			=> __( 'تمام مقامات', 'church-theme-content' ),
			'view_item' 			=> __( 'مقام دیکھیے', 'church-theme-content' ),
			'search_items' 			=> __( 'مقامات میں ڈھونڈیے', 'church-theme-content' ),
			'not_found' 			=> __( 'مقام نہ ملا', 'church-theme-content' ),
			'not_found_in_trash' 	=> __( 'محذوف شدھ مقام نہ ملا', 'church-theme-content' )
		),
		'public' 		=> ctc_feature_supported( 'locations' ),
		'has_archive' 	=> ctc_feature_supported( 'locations' ),
		'rewrite'		=> array(
			'slug' 			=> 'locations',
			'with_front' 	=> false,
			'feeds'			=> ctc_feature_supported( 'locations' ),
		),
		'supports' 		=> array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		'menu_icon'		=> 'dashicons-location'
	);
	$args = apply_filters( 'ctc_post_type_location_args', $args ); // allow filtering
		
	// Registration
	register_post_type(
		'ctc_location',
		$args
	);
	
}

add_action( 'init', 'ctc_location_post_type' ); // register post type

/**********************************
 * PERSON
 **********************************/ 

/**
 * Register person post type
 *
 * @since 0.9
 */	
function ctc_register_post_type_person() {

	// Arguments
	$args = array(
		'labels' => array(
			'name'					=> _x( 'عملہ', 'post type general name', 'church-theme-content' ),
			'singular_name'			=> _x( 'عامل', 'post type singular name', 'church-theme-content' ),
			'add_new' 				=> _x( 'نیا ڈالیے', 'person', 'church-theme-content' ),
			'add_new_item' 			=> __( 'نیا عامل', 'church-theme-content' ),
			'edit_item' 			=> __( 'عامل بدلیے', 'church-theme-content' ),
			'new_item' 				=> __( 'نیا عامل', 'church-theme-content' ),
			'all_items' 			=> __( 'تمام عملہ', 'church-theme-content' ),
			'view_item' 			=> __( 'عامل کو دیکھیے', 'church-theme-content' ),
			'search_items' 			=> __( 'عملہ میں ڈھونڈیے', 'church-theme-content' ),
			'not_found' 			=> __( 'عملہ نہ ملا', 'church-theme-content' ),
			'not_found_in_trash' 	=> __( 'محذوف شدہ عملہ نہ ملا', 'church-theme-content' )
		),
		'public' 		=> ctc_feature_supported( 'people' ),
		'has_archive' 	=> ctc_feature_supported( 'people' ),
		'rewrite'		=> array(
			'slug' 			=> 'people',
			'with_front' 	=> false,
			'feeds'			=> ctc_feature_supported( 'people' ),
		),
		'supports' 		=> array( 'title', 'editor', 'page-attributes', 'thumbnail', 'excerpt' ),
		'taxonomies' 	=> array( 'ctc_person_group' ),
		'menu_icon'		=> 'dashicons-admin-users'
	);
	$args = apply_filters( 'ctc_post_type_person_args', $args ); // allow filtering
	
	// Registration
	register_post_type(
		'ctc_person',
		$args
	);
	
}

add_action( 'init', 'ctc_register_post_type_person' ); // register post type
