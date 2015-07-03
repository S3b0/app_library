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
use S3b0\AppLibrary\Domain\Model\App;
use S3b0\AppLibrary\Domain\Model\FrontendUser;
use S3b0\AppLibrary\Domain\Model\Log;
use S3b0\AppLibrary\Domain\Model\Provider;
use S3b0\AppLibrary\Domain\Model\Tag;
use S3b0\EcomProductTools\Domain\Model\Product;
use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Core\Utility;
use Ecom\EcomToolbox as Toolbox;

/**
 * AppController
 */
class AppController extends ExtensionController {

	/**
	 * @var \S3b0\EcomProductTools\Domain\Repository\ProductRepository
	 * @inject
	 */
	protected $productRepository;

	/**
	 * @var \Ecom\EcomToolbox\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository;

	/**
	 * @var bool
	 */
	protected $cookiesEnabled = TRUE;

	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * Override this method to solve tasks which all actions have in
	 * common.
	 *
	 * @return void
	 * @api
	 */
	public function initializeAction() {
		if ( \Ecom\EcomToolbox\Security\Backend::isAuthenticated() ) {
			$GLOBALS['TSFE']->showHiddenRecords = TRUE;
		}
	}

	/**
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentNameException
	 */
	public function initializeListAction() {
		setcookie('cookieCheck', 1);
		$this->cookiesEnabled = (bool) $_COOKIE['cookieCheck'];

		switch ( (int)$this->configurationManager->getContentObject()->data['tx_applib_mode'] ) {
			case 1: // List by product
				$this->settings['limit'] = $this->settings['apps'] = 0;
				break;
			case 2: // List selected
				$this->settings['limit'] = $this->settings['product'] = $this->settings['categories'] = $this->settings['tags'] = 0;
				break;
			case 3: // List by categories
				$this->settings['limit'] = $this->settings['product'] = $this->settings['apps'] = $this->settings['tags'] = 0;
				break;
			default:
				$this->settings['product'] = $this->settings['categories'] = $this->settings['tags'] = $this->settings['apps'] = 0;
		}

		// Add Arguments as set in settings array! No overwrite!
		if ( !$this->request->hasArgument('limit') && Utility\MathUtility::canBeInterpretedAsInteger($this->settings['limit']) ) {
			$this->request->setArgument('limit', (int)$this->settings['limit']);
		}
		if ( !$this->request->hasArgument('product') && Utility\MathUtility::canBeInterpretedAsInteger($this->settings['product']) ) {
			$this->request->setArgument('product', $this->productRepository->findByUid((int)$this->settings['product']));
		}
		if ( !$this->request->hasArgument('categories') && preg_match('/^[0-9,]*$/i', $this->settings['categories']) ) {
			$this->request->setArgument('categories', $this->settings['categories']);
		}
		if ( !$this->request->hasArgument('tags') && preg_match('/^[0-9,]*$/i', $this->settings['tags']) ) {
			$this->request->setArgument('tags', $this->settings['tags']);
		}
		if ( !$this->request->hasArgument('appList') && preg_match('/^[0-9,]*$/i', $this->settings['apps']) ) {
			$this->request->setArgument('appList', $this->settings['apps']);
		}
	}

