<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 Rens Admiraal <r.admiraal@drecomm.nl>, Drecomm Internet Intelligence
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
 * Controller for the Template object
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Flex_Controller_StandardController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * cObject
	 *
	 * @var tslib_cObj
	 */
	protected $cObject;

	/**
	 * templateRepository
	 *
	 * @var Tx_Flex_Domain_Repository_TemplateRepository
	 */
	protected $templateRepository;

	/**
	 * injectConfigurationManager
	 *
	 * @param Tx_Extbase_Configuration_ConfigurationManager $configurationManager
	 * @return void
	 */
	public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManager $configurationManager) {
		parent::injectConfigurationManager($configurationManager);

		$this->cObject = $configurationManager->getContentObject();
		$flexformService = t3lib_div::makeInstance('Tx_Extbase_Service_FlexFormService');
		$this->settings['flex'] = $flexformService->convertFlexFormContentToArray($this->cObject->data['tx_flex_value']);
	}

	/**
	 * Initializes the current action
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->templateRepository = t3lib_div::makeInstance('Tx_Flex_Domain_Repository_TemplateRepository');
	}

	/**
	 * indexAction
	 *
	 * @return string
	 */
	public function indexAction() {
		if (!empty($this->cObject->data['tx_flex_datastructure'])) {
			$template = $this->templateRepository->findByUid((int) $this->cObject->data['tx_flex_datastructure']);
			return $this->show($template);
		} else {
			return '';
		}
	}

	/**
	 * Render a Template
	 *
	 * @param Tx_Flex_Domain_Model_Template $template the Template to be deleted
	 * @return
	 */
	public function show(Tx_Flex_Domain_Model_Template $template) {

		$flexformValues = t3lib_div::xml2array($this->cObject->data['tx_flex_value']);
		foreach ($flexformValues['data']['sDEF']['lDEF'] as $key => $value) {
			$this->cObject->data['flex_' . $key] = $value['vDEF'];
		}

		$renderingConfigurations = array();
		$flexFormConfig = t3lib_div::xml2array(
			t3lib_div::getUrl($template->getDatastructure())
		);

		$sheets = array();
		if (isset($flexFormConfig['sheets'])) {
			foreach ($flexFormConfig['sheets'] as $sheetIndex => $sheet) {
				$sheets[] = $sheet;
			}
		} elseif (isset($flexFormConfig['ROOT'])) {
			$sheets[] = $flexFormConfig;
		}

		foreach ($sheets as $sheetIndex => $sheet) {
			$renderingConfigurations = array_merge($renderingConfigurations, $this->parseElement($sheet['ROOT']['el'], $this->settings['flex']));
		}

		$html = '';
		$view = t3lib_div::makeInstance('Tx_Fluid_View_StandaloneView');

			// Add namespaces
		if (!empty($this->settings['namespaces']) && is_array($this->settings['namespaces'])) {
			foreach ($this->settings['namespaces'] as $namespace => $path) {
				$html .= '{namespace ' . $namespace . '=' . $path . '}';
			}
		}

		$templateFile = $template->getTemplateFile();
		if (!empty($templateFile)) {
			$baseDirectory = t3lib_div::dirname(PATH_site . $templateFile) . DIRECTORY_SEPARATOR;
			$view->setLayoutRootPath($baseDirectory . 'Layouts/');
			$view->setPartialRootPath($baseDirectory . 'Partials/');
			$view->setTemplateSource(t3lib_div::getUrl(PATH_site . $templateFile));
		} else {
			foreach ($renderingConfigurations as $key => $value) {
				$html .= "{elements." . $key . "->flex:typoScript()}";
			}
			$view->setTemplateSource($html);
		}

		$view->assign('elements', $renderingConfigurations);
		$view->assign('contentObject', $this->cObject);
		return $view->render();
	}

	/**
	 * Parses the elements from the flexform and determine how they should be
	 * rendered.
	 *
	 * @param array $configurationArray
	 * @param array $values
	 * @return array
	 */
	private function parseElement(array $configurationArray, array $values) {
		$renderingConfigurations = array();
		foreach ($values as $index => $element) {
			if (!isset($configurationArray[$index])) {
				continue;
			}

				// Do we need to render this specific item?
			if (isset($configurationArray[$index]['tx_flex']) && isset($configurationArray[$index]['tx_flex']['eType'])) {
				$renderingConfigurations[$index]['configuration'] = $this->parseRenderConfiguration($configurationArray[$index]['tx_flex'], $element, $values);
			} else {
				if (isset($configurationArray[$index]['section'])) {
					$renderingConfigurations['children'] = array();
					foreach ($element as $value) {
						$renderingConfigurations['children'][] = $this->parseElement($configurationArray[$index]['el'], $value);
					}
				} else {
					$renderingConfigurations = $this->parseElement($configurationArray[$index]['el'], $element);
				}
			}
		}
		return $renderingConfigurations;
	}

	/**
	 * Parses the renderConfiguration
	 *
	 * @param array $renderConfiguration
	 * @param string $currentValue The value of the current item
	 * @param array $allValues All values at the current level
	 * @return string;
	 */
	private function parseRenderConfiguration(array $renderConfiguration, $currentValue, array $allValues) {
		switch ($renderConfiguration['eType']) {
			case 'TypoScript':
				$renderingConfiguration = $this->getTypoScriptRenderingConfiguration($renderConfiguration, $allValues);
				break;
			case 'none':
				break;
			case 'plain':
			default:
				$renderingConfiguration = $currentValue;
		}
		return $renderingConfiguration;
	}

	/**
	 * Parses the TypoScript configuration and substitute references to other
	 * fields with their values.
	 *
	 * @param array $renderConfiguration The TypoScript configuration
	 * @param array $allValues All values at the current level
	 * @return string The typoscript configuration.
	 */
	private function getTypoScriptRenderingConfiguration(array $renderConfiguration, array $allValues) {
		if (!empty($renderConfiguration['TypoScript']) &&
				$renderConfiguration['eType'] == 'TypoScript') {
			return $renderConfiguration['TypoScript'];
		}
		return NULL;
	}

}

?>