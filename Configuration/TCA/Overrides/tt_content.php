<?php
	/**
	 * Created by PhpStorm.
	 * User: sebo
	 * Date: 25.11.14
	 * Time: 13:43
	 */

$_EXTKEY = 'app_library';
$locallang_db = 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xlf:';

$tempColumns = [
	// Packages selectable
	'tx_applib_mode' => [
		'displayCond' => 'FIELD:list_type:=:applibrary_list',
		'l10n_mode' => 'exclude',
		'exclude' => 1,
		'label' => $locallang_db . 'tx_applib_mode',
		'config' => [
			'type' => 'select',
			'items' => [
				[ $locallang_db . 'tx_applib_mode.I.0', 0 ],
				[ $locallang_db . 'tx_applib_mode.I.2', 2 ],
				[ $locallang_db . 'tx_applib_mode.I.1', 1 ]
			]
		],
	]
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns, TRUE);

$GLOBALS['TCA']['tt_content']['ctrl']['requestUpdate'] .= ',tx_applib_mode';