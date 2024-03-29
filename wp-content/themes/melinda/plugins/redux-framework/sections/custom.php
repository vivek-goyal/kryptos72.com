<?php
Redux::setSection( $opt_name, array(
	'id' => 'sec_custom',
	'title' => esc_html__('Custom CSS/JS', 'melinda'),
	'desc' => 'Easily add custom CSS and JS to your website.',
	'icon' => 'el el-css',
	'fields' => array(
		array(
			'id' => 'custom--css',
			'type' => 'ace_editor',
			'title' => esc_html__('CSS code', 'melinda'),
			'subtitle' => esc_html__('Insert your custom CSS code here. It will be displayed globally in the website.', 'melinda'),
			'mode' => 'css',
			'theme' => 'monokai',
			'default' => '',
		),
		array(
			'id' => 'custom--js',
			'type' => 'ace_editor',
			'title' => esc_html__('JS code', 'melinda'),
			'subtitle' => esc_html__('Insert your custom JS code here, e.g. Google Analytics code or whatever you want. It will be displayed globally in the website.', 'melinda'),
			'mode' => 'javascript',
			'theme' => 'monokai',
			'default' => '',
		),
		array(
			'id' => 'custom--head_html',
			'type' => 'ace_editor',
			'title' => esc_html__('Head link tags', 'melinda'),
			'subtitle' => esc_html__('Insert your custom tags to be displayed in the head, e.g. Google Fonts link tags and others.', 'melinda'),
			'mode' => 'html',
			'theme' => 'monokai',
			'default' => '',
		),
		array(
			'id' => 'custom--footer_html',
			'type' => 'ace_editor',
			'title' => esc_html__('HTML code', 'melinda'),
			'subtitle' => esc_html__('Insert your custom HTML to be append after footer.', 'melinda'),
			'mode' => 'html',
			'theme' => 'monokai',
			'default' => '',
		),
	),
) );
