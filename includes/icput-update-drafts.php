<?php
/**
 * Sets posts to draft if their expiration field is out of date.
 **/
function tcp_update_drafts() {

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

	$posts_string = implode( ',', $posts );

	$wpdb->query(
		$wpdb->prepare(
			"UPDATE $wpdb->posts
			SET `post_status` = 'draft'
			WHERE `ID` IN ( $posts_string  )"
		)
	);
}

function tcp_wp_cron() {
	if ( ! wp_next_scheduled( 'tcp_update_drafts' ) ) {
		wp_schedule_event( strtotime( '00:00:00' ), 'daily', 'tcp_update_drafts' );
	}
}
add_action( 'wp', 'tcp_wp_cron' );

add_action( 'tcp_update_drafts', 'tcp_update_drafts' );
