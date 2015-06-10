<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_domain_model_tag',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'hideAtCopy' => TRUE,
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
		],
		'searchFields' => 'title,tx_realurl_pathsegment,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('app_library') . 'Resources/Public/Icons/tx_applib_domain_model_tag.png'
	],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, tx_realurl_pathsegment'
	],
	'types' => [
		'1' => [ 'showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, tx_realurl_pathsegment, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime' ]
	],
	'palettes' => [],
	'columns' => [

		'sys_language_uid' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => [
					['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
					['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0]
				]
			]
		],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
				'items' => [
					[ '', 0 ]
				],
				'foreign_table' => 'tx_applib_domain_model_tag',
				'foreign_table_where' => 'AND tx_applib_domain_model_tag.pid=###CURRENT_PID### AND tx_applib_domain_model_tag.sys_language_uid IN (-1,0)'
			]
		],
		'l10n_diffsource' => [
			'exclude' => 1,
			'config' => [
				'type' => 'passthrough'
			]
		],

		'hidden' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:cms/locallang_ttc.xlf:hidden.I.0',
			'config' => [
				'type' => 'check',
			]
		],

		'title' => [
			'exclude' => 0,
			'l10n_mode' => 'prefixLangTitle',
			'label' => 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_domain_model_tag.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			]
		],
		'tx_realurl_pathsegment' => [
			'label' => 'LLL:EXT:realurl/locallang_db.xml:pages.tx_realurl_pathsegment',
			'exclude' => 1,
			'config' => [
				'type' => 'input',
				'max' => 255,
				'eval' => 'trim,nospace,lower'
			]
		]

	]
];
