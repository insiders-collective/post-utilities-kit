<?php
add_filter( 'rwmb_meta_boxes', 'icput_register_meta_boxes' );

function icput_register_meta_boxes( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'title'      => esc_html__( 'Extra Fields', 'icput' ),
		'id'         => 'extra-fields',
		'context'    => 'normal',
		'post_types' => array( 'post' ),
		'autosave'   => true,
		'fields'     => array(
			array(
				'type' => 'text',
				'name' => esc_html__( 'Redirect URL', 'icput' ),
				'id'   => $prefix . 'canonical_url',
			),
			array(
				'type' => 'text',
				'name' => esc_html__( 'Canonical URL', 'icput' ),
				'id'   => $prefix . 'canonical_url',
			),
			array(
				'type' => 'date',
				'name' => esc_html__( 'Removal Date', 'icput' ),
				'id'   => $prefix . 'removal_date',
				'desc' => esc_html__( 'Page removed at the beginning of date.   So if you pick Monday, you won\\\'t see it on Monday.', 'icput' ),
			),
		),
	);

	return $meta_boxes;
}
