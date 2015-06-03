<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_domain_model_provider',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'hideAtCopy' => TRUE,
		'sortby' => 'sorting',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden'
		],
		'searchFields' => 'title,websites,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('app_library') . 'Resources/Public/Icons/tx_applib_domain_model_provider.png'
	],
	'interface' => [
		'showRecordFieldList' => 'hidden, title, websites'
	],
	'types' => [
		'1' => [ 'showitem' => 'hidden;;1, title, websites' ]
	],
	'palettes' => [],
	'columns' => [

		'hidden' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:cms/locallang_ttc.xlf:hidden.I.0',
			'config' => [
				'type' => 'check'
			]
		],

		'title' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_domain_model_provider.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			]
		],
		'websites' => [
			'exclude' => 0,
			'label' => 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_domain_model_provider.websites',
			'config' => [
				'type' => 'text',
				'cols' => 28,
				'rows' => 5,
				'eval' => 'trim',
				'wizards' => [
					'link' => [
						'type' => 'popup',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel',
						'icon' => 'link_popup.gif',
						'module' => [
							'name' => 'wizard_element_browser',
							'urlParameters' => [ 'mode' => 'wizard' ]
						],
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
						'params' => [ 'blindLinkOptions' => 'file, folder, mail, spec' ]
					]
				]
			]
		]

	]
];
