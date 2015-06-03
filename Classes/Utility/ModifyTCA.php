<?php
/**
 * Created by PhpStorm.
 * User: S3b0
 * Date: 14/04/15
 * Time: 09:50
 */

namespace S3b0\AppLibrary\Utility;

/**
 * Class ModifyTCA
 * @package S3b0\AppLibrary\Utility
 */
class ModifyTCA {

	/**
	 * @param array                              $PA
	 * @param \TYPO3\CMS\Backend\Form\FormEngine $fObj
	 *
	 * @return string
	 */
	public function clearFieldValue(array &$PA, \TYPO3\CMS\Backend\Form\FormEngine $fObj = NULL) {
		$formField = '<input type="hidden" name="' . $PA['itemFormElName'] . '" value="" />Default';
		return $formField;
	}

}