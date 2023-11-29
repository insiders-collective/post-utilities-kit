<?php
/**
 * Make canonical redirect
 **/
function icput_redirect() {

	if ( empty( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}

	$url = esc_url( wp_unslash( $_SERVER['REQUEST_URI'] ) );

	$purl = wp_parse_url( $url );

	$purle = array_reverse( array_filter( explode( '/', $purl['path'] ) ) );

	if ( empty( $purle[0] ) ) {
		return;
	} else {
		$slug = $purle[0];
	}

	if ( empty( $slug ) ) {
		return;
	}

	$args = array(
		'fields'      => 'ids',
		'post_type'   => 'post',
		'post_status' => 'draft',
		'name'        => esc_attr( $slug ),
	);

	$query = new WP_Query( $args );

	$posts = $query->posts;

	if ( 1 !== count( $posts ) ) {
		return;
	}

	$url = get_post_meta( $posts[0], 'canonical_url', true );

	if ( ! empty( esc_url( $url ) ) ) {

		if ( wp_redirect( $url ) ) {
			exit;
		}
	}
}
add_action( 'wp_loaded', 'icput_redirect' );
