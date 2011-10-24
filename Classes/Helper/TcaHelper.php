<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Peter Beernink <p.beernink@drecomm.nl>, Drecomm
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
 * Handles modifications in the backend like adding fields to specific tables.
 *
 * @author Rens Admiraal <r.admiraal@drecomm.nl>
 */
class Tx_Flex_Helper_TcaHelper {

	/**
	 * @var Tx_Flex_Domain_Repository_TemplateRepository
	 */
	private $templateRepository;

	/**
	 * @return void
	 */
	public function __construct() {
		$this->templateRepository = t3lib_div::makeInstance('Tx_Flex_Domain_Repository_TemplateRepository');
	}

	/**
	 * @param array $params
	 * @param t3lib_TCEforms $pObj
	 * @return void
	 */
	public function templateSelectionItemsProcFunc(array &$params, &$pObj) {

		$templates = $this->templateRepository->findAll();
		if (!empty($templates)) {
			$backPath = str_repeat('../', substr_count(TYPO3_mainDir, '/'));
			foreach ($templates as $template) {
				$icon = $backPath . $template->getIcon();
				if ($icon == $backPath) {
					$icon = NULL;
				}
				$params['items'][] = array(
					$template->getTitle(),
					$template->getUid(),
					$icon
				);
			}
		}
	}

	/**
	 * @param array $params
	 * @param t3lib_TCEforms $pObj
	 * @return void
	 */
	public function layoutSelectionItemsProcFunc(array &$params, &$pObj) {
		$template = $this->templateRepository->findByUid($params['row']['tx_flex_datastructure']);
		if ($template !== NULL) {
			foreach ($template->getLayout() as $layout) {
				$params['items'][] = array(
					$layout->getTitle(),
					$layout->getUid(),
				);
			}
		}
	}
}

?>