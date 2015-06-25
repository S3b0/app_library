<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'S3b0.' . $_EXTKEY,
	'List',
	[
		'App' => 'list, show, requestUserData, download, startDownload',
		'Faq' => 'list',
		'Provider' => 'list',
		'Tag' => 'list'
	],
	// non-cacheable actions
	[
		'App' => 'list, show, requestUserData, download, startDownload',
		'Faq' => '',
		'Provider' => '',
		'Tag' => ''
	]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'S3b0.' . $_EXTKEY,
	'SubNav',
	[ 'App' => 'subNavigationLatest, subNavigationMostPopular, subNavigationFeatured, subNavigationTopDownloads, subNavigationTopRated, subNavigationTagCloud, subNavigationCategories' ],
	[ 'App' => 'subNavigationLatest, subNavigationMostPopular, subNavigationFeatured, subNavigationTopDownloads, subNavigationTopRated, subNavigationTagCloud' ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'S3b0.' . $_EXTKEY,
	'Faq',
	[ 'Faq' => 'list' ]
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/PageTS/rte.ts">');