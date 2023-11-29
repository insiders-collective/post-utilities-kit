<?php
/**
 * Sets posts to draft if their expiration field is out of date.
 **/
function icput_update_drafts() {

	global $wpdb;

	$args = array(
		'fields'      => 'ids',
		'post_type'   => 'post',
		'post_status' => 'publish',
		'meta_query'  => array(
			array(
				'key'     => 'removal_date',
				'value'   => date( 'Ymd' ),
				'compare' => '<',
				'type'    => 'NUMERIC',
			),
			array(
				'key'     => 'removal_date',
				'value'   => '',
				'compare' => '!=',
			),
		),
	);

	$query = new WP_Query( $args );

	$posts = $query->posts;

	// for each post, get the redirect and canonical and set redirect to canonical.
	foreach ( $posts as $post ) {
		rwmb_set_meta( $post, 'canonical_url', rwmb_meta( 'redirect_url', null, $post ) );
	}

	// get all the post IDs and mash them into a csv.
	$posts_string = implode( ',', $posts );

	// update all the posts to draft.
	$wpdb->query(
		$wpdb->prepare(
			"UPDATE $wpdb->posts
			SET `post_status` = 'draft'
			WHERE `ID` IN ( $posts_string  )"
		)
	);
}

function icput_wp_cron() {
	if ( ! wp_next_scheduled( 'icput_update_drafts' ) ) {
		wp_schedule_event( strtotime( '00:00:00' ), 'daily', 'icput_update_drafts' );
	}
}
add_action( 'wp', 'icput_wp_cron' );

add_action( 'icput_update_drafts', 'icput_update_drafts' );
