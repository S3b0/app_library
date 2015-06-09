<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$extensionConfiguration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['app_library']);
$l10nPrefix = 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:';

return [
	'ctrl' => [
		'title'	=> $l10nPrefix . 'tx_applib_domain_model_app',
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
		'requestUpdate' => 'file_reference,external_url',
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group'
		],
		'searchFields' => 'title,file_reference,external_url,icon,preview_images,youtube_links,file_size,featured_until,features,description,system_requirements,keywords,version,release_date,last_modified,supported_operating_systems,views,downloads,settings,page,rating,votes,supported_languages,related,recommended,provider,developer,copyright_holder,tags,products,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('app_library') . 'Resources/Public/Icons/tx_applib_domain_model_app.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, file_reference, external_url, icon, preview_images, youtube_links, file_size, featured_until, description, features, system_requirements, version, release_date, last_modified, supported_operating_systems, views, downloads, settings, page, rating, votes, supported_languages, related, recommended, provider, developer, copyright_holder, tags, products'
	],
	'types' => [
		'1' => [ 'showitem' => '--palette--;;basic, file_reference, external_url, file_size, icon, preview_images, youtube_links, page, tags, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.text, description;;;richtext:rte_transform[flag=rte_enabled|mode=ts_css], features;;;richtext:rte_transform[flag=rte_enabled|mode=ts_css], system_requirements;;;richtext:rte_transform[flag=rte_enabled|mode=ts_css], --div--;' . $l10nPrefix . 'tabs.dates, release_date, featured_until, last_modified, --div--;' . $l10nPrefix . 'tabs.options, supported_operating_systems, supported_languages, settings, --div--;' . $l10nPrefix . 'tabs.relations, related, recommended, categories, products, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, --palette--;LLL:EXT:cms/locallang_ttc.xlf:palette.access;access, --div--;LLL:EXT:lang/locallang_core.xlf:labels._LOCALIZATION_, sys_language_uid, l10n_parent, l10n_diffsource' ]
	],
	'palettes' => [
		'basic' => [ 'showitem' => 'title, version, developer, provider, copyright_holder, hidden', 'canNotCollapse' => 1 ],
		'access' => [ 'showitem' => 'starttime;LLL:EXT:cms/locallang_ttc.xlf:starttime_formlabel, --linebreak--, endtime;LLL:EXT:cms/locallang_ttc.xlf:endtime_formlabel, --linebreak--, fe_group;LLL:EXT:cms/locallang_ttc.xlf:fe_group_formlabel', 'canNotCollapse' => 1 ]
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
				'foreign_table' => 'tx_applib_domain_model_app',
				'foreign_table_where' => 'AND tx_applib_domain_model_app.pid=###CURRENT_PID### AND tx_applib_domain_model_app.sys_language_uid IN (-1,0)'
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
		'fe_group' => [
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.fe_group',
			'config' => [
				'type' => 'select',
				'size' => 5,
				'maxitems' => 20,
				'items' => [
					[ 'LLL:EXT:lang/locallang_general.xlf:LGL.hide_at_login', -1 ],
					[ 'LLL:EXT:lang/locallang_general.xlf:LGL.any_login', -2 ],
					[ 'LLL:EXT:lang/locallang_general.xlf:LGL.usergroups', '--div--' ]
				],
				'exclusiveKeys' => '-1,-2',
				'foreign_table' => 'fe_groups',
				'foreign_table_where' => 'ORDER BY fe_groups.title'
			]
		],

		'title' => [
			'exclude' => 0,
			'l10n_mode' => 'prefixLangTitle',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.title',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			]
		],
		'version' => [
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.version',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			]
		],
		'file_reference' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'displayCond' => 'FIELD:external_url:REQ:FALSE',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.file_reference',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'fileReference',
				[ 'maxitems' => 1 ]
			)
		],
		'external_url' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'displayCond' => 'FIELD:file_reference:REQ:FALSE',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.external_url',
			'config' => [
				'type' => 'input',
				'size' => 30,
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
		],
		'icon' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.icon',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'icon',
				[
					'appearance' => [
						'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
					],
					// custom configuration for displaying fields in the overlay/reference table
					// to use the imageoverlayPalette instead of the basicoverlayPalette
					'foreign_types' => [
						'0' => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						]
					],
					'maxitems' => 1
				],
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			)
		],
		'preview_images' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.preview_images',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'preview_images',
				[
					'appearance' => [
						'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference'
					],
					// custom configuration for displaying fields in the overlay/reference table
					// to use the imageoverlayPalette instead of the basicoverlayPalette
					'foreign_types' => [
						'0' => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
							'showitem' => '
								--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
								--palette--;;filePalette'
						]
					],
					'minitems' => 1
				],
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			)
		],
		'youtube_links' => [
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.youtube_links',
			'config' => [
				'type' => 'text',
				'cols' => 28,
				'rows' => 5,
				'eval' => 'trim',
				'wizards'  => [
					'_PADDING' => 5,
					'link'  => [
						'type' => 'popup',
						'title' => 'Link',
						'icon' => 'link_popup.gif',
						'module' => [
							'name' => 'wizard_element_browser',
							'urlParameters' => [
								'mode' => 'wizard'
							]
						],
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
						'params' => [ 'blindLinkOptions' => 'file, folder, mail, spec' ]
					]
				]
			]
		],
		'file_size' => [
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'displayCond' => 'FIELD:external_url:REQ:TRUE',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.file_size',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			]
		],
		'release_date' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.release_date',
			'config' => [
				'dbType' => 'date',
				'type' => 'input',
				'size' => 7,
				'eval' => 'date,required',
				'checkbox' => 0,
				'default' => '0000-00-00'
			]
		],
		'featured_until' => [
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.featured_until',
			'config' => [
				'dbType' => 'date',
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 0,
				'default' => '0000-00-00',
				'range' => [ 'lower' => mktime(0,0,0,date('m'), date('d'), date('Y')) + 86400 ]
			]
		],
		'description' => [
			'exclude' => 0,
			'l10n_mode' => 'prefixLangTitle',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.description',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
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
		'features' => [
			'exclude' => 0,
			'l10n_mode' => 'prefixLangTitle',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.features',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
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
		'system_requirements' => [
			'exclude' => 0,
			'l10n_mode' => 'prefixLangTitle',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.system_requirements',
			'config' => [
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim',
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
		'last_modified' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.last_modified',
			'config' => [
				'dbType' => 'date',
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 0,
				'default' => '0000-00-00'
			]
		],
		'supported_operating_systems' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems',
			'config' => [
				'type' => 'check',
				'items' => [
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.0' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.1' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.2' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.3' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.4' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.5' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.6' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.7' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.8' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.9' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.10' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.11' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.12' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.13' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.14' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.supported_operating_systems.I.15' ]
				],
				'cols' => 4
			]
		],
		'views' => [
			'exclude' => 1,
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.views',
			'config' => [
				'readOnly' => 1,
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			]
		],
		'downloads' => [
			'exclude' => 1,
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.downloads',
			'config' => [
				'readOnly' => 1,
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			]
		],
		'settings' => [
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.settings',
			'config' => [
				'type' => 'check',
				'items' => [
					[ $l10nPrefix . 'tx_applib_domain_model_app.settings.I.1' ],
					[ $l10nPrefix . 'tx_applib_domain_model_app.settings.I.2' ]
				],
				'cols' => 4
			]
		],
		'page' => [
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.page',
			'config' => [
				'type' => 'input',
				'size' => 30,
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
		],
		'rating' => [
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.rating',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'double2'
			]
		],
		'votes' => [
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.votes',
			'config' => [
				'type' => 'input',
				'size' => 4,
				'eval' => 'int'
			]
		],
		'supported_languages' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.supported_languages',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_ecomtoolbox_domain_model_language',
				'MM' => 'tx_applib_app_language_mm',
				'size' => 10,
				'autoSizeMax' => 30,
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
		],
		'related' => [
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.related',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_applib_domain_model_app',
				'foreign_table_where' => 'AND NOT tx_applib_domain_model_app.uid=###THIS_UID### AND tx_applib_domain_model_app.sys_language_uid IN (-1,0) ORDER BY tx_applib_domain_model_app.title',
				'MM' => 'tx_applib_app_app_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 20,
				'multiple' => 0,
				'wizards' => [
					'_POSITION' => 'bottom',
					'suggest' => [
						'type' => 'suggest',
						'default' => [ 'searchWholePhrase' => 1 ]
					]
				]
			]
		],
		'recommended' => [
			'exclude' => 1,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.recommended',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_applib_domain_model_app',
				'foreign_table_where' => 'AND NOT tx_applib_domain_model_app.uid=###THIS_UID### AND tx_applib_domain_model_app.sys_language_uid IN (-1,0) ORDER BY tx_applib_domain_model_app.title',
				'MM' => 'tx_applib_app_recommended_app_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 20,
				'multiple' => 0,
				'wizards' => [
					'_POSITION' => 'bottom',
					'suggest' => [
						'type' => 'suggest',
						'default' => [ 'searchWholePhrase' => 1 ]
					]
				]
			]
		],
		'provider' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.provider',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_applib_domain_model_provider',
				'items' => [ [] ],
				'maxitems' => 1
			]
		],
		'developer' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.developer',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_applib_domain_model_provider',
				'items' => [ [] ],
				'minitems' => 1,
				'maxitems' => 1
			]
		],
		'copyright_holder' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.copyright_holder',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_applib_domain_model_provider',
				'items' => [ [] ],
				'maxitems' => 1
			]
		],
		'tags' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => $l10nPrefix . 'tx_applib_domain_model_app.tags',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_applib_domain_model_tag',
				'foreign_table_where' => 'AND tx_applib_domain_model_tag.sys_language_uid IN (-1,0) ORDER BY tx_applib_domain_model_tag.title',
				'MM' => 'tx_applib_app_tag_mm',
				'size' => 10,
				'autoSizeMax' => 30,
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
		],
		'products' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_domain_model_app.products',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_ecomproducttools_domain_model_product',
				'foreign_table_where' => 'AND tx_ecomproducttools_domain_model_product.sys_language_uid IN (-1,0) ORDER BY tx_ecomproducttools_domain_model_product.title',
				'MM' => 'tx_applib_app_product_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 20,
				'multiple' => 0,
				'wizards' => [
					'_POSITION' => 'bottom',
					'suggest' => [
						'type' => 'suggest',
						'default' => [ 'searchWholePhrase' => 1 ]
					]
				]
			]
		],
		'categories' => [
			'exclude' => 0,
			'l10n_mode' => 'exclude',
			'label' => 'LLL:EXT:lang/locallang_tca.xlf:sys_category.categories',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'sys_category',
				'foreign_table_where' => ' AND (sys_category.uid=' . (\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($extensionConfiguration['rootCatCategory']) ? (int)$extensionConfiguration['rootCatCategory'] : '0') . ' OR sys_category.parent=' . (\TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($extensionConfiguration['rootCatCategory']) ? (int)$extensionConfiguration['rootCatCategory'] : '0') . ') AND sys_category.sys_language_uid IN (-1, 0) ORDER BY sys_category.title ASC',
				'minitems' => 1,
				'maxitems' => 9999,
				'autoSizeMax' => 50,
				'MM' => 'sys_category_record_mm',
				'MM_match_fields' => [
					'fieldname' => 'categories',
					'tablenames' => 'tx_applib_domain_model_app'
				],
				'MM_opposite_field' => 'items',
				'renderMode' => 'tree',
				'size' => 10,
				'treeConfig' => [
					'appearance' => [
						'expandAll' => 1,
						'maxLevels' => 99,
						'showHeader' => 1
					],
					'parentField' => 'parent'
				]
			]
		]

	]
];
