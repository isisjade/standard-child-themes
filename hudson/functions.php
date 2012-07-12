<?php 

/**
 * Enqueues stylesheets for this theme.
 */
function hudson_enqueue_styles() {
	
	// Google fonts for Android Sans
	wp_register_style( 'hudson-fonts', 'http://fonts.googleapis.com/css?family=Droid+Sans:400,700' );
	wp_enqueue_style( 'hudson-fonts' );
	
} // end hudson_enqueue_styles
add_action( 'wp_enqueue_scripts', 'hudson_enqueue_styles' );

/**
 * Determines if the given post is older than 14 days.
 *
 * @returns	True if the post is older than 14 days; otherwise, false.
 */
function hudson_post_is_two_weeks_old() {
	
	$today = strtotime( date( 'Y-m-d' ) );
	
	global $post;
	$post_date = explode(' ', $post->post_date );
	$post_date = strtotime( $post_date[0] );

	return 14 <= floor( abs( $today - $post_date ) ) / ( 60 * 60 * 24 );
	
} // end hudson_post_is_two_weeks_old

?>