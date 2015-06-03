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
 * FAQ (Frequently Asked Questions) Model of "App Library" extension.
 */
class Faq extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * The original question sent.
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title = '';

	/**
	 * An answer from Support/AE.
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $answer = '';

	/**
	 * Date of inquiry.
	 *
	 * @var \DateTime
	 * @validate NotEmpty
	 */
	protected $date = NULL;

	/**
	 * Name of inquirer.
	 *
	 * @var string
	 */
	protected $inquirer = '';

	/**
	 * Name of responder.
	 *
	 * @var string
	 */
	protected $responder = '';

	/**
	 * The app FAQ belongs to.
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\App>
	 */
	protected $app = NULL;

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
		$this->app = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Returns the answer
	 *
	 * @return string $answer
	 */
	public function getAnswer() {
		return $this->answer;
	}

	/**
	 * Sets the answer
	 *
	 * @param string $answer
	 * @return void
	 */
	public function setAnswer($answer) {
		$this->answer = $answer;
	}

	/**
	 * Returns the date
	 *
	 * @return \DateTime $date
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * Sets the date
	 *
	 * @param \DateTime $date
	 * @return void
	 */
	public function setDate(\DateTime $date) {
		$this->date = $date;
	}

	/**
	 * Returns the inquirer
	 *
	 * @return string $inquirer
	 */
	public function getInquirer() {
		return $this->inquirer;
	}

	/**
	 * Sets the inquirer
	 *
	 * @param string $inquirer
	 * @return void
	 */
	public function setInquirer($inquirer) {
		$this->inquirer = $inquirer;
	}

	/**
	 * Returns the responder
	 *
	 * @return string $responder
	 */
	public function getResponder() {
		return $this->responder;
	}

	/**
	 * Sets the responder
	 *
	 * @param string $responder
	 * @return void
	 */
	public function setResponder($responder) {
		$this->responder = $responder;
	}

	/**
	 * Adds a App
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\App $app
	 * @return void
	 */
	public function addApp(\S3b0\AppLibrary\Domain\Model\App $app) {
		$this->app->attach($app);
	}

	/**
	 * Removes a App
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\App $appToRemove The App to be removed
	 * @return void
	 */
	public function removeApp(\S3b0\AppLibrary\Domain\Model\App $appToRemove) {
		$this->app->detach($appToRemove);
	}

	/**
	 * Returns the app
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\App> $app
	 */
	public function getApp() {
		return $this->app;
	}

	/**
	 * Sets the app
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\AppLibrary\Domain\Model\App> $app
	 * @return void
	 */
	public function setApp(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $app) {
		$this->app = $app;
	}

}