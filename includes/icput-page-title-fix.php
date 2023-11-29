<?php
/**
 * Update the post slug on save to match the title
 **/

// change slug on post if title is changed.
add_action( 'save_post', 'icput_post_title_fix' );
function icput_post_title_fix( $post_id ) {

	$url = rwmb_get_value( 'canonical_url' );

	if ( empty( $url ) ) {
		return;
	}

	if ( get_post_type( $post_id ) === 'post' ) {
		$post        = get_post( $post_id );
		$title       = $post->post_title;
		$clean_title = sanitize_title( $title );
		$slug        = $post->post_name;
		if ( $slug !== $clean_title ) {
			$clean_post = array(
				'ID'        => $post_id,
				'post_name' => $clean_title,
			);

			// Update the post.
			wp_update_post( $clean_post );
		}
	}
}