	/**
	 * action list
	 *
	 * @param string                                      $search
	 * @param \S3b0\EcomProductTools\Domain\Model\Product $product
	 * @param string                                      $categories
	 * @param string                                      $tags
	 * @param string                                      $appList
	 * @param \TYPO3\CMS\Extbase\Domain\Model\Category    $category
	 * @param \S3b0\AppLibrary\Domain\Model\Tag           $tag
	 * @param int                                         $limit
	 *
	 * @return void
	 */
	public function listAction($search = '', Product $product = NULL, $categories = '', $tags = '', $appList = '', Category $category = NULL, Tag $tag = NULL, $limit = 0) {
		if ( $this->cookiesEnabled && !$this->feSession->get($this->extensionName . '.hasRegistered') && !Toolbox\Security\Backend::isAuthenticated() ) {
			// For logged in users redirect them directly, write data to log
			if ( $GLOBALS['TSFE']->loginUser ) {
				/** @var \S3b0\AppLibrary\Domain\Model\FrontendUser $feUser */
				$feUser = $this->frontendUserRepository->findByUid((int) $GLOBALS['TSFE']->fe_user->user['uid']);
				$this->feSession->store($this->extensionName . '.user', [
					$feUser->getName(),
					$feUser->getCompany(),
					$feUser->getEmail(),
					$feUser->getAddress(),
					$feUser->getCity(),
					$feUser->getZip(),
					$feUser->getEcomToolboxCountry()->getTitle(),
					$feUser->getEcomToolboxState()->getAbbreviation()
				]);
				$this->feSession->store($this->extensionName . '.hasRegistered', TRUE);
			} else {
				// Handle unregistered users, fetching some Marketing information ;)
				$this->forward('requestUserData');
			}
		}

		// Actual listAction
		$apps = $this->appRepository->findAll($search, $limit);

		if ( $product instanceof Product ) {
			$apps = $this->appRepository->findByProductAdvanced($product, $search, ['categories' => $categories, 'tags' => $tags]);
		} elseif ( $categories !== '' && $categories !== '0' && preg_match('/^[0-9,]*$/i', $categories) ) {
			$apps = $this->appRepository->findByCategories($categories);
		}

		if ( $appList ) {
			$apps = $this->appRepository->findByUidList($appList, $search);
		}

		if ( $category instanceof Category ) {
			$apps = $this->appRepository->findByCategory($category);
			$this->view->assign('gridTitle', \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('resultsFor', $this->extensionName, [ \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('views.detail.sidebar.category', $this->extensionName), $category->getTitle() ]));
		}

		if ( $tag instanceof Tag ) {
			$apps = $this->appRepository->findByTag($tag);
			$this->view->assign('gridTitle', \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('resultsFor', $this->extensionName, [ \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_applib_domain_model_tag', $this->extensionName), $tag->getTitle() ]));
		}

		$this->processListAction($apps, $search, $search || $tag instanceof Tag || $category instanceof Category);
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryResultInterface|\TYPO3\CMS\Extbase\Persistence\ObjectStorage $apps
	 * @param string                                                                                           $search
	 * @param bool                                                                                             $showLevelUpLink
	 */
	public function processListAction($apps, $search = '', $showLevelUpLink = FALSE) {
		$this->postProcessApps($apps);

		$this->view->assignMultiple([
			'apps' => $apps,
			'search' => $search,
			'arguments' => array_diff_key( $this->request->getArguments(), ['search' => 1] ),
			'showLevelUpLink' => $showLevelUpLink
		]);
	}

	/**
	 * action show
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\App $app
	 *
	 * @return void
	 */
	public function showAction(\S3b0\AppLibrary\Domain\Model\App $app) {
		$this->raiseOrLowerProperty($app, 'views');
		$this->postProcessApp($app, $tmp = FALSE);
		$this->view->assign('app', $app);
	}

	/**
	 * action download
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\App $app
	 *
	 * @return void
	 */
	public function downloadAction(\S3b0\AppLibrary\Domain\Model\App $app) {
		$this->raiseOrLowerProperty($app, 'downloads');
		if ( !\Ecom\EcomToolbox\Security\Backend::isAuthenticated() ) {
			$this->writeLog($app);
		}

		if ( $app->getExternalUrl() ) {
			/** @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $contentObject */
			$contentObject = Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
			$this->redirectToUri( $contentObject->typoLink_URL([ 'parameter' => $app->getExternalUrl() ]) );
		}

		$this->redirectToUri( $this->uriBuilder->uriFor('startDownload', $this->request->getArguments()) );
	}

	/**
	 * action startDownload
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\App $app
	 *
	 * @return void
	 */
	public function startDownloadAction(\S3b0\AppLibrary\Domain\Model\App $app) {
		$file = $app->getFileReference()->getOriginalResource()->getPublicUrl(TRUE);

		if ( file_exists( $file ) ) {
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . basename( $file ));
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize( $file ));
			readfile( $file );
			exit;
		}
	}

	/**
	 * Log downloads!
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\App          $app
	 * @param \S3b0\AppLibrary\Domain\Model\Log          $log
	 * @param \S3b0\AppLibrary\Domain\Model\FrontendUser $frontendUser
	 *
	 * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
	 * @return void
	 */
	public function writeLog(App $app = NULL, Log $log = NULL, FrontendUser $frontendUser = NULL) {
		if ( !$log instanceof Log ) {
			$log = new Log();
			$userData = $this->feSession->get($this->extensionName . '.user');
			/** @var \Ecom\EcomToolbox\Domain\Model\Region $country */
			$country = $this->regionRepository->findOneByTitle($userData[6]);
			$state = NULL;
			if ( $userData[7] ) {
				/** @var \Ecom\EcomToolbox\Domain\Model\State $state */
				$state = $this->stateRepository->findOneByAbbreviation($userData[7]);
			}
			$log->setPid(0)
				->setName($userData[0])
				->setCompany($userData[1])
				->setEmail($userData[2])
				->setAddress($userData[3])
				->setCity($userData[4])
				->setZip($userData[5])
				->setCountry($country)
				->setStateProvince($state)
				->setFeUser($frontendUser)
				->setApp($app);
		}

		$this->logRepository->add($log);
		/** @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager */
		$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
		$persistenceManager->add($log);
		$persistenceManager->persistAll();
	}

	/**
	 * Initializes the requestUserDataAction
	 */
	public function initializeRequestUserDataAction() {
		$propertyMappingConfiguration = $this->arguments['newLog']->getPropertyMappingConfiguration();
		$propertyMappingConfiguration->allowProperties('stateProvince');
	}

	/**
	 * action requestUserData
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\Log $newLog
	 *
	 * @ignorevalidation $newLog
	 * @return void
	 */
	public function requestUserDataAction(Log $newLog = NULL) {
		if ( $newLog instanceof Log && $newLog->getName() && $newLog->getCompany() && $newLog->getEmail() && $newLog->getAddress() && $newLog->getCity() && $newLog->getZip() && $newLog->getCountry() instanceof Toolbox\Domain\Model\Region ) {
			$this->feSession->store($this->extensionName . '.user', [
				$newLog->getName(),
				$newLog->getCompany(),
				$newLog->getEmail(),
				$newLog->getAddress(),
				$newLog->getCity(),
				$newLog->getZip(),
				$newLog->getCountry()->getTitle(),
				$newLog->getStateProvince() instanceof \Ecom\EcomToolbox\Domain\Model\State ? $newLog->getStateProvince()->getAbbreviation() : ''
			]);
			$this->feSession->store($this->extensionName . '.hasRegistered', TRUE);
			$this->redirectToUri( $this->uriBuilder->build() );
		}

		$this->view->assignMultiple([
			'log' => $newLog,
			'countries' => $this->regionRepository->findByType(0),
			'states' => $this->stateRepository->findAll()
		]);
	}

	/**
	 * action subNavigation
	 *
	 * @param string $method
	 *
	 * @return void
	 */
	public function subNavigationAction($method) {
		$this->view->assign('apps', $this->appRepository->{$method}( (int)$this->settings['limit'] ));
	}

	/**
	 * action subNavigationLatest
	 *
	 * @return void
	 */
	public function subNavigationLatestAction() {
		$this->forward('subNavigation', NULL, NULL, ['method' => 'findLatest']);
	}

	/**
	 * action subNavigationMostPopular
	 * currently figured out by downloads and views, @todo may check rating when included afterwards
	 *
	 * @return void
	 */
	public function subNavigationMostPopularAction() {
		$this->forward('subNavigation', NULL, NULL, ['method' => 'findMostPopular']);
	}

	/**
	 * action subNavigationFeatured
	 *
	 * @return void
	 */
	public function subNavigationFeaturedAction() {
		$this->forward('subNavigation', NULL, NULL, ['method' => 'findFeatured']);
	}

	/**
	 * action subNavigationTopDownloads
	 *
	 * @return void
	 */
	public function subNavigationTopDownloadsAction() {
		$this->forward('subNavigation', NULL, NULL, ['method' => 'findTopDownloads']);
	}

	/**
	 * action subNavigationTopRated
	 *
	 * @return void
	 */
	public function subNavigationTopRatedAction() {
		$this->forward('subNavigation', NULL, NULL, ['method' => 'findTopRated']);
	}

	/**
	 * action subNavigationTagCloud
	 *
	 * @return void
	 */
	public function subNavigationTagCloudAction() {
		$tags = $this->tagRepository->findAll()->toArray();
		usort($tags, 'self::sortTags');
		array_walk($tags, 'self::prepareTags');
		shuffle($tags);
		$this->view->assign('tags', $tags);
	}

	/**
	 * @param \S3b0\AppLibrary\Domain\Model\Tag $tagA
	 * @param \S3b0\AppLibrary\Domain\Model\Tag $tagB
	 *
	 * @return int
	 */
	private static function sortTags($tagA, $tagB) {
		return ($tagA->getReferenceCount() < $tagB->getReferenceCount()) ? -1 : 1;
	}

	/**
	 * @param \S3b0\AppLibrary\Domain\Model\Tag $tag
	 * @param int                               $index
	 */
	private static function prepareTags(&$tag, $index) {
		$tag->setPriority($index + 1);
	}

	/**
	 * action subNavigationCategories
	 *
	 * @return void
	 */
	public function subNavigationCategoriesAction() {
		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['app_library']);
		/** @var \Ecom\EcomToolbox\Domain\Model\Category $rootCategory */
		$rootCategory = $this->categoryRepository->findByUid((int)$extConf['rootCatCategory']);
		$this->view->assign('categories', $this->categoryRepository->findByParent($rootCategory));
	}

	/**
	 * @param array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface $apps
	 *
	 * @return void
	 */
	final private function postProcessApps($apps) {
		$filterCategories = [];

		if ( $apps instanceof \Countable && $apps->count() || ( is_array($apps) && count($apps) ) ) {
			$requestReload = FALSE;
			/** @var \S3b0\AppLibrary\Domain\Model\App $app */
			foreach ( $apps as $app ) {
				$this->postProcessApp($app, $requestReload, $filterCategories);
			}
			if ( $requestReload ) {
				$this->redirectToUri( $this->uriBuilder->uriFor($this->request->getControllerActionName(), $this->request->getArguments()) );
			}
			ksort($filterCategories);
		}

		$this->view->assign('filterCategories', $filterCategories);
	}

	/**
	 * @param \S3b0\AppLibrary\Domain\Model\App $app
	 * @param bool                              $requestReload
	 * @param null|array                        $filterCategories
	 *
	 * @return void
	 */
	final private function postProcessApp(App $app, &$requestReload, &$filterCategories = NULL) {
		/** Check for outdated featured apps and reset corresponding property */
		if ( $app->getFeaturedUntil() && $app->getFeaturedUntil() < new \DateTime() ) {
			$app->setFeaturedUntil();
			$this->appRepository->update($app);
			$requestReload = TRUE;
		}

		if ( count($app->getYoutubeLinks()) ) {
			$app->downloadVideoPreviewImages();
		}

		/** Set related Apps either by property or tags */
		if ( $app->getRelated()->count() ) {
			$app->setRelatedApps( $app->getRelated() );
		} elseif ( $app->getTags()->count() ) {
			$relatedApps = $this->appRepository->findByTags($app->getTags(), $app, Utility\MathUtility::canBeInterpretedAsInteger($this->settings['limits']['related']) ? (int)$this->settings['limits']['related'] : 20);
			$app->setRelatedApps( $relatedApps );
		}

		if ( is_array($filterCategories) ) {
			/** @var \S3b0\AppLibrary\Domain\Model\Category $category */
			foreach ( $app->getCategories() as $category ) {
				if ( !array_key_exists($category->getJsSelector(), $filterCategories) ) {
					$filterCategories[ $category->getJsSelector() ] = [
						'title' => $category->getTitle(),
						'appCount' => 1
					];
				} else {
					$filterCategories[ $category->getJsSelector() ]['appCount']++;
				}
			}
		}
	}

	/**
	 * In-|Decrease built-in counters
	 *
	 * @param \S3b0\AppLibrary\Domain\Model\App $app
	 * @param string                            $property
	 * @param bool                              $decrease
	 *
	 * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
	 * @return void
	 */
	final public function raiseOrLowerProperty(App $app, $property = '', $decrease = FALSE) {
		if (
			$app->_hasProperty( $property )
			&& gettype( $app->_getProperty( $property ) ) === 'integer'
			&& method_exists( $app, 'raise' . ucfirst( $property ) )
			&& method_exists( $app, 'lower' . ucfirst( $property ) )
			&& !$this->feSession->get($this->extensionName . '.' . $app->getUid()  . '.' . $property . '.vote')
		) {
			call_user_func( [ $app, ( $decrease ? 'lower' : 'raise' ) . ucfirst( $property ) ] );
			$this->appRepository->update( $app );
		}
		$this->feSession->store($this->extensionName . '.' . $app->getUid()  . '.' . $property . '.vote', 1);
	}

	/**
	 * Magic methods
	 *
	 * @param $method
	 * @param $arguments
	 */
	public function __call($method, $arguments) {
		if ( substr($method, 0, 6) === 'listBy' && method_exists('S3b0\AppLibrary\Domain\Repository\AppRepository', 'findBy' . substr($method, 6)) || property_exists('S3b0\AppLibrary\Domain\Model\App', lcfirst(substr($method, 6))) ) {
			$call = 'findBy' . substr($method, 6);
			$this->processListAction($this->appRepository->{$call}($arguments[0], $arguments[1]), $arguments[1], TRUE); // $arguments[0] => {property} | $arguments[1] => {search}
		}
	}

}