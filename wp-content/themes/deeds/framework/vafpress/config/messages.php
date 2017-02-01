<?php

return array(

	////////////////////////////////////////
	// Localized JS Message Configuration //
	////////////////////////////////////////

	/**
	 * Validation Messages
	 */
	'validation' => array(
		'alphabet'     => __('Value needs to be Alphabet', 'wp_deeds'),
		'alphanumeric' => __('Value needs to be Alphanumeric', 'wp_deeds'),
		'numeric'      => __('Value needs to be Numeric', 'wp_deeds'),
		'email'        => __('Value needs to be Valid Email', 'wp_deeds'),
		'url'          => __('Value needs to be Valid URL', 'wp_deeds'),
		'maxlength'    => __('Length needs to be less than {0} characters', 'wp_deeds'),
		'minlength'    => __('Length needs to be more than {0} characters', 'wp_deeds'),
		'maxselected'  => __('Select no more than {0} items', 'wp_deeds'),
		'minselected'  => __('Select at least {0} items', 'wp_deeds'),
		'required'     => __('This is required', 'wp_deeds'),
	),

	/**
	 * Import / Export Messages
	 */
	'util' => array(
		'import_success'    => __('Import succeed, option page will be refreshed..', 'wp_deeds'),
		'import_failed'     => __('Import failed', 'wp_deeds'),
		'export_success'    => __('Export succeed, copy the JSON formatted options', 'wp_deeds'),
		'export_failed'     => __('Export failed', 'wp_deeds'),
		'restore_success'   => __('Restoration succeed, option page will be refreshed..', 'wp_deeds'),
		'restore_nochanges' => __('Options identical to default', 'wp_deeds'),
		'restore_failed'    => __('Restoration failed', 'wp_deeds'),
	),

	/**
	 * Control Fields String
	 */
	'control' => array(
		// select2 select box
		'select2_placeholder' => __('Select option(s)', 'wp_deeds'),
		// fontawesome chooser
		'fac_placeholder'     => __('Select an Icon', 'wp_deeds'),
	),

);

/**
 * EOF
 */