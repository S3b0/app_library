<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'S3b0.' . $_EXTKEY,
	'List',
	[
		'App' => 'list, show, requestUserData, download, startDownload',
		'Faq' => 'list, show',
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
	[ 'Faq' => 'list, show' ]
);
