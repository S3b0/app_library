<?php
namespace S3b0\AppLibrary\Domain\Repository;


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
use Ecom\EcomToolbox\Domain\Repository\AbstractRepository;

/**
 * The repository for Faqs
 */
class FaqRepository extends AbstractRepository {

	/**
	 * @param \S3b0\AppLibrary\Domain\Model\App $app
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByApp(\S3b0\AppLibrary\Domain\Model\App $app = NULL) {
		$query = $this->createQuery();

		return $query->matching(
			$app instanceof \S3b0\AppLibrary\Domain\Model\App ? $query->contains('app', $app) : $query->equals('app', 0)
		)->execute();
	}

}