<?php

/*-----------------------------------------------------------------------*/
// COMMON ASSETS
/*-----------------------------------------------------------------------*/
// CSS
Asset::add('bookstore-main-styles', 'css/screen.css', false, '1.0', 'all');

// JS
Asset::add('bks-modernizr', 'js/vendor/modernizr.js', false, '2.7.1');

/*-----------------------------------------------------------------------*/
// CUSTOM IMAGE SIZES
/*-----------------------------------------------------------------------*/
add_action('init', function(){

	add_image_size('book-promo', 399, 435, true);
	add_image_size('book-featured-image', 266, 146, true);
	add_image_size('member-pic', 104, 104, true);

	// Default featured image size
	set_post_thumbnail_size(620, 200, true);

});

/*-----------------------------------------------------------------------*/
// ADD SIZES TO MEDIA UPLOADER
/*-----------------------------------------------------------------------*/
add_filter('image_size_names_choose', function($mediaSizes){

	$sizes = array(
    	'book-promo' 			=> __('Book promo', THEMOSISTHEME_TEXTDOMAIN),
    	'book-featured-image' 	=> __('Book featured image', THEMOSISTHEME_TEXTDOMAIN),
    	'member-pic' 			=> __('Team profile', THEMOSISTHEME_TEXTDOMAIN)
	);

   return array_merge($mediaSizes, $sizes);
});

/*-----------------------------------------------------------------------*/
// HELPERS
/*-----------------------------------------------------------------------*/
function bks_getPromoBooks(){

	$books = array(
		'none'	=> 'None'
	);

	$query = new WP_Query(array(
		'post_type' 		=> 'bks-books',
		'posts_per_page' 	=> -1,
		'post_status'		=> 'publish'
	));

	$results = $query->get_posts();

	foreach ($results as $book) {
		
		$books[$book->ID] = $book->post_title;

	}

	return $books;

}