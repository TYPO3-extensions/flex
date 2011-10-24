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
 * Layout
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
 class Tx_Flex_Domain_Model_Layout  extends Tx_Extbase_DomainObject_AbstractEntity   {


	/**
	* title
	*
	* @var string $title
	* @validate NotEmpty
	*/
	protected $title;

	/**
	* layoutFile
	*
	* @var string $layoutFile
	* @validate NotEmpty
	*/
	protected $layoutFile;

	/**
	* class
	*
	* @var string
	*/
	protected $class;



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
	* Setter for layoutFile
	*
	* @param string $layoutFile layoutFile
	* @return void
	*/
	public function setLayoutFile($layoutFile){
		$this->layoutFile = $layoutFile;
	}

	/**
	* Getter for layoutFile
	*
	* @return string layoutFile
	*/
	public function getLayoutFile(){
		return $this->layoutFile;
	}

	/**
	* The constructor of this Layout
	*
	* @return void
	*/
	public function __construct(){

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