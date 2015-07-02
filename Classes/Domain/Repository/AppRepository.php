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
 * The repository for Apps
 */
class AppRepository extends AbstractRepository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = [
		'featured_until' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
		'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	];

	/**
	 * @var \S3b0\EcomProductTools\Domain\Repository\ProductRepository
	 * @inject
	 */
	protected $productRepository;

	/**
	 * @var \S3b0\AppLibrary\Domain\Repository\TagRepository
	 * @inject
	 */
	protected $tagRepository;

	/**
	 * @var \Ecom\EcomToolbox\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository;

	/**
	 * Declare magic methods processed by __call() method
	 * @var string
	 */
	protected $magicMethods = 'findLatest,findMostPopular,findTopDownloads,findTopRated';

	/**
	 * @param string $search
	 * @param int    $limit
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findAll($search = '', $limit = 0) {
		$query = $this->createQuery();
		$this->setLimit($query, $limit);

		return $this->applySearch($query, $search);
	}

	/**
	 * @param string $list
	 * @param string $search
	 *
	 * @return array|null|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByUidList($list, $search = '') {
		$query = $this->createQuery();
		$this->ignoreSysLanguageUidOnQuery($query);

		return $this->applySearch($query, $search, $query->in('uid', \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(',', $list, TRUE)));
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
	 * @param string                                   $search
	 * @param int                                      $limit
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category, $search = '', $limit = 0) {
		$query = $this->createQuery();
		$this->ignoreSysLanguageUidOnQuery($query);
		$this->setLimit($query, $limit);

		return $this->applySearch($query, $search, $query->contains('categories', $category));
	}

	/**
	 * @param \S3b0\AppLibrary\Domain\Model\Provider $provider
	 * @param string                                 $search
	 * @param int                                    $limit
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByProvider(\S3b0\AppLibrary\Domain\Model\Provider $provider, $search = '', $limit = 0) {
		$query = $this->createQuery();
		$this->ignoreSysLanguageUidOnQuery($query);
		$this->setLimit($query, $limit);

		return $this->applySearch($query, $search, $query->equals('provider', $provider));
	}

	/**
	 * @param \S3b0\AppLibrary\Domain\Model\Provider $developer
	 * @param string                                 $search
	 * @param int                                    $limit
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByDeveloper(\S3b0\AppLibrary\Domain\Model\Provider $developer, $search = '', $limit = 0) {
		$query = $this->createQuery();
		$this->ignoreSysLanguageUidOnQuery($query);
		$this->setLimit($query, $limit);

		return $this->applySearch($query, $search, $query->equals('developer', $developer));
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $tags
	 * @param \S3b0\AppLibrary\Domain\Model\App            $excludeApp
	 * @param null|int                                     $limit
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function findByTags(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $tags, \S3b0\AppLibrary\Domain\Model\App $excludeApp = NULL, $limit = 0) {
		$matching = $matchingAmount = $sorting = [];

		/** @var \S3b0\AppLibrary\Domain\Model\Tag $tag */
		foreach ( $tags as $tag ) {
			if ( $apps = $this->findByTag($tag, '', $excludeApp, $limit) ) {
				/** @var \S3b0\AppLibrary\Domain\Model\App $app */
				foreach ( $apps as $app ) {
					if ( !in_array($app, $matching, TRUE) ) {
						$matching[$app->getUid()] = $app;
						$sorting[$app->getUid()] = $app->getSorting();
					}
					$matchingAmount[$app->getUid()]++;
				}
			}
		}
		array_multisort($matchingAmount, SORT_DESC, SORT_NUMERIC, $sorting, SORT_ASC, SORT_NUMERIC, $matching);
		$return = \Ecom\EcomToolbox\Utility\Div::arrayToObjectStorage($matching);

		return $return;
	}

	/**
	 * @param \S3b0\AppLibrary\Domain\Model\Tag $tag
	 * @param string                            $search
	 * @param \S3b0\AppLibrary\Domain\Model\App $excludeApp
	 * @param null|int                          $limit
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	final public function findByTag(\S3b0\AppLibrary\Domain\Model\Tag $tag, $search = '', \S3b0\AppLibrary\Domain\Model\App $excludeApp = NULL, $limit = 0) {
		$query = $this->createQuery();
		$this->ignoreSysLanguageUidOnQuery($query);
		$constraint = $query->contains('tags', $tag);

		if ( $excludeApp ) {
			$constraint = $query->logicalAnd([
				$query->logicalNot(
					$query->equals('uid', $excludeApp->getUid())
				),
				$constraint
			]);
		}

		$this->setLimit($query, $limit);

		return $this->applySearch($query, $search, $constraint);
	}

	/**
	 * @param array                             $products
	 * @param string                            $search
	 * @param \S3b0\AppLibrary\Domain\Model\App $excludeApp
	 * @param int                               $limit
	 *
	 * @return array|null|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByProducts(array $products, $search = '', \S3b0\AppLibrary\Domain\Model\App $excludeApp = NULL, $limit = 0) {
		$query = $this->createQuery();
		$this->ignoreSysLanguageUidOnQuery($query);
		$temp = [];

		foreach ( $products as $product ) {
			$temp[] = $query->contains('products', $product);
		}
		$constraint = $query->logicalOr($temp);

		if ( $excludeApp ) {
			$constraint = $query->logicalAnd([
				$query->logicalNot(
					$query->equals('uid', $excludeApp->getUid())
				),
				$constraint
			]);
		}

		$this->setLimit($query, $limit);

		return $this->applySearch($query, $search, $constraint);
	}

	/**
	 * @param \S3b0\EcomProductTools\Domain\Model\Product $product
	 * @param string                                      $search
	 * @param \S3b0\AppLibrary\Domain\Model\App           $excludeApp
	 * @param int                                         $limit
	 *
	 * @return array|null|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findByProduct(\S3b0\EcomProductTools\Domain\Model\Product $product, $search = '', \S3b0\AppLibrary\Domain\Model\App $excludeApp = NULL, $limit = 0) {
		$query = $this->createQuery();
		$this->ignoreSysLanguageUidOnQuery($query);

		$constraint = $query->contains('products', $product);

		if ( $excludeApp ) {
			$constraint = $query->logicalAnd([
				$query->logicalNot(
					$query->equals('uid', $excludeApp->getUid())
				),
				$constraint
			]);
		}

		$this->setLimit($query, $limit);

		return $this->applySearch($query, $search, $constraint);
	}

	/**
	 * @param \S3b0\EcomProductTools\Domain\Model\Product $product
	 * @param string                                      $search
	 * @param array                                       $advancedFilter
	 * @param \S3b0\AppLibrary\Domain\Model\App           $excludeApp
	 *
	 * @return null|\TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function findByProductAdvanced(\S3b0\EcomProductTools\Domain\Model\Product $product, $search = '', array $advancedFilter = [], \S3b0\AppLibrary\Domain\Model\App $excludeApp = NULL) {
		$query = $this->createQuery();
		$this->ignoreSysLanguageUidOnQuery($query);

		$constraint = $query->contains('products', $product);

		if ( $excludeApp ) {
			$constraint = $query->logicalAnd([
				$query->logicalNot(
					$query->equals('uid', $excludeApp->getUid())
				),
				$constraint
			]);
		}

		if ( $apps = $this->applySearch($query, $search, $constraint) ) {
			$return = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();

			/** @var \S3b0\AppLibrary\Domain\Model\App $app */
			foreach ( $apps as $app ) {
				$keepApp = ($advancedFilter['categories'] === '' || !preg_match('/^[0-9,]*$/i', $advancedFilter['categories'])) && ($advancedFilter['tags'] === '' || !preg_match('/^[0-9,]*$/i', $advancedFilter['tags']));
				/** Categories */
				if ( $advancedFilter['categories'] !== '' && preg_match('/^[0-9,]*$/i', $advancedFilter['categories']) && $app->getCategories()->count() ) {
					/** @var \S3b0\AppLibrary\Domain\Model\Category $category */
					foreach ( $app->getCategories() as $category ) {
						if ( \TYPO3\CMS\Core\Utility\GeneralUtility::inList($advancedFilter['categories'], $category->getUid()) ) {
							$keepApp = TRUE;
						}
					}
				}

				/** Tags */
				if ( $advancedFilter['tags'] !== '' && preg_match('/^[0-9,]*$/i', $advancedFilter['tags']) && $app->getTags()->count() ) {
					/** @var \S3b0\AppLibrary\Domain\Model\Tag $tag */
					foreach ( $app->getTags() as $tag ) {
						if ( \TYPO3\CMS\Core\Utility\GeneralUtility::inList($advancedFilter['tags'], $tag->getUid()) ) {
							$keepApp = TRUE;
						}
					}
				}

				if ( $keepApp ) {
					$return->attach($app);
				}
			}

			return $return;
		} else {
			return NULL;
		}
	}

	/**
	 * @param string                            $categories
	 *
	 * @return null|\TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function findByCategories($categories) {
		$query = $this->createQuery();
		$this->ignoreSysLanguageUidOnQuery($query);

		if ( $apps = $query->execute() ) {
			$return = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();

			/** @var \S3b0\AppLibrary\Domain\Model\App $app */
			foreach ( $apps as $app ) {
				if ( $categories !== '' && preg_match('/^[0-9,]*$/i', $categories) && $app->getCategories()->count() ) {
					/** @var \S3b0\AppLibrary\Domain\Model\Category $category */
					foreach ( $app->getCategories() as $category ) {
						if ( \TYPO3\CMS\Core\Utility\GeneralUtility::inList($categories, $category->getUid()) ) {
							$return->attach($app);
						}
					}
				}
			}

			return $return;
		} else {
			return NULL;
		}
	}

	/**
	 * @param int $limit
	 *
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findFeatured($limit = 0) {
		$query = $this->createQuery();
		$this->ignoreSysLanguageUidOnQuery($query);
		$this->setLimit($query, $limit);

		return $query->matching( $query->greaterThanOrEqual('featured_until', time()) )->execute();
	}

	/**
	 * Dispatches magic methods
	 * This is used for requests that only differ in orderings of result (first arguments element represents SQL limit!)
	 * All other functionality is exactly the same as findAll() method
	 *
	 * @param string $method    The name of the magic method
	 * @param string $arguments The arguments of the magic method
	 *
	 * @return mixed
	 */
	public function __call($method, $arguments) {
		if ( \TYPO3\CMS\Core\Utility\GeneralUtility::inList($this->magicMethods, $method) ) {
			$orderings = $this->defaultOrderings;
			switch ( $method ) {
				case 'findMostPopular':
				case 'findTopDownloads':
					$orderings = [
						'downloads' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
						'views' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
						'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
					];
					break;
				case 'findLatest':
					$orderings = [
						'last_modified' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING,
						'release_date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
					];
					break;
			}

			$query = $this->createQuery();
			$this->ignoreSysLanguageUidOnQuery($query);
			$this->setLimit($query, (int)$arguments[0]);

			return $query->setOrderings( $orderings )->execute();
		} else {
			return call_user_func([get_parent_class($this), '__call'], $method, $arguments);
		}
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface                  $query
	 * @param string                                                         $lookUp
	 * @param \TYPO3\CMS\Extbase\Persistence\Generic\Qom\ConstraintInterface $constraint
	 *
	 * @return array|null|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	private function applySearch(\TYPO3\CMS\Extbase\Persistence\QueryInterface $query, $lookUp = '', \TYPO3\CMS\Extbase\Persistence\Generic\Qom\ConstraintInterface $constraint = NULL) {
		if ( $lookUp !== '' && strlen($lookUp) > 2 ) {
			$terms = \TYPO3\CMS\Core\Utility\GeneralUtility::unQuoteFilenames($lookUp);
			$searchConstraints = [];
			foreach ( $terms as $lookUp ) {
				foreach ( ['title', 'features', 'description', 'system_requirements', 'developer.title'] as $property ) {
					$searchConstraints[] = $query->logicalOr([
						$query->equals($property, $lookUp, FALSE),
						$query->like($property, '%' . $lookUp . '%', FALSE),
						$query->like($property, '%' . $lookUp, FALSE),
						$query->like($property, $lookUp . '%', FALSE)
					]);
				}

				/** Search by Tags */
				if ( $tags = $this->tagRepository->findSimilarByProperty('title', $lookUp) ) {
					if ( count($tags) ) {
						$tagCheck = [];
						/** @var \S3b0\AppLibrary\Domain\Model\Tag $tag */
						foreach ( $tags as $tag ) {
							$tagCheck[] = $query->contains('tags', $tag);
						}
						$searchConstraints[] = $query->logicalOr($tagCheck);
					}
				}

				/** Search by Products */
				if ( $products = $this->productRepository->findSimilarByProperty('title', $lookUp) ) {
					if ( count($products) ) {
						$productCheck = [];
						/** @var \S3b0\EcomProductTools\Domain\Model\Product $product */
						foreach ( $products as $product ) {
							$productCheck[] = $query->contains('products', $product);
						}
						$searchConstraints[] = $query->logicalOr($productCheck);
					}
				}

				/** Search by Categories */
				if ( $categories = $this->categoryRepository->findSimilarByProperty('title', $lookUp) ) {
					if ( count($categories) ) {
						$categoryCheck = [];
						/** @var \TYPO3\CMS\Extbase\Domain\Model\Category $category */
						foreach ( $categories as $category ) {
							$categoryCheck[] = $query->contains('categories', $category);
						}
						$searchConstraints[] = $query->logicalOr($categoryCheck);
					}
				}
			}

			if ( $constraint instanceof \TYPO3\CMS\Extbase\Persistence\Generic\Qom\ComparisonInterface ) {
				return $query->matching(
					$query->logicalAnd([
						$constraint,
						$query->logicalOr( $searchConstraints )
					])
				)->execute();
			} else {
				return $query->matching(
					$query->logicalOr( $searchConstraints )
				)->execute();
			}
		} elseif( $lookUp !== '' ) {
			return NULL;
		} else {
			return $constraint instanceof \TYPO3\CMS\Extbase\Persistence\Generic\Qom\ComparisonInterface ? $query->matching( $constraint )->execute() : $query->execute();
		}
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
	 * @param int                                           $limit
	 */
	private function setLimit(\TYPO3\CMS\Extbase\Persistence\QueryInterface &$query, $limit = 0) {
		if ( $limit ) {
			$query->setLimit( (int)$limit );
		}
	}

}