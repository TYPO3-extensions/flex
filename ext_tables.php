<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');


t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Flex');




t3lib_extMgm::addLLrefForTCAdescr('tx_flex_domain_model_template', 'EXT:flex/Resources/Private/Language/locallang_csh_tx_flex_domain_model_template.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_flex_domain_model_template');
$TCA['tx_flex_domain_model_template'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_template',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',

		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,


		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField' 	=> 'l18n_parent',
		'transOrigDiffSourceField' 	=> 'l18n_diffsource',

		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden'
			),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Template.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_flex_domain_model_template.gif'
	)
);


		// @TODO: $tempColumns definition

t3lib_extMgm::addLLrefForTCAdescr('tx_flex_domain_model_layout', 'EXT:flex/Resources/Private/Language/locallang_csh_tx_flex_domain_model_layout.xml');
t3lib_extMgm::allowTableOnStandardPages('tx_flex_domain_model_layout');
$TCA['tx_flex_domain_model_layout'] = array (
	'ctrl' => array (
		'title'             => 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_layout',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',

		'versioningWS' 		=> 2,
		'versioning_followPages'	=> TRUE,

		'origUid' 			=> 't3_origuid',
		'languageField' 	=> 'sys_language_uid',
		'transOrigPointerField'	=> 'l18n_parent',
		'transOrigDiffSourceField'	=> 'l18n_diffsource',

		'delete' 			=> 'deleted',
		'enablecolumns' 	=> array(
			'disabled'		=> 'hidden'
		),
		'dynamicConfigFile'	=> t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Layout.php',
		'iconfile'			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_flex_domain_model_layout.gif'
	)
);


## KICKSTARTER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the kickstarter

$TCA['tx_flex_domain_model_template']['ctrl']['title'] = 'LLL:EXT:flex/Resources/Private/Language/locallang.xml:flex_template';
$TCA['tx_flex_domain_model_layout']['ctrl']['title'] = 'LLL:EXT:flex/Resources/Private/Language/locallang.xml:flex_layout';

$temporaryColumns = array(
	'block_layout' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_contentelement.block_layout',
//		'displayCond' => 'FIELD:tx_flex_datastructure:REQ:true',
		'config' => array (
			'type' => 'select',
			'itemsProcFunc' => 'EXT:flex/Classes/Helper/TcaHelper.php:&tx_Flex_Helper_TcaHelper->layoutSelectionItemsProcFunc',
			'minitems' => 0,
			'maxitems' => 1,
			'items' => array(array('', '')),
		)
	),
	'tx_flex_datastructure' => array(
		'exclude' => 1,
		'label' => 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_contentelement.tx_flex_datastructure',
		'config' => array(
			'type' => 'select',
			'items' => array(array('',0)),
			'allowNonIdValues' => 1,
			'itemsProcFunc' => 'EXT:flex/Classes/Helper/TcaHelper.php:&tx_Flex_Helper_TcaHelper->templateSelectionItemsProcFunc',
			'size' => 1,
			'minitems' => 1,
			'maxitems' => 1,
			'selicon_cols' => 10
		)
	),
	'tx_flex_value' => array(
		'exclude' => 1,
//		'displayCond' => 'FIELD:tx_flex_datastructure:REQ:true',
		'label' => 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_value',
		'config' => array(
			'type' => 'flex',
			'ds_pointerField' => 'tx_flex_datastructure',
			'ds_tableField' => 'tx_flex_domain_model_template:datastructure'
		)
	)
);

t3lib_div::loadTCA('tt_content');
t3lib_extMgm::addTCAcolumns('tt_content', $temporaryColumns, 1);

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Flex',
	'Flex Element'
);

$extensionName = str_replace(' ', '', ucwords(str_replace('_', ' ', $_EXTKEY)));

if (!empty($TCA['tt_content']['requestUpdate'])) {
	$TCA['tt_content']['ctrl']['requestUpdate'] = implode(',', array_merge(explode(',', $TCA['tt_content']['requestUpdate']), array('tx_flex_datastructure')));
} else {
	$TCA['tt_content']['ctrl']['requestUpdate'] = 'tx_flex_datastructure';
}

$TCA['tt_content']['types'][strtolower($extensionName) . '_flex']['showitem'] = 'CType;;4;button;1-1-1,header;;3;;2-2-2,block_layout,tx_flex_datastructure;;flex;;1-1-1,tx_flex_value,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility;visibility';

?>