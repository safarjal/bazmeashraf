<?php
/**
 * Register Taxonomies
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
 * SERMON TAXONOMIES
 **********************************/

/**
 * Sermon topic
 *
 * @since 0.9
 */
function ctc_register_taxonomy_sermon_topic() {

	// Arguments
	$args = array(
		'labels' => array(
			'name' 							=> _x( 'بیانات کے مضامین', 'taxonomy general name', 'church-theme-content' ),
			'singular_name'					=> _x( 'بیان کا مضمون', 'taxonomy singular name', 'church-theme-content' ),
			'search_items' 					=> _x( 'بحچ کے مضامین', 'sermons', 'church-theme-content' ),
			'popular_items' 				=> _x( 'پسندیدہ مضامین', 'sermons', 'church-theme-content' ),
			'all_items' 					=> _x( 'تمام مضامین', 'sermons', 'church-theme-content' ),
			'parent_item' 					=> null,
			'parent_item_colon' 			=> null,
			'edit_item' 					=> _x( 'مضمون بدلیے', 'sermons', 'church-theme-content' ), 
			'update_item' 					=> _x( 'مضمون کو اپ ڈیٹ کریے', 'sermons', 'church-theme-content' ),
			'add_new_item' 					=> _x( 'مضمون ڈالیے', 'sermons', 'church-theme-content' ),
			'new_item_name' 				=> _x( 'نیا مضمون', 'sermons', 'church-theme-content' ),
			'separate_items_with_commas' 	=> _x( 'مضامین کو کومہ کے نشان سے علیحدہ رکھیے', 'sermons', 'church-theme-content' ),
			'add_or_remove_items' 			=> _x( 'مضامین میں اضافہ یا حزف کیجیے', 'sermons', 'church-theme-content' ),
			'choose_from_most_used' 		=> _x( 'اکچر استعمال ہونے والے مضامین میں سے اختیار کیجیے', 'sermons', 'church-theme-content' ),
			'menu_name' 					=> _x( 'مضامین', 'sermon menu name', 'church-theme-content' )
		),
		'hierarchical'	=> true, // category-style instead of tag-style
		'public' 		=> ctc_taxonomy_supported( 'sermons', 'ctc_sermon_topic' ),
		'rewrite' 		=> array(
			'slug' 			=> 'sermon-topic',
			'with_front' 	=> false,
			'hierarchical' 	=> true
		)
	);
	$args = apply_filters( 'ctc_taxonomy_sermon_topic_args', $args ); // allow filtering

	// Registration
	register_taxonomy(
		'ctc_sermon_topic',
		'ctc_sermon',
		$args
	);

}

add_action( 'init', 'ctc_register_taxonomy_sermon_topic' );

/**
 * Sermon book
 *
 * @since 0.9
 */
