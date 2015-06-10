<?php
/**
 * Created by PhpStorm.
 * User: S3b0
 * Date: 09.06.15
 * Time: 15:29
 */

if ( \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('realurl') ) {
	\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule(
		$GLOBALS['TCA']['sys_category'],
		[
			'columns' => [
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
		]
	);
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', 'tx_realurl_pathsegment', '', 'after:parent');
}