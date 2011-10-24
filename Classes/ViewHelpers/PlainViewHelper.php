<?php

class Tx_Flex_ViewHelpers_PlainViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * @return string
	 */
	public function render() {
		$content = $this->renderChildren();
		if (is_array($content) && isset($content['configuration'])) {
			return $content['configuration'];
		}
		return $content;
	}

}

?>