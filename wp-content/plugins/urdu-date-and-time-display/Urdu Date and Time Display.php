<?php
/*
Plugin Name: URDU Date and Time Display
Plugin URL: http://www.imughal.com/
Description: This plugin will display all date, time and numbers of WordPress website into Urdu Language. Urdu date and time will be shown according to English calendar only. If you feel any problem with this plugin then please visit the website <a href=http://www.imughal.com/>(iMughal)</a>. Feel free to contact with developer <a href=https://www.facebook.com/iMughal7>Imran Ali Mughal</a> in Facebook.
(Based on Bangla Date and Time Plugin)
Version: 1.0
Author: Imran Ali Mughal
Orignal_Author: Abu Saeed Mohammad Sayem
License: GPLv2 http://www.gnu.org/licenses/gpl-2.0.html
*/

function urdu_month_day( $str )
{
	$enWords =  array (	'lm1' => 'January',
						'lm2' => 'February',
						'lm3' => 'March',
						'lm4' => 'April',
						'lm5' => 'May',
						'lm6' => 'June',
						'lm7' => 'July',
						'lm8' => 'August',
						'lm9' => 'September',
						'lm10'=> 'October',
						'lm11'=> 'November',
						'lm12'=> 'December',
						'sm1' => 'Jan',
						'sm2' => 'Feb',
						'sm3' => 'Mar',
						'sm4' => 'Apr',
						'sm5' => 'May',
						'sm6' => 'Jun',
						'sm7' => 'Jul',
						'sm8' => 'Aug',
						'sm9' => 'Sep',
						'sm10'=> 'Oct',
						'sm11'=> 'Nov',
						'sm12'=> 'Dec',
						'ld1' => 'Saturday',
						'ld2' => 'Sunday',
						'ld3' => 'Monday',
						'ld4' => 'Tuesday',
						'ld5' => 'Wednesday',
						'ld6' => 'Thursday',
						'ld7' => 'Friday',
						'sd1' => 'Sat',
						'sd2' => 'Sun',
						'sd3' => 'Mon',
						'sd4' => 'Tue',
						'sd5' => 'Wed',
						'sd6' => 'Thu',
						'sd7' => 'Fri'
						);

	$urWords =  array ( 'lm1' => 'جنوری',
						'lm2' => 'فروری',
						'lm3' => 'مارچ',
						'lm4' => 'اپریل',
						'lm5' => 'مئی',
						'lm6' => 'جون',
						'lm7' => 'جولائی',
						'lm8' => 'اگست',
						'lm9' => 'ستمبر',
						'lm10'=> 'اکتوبر',
						'lm11'=> 'نومبر',
						'lm12'=> 'دسمبر',
						'sm1' => 'جنوری',
						'sm2' => 'فروری',
						'sm3' => 'مارچ',
						'sm4' => 'اپریل',
						'sm5' => 'مئی',
						'sm6' => 'جون',
						'sm7' => 'جولائی',
						'sm8' => 'اگست',
						'sm9' => 'ستمبر',
						'sm10'=> 'اکتوبر',
						'sm11'=> 'نومبر',
						'sm12'=> 'دسمبر',
						'ld1' => 'ہفتہ',
						'ld2' => 'اتوار',
						'ld3' => 'پیر',
						'ld4' => 'منگل',
						'ld5' => 'بدھ',
						'ld6' => 'جمعرات',
						'ld7' => 'جمعہ',
						'sd1' => 'ہفتہ',
						'sd2' => 'اتوار',
						'sd3' => 'پیر',
						'sd4' => 'منگل',
						'sd5' => 'بدھ',
						'sd6' => 'جمعرات',
						'sd7' => 'جمعہ'
						);
	
	array_push($enWords, 'am', 'pm');
	array_push($urWords, 'دن', 'شام');

	return str_ireplace($enWords, $urWords, $str);
} 

$udat = '<meta name=\'urdu-date-and-time-display\' content=\'urdu-date-and-time-display-v1.0\' />';

function latin_to_urdu( $int ) {

	$latDigt = array( 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 );
	$urduDigt = array( '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' );

	return str_replace( $latDigt, $urduDigt, $int );
}

	function urnt() { 
	echo $GLOBALS['udat']; 
	}
	add_filter('get_the_date', 'urdu_month_day');
	add_filter('get_archives_link','urdu_month_day');
	add_filter('get_archives_link','latin_to_urdu');
	add_filter('the_time', 'urdu_month_day');
	add_filter('get_comment_date', 'urdu_month_day');
	add_filter('get_comment_time', 'urdu_month_day');
	add_filter('date_i18n', 'latin_to_urdu', 10, 2);
	add_filter('number_format_i18n', 'latin_to_urdu', 10, 1);
	add_action('wp_head', 'urnt');
?>