<?php
namespace S3b0\AppLibrary\Domain\Model;


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
 * (App) Provider Model of "App Library" extension.
 */
class Provider extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

	/**
	 * The title of provider.
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title = '';

	/**
	 * Provider websites/web services.
	 *
	 * @var string
	 */
	protected $websites = '';

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
	 * Returns the websites
	 *
	 * @return string $websites
	 */
	public function getWebsites() {
		return \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(PHP_EOL, $this->websites, TRUE);
	}

	/**
	 * Sets the websites
	 *
	 * @param string $websites
	 * @return void
	 */
	public function setWebsites($websites) {
		$this->websites = $websites;
	}

}