<?php
namespace S3b0\AppLibrary\Domain\Model;

require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('app_library') . 'Classes/User/TranslateBits.php');

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>, ecom instruments GmbH
 *           Nicolas Scheidler <Nicolas.Scheidler@ecom-ex.com>, ecom instruments GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * App Model, the core of "App Library" extension.
 */
class App extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var bool
	 */
	protected $hidden = FALSE;

	/**
	 * @var int
	 */
	protected $sorting = 0;

	/**
	 * The app title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title = '';

	/**
	 * Select the app file for download.
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $fileReference = NULL;

	/**
	 * Select the app URL for download.
	 *
	 * @var string
	 */
	protected $externalUrl = '';

	/**
	 * An app icon to render, proportions may vary as included in fluid template
	 * (f:image).
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $icon = NULL;

	/**
	 * @var string
	 */
	protected $youtubeLinks = '';

	/**
	 * @var float
	 */
	protected $fileSize = 0.00;

	/**
	 * Specify app version.
	 *
	 * @var string
	 */
	protected $version = '';

	/**
	 * Set a date until the app should be marked featured.
	 *
	 * @var \DateTime
	 */
	protected $featuredUntil = NULL;

	/**
	 * Add features text block.
	 *
	 * @var string
	 */
	protected $features = '';

	/**
	 * Add description for generated detail page.
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * Specify minimum system requirements.
	 *
	 * @var string
	 */
	protected $systemRequirements = '';

	/**
	 * Set date of release.
	 *
	 * @var \DateTime
	 */
	protected $releaseDate = NULL;

	/**
	 * Set date of last modification.
	 *
	 * @var \DateTime
	 */
	protected $lastModified = NULL;

	/**
	 * Select supported operating systems for filtering / views.
	 *
	 * @var int
	 */
	protected $supportedOperatingSystems = 0;

	/**
	 * Specify your very own prize
	 *
	 * @var string
	 */
	protected $prize = '';

	/**
	 * The number of views for this app. Detail view only!
	 *
	 * @var int
	 */
	protected $views = 0;

	/**
	 * Number of downloads for this app.
	 *
	 * @var int
	 */
	protected $downloads = 0;

	/**
	 * Miscellaneous settings, see labels.
	 *
	 * @var int
	 */
	protected $settings = 0;

	/**
	 * Link to detail page.
	 *
	 * @var string
	 */
	protected $page = '';

	/**
	 * @var string
	 */
	protected $realUrl = '';

	/**
	 * Rating, incrementally summed up, to be divided by votes.
	 *
	 * @var float
	 */
	protected $rating = 0.0;

	/**
	 * Amount of people who rated this app.
	 *
	 * @var int
	 */
	protected $votes = 0;

	/**
	 * Select the app file for download.
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	protected $previewImages = NULL;

	/**
	 * Select languages supported by app.
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\EcomToolbox\Domain\Model\Language>
	 */
	protected $supportedLanguages = NULL;

	/**
	 * Set related Apps. By default they´re fetched by keywords matching.
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\App>
	 */
	protected $related = NULL;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\App>
	 */
	protected $relatedApps = NULL;

	/**
	 * Set recommended Apps.
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\App>
	 */
	protected $recommended = NULL;

	/**
	 * The app provider.
	 *
	 * @var \S3b0\AppLibrary\Domain\Model\Provider
	 */
	protected $provider = NULL;

	/**
	 * The app developer.
	 *
	 * @var \S3b0\AppLibrary\Domain\Model\Provider
	 */
	protected $developer = NULL;

	/**
	 * The copyright holder.
	 *
	 * @var \S3b0\AppLibrary\Domain\Model\Provider
	 */
	protected $copyrightHolder = NULL;

	/**
	 * Tag the app.
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\Tag>
	 */
	protected $tags = NULL;

	/**
	 * FE user-group restrictions.
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup>
	 */
	protected $feGroup = NULL;

	/**
	 * Products app is compatible with.
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomProductTools\Domain\Model\Product>
	 */
	protected $products = NULL;

	/**
	 * App categories.
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\Category>
	 */
	protected $categories = NULL;

	/**
	 * @var \S3b0\AppLibrary\Domain\Repository\FaqRepository
	 * @inject
	 */
	protected $faqRepository;

	/**
	 * @var string
	 */
	protected $osIconSize = '26x26';

	/**
	 * @var string
	 */
	protected $osIconColor = 'Black';

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->previewImages = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->supportedLanguages = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->related = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->recommended = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->tags = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->feGroup = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->products = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * @return boolean
	 */
	public function isHidden() {
		return $this->hidden;
	}

	/**
	 * @return int
	 */
	public function getSorting() {
		return $this->sorting;
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the fileReference
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference
	 */
	public function getFileReference() {
		return $this->fileReference;
	}

	/**
	 * Sets the fileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference
	 * @return void
	 */
	public function setFileReference(\TYPO3\CMS\Extbase\Domain\Model\FileReference $fileReference) {
		$this->fileReference = $fileReference;
	}

	/**
	 * Returns the externalUrl
	 *
	 * @return string $externalUrl
	 */
	public function getExternalUrl() {
		return $this->externalUrl;
	}

	/**
	 * Sets the externalUrl
	 *
	 * @param string $externalUrl
	 * @return void
	 */
	public function setExternalUrl($externalUrl) {
		$this->externalUrl = $externalUrl;
	}

	/**
	 * Returns the icon
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $icon
	 */
	public function getIcon() {
		return $this->icon;
	}

	/**
	 * Sets the icon
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $icon
	 * @return void
	 */
	public function setIcon(\TYPO3\CMS\Extbase\Domain\Model\FileReference $icon) {
		$this->icon = $icon;
	}

	/**
	 * @return array
	 */
	public function getYoutubeLinks() {
		$links = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(PHP_EOL, $this->youtubeLinks, TRUE);
		foreach ( $links as $k => &$link ) {
			$tmp = \TYPO3\CMS\Core\Utility\GeneralUtility::unQuoteFilenames($link, TRUE);
			if ( preg_match('/\/([0-9a-z\_\-]+)$/i', $tmp[0], $matches) ) {
				$link = [ $tmp[0], $matches[1] ];
			} else {
				unset($links[$k]); // Remove invalid links
			}
		}

		return $links;
	}

	public function downloadVideoPreviewImages() {
		$links = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(PHP_EOL, $this->youtubeLinks, TRUE);
		foreach ( $links as &$link ) {
			$tmp = \TYPO3\CMS\Core\Utility\GeneralUtility::unQuoteFilenames($link, TRUE);
			$videoId = preg_match('/\/([0-9a-z\_\-]+)$/i', $tmp[0], $matches);
			if ( !$videoId || file_exists('uploads/tx_applibrary/ytp_' . $matches[1] . '.jpg') ) {
				continue;
			}
			/** @var string $imgResource Default preview image */
			$imgResource = 'https://img.youtube.com/vi/' . $matches[1] . '/default.jpg';
			/** Check for maximum resolution */
			if ( \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl('https://img.youtube.com/vi/' . $matches[1] . '/maxresdefault.jpg') !== FALSE ) {
				$imgResource = 'https://img.youtube.com/vi/' . $matches[1] . '/maxresdefault.jpg';
			/** Check fo high quality */
			} elseif ( \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl('https://img.youtube.com/vi/' . $matches[1] . '/hqdefault.jpg') !== FALSE ) {
				$imgResource = 'https://img.youtube.com/vi/' . $matches[1] . '/hqdefault.jpg';
			/** Check for medium quality */
			} elseif ( \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl('https://img.youtube.com/vi/' . $matches[1] . '/mqdefault.jpg') !== FALSE ) {
				$imgResource = 'https://img.youtube.com/vi/' . $matches[1] . '/mqdefault.jpg';
			/** Check for standard definition */
			} elseif ( \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl('https://img.youtube.com/vi/' . $matches[1] . '/sddefault.jpg') !== FALSE ) {
				$imgResource = 'https://img.youtube.com/vi/' . $matches[1] . '/sddefault.jpg';
			}
			copy($imgResource, PATH_site . 'uploads/tx_applibrary/ytp_' . $matches[1] . '.jpg');
		}
	}

	/**
	 * @param string $youtubeLinks
	 */
	public function setYoutubeLinks($youtubeLinks) {
		$this->youtubeLinks = $youtubeLinks;
	}

	/**
	 * @return float
	 */
	public function getFileSize() {
		return $this->fileSize * 1024;
	}

	/**
	 * @param float $fileSize
	 */
	public function setFileSize($fileSize) {
		$this->fileSize = $fileSize;
	}

	/**
	 * Returns the version
	 *
	 * @return string $version
	 */
	public function getVersion() {
		return $this->version;
	}

	/**
	 * Sets the version
	 *
	 * @param string $version
	 * @return void
	 */
	public function setVersion($version) {
		$this->version = $version;
	}

	/**
	 * Returns the featuredUntil
	 *
	 * @return \DateTime $featuredUntil
	 */
	public function getFeaturedUntil() {
		return $this->featuredUntil;
	}

	/**
	 * Sets the featuredUntil
	 *
	 * @param \DateTime $featuredUntil
	 * @return void
	 */
	public function setFeaturedUntil(\DateTime $featuredUntil = NULL) {
		$this->featuredUntil = $featuredUntil;
	}

	/**
	 * Returns the features
	 *
	 * @return string $features
	 */
	public function getFeatures() {
		return $this->features;
	}

	/**
	 * Sets the features
	 *
	 * @param string $features
	 * @return void
	 */
	public function setFeatures($features) {
		$this->features = $features;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @return string
	 */
	public function getDescriptionTeaser() {
		preg_match('/^.{1,90}\b/s', strip_tags($this->description), $match);
		return $match[0] . '...';
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the systemRequirements
	 *
	 * @return string $systemRequirements
	 */
	public function getSystemRequirements() {
		return $this->systemRequirements;
	}

	/**
	 * Sets the systemRequirements
	 *
	 * @param string $systemRequirements
	 * @return void
	 */
	public function setSystemRequirements($systemRequirements) {
		$this->systemRequirements = $systemRequirements;
	}

	/**
	 * Returns the releaseDate
	 *
	 * @return \DateTime $releaseDate
	 */
	public function getReleaseDate() {
		return $this->releaseDate;
	}

	/**
	 * Sets the releaseDate
	 *
	 * @param \DateTime $releaseDate
	 * @return void
	 */
	public function setReleaseDate(\DateTime $releaseDate) {
		$this->releaseDate = $releaseDate;
	}

	/**
	 * Returns the lastModified
	 *
	 * @return \DateTime $lastModified
	 */
	public function getLastModified() {
		return $this->lastModified;
	}

	/**
	 * Sets the lastModified
	 *
	 * @param \DateTime $lastModified
	 * @return void
	 */
	public function setLastModified(\DateTime $lastModified) {
		$this->lastModified = $lastModified;
	}

	/**
	 * @return bool|string
	 */
	public function getCopyrightDate() {
		$date = date('Y', $this->releaseDate->getTimestamp());
		if ( $this->lastModified instanceof \DateTime && (int)$date < (int)date('Y', $this->lastModified->getTimestamp()) ) {
			$date .= '-' . date('Y', $this->lastModified->getTimestamp());
		}

		return $date;
	}

	/**
	 * Returns the supportedOperatingSystems
	 *
	 * @return array $list
	 */
	public function getSupportedOperatingSystems() {
		return \S3b0\AppLibrary\User\TranslateBits::getSupportedOperatingSystems($this->supportedOperatingSystems, $this->osIconSize, $this->osIconColor);
	}

	/**
	 * Sets the supportedOperatingSystems
	 *
	 * @param int $supportedOperatingSystems
	 * @return void
	 */
	public function setSupportedOperatingSystems($supportedOperatingSystems) {
		$this->supportedOperatingSystems = $supportedOperatingSystems;
	}

	/**
	 * Returns the prize
	 *
	 * @return string
	 */
	public function getPrize() {
		return $this->prize;
	}

	/**
	 * Sets the prize
	 *
	 * @param string $prize
	 */
	public function setPrize($prize) {
		$this->prize = $prize;
	}

	/**
	 * Returns the views
	 *
	 * @return int $views
	 */
	public function getViews() {
		return $this->views;
	}

	/**
	 * Sets the views
	 *
	 * @param int $views
	 * @return void
	 */
	public function setViews($views) {
		$this->views = $views;
	}

	/**
	 * @return void
	 */
	public function raiseViews() {
		$this->views += 1;
	}

	/**
	 * @return void
	 */
	public function lowerViews() {
		$this->views -= 1;
	}

	/**
	 * Returns the downloads
	 *
	 * @return int $downloads
	 */
	public function getDownloads() {
		return $this->downloads;
	}

	/**
	 * Sets the downloads
	 *
	 * @param int $downloads
	 * @return void
	 */
	public function setDownloads($downloads) {
		$this->downloads = $downloads;
	}

	/**
	 * @return void
	 */
	public function raiseDownloads() {
		$this->downloads += 1;
	}

	/**
	 * @return void
	 */
	public function lowerDownloads() {
		$this->downloads -= 1;
	}

	/**
	 * Returns the settings
	 *
	 * @return int $settings
	 */
	public function getSettings() {
		return $this->settings;
	}

	/**
	 * Sets the settings
	 *
	 * @param int $settings
	 * @return void
	 */
	public function setSettings($settings) {
		$this->settings = $settings;
	}

	/**
	 * Returns the page
	 *
	 * @return string $page
	 */
	public function getPage() {
		return $this->page;
	}

	/**
	 * Sets the page
	 *
	 * @param string $page
	 * @return void
	 */
	public function setPage($page) {
		$this->page = $page;
	}

	/**
	 * @return string
	 */
	public function getRealUrl() {
		if ( $this->realUrl ) {
			return $this->realUrl;
		} else {
			// Fetch character set
			$charset = $GLOBALS['TYPO3_CONF_VARS']['BE']['forceCharset'] ? $GLOBALS['TYPO3_CONF_VARS']['BE']['forceCharset'] : $GLOBALS['TSFE']->defaultCharSet;
			// Convert to lowercase
			$processedTitle = $GLOBALS['TSFE']->csConvObj->conv_case($charset, $this->title, 'toLower');
			// Strip tags
			$processedTitle = strip_tags($processedTitle);
			// Convert some special tokens to the space character
			$processedTitle = preg_replace('/[ \-+_]+/', '-', $processedTitle); // convert spaces
			// Convert extended letters to ascii equivalents
			$processedTitle = $GLOBALS['TSFE']->csConvObj->specCharsToASCII($charset, $processedTitle);
			// Strip the rest
			if ( $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['realurl']['_DEFAULT']['init']['enableAllUnicodeLetters'] ) {
				// Warning: slow!!!
				$processedTitle = preg_replace('/[^\p{L}0-9-]/u', '', $processedTitle);
			} else {
				$processedTitle = preg_replace('/[^a-zA-Z0-9-]/', '', $processedTitle);
			}
			$processedTitle = preg_replace('/\\-{2,}/', '-', $processedTitle); // Convert multiple 'spaces' to a single one
			$processedTitle = trim($processedTitle, '-');

			return $processedTitle;
		}
	}

	/**
	 * @param string $realUrl
	 */
	public function setRealUrl($realUrl) {
		$this->realUrl = $realUrl;
	}

	/**
	 * Returns the rating
	 *
	 * @return float $rating
	 */
	public function getRating() {
		return $this->votes ? $this->rating / $this->votes : 0.00;
	}

	/**
	 * Sets the rating
	 *
	 * @param float $rating
	 * @return void
	 */
	public function setRating($rating) {
		$this->rating = $rating;
	}

	/**
	 * @return float
	 */
	public function getRatingFactor() {
		return $this->getRating() / 5;
	}

	/**
	 * @return float
	 */
	public function getRatingPercentage() {
		return round($this->getRatingFactor() * 100);
	}

	/**
	 * Returns the votes
	 *
	 * @return int $votes
	 */
	public function getVotes() {
		return $this->votes;
	}

	/**
	 * Sets the votes
	 *
	 * @param int $votes
	 * @return void
	 */
	public function setVotes($votes) {
		$this->votes = $votes;
	}

	/**
	 * @return void
	 */
	public function raiseVotes() {
		$this->votes += 1;
	}

	/**
	 * @return void
	 */
	public function lowerVotes() {
		$this->votes -= 1;
	}

	/**
	 * Adds a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $previewImage
	 * @return void
	 */
	public function addPreviewImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $previewImage) {
		$this->previewImages->attach($previewImage);
	}

	/**
	 * Removes a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $previewImageToRemove The FileReference to be removed
	 * @return void
	 */
	public function removePreviewImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $previewImageToRemove) {
		$this->previewImages->detach($previewImageToRemove);
	}

	/**
	 * Returns the previewImages
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $previewImages
	 */
	public function getPreviewImages() {
		return $this->previewImages;
	}

	/**
	 * Sets the previewImages
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $previewImages
	 * @return void
	 */
	public function setPreviewImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $previewImages = NULL) {
		$this->previewImages = $previewImages;
	}

	/**
	 * Adds a Language
	 *
	 * @param \Ecom\EcomToolbox\Domain\Model\Language $supportedLanguage
	 * @return void
	 */
	public function addSupportedLanguage(\Ecom\EcomToolbox\Domain\Model\Language $supportedLanguage) {
		$this->supportedLanguages->attach($supportedLanguage);
	}

	/**
	 * Removes a Language
	 *
	 * @param \Ecom\EcomToolbox\Domain\Model\Language $supportedLanguageToRemove The Language to be removed
	 * @return void
	 */
	public function removeSupportedLanguage(\Ecom\EcomToolbox\Domain\Model\Language $supportedLanguageToRemove) {
		$this->supportedLanguages->detach($supportedLanguageToRemove);
	}

	/**
	 * Returns the supportedLanguages
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\EcomToolbox\Domain\Model\Language> $supportedLanguages
	 */
	public function getSupportedLanguages() {
		return $this->supportedLanguages;
	}

	/**
	 * Sets the supportedLanguages
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Ecom\EcomToolbox\Domain\Model\Language> $supportedLanguages
	 * @return void
	 */
	public function setSupportedLanguages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $supportedLanguages = NULL) {
		$this->supportedLanguages = $supportedLanguages;
	}

	/**
	 * Adds a App
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\App $related
	 * @return void
	 */
	public function addRelated(\S3b0\AppLibrary\Domain\Model\App $related) {
		$this->related->attach($related);
	}

	/**
	 * Removes a App
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\App $relatedToRemove The App to be removed
	 * @return void
	 */
	public function removeRelated(\S3b0\AppLibrary\Domain\Model\App $relatedToRemove) {
		$this->related->detach($relatedToRemove);
	}

	/**
	 * Returns the related
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\App> $related
	 */
	public function getRelated() {
		return $this->related;
	}

	/**
	 * Sets the related
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\App> $related
	 * @return void
	 */
	public function setRelated(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $related = NULL) {
		$this->related = $related;
	}

	/**
	 * Adds a App
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\App $app
	 * @return void
	 */
	public function addRelatedApps(\S3b0\AppLibrary\Domain\Model\App $app) {
		$this->relatedApps->attach($app);
	}

	/**
	 * Removes a App
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\App $appToRemove The App to be removed
	 * @return void
	 */
	public function removeRelatedApps(\S3b0\AppLibrary\Domain\Model\App $appToRemove) {
		$this->relatedApps->detach($appToRemove);
	}

	/**
	 * Returns the related
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\App> $related
	 */
	public function getRelatedApps() {
		return $this->relatedApps;
	}

	/**
	 * Sets the related
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\App> $relatedApps
	 * @return void
	 */
	public function setRelatedApps(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $relatedApps = NULL) {
		$this->relatedApps = $relatedApps;
	}

	/**
	 * Adds a App
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\App $recommended
	 * @return void
	 */
	public function addRecommended(\S3b0\AppLibrary\Domain\Model\App $recommended) {
		$this->recommended->attach($recommended);
	}

	/**
	 * Removes a App
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\App $recommendedToRemove The App to be removed
	 * @return void
	 */
	public function removeRecommended(\S3b0\AppLibrary\Domain\Model\App $recommendedToRemove) {
		$this->recommended->detach($recommendedToRemove);
	}

	/**
	 * Returns the recommended
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\App> $recommended
	 */
	public function getRecommended() {
		return $this->recommended;
	}

	/**
	 * Sets the recommended
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\App> $recommended
	 * @return void
	 */
	public function setRecommended(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $recommended = NULL) {
		$this->recommended = $recommended;
	}

	/**
	 * Returns the provider
	 *
	 * @return \S3b0\AppLibrary\Domain\Model\Provider $provider
	 */
	public function getProvider() {
		return $this->provider;
	}

	/**
	 * Sets the provider
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\Provider $provider
	 * @return void
	 */
	public function setProvider(\S3b0\AppLibrary\Domain\Model\Provider $provider = NULL) {
		$this->provider = $provider;
	}

	/**
	 * Returns the developer
	 *
	 * @return \S3b0\AppLibrary\Domain\Model\Provider $developer
	 */
	public function getDeveloper() {
		return $this->developer;
	}

	/**
	 * Sets the developer
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\Provider $developer
	 * @return void
	 */
	public function setDeveloper(\S3b0\AppLibrary\Domain\Model\Provider $developer = NULL) {
		$this->developer = $developer;
	}

	/**
	 * Returns the copyrightHolder
	 *
	 * @return \S3b0\AppLibrary\Domain\Model\Provider $copyrightHolder
	 */
	public function getCopyrightHolder() {
		return $this->copyrightHolder;
	}

	/**
	 * Sets the copyrightHolder
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\Provider $copyrightHolder
	 * @return void
	 */
	public function setCopyrightHolder(\S3b0\AppLibrary\Domain\Model\Provider $copyrightHolder = NULL) {
		$this->copyrightHolder = $copyrightHolder;
	}

	/**
	 * Adds a Tag
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\Tag $tag
	 * @return void
	 */
	public function addTag(\S3b0\AppLibrary\Domain\Model\Tag $tag) {
		$this->tags->attach($tag);
	}

	/**
	 * Removes a Tag
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\Tag $tagToRemove The Tag to be removed
	 * @return void
	 */
	public function removeTag(\S3b0\AppLibrary\Domain\Model\Tag $tagToRemove) {
		$this->tags->detach($tagToRemove);
	}

	/**
	 * Returns the tags
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\Tag> $tags
	 */
	public function getTags() {
		return $this->tags;
	}

	/**
	 * Sets the tags
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\Tag> $tags
	 * @return void
	 */
	public function setTags(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $tags = NULL) {
		$this->tags = $tags;
	}

	/**
	 * Adds a Category
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\Category $category
	 * @return void
	 */
	public function addCategory(\S3b0\AppLibrary\Domain\Model\Category $category) {
		$this->categories->attach($category);
	}

	/**
	 * Removes a Category
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\Category $categoryToRemove The Category to be removed
	 * @return void
	 */
	public function removeCategory(\S3b0\AppLibrary\Domain\Model\Category $categoryToRemove) {
		$this->categories->detach($categoryToRemove);
	}

	/**
	 * Returns the categories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\Category>
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * Sets the categories
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\Category> $categories
	 */
	public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories = NULL) {
		$this->categories = $categories;
	}

	/**
	 * Adds a FrontendUserGroup
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup $feGroup
	 * @return void
	 */
	public function addFeGroup(\TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup $feGroup) {
		$this->feGroup->attach($feGroup);
	}

	/**
	 * Removes a FrontendUserGroup
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup $feGroupToRemove The FrontendUserGroup to be removed
	 * @return void
	 */
	public function removeFeGroup(\TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup $feGroupToRemove) {
		$this->feGroup->detach($feGroupToRemove);
	}

	/**
	 * Returns the feGroup
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup> $feGroup
	 */
	public function getFeGroup() {
		return $this->feGroup;
	}

	/**
	 * Sets the feGroup
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup> $feGroup
	 * @return void
	 */
	public function setFeGroup(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $feGroup) {
		$this->feGroup = $feGroup;
	}

	/**
	 * Adds a Product
	 *
	 * @param \S3b0\EcomProductTools\Domain\Model\Product $product
	 * @return void
	 */
	public function addProduct(\S3b0\EcomProductTools\Domain\Model\Product $product) {
		$this->products->attach($product);
	}

	/**
	 * Removes a Product
	 *
	 * @param \S3b0\EcomProductTools\Domain\Model\Product $productToRemove The Product to be removed
	 * @return void
	 */
	public function removeProduct(\S3b0\EcomProductTools\Domain\Model\Product $productToRemove) {
		$this->products->detach($productToRemove);
	}

	/**
	 * Returns the products
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomProductTools\Domain\Model\Product> $products
	 */
	public function getProducts() {
		return $this->products;
	}

	/**
	 * Sets the products
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomProductTools\Domain\Model\Product> $products
	 * @return void
	 */
	public function setProducts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $products) {
		$this->products = $products;
	}

	/**
	 * Returns the supportedLanguagesList (generated from ObjectStorage)
	 *
	 * @return string
	 */
	public function getSupportedLanguagesList() {
		return \Ecom\EcomToolbox\Utility\Div::generateStringListFromObjectStorage($this->supportedLanguages);
	}

	/**
	 * Returns the tags (generated from ObjectStorage)
	 *
	 * @return string
	 */
	public function getTagsList() {
		return \Ecom\EcomToolbox\Utility\Div::generateStringListFromObjectStorage($this->tags);
	}

	/**
	 * Returns the categories (generated from ObjectStorage)
	 *
	 * @return string
	 */
	public function getCategoriesList() {
		return \Ecom\EcomToolbox\Utility\Div::generateStringListFromObjectStorage($this->categories);
	}

	/**
	 * @return array|\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
	 */
	public function getFaq() {
		return $this->faqRepository->ignoreStoragePidAndSysLanguageUid()->findByApp($this);
	}

	/**
	 * @return bool
	 */
	public function isFeatured() {
		return $this->featuredUntil instanceof \DateTime && $this->featuredUntil->getTimestamp() >= time();
	}

	/**
	 * @return bool
	 */
	public function isPaidApp() {
		return $this->returnBool($this->settings & 1);
	}

	/**
	 * @return bool
	 */
	public function isShowCopyright() {
		return $this->returnBool($this->settings & 2) && $this->copyrightHolder instanceof \S3b0\AppLibrary\Domain\Model\Provider;
	}

	/**
	 * @return bool
	 */
	public function isLightboxEnabled() {
		return !$this->returnBool($this->settings & 4);
	}

	/**
	 * @return int
	 */
	public function getCountCarouselItems() {
		return count($this->getYoutubeLinks()) + $this->previewImages->count();
	}

	/**
	 * @param $value
	 * @return bool
	 */
	private function returnBool($value) {
		/** For all PHP versions 5.5+ use the boolval() method */
		if ( version_compare(PHP_VERSION, '5.5', '>=') ) {
			return boolval( $value );
		} else {
			return (bool) $value;
		}
	}

}