<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "app_library"
 *
 * Auto generated by Extension Builder 2015-04-20
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[ $_EXTKEY ] = [
	'title' => 'App Library',
	'description' => 'This extension provides an app library for TYPO3 CMS 6.2+',
	'category' => 'plugin',
	'author' => 'Sebastian Iffland, Nicolas Scheidler',
	'author_email' => 'Sebastian.Iffland@ecom-ex.com, Nicolas.Scheidler@ecom-ex.com',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => '1',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '1.0.3',
	'constraints' => [
		'depends' => [
			'typo3' => '6.2',
			'ecom_toolbox' => '1.2.0',
			'ecom_product_tools' => ''
		],
		'conflicts' => [],
		'suggests' => []
	]
];