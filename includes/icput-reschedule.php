<?php
/**
 * Sets posts to draft if their expiration field is out of date.
 **/
function icput_reschedule() {

	global $wpdb;

	$args = array(
		'fields'      => 'ids',
		'post_type'   => 'post',
		'post_status' => 'publish',
		'meta_query'  => array(
			array(
				'key'     => 'date_and_time_for_reschedule',
				'value'   => date( 'Y-m-d H:m' ),
				'compare' => '<',
				'type'    => 'DATETIME',
			),
			array(
				'key'     => 'date_and_time_for_reschedule',
				'value'   => '',
				'compare' => '!=',
			),
		),
	);

	$query = new WP_Query( $args );

	$posts = $query->posts;

	// for each post, update the post date
	foreach ( $posts as $post ) {

		$time = rwmb_meta( 'date_and_time_for_reschedule', null, $post );

		$update_args = array(
			'ID'            => $post, // ID of the post to update
			'post_type'     => 'post',
			'post_date'     => $time,
			'post_date_gmt' => get_gmt_from_date( $time ),
		);

		wp_update_post( $update_args );
	}
}

function icput_reschedule_cron() {
	if ( ! wp_next_scheduled( 'icput_reschedule' ) ) {
		wp_schedule_event( time(), 'daily', 'icput_reschedule' );
	}
}
add_action( 'wp', 'icput_reschedule_cron' );

add_action( 'icput_reschedule', 'icput_reschedule' );
