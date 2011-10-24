<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2011 Rens Admiraal <r.admiraal@drecomm.nl>, Drecomm Internet Intelligence
*  			Peter Beernink <p.beernink@drecomm.nl>, Drecomm Internet Intelligence
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
 * Template
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
 class Tx_Flex_Domain_Model_Template  extends Tx_Extbase_DomainObject_AbstractEntity   {


	/**
	* title
	*
	* @var string $title
	* @validate NotEmpty
	*/
	protected $title;

	/**
	* datastructure
	*
	* @var string $datastructure
	* @validate NotEmpty
	*/
	protected $datastructure;

	/**
	* templateFile
	*
	* @var string $templateFile
	* @validate NotEmpty
	*/
	protected $templateFile;

	/**
	* icon
	*
	* @var string $icon
	*/
	protected $icon;

	/**
	* Layouts available for this block
	*
	* @var Tx_Extbase_Persistence_ObjectStorage<Tx_Flex_Domain_Model_Layout> $layout
	*/
	protected $layout;

	/**
	* class
	*
	* @var string
	*/
	protected $class;



	/**
	* The constructor of this Template
	*
	* @return void
	*/
	public function __construct(){
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	* Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	*
	* @return void
	*/
	protected function initStorageObjects(){
		/**
		* Do not modify this method!
		* It will be rewritten on each save in the kickstarter
		* You may modify the constructor of this class instead
		*/
		$this->layout = new Tx_Extbase_Persistence_ObjectStorage();
	}

	/**
	* Setter for title
	*
	* @param string $title title
	* @return void
	*/
	public function setTitle($title){
		$this->title = $title;
	}

	/**
	* Getter for title
	*
	* @return string title
	*/
	public function getTitle(){
		return $this->title;
	}

	/**
	* Setter for datastructure
	*
	* @param string $datastructure datastructure
	* @return void
	*/
	public function setDatastructure($datastructure){
		$this->datastructure = $datastructure;
	}

	/**
	* Getter for datastructure
	*
	* @return string datastructure
	*/
	public function getDatastructure(){
		return $this->datastructure;
	}

	/**
	* Setter for templateFile
	*
	* @param string $templateFile templateFile
	* @return void
	*/
	public function setTemplateFile($templateFile){
		$this->templateFile = $templateFile;
	}

	/**
	* Getter for templateFile
	*
	* @return string templateFile
	*/
	public function getTemplateFile(){
		return $this->templateFile;
	}

	/**
	* Setter for icon
	*
	* @param string $icon icon
	* @return void
	*/
	public function setIcon($icon){
		$this->icon = $icon;
	}

	/**
	* Getter for icon
	*
	* @return string icon
	*/
	public function getIcon(){
		return $this->icon;
	}

	/**
	* Adds a Layout
	*
	* @param Tx_Flex_Domain_Model_Layout $layout
	* @return void
	*/
	public function addLayout(Tx_Flex_Domain_Model_Layout $layout){
		$this->layout->attach($layout);
	}

	/**
	* Removes a Layout
	*
	* @param Tx_Flex_Domain_Model_Layout $layoutToRemove The Layout to be removed
	* @return void
	*/
	public function removeLayout(Tx_Flex_Domain_Model_Layout $layoutToRemove){
		$this->layout->detach($layoutToRemove);
	}

	/**
	* Returns the layout
	*
	* @return Tx_Extbase_Persistence_ObjectStorage<Tx_Flex_Domain_Model_Layout> $layout
	*/
	public function getLayout(){
		return $this->layout;
	}

	/**
	* Sets the layout
	*
	* @param Tx_Extbase_Persistence_ObjectStorage<Tx_Flex_Domain_Model_Layout> $layout
	* @return void
	*/
	public function setLayout($layout){
		$this->layout = $layout;
	}

	/**
	* Returns the class
	*
	* @return string $class
	*/
	public function getClass(){
		return $this->class;
	}

	/**
	* Sets the class
	*
	* @param string $class
	* @return void
	*/
	public function setClass($class){
		$this->class = $class;
	}

}
?>