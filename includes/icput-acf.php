<?php

add_action(
	'acf/include_fields',
	function() {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		acf_add_local_field_group(
			array(
				'key'                   => 'group_654bc31fbcc29',
				'title'                 => 'Extra Fields',
				'fields'                => array(
					array(
						'key'               => 'field_654bc31f5c185',
						'label'             => 'Canonical URL',
						'name'              => 'canonical_url',
						'aria-label'        => '',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'maxlength'         => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
					),
					array(
						'key'               => 'field_654bc3585c186',
						'label'             => 'Removal Date',
						'name'              => 'removal_date',
						'aria-label'        => '',
						'type'              => 'date_picker',
						'instructions'      => 'Page removed at the beginning of date.	So if you pick Monday, you won\'t see it on Monday.',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'display_format'    => 'l, F j, Y',
						'return_format'     => 'Y-m-d',
						'first_day'         => 1,
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'post',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 0,
			)
		);
	}
);