function ctc_register_taxonomy_sermon_book() {

	// Arguments
	$args = array(
		'labels' => array(
			'name' 							=> _x( 'بیانات کی کتابیں', 'taxonomy general name', 'church-theme-content' ),
			'singular_name'					=> _x( 'بیان کی کتاب', 'taxonomy singular name', 'church-theme-content' ),
			'search_items' 					=> _x( 'کتابوں میں ڈہونڈیے', 'sermons', 'church-theme-content' ),
			'popular_items' 				=> _x( 'پسندیدہ کتب', 'sermons', 'church-theme-content' ),
			'all_items' 					=> _x( 'تمام کتابیں', 'sermons', 'church-theme-content' ),
			'parent_item' 					=> null,
			'parent_item_colon' 			=> null,
			'edit_item' 					=> _x( 'کتاب بدلیے', 'sermons', 'church-theme-content' ), 
			'update_item' 					=> _x( 'کتاب اپ ڈیٹ کریے', 'sermons', 'church-theme-content' ),
			'add_new_item' 					=> _x( 'نی کتاب ڈالیے', 'sermons', 'church-theme-content' ),
			'new_item_name' 				=> _x( 'نی کتاب', 'sermons', 'church-theme-content' ),
			'separate_items_with_commas' 	=> _x( 'کتابوں کو کومہ سے علیحدہ کریے', 'sermons', 'church-theme-content' ),
			'add_or_remove_items' 			=> _x( 'کتابوں میں اضافہ یا حذف کریے', 'sermons', 'church-theme-content' ),
			'choose_from_most_used' 		=> _x( 'اکچر استعمال کتب سے اختیار کیجیے', 'sermons', 'church-theme-content' ),
			'menu_name' 					=> _x( 'کتابیں', 'sermon menu name', 'church-theme-content' )
		),
		'hierarchical'	=> true, // category-style instead of tag-style
		'public' 		=> ctc_taxonomy_supported( 'sermons', 'ctc_sermon_book' ),
		'rewrite' 		=> array(
			'slug' 			=> 'sermon-book',
			'with_front' 	=> false,
			'hierarchical' 	=> true
		)
	);
	$args = apply_filters( 'ctc_taxonomy_sermon_book_args', $args ); // allow filtering

	// Registration
	register_taxonomy(
		'ctc_sermon_book',
		'ctc_sermon',
		$args
	);

}

add_action( 'init', 'ctc_register_taxonomy_sermon_book' );

/**
 * Sermon series
 *
 * @since 0.9
 */
function ctc_register_taxonomy_sermon_series() {

	// Arguments
	$args = array(
		'labels' => array(
			'name' 							=> _x( "بیانات کا سلسلہ", 'taxonomy general name', 'church-theme-content' ),
			'singular_name'					=> _x( "بیانات لا سلسلہ", 'taxonomy singular name', 'church-theme-content' ),
			'search_items' 					=> _x( "اس سلسلے میں ڈھونڈیے", 'sermons', 'church-theme-content' ),
			'popular_items' 				=> _x( "پسندیدہ سلسلہ", 'sermons', 'church-theme-content' ),
			'all_items' 					=> _x( "تمام سلسلے", 'sermons', 'church-theme-content' ),
			'parent_item' 					=> null,
			'parent_item_colon' 			=> null,
			'edit_item' 					=> _x( 'سلسلہ بدلیے', 'sermons', 'church-theme-content' ), 
			'update_item' 					=> _x( 'سلسلہ اپ ڈیٹ کیجیے', 'sermons', 'church-theme-content' ),
			'add_new_item' 					=> _x( 'نیا سلسلہ ڈالیے', 'sermons', 'church-theme-content' ),
			'new_item_name' 				=> _x( 'نیا سلسلہ', 'sermons', 'church-theme-content' ),
			'separate_items_with_commas' 	=> _x( "سلسلوں کو کومے کے سیتھ علیحدہ کیجیے", 'sermons', 'church-theme-content' ),
			'add_or_remove_items' 			=> _x( "سلسلے میں اضافہ یا حذف کیجیے", 'sermons', 'church-theme-content' ),
			'choose_from_most_used' 		=> _x( "اکثر استعمال ہونے والے سلسلوں میں سے اختیار کیجیے", 'sermons', 'church-theme-content' ),
			'menu_name' 					=> _x( "سلسلے", 'sermon menu name', 'church-theme-content' )
		),
		'hierarchical'	=> true, // category-style instead of tag-style
		'public' 		=> ctc_taxonomy_supported( 'sermons', 'ctc_sermon_series' ),
		'rewrite' 		=> array(
			'slug' 			=> 'sermon-series',
			'with_front' 	=> false,
			'hierarchical' 	=> true
		)
	);
	$args = apply_filters( 'ctc_taxonomy_sermon_series_args', $args ); // allow filtering

	// Registration
	register_taxonomy(
		'ctc_sermon_series',
		'ctc_sermon',
		$args
	);

}
 
add_action( 'init', 'ctc_register_taxonomy_sermon_series' );

