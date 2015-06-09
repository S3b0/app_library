<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return [
	'ctrl' => [
		'title'	=> 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_domain_model_faq',
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'hideAtCopy' => TRUE,
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		],
		'searchFields' => 'title,answer,date,inquirer,responder,app,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('app_library') . 'Resources/Public/Icons/tx_applib_domain_model_faq.png'
	],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, answer, date, inquirer, responder, app',
	],
	'types' => [
		'1' => [ 'showitem' => '--palette--;;1, title, answer;;;richtext:rte_transform[mode=ts_links], app, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended, inquirer, responder, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime' ]
	],
	'palettes' => [
		'1' => [ 'showitem' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, date', 'canNotCollapse' => TRUE ]
	],
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
				'foreign_table' => 'tx_applib_domain_model_faq',
				'foreign_table_where' => 'AND tx_applib_domain_model_faq.pid=###CURRENT_PID### AND tx_applib_domain_model_faq.sys_language_uid IN (-1,0)'
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
		'starttime' => [
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [ 'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')) ],
			]
		],
		'endtime' => [
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [ 'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y')) ],
			]
		],

		'title' => [
			'exclude' => 0,
			'l10n_mode' => 'prefixLangTitle',
			'label' => 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_domain_model_faq.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			]
		],
		'answer' => [
			'exclude' => 0,
			'l10n_mode' => 'prefixLangTitle',
			'label' => 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_domain_model_faq.answer',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim,required',
				'wizards' => [
					'RTE' => [
						'icon' => 'wizard_rte2.gif',
						'notNewRecords'=> 1,
						'RTEonly' => 1,
						'script' => 'wizard_rte.php',
						'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
						'type' => 'script'
					]
				]
			]
		],
		'date' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_domain_model_faq.date',
			'config' => [
				'dbType' => 'date',
				'type' => 'input',
				'size' => 7,
				'eval' => 'date,required',
				'checkbox' => 0,
				'default' => '0000-00-00'
			]
		],
		'inquirer' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_domain_model_faq.inquirer',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			]
		],
		'responder' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_domain_model_faq.responder',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			]
		],
		'app' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_domain_model_faq.app',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_applib_domain_model_app',
				'foreign_table_where' => 'AND tx_applib_domain_model_app.sys_language_uid IN (-1,0) ORDER BY tx_applib_domain_model_app.title',
				'MM' => 'tx_applib_faq_app_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'minitems' => 1,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => [
					'_POSITION' => 'bottom',
					'suggest' => [
						'type' => 'suggest',
						'default' => [ 'searchWholePhrase' => 1 ]
					]
				]
			]
		]

	]
];
