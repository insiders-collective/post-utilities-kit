<?php
/**
 * Insert the Canonical tag where it should be
 */
function icput_insert_canonical_tag() {

	$output    = '';
	$url       = '';
	$id        = get_queried_object_id();
	$post_type = get_post_type( $id );

	if ( 'post' === $post_type ) {

		$url = rwmb_get_value( 'canonical_url' );

		if ( ! empty( $url ) ) {
			echo '<link rel="canonical" href="' . esc_url( $url ) . '">';
		}
	}

	return $url;
}
remove_action( 'wp_head', 'rel_canonical' );
add_action( 'wp_head', 'icput_insert_canonical_tag' );