/**
 * Sermon speaker
 *
 * @since 0.9
 */
function ctc_register_taxonomy_sermon_speaker() {

	// Arguments
	$args = array(
		'labels' => array(
			'name' 							=> _x( 'بیان کے مبلغین', 'taxonomy general name', 'church-theme-content' ),
			'singular_name'					=> _x( 'بیان کا مبلغ', 'taxonomy singular name', 'church-theme-content' ),
			'search_items' 					=> _x( 'مبلغین میں ڈھونڈیے', 'sermons', 'church-theme-content' ),
			'popular_items' 				=> _x( 'پسندیدہ مبلغین', 'sermons', 'church-theme-content' ),
			'all_items' 					=> _x( 'تمام مبلگین', 'sermons', 'church-theme-content' ),
			'parent_item' 					=> null,
			'parent_item_colon' 			=> null,
			'edit_item' 					=> _x( 'مبلغ کو بدلیے', 'sermons', 'church-theme-content' ), 
			'update_item' 					=> _x( 'مبلغ کو اپ ڈیٹ کیجیے', 'sermons', 'church-theme-content' ),
			'add_new_item' 					=> _x( 'نیا مبلگ ڈالیے', 'sermons', 'church-theme-content' ),
			'new_item_name' 				=> _x( 'نیا مبلغ', 'sermons', 'church-theme-content' ),
			'separate_items_with_commas' 	=> _x( 'مبلغین کو کوما سے ِلیحدہ کیجیے', 'sermons', 'church-theme-content' ),
			'add_or_remove_items' 			=> _x( 'مبلقینگ میں اضافہ اور حزف کیجیے', 'sermons', 'church-theme-content' ),
			'choose_from_most_used' 		=> _x( 'اکثر استعمال ہونے والے مبلغین میں سے اختیار کیجیے', 'sermons', 'church-theme-content' ),
			'menu_name' 					=> _x( 'مبلغین', 'sermon menu name', 'church-theme-content' )
		),
		'hierarchical'	=> true, // category-style instead of tag-style
		'public' 		=> ctc_taxonomy_supported( 'sermons', 'ctc_sermon_speaker' ),
		'rewrite' 		=> array(
			'slug' 			=> 'sermon-speaker',
			'with_front' 	=> false,
			'hierarchical' 	=> true
		)
	);
	$args = apply_filters( 'ctc_taxonomy_sermon_speaker_args', $args ); // allow filtering

	// Registration
	register_taxonomy(
		'ctc_sermon_speaker',
		'ctc_sermon',
		$args
	);

}

add_action( 'init', 'ctc_register_taxonomy_sermon_speaker' );

/**
 * Sermon tag
 *
 * @since 0.9
 */
