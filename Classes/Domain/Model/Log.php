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
use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;

/**
 * Log
 */
class Log extends \TYPO3\CMS\Extbase\DomainObject\AbstractValueObject {

	/**
	 * @var string
	 * @validate Ecom\EcomToolbox\Validation\Validator\NotEmpty
	 */
	protected $name = '';

	/**
	 * @var string
	 * @validate Ecom\EcomToolbox\Validation\Validator\NotEmpty
	 */
	protected $company = '';

	/**
	 * @var string
	 * @validate Ecom\EcomToolbox\Validation\Validator\NotEmpty, EmailAddress
	 */
	protected $email = '';

	/**
	 * @var string
	 * @validate Ecom\EcomToolbox\Validation\Validator\NotEmpty
	 */
	protected $address = '';

	/**
	 * @var string
	 * @validate Ecom\EcomToolbox\Validation\Validator\NotEmpty
	 */
	protected $city = '';

	/**
	 * @var string
	 * @validate Ecom\EcomToolbox\Validation\Validator\NotEmpty
	 */
	protected $zip = '';

	/**
	 * @var \Ecom\EcomToolbox\Domain\Model\Region
	 * @validate GenericObject
	 */
	protected $country = NULL;

	/**
	 * @var \Ecom\EcomToolbox\Domain\Model\State
	 */
	protected $stateProvince = NULL;

	/**
	 * @var \S3b0\AppLibrary\Domain\Model\FrontendUser
	 */
	protected $feUser = NULL;

	/**
	 * @var \S3b0\AppLibrary\Domain\Model\App
	 * @validate Ecom\EcomToolbox\Validation\Validator\NotEmpty
	 */
	protected $app = NULL;

	/**
	 * Setter for the pid.
	 *
	 * @param int|NULL $pid
	 * @return Log
	 */
	public function setPid($pid) {
		parent::setPid($pid);
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return Log
	 */
	public function setName($name) {
		$this->name = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * @param string $company
	 * @return Log
	 */
	public function setCompany($company) {
		$this->company = $company;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $email
	 * @return Log
	 */
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @param string $address
	 * @return Log
	 */
	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * @param string $city
	 * @return Log
	 */
	public function setCity($city) {
		$this->city = $city;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * @param string $zip
	 * @return Log
	 */
	public function setZip($zip) {
		$this->zip = $zip;
		return $this;
	}

	/**
	 * @return \Ecom\EcomToolbox\Domain\Model\Region
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * @param \Ecom\EcomToolbox\Domain\Model\Region $country
	 * @return Log
	 */
	public function setCountry(\Ecom\EcomToolbox\Domain\Model\Region $country = NULL) {
		$this->country = $country;
		return $this;
	}

	/**
	 * @return \Ecom\EcomToolbox\Domain\Model\State
	 */
	public function getStateProvince() {
		return $this->stateProvince;
	}

	/**
	 * @param \Ecom\EcomToolbox\Domain\Model\State $stateProvince
	 * @return Log
	 */
	public function setStateProvince(\Ecom\EcomToolbox\Domain\Model\State $stateProvince = NULL) {
		$this->stateProvince = $stateProvince;
		return $this;
	}

	/**
	 * @return FrontendUser
	 */
	public function getFeUser() {
		return $this->feUser;
	}

	/**
	 * @param FrontendUser $feUser
	 * @return Log
	 */
	public function setFeUser(FrontendUser $feUser = NULL) {
		$this->feUser = $feUser;
		return $this;
	}

	/**
	 * @return App
	 */
	public function getApp() {
		return $this->app;
	}

	/**
	 * @param App $app
	 * @return Log
	 */
	public function setApp(App $app = NULL) {
		$this->app = $app;
		return $this;
	}

}