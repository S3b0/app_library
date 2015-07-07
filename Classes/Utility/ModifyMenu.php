<?php
	/**
	 * Created by PhpStorm.
	 * User: S3b0
	 * Date: 07/07/15
	 * Time: 10:37 AM
	 */

	namespace S3b0\AppLibrary\Utility;


	use TYPO3\CMS\Core\Utility as Utility;

	class ModifyMenu extends \TYPO3\CMS\Frontend\Plugin\AbstractPlugin {

		/**
		 * @param array $item
		 * @param array $pObj
		 *
		 * @return array
		 */
		public function bradcrumb($item, $pObj) {
			/** @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer cObj */
			$this->cObj = Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectRenderer');
			$rootLine = $GLOBALS['TSFE']->rootLine;
			array_walk($rootLine, 'self::getSingleArrayValue', 'uid');
			$this->parseRootLineMenu($item, $pObj);

			return $item;
		}

		/**
		 * @param array &$item
		 * @param array $pObj
		 *
		 * @return void
		 */
		public function parseRootLineMenu(&$item = [ ], $pObj = [ ]) {
			$GPvar = Utility\GeneralUtility::_GPmerged('tx_applibrary_list');
			$localizations = (bool) $GLOBALS['TYPO3_DB']->exec_SELECTcountRows ('*', 'sys_language', '1=1' . $this->cObj->enableFields('sys_language'));
			if (Utility\MathUtility::canBeInterpretedAsInteger($GPvar['app']) && $GPvar['app']) {
				$last = array_pop($item); // Set array pointer to last object
				$record = $this->pi_getRecord('tx_applib_domain_model_app', Utility\MathUtility::convertToPositiveInteger($GPvar['app']));
				if ( $GLOBALS['TSFE']->sys_language_content && $GLOBALS['TSFE']->sys_language_contentOL !== 'hideNonTranslated' ) {
					$record = $GLOBALS['TSFE']->sys_page->getRecordOverlay('tx_applib_domain_model_app', $record, $GLOBALS['TSFE']->sys_language_content, $GLOBALS['TSFE']->sys_language_contentOL);
				}
				if ( !sizeof($record) ) {
					return NULL;
				}
				$last['ITEM_STATE'] = 'ACTIFSUB';
				$item[] = $last;
				$typoLink_Conf['parameter'] = &$GLOBALS['TSFE']->id;
				$typoLink_Conf['useCacheHash'] = 1;
				$typoLink_Conf['additionalParams'] = '&tx_applibrary_list[app]=' . Utility\MathUtility::convertToPositiveInteger($GPvar['app']); // Add piVars
				// Protect L-var
				if ( $localizations ) {
					$typoLink_Conf['additionalParams'] .= '&L=' . $GLOBALS['TSFE']->sys_language_content;
				}
				$item[] = array(
					'title' => $record['name'],
					'_OVERRIDE_HREF' => $this->cObj->typoLink_URL($typoLink_Conf),
					'ITEM_STATE' => 'CUR',
					'_SAFE' => TRUE
				);
			}
		}

		/**
		 * @param mixed &$item
		 * @param mixed $key
		 * @param string $filter
		 *
		 * @return void
		 */
		public static function getSingleArrayValue(&$item, $key, $filter = '') {
			$item = $item[ $filter ];
		}

	}

?>