function ctc_register_taxonomy_sermon_tag() {

	// Arguments
	$args = array(
		'labels' => array(
			'name' 							=> _x( 'بیان کے ٹیگز', 'taxonomy general name', 'church-theme-content' ),
			'singular_name'					=> _x( 'بیان کا ٹیگ', 'taxonomy singular name', 'church-theme-content' ),
			'search_items' 					=> _x( 'ٹیگز میں ڈھونڈیے', 'sermons', 'church-theme-content' ),
			'popular_items' 				=> _x( 'پسندیدہ ٹیگز', 'sermons', 'church-theme-content' ),
			'all_items' 					=> _x( 'تمام ٹیگز', 'sermons', 'church-theme-content' ),
			'parent_item' 					=> null,
			'parent_item_colon' 			=> null,
			'edit_item' 					=> _x( 'ٹیگ بدلیے', 'sermons', 'church-theme-content' ), 
			'update_item' 					=> _x( 'ٹیگ کو اپ ڈیٹ کیجیے', 'sermons', 'church-theme-content' ),
			'add_new_item' 					=> _x( 'نیا ٹیگ ڈالیے', 'sermons', 'church-theme-content' ),
			'new_item_name' 				=> _x( 'نیا ٹیگ', 'sermons', 'church-theme-content' ),
			'separate_items_with_commas' 	=> _x( 'ٹیگز کو کاما سے علیحدہ کریے', 'sermons', 'church-theme-content' ),
			'add_or_remove_items' 			=> _x( 'ٹیگز میں اضافہ اور حذف کیجیے', 'sermons', 'church-theme-content' ),
			'choose_from_most_used' 		=> _x( 'اکثر استعمال ہونے والے ٹیگز میں سے اکتیار کیجیے', 'sermons', 'church-theme-content' ),
			'menu_name' 					=> _x( 'ٹیگز', 'sermon menu name', 'church-theme-content' )
		),
		'hierarchical'	=> false, // tag style instead of category style
		'public' 		=> ctc_taxonomy_supported( 'sermons', 'ctc_sermon_tag' ),
		'rewrite' 		=> array(
			'slug' 			=> 'sermon-tag',
			'with_front'	=> false,
			'hierarchical' 	=> true
		)
	);
	$args = apply_filters( 'ctc_taxonomy_sermon_tag_args', $args ); // allow filtering

	// Registration
	register_taxonomy(
		'ctc_sermon_tag',
		'ctc_sermon',
		$args
	);

}
 
add_action( 'init', 'ctc_register_taxonomy_sermon_tag' );

/**********************************
 * PERSON TAXONOMIES
 **********************************/

/**
 * Person group
 *
 * @since 0.9
 */
function ctc_register_taxonomy_person_group() {

	// Arguments
	$args = array(
		'labels' => array(
			'name' 							=> _x( 'گروپس', 'taxonomy general name', 'church-theme-content' ),
			'singular_name'					=> _x( 'گروپ', 'taxonomy singular name', 'church-theme-content' ),
			'search_items' 					=> _x( 'گروپس میں ڈھونڈیں', 'people', 'church-theme-content' ),
			'popular_items' 				=> _x( 'پسندیدہ گروپس', 'people', 'church-theme-content' ),
			'all_items' 					=> _x( 'تمام گروپس', 'people', 'church-theme-content' ),
			'parent_item' 					=> null,
			'parent_item_colon' 			=> null,
			'edit_item' 					=> _x( 'گروپ کو بدلیے', 'people', 'church-theme-content' ), 
			'update_item' 					=> _x( 'گروپ کو اپ ڈیٹ کیجیے', 'people', 'church-theme-content' ),
			'add_new_item' 					=> _x( 'نیا گروپ ڈالیے', 'people', 'church-theme-content' ),
			'new_item_name' 				=> _x( 'نیا گروپ', 'people', 'church-theme-content' ),
			'separate_items_with_commas' 	=> _x( 'گروپس کو کوما کے ساتھ علحدہ کریے', 'people', 'church-theme-content' ),
			'add_or_remove_items' 			=> _x( 'گروپس میں اضافہ اور حزف کیجیے', 'people', 'church-theme-content' ),
			'choose_from_most_used' 		=> _x( 'اکثر استعمال ہونے والے گروپس میں سے اختیار کیجیے', 'people', 'church-theme-content' ),
			'menu_name' 					=> _x( 'گروپس', 'people menu name', 'church-theme-content' )
		),
		'hierarchical'	=> true, // category-style instead of tag-style
		'public' 		=> ctc_taxonomy_supported( 'people', 'ctc_person_group' ),
		'rewrite' 		=> array(
			'slug' 			=> 'group',
			'with_front' 	=> false,
			'hierarchical' 	=> true
		)
	);
	$args = apply_filters( 'ctc_taxonomy_person_group_args', $args ); // allow filtering

	// Registration
	register_taxonomy(
		'ctc_person_group',
		'ctc_person',
		$args
	);

}

add_action( 'init', 'ctc_register_taxonomy_person_group' );
