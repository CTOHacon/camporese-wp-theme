<?php

createACFBlock(
	[
		'name'     => 'company-rating-bar',
		'title'    => 'Company Rating Bar',
		'category' => 'theme-blocks',
		'icon'     => 'star-filled',
		'mode'     => 'preview',
		'parent'   => [
			'acf/content-block'
		],
		'supports' => [
			'align' => false,
		],
	],
	[
		[
			'key'           => 'field_crb_background',
			'name'          => 'background',
			'label'         => 'Background',
			'type'          => 'select',
			'choices'       => [
				'white' => 'White',
				'gray'  => 'Gray',
			],
			'default_value' => 'white',
		],
		[
			'key'     => 'field_crb_info',
			'name'    => '',
			'label'   => '',
			'type'    => 'message',
			'message' => 'Rating data and reviews are pulled from <a href="' . admin_url('admin.php?page=reviews') . '" target="_blank">Reviews</a> settings.',
		],
	],
	function ($fields, $context) {
		component_company_rating_bar(
			[
				'class' => [
					$context['block']['className'] ?? null,
				],
			],
			$fields
		);
	}
);
