<?php 

/**
 * Changes the default size of the poset editor to 20 lines. Since I use a MacBook Air,
 * this particular size of the editor works optimal for my screen :).
 */
function hudson_set_editor_size() {
	
	if( '20' != get_option( 'default_post_edit_rows' ) ) {
		update_option( 'default_post_edit_rows', 20 );
	} // end if
	
} // end hudson_set_editor_size
add_action( 'admin_init', 'hudson_set_editor_size' );

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
 * Adds the Sharrre library to replace JetPack's sharers
 */
function hudson_enqueue_scripts() {
	
	// Sharrre
	wp_register_script( 'hudson-share', get_stylesheet_directory_uri() . '/lib/sharrre/jquery.sharrre-1.3.2.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'hudson-share' );
	
} // end hudson_enqueue_styles
//add_action( 'wp_enqueue_scripts', 'hudson_enqueue_scripts' );

/**
 * Enqueues admin stylesheets and JavaScript.
 */
function hudson_enqueue_admin_styles() {
	
	wp_register_style( 'hudson-admin', get_stylesheet_directory_uri() . '/css/admin.css' );
	wp_enqueue_style( 'hudson-admin' );

	wp_register_script( 'hudson-admin', get_stylesheet_directory_uri() . '/js/admin.min.js' );
	wp_enqueue_script( 'hudson-admin' );
	
} // end hudson_enqueue_admin_styles
add_action( 'admin_print_styles', 'hudson_enqueue_admin_styles' );

/**
 * Adds the Sharrre functionality below the content on each post.
 */
function hudson_add_sharrre( $content ) {
	
	if( is_single() ) {
		
		$html = '<div id="share"></div><!-- /#share -->';
		$html .= '<script type="text/javascript">';
			$html .= "$('#share').sharrre({ share: { googlePlus: true, facebook: true, twitter: true }, url: '" . get_permalink() . "'});";
		$html .= '</script>';
		
	} // end if
	
	return $content;
	
} // end hudson_add_sharrre
//add_filter( 'the_content', 'hudson_add_sharrre' );

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

/**
 * Add the post meta box for the link post format URL.
 */
function hudson_add_url_field_to_link_post_format() {
	
	add_meta_box(
		'link_format_url',
		__( 'Link URL', 'standard' ),
		'hudson_link_url_field_display',
		'post',
		'side',
		'high'
	);
	
} // end hudson_add_url_to_link_post_type
add_action( 'add_meta_boxes', 'hudson_add_url_field_to_link_post_format' );

/**
 * Renders the input field for the URL.
 * 
 * @params	$post	The post on which this meta box is attached.
 */
function hudson_link_url_field_display( $post ) {
	
	wp_nonce_field( plugin_basename( __FILE__ ), 'hudson_link_url_field_nonce' );

	echo '<input type="text" id="hudson_link_url_field" name="hudson_link_url_field" value="' . get_post_meta( $post->ID, 'hudson_link_url_field', true ) . '" />';
	
} // end standard_post_level_layout_display

/**
 * Sets the URL for the given post.
 *
 * @params	$post_id	The ID of the post that we're serializing
 */
function hudson_save_link_url_data( $post_id ) {
	
	if( isset( $_POST['hudson_link_url_field_nonce'] ) && isset( $_POST['post_type'] ) ) {
	
		// Don't save if the user hasn't submitted the changes
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		} // end if
		
		// Verify that the input is coming from the proper form
		if( ! wp_verify_nonce( $_POST['hudson_link_url_field_nonce'], plugin_basename( __FILE__ ) ) ) {
			return;
		} // end if
		
		// Make sure the user has permissions to post
		if( 'post' == $_POST['post_type']) {
			if( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			} // end if
		} // end if/else
	
		// Read the Link's URL
		$link_url = '';
		if( isset( $_POST['hudson_link_url_field'] ) ) {
			$link_url = esc_url( $_POST['hudson_link_url_field'] );
		} // end if
		
		// If the value exists, delete it first. I don't want to write extra rows into the table.
		if ( 0 == count( get_post_meta( $post_id, 'hudson_link_url_field' ) ) ) {
			delete_post_meta( $post_id, 'hudson_link_url_field' );
		} // end if

		// Update it for this post.
		update_post_meta( $post_id, 'hudson_link_url_field', $link_url );

	} // end if

} // end standard_save_post_layout_data
add_action( 'save_post', 'hudson_save_link_url_data' );