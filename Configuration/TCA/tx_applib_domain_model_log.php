<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return [
	'ctrl' => [
		'title'	=> 'AppLib Log',
		'label' => 'name',
		'label_alt' => 'app',
		'label_alt_force' => TRUE,
		'tstamp' => 'tstamp',
		'dividers2tabs' => TRUE,
		'rootLevel' => 1,
		'readOnly' => TRUE,
		'searchFields' => 'name,company,email,address,city,zip,country,state_province,fe_user,app,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3skin') . 'icons/gfx/clipbrd.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'name, company, email, address, city, zip, country, state_province, fe_user, app'
	],
	'types' => [
		'1' => [ 'showitem' => 'name, company, email, --palette--;Address;1, fe_user, app' ]
	],
	'palettes' => [
		'1' => [ 'showitem' => 'address, city, zip, --linebreak--, country, state_province', 'canNotCollapse' => TRUE ]
	],
	'columns' => [
		'name' => [
			'label' => 'Name',
			'config' => [
				'readOnly' => TRUE,
				'type' => 'input',
				'size' => 30
			]
		],
		'company' => [
			'label' => 'Company',
			'config' => [
				'readOnly' => TRUE,
				'type' => 'input',
				'size' => 30
			]
		],
		'email' => [
			'label' => 'E-M@il',
			'config' => [
				'readOnly' => TRUE,
				'type' => 'input',
				'size' => 30
			]
		],
		'address' => [
			'label' => 'Street Address',
			'config' => [
				'readOnly' => TRUE,
				'type' => 'input',
				'size' => 30
			]
		],
		'city' => [
			'label' => 'City',
			'config' => [
				'readOnly' => TRUE,
				'type' => 'input',
				'size' => 10
			]
		],
		'zip' => [
			'label' => 'Postal Code',
			'config' => [
				'readOnly' => TRUE,
				'type' => 'input',
				'size' => 5
			]
		],
		'country' => [
			'label' => 'Country',
			'config' => [
				'readOnly' => TRUE,
				'type' => 'select',
				'foreign_table' => 'tx_ecomtoolbox_domain_model_region',
				'items' => [['']]
			]
		],
		'state_province' => [
			'label' => 'State / Province',
			'config' => [
				'readOnly' => TRUE,
				'type' => 'select',
				'foreign_table' => 'tx_ecomtoolbox_domain_model_state',
				'items' => [['']]
			]
		],
		'fe_user' => [
			'label' => 'FE-User',
			'config' => [
				'readOnly' => TRUE,
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'items' => [['']]
			]
		],
		'app' => [
			'label' => 'App',
			'config' => [
				'readOnly' => TRUE,
				'type' => 'select',
				'foreign_table' => 'tx_applib_domain_model_app'
			]
		]
	]
];