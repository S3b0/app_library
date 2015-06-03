<?php
namespace S3b0\AppLibrary\Controller;


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
 * ExtensionController
 */
class ExtensionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * appRepository
	 *
	 * @var \S3b0\AppLibrary\Domain\Repository\AppRepository
	 * @inject
	 */
	protected $appRepository = NULL;

	/**
	 * faqRepository
	 *
	 * @var \S3b0\AppLibrary\Domain\Repository\FaqRepository
	 * @inject
	 */
	protected $faqRepository = NULL;

	/**
	 * providerRepository
	 *
	 * @var \S3b0\AppLibrary\Domain\Repository\ProviderRepository
	 * @inject
	 */
	protected $providerRepository = NULL;

	/**
	 * tagRepository
	 *
	 * @var \S3b0\AppLibrary\Domain\Repository\TagRepository
	 * @inject
	 */
	protected $tagRepository = NULL;

	/**
	 * logRepository
	 *
	 * @var \S3b0\AppLibrary\Domain\Repository\LogRepository
	 * @inject
	 */
	protected $logRepository = NULL;

	/**
	 * frontendUserRepository
	 *
	 * @var \S3b0\AppLibrary\Domain\Repository\FrontendUserRepository
	 * @inject
	 */
	protected $frontendUserRepository = NULL;

	/**
	 * regionRepository
	 *
	 * @var \Ecom\EcomToolbox\Domain\Repository\RegionRepository
	 * @inject
	 */
	protected $regionRepository = NULL;

	/**
	 * stateRepository
	 *
	 * @var \Ecom\EcomToolbox\Domain\Repository\StateRepository
	 * @inject
	 */
	protected $stateRepository = NULL;

	/**
	 * feSession
	 *
	 * @var \Ecom\EcomToolbox\Domain\Session\FrontendSessionHandler
	 * @inject
	 */
	protected $feSession = NULL;

}