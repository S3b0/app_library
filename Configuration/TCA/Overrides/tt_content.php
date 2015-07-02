<?php
/**
 * Created by PhpStorm.
 * User: S3b0
 * Date: 25.11.14
 * Time: 13:43
 */

if ( \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('app_library') ) {
	\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
		$GLOBALS[ 'TCA' ][ 'tt_content' ],
		[
			'ctrl'    => [
				'requestUpdate' => $GLOBALS[ 'TCA' ][ 'tt_content' ][ 'ctrl' ][ 'requestUpdate' ] . ',tx_applib_mode'
			],
			'columns' => [
				'tx_applib_mode' => [
					'displayCond' => 'FIELD:list_type:=:applibrary_list',
					'l10n_mode'   => 'exclude',
					'exclude'     => 1,
					'label'       => 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_mode',
					'config'      => [
						'type'  => 'select',
						'items' => [
							[ 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_mode.I.0', 0 ],
							[ 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_mode.I.2', 2 ],
							[ 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_mode.I.3', 3 ],
							[ 'LLL:EXT:app_library/Resources/Private/Language/locallang_db.xlf:tx_applib_mode.I.1', 1 ]
						]
					],
				]
			]
		]
	);
}