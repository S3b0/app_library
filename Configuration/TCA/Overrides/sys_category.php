<?php
/**
 * Created by PhpStorm.
 * User: S3b0
 * Date: 09.06.15
 * Time: 15:29
 */

$GLOBALS['TCA']['sys_category']['columns']['tx_applib_hashval'] = [
	'exclude' => 1,
	'displayCond' => 'FIELD:tx_ext_type:=:app_library',
	'l10n_mode' => 'exclude',
	'label' => 'URL-Hash',
	'config' => [
		'type' => 'input',
		'size' => 30,
		'eval' => 'trim,nospace,lower,required,unique'
	]
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', 'tx_applib_hashval', '', 'after:parent');