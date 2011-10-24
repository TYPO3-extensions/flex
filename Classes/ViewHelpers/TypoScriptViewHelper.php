<?php

class Tx_Flex_ViewHelpers_TypoScriptViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * @var t3lib_TSparser
	 */
	protected $typoScriptParser;

	/**
	 * @return void
	 */
	public function __construct() {
		$this->typoScriptParser = t3lib_div::makeInstance('t3lib_TSparser');
	}

	/**
	 * @return string
	 */
	public function render() {
		$cObj = $this->templateVariableContainer->get('contentObject');
		if (empty($cObj)) {
			$cObj = $GLOBALS['TSFE']->cObj;
		}

		$typoscript = $this->renderChildren();
		if (isset($typoscript['configuration'])) {
			$this->typoScriptParser->parse($typoscript['configuration']);
			return $cObj->cObjGet($this->typoScriptParser->setup);
		}
	}

}

?>