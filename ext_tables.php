<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'S3b0.AppLibrary',
	'List',
	'App Library - List',
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath( 'app_library' ) . 'ext_icon.png'
);

$TCA['tt_content']['types']['list']['subtypes_addlist']['applibrary_list'] = 'tx_applib_mode, pi_flexform';
$TCA['tt_content']['types']['list']['subtypes_excludelist']['applibrary_list'] = 'select_key';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('applibrary_list', 'FILE:EXT:app_library/Configuration/FlexForms/flexform_applibrary_list.xml');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'S3b0.AppLibrary',
	'SubNav',
	'App Library - Sub Navigation',
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath( 'app_library' ) . 'ext_icon2.png'
);

$TCA['tt_content']['types']['list']['subtypes_addlist']['applibrary_subnav'] = 'pi_flexform';
$TCA['tt_content']['types']['list']['subtypes_excludelist']['applibrary_subnav'] = 'select_key';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue('applibrary_subnav', 'FILE:EXT:app_library/Configuration/FlexForms/flexform_applibrary_subnav.xml');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'S3b0.AppLibrary',
	'Faq',
	'App Library - FAQ',
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath( 'app_library' ) . 'ext_icon3.png'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('app_library', 'Resources/Private/TypoScript', 'App Library');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_applib_domain_model_app', 'EXT:app_library/Resources/Private/Language/locallang_csh_tx_applib_domain_model_app.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_applib_domain_model_faq', 'EXT:app_library/Resources/Private/Language/locallang_csh_tx_applib_domain_model_faq.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_applib_domain_model_provider', 'EXT:app_library/Resources/Private/Language/locallang_csh_tx_applib_domain_model_provider.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_applib_domain_model_tag', 'EXT:app_library/Resources/Private/Language/locallang_csh_tx_applib_domain_model_tag.xlf');