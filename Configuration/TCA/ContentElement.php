<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tt_content'] = array(
	'ctrl' => $TCA['tt_content']['ctrl'],
	'interface' => array(
		'showRecordFieldList'	=> 'block_layout,tx_flex_datastructure,tx_flex_value',
	),
	'types' => array(
		'1' => array('showitem'	=> 'block_layout,tx_flex_datastructure,tx_flex_value'),
	),
	'palettes' => array(
		'1' => array('showitem'	=> ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude'			=> 1,
			'label'				=> 'LLL:EXT:lang/locallang_general.php:LGL.language',
			'config'			=> array(
				'type'					=> 'select',
				'foreign_table'			=> 'sys_language',
				'foreign_table_where'	=> 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value', 0)
				),
			)
		),
		'l18n_parent' => array(
			'displayCond'	=> 'FIELD:sys_language_uid:>:0',
			'exclude'		=> 1,
			'label'			=> 'LLL:EXT:lang/locallang_general.php:LGL.l18n_parent',
			'config'		=> array(
				'type'			=> 'select',
				'items'			=> array(
					array('', 0),
				),
				'foreign_table' => 'tt_content',
				'foreign_table_where' => 'AND tt_content.uid=###REC_FIELD_l18n_parent### AND tt_content.sys_language_uid IN (-1,0)',
			)
		),
		'l18n_diffsource' => array(
			'config'		=>array(
				'type'		=>'passthrough',
			)
		),
		't3ver_label' => array(
			'displayCond'	=> 'FIELD:t3ver_label:REQ:true',
			'label'			=> 'LLL:EXT:lang/locallang_general.php:LGL.versionLabel',
			'config'		=> array(
				'type'		=>'none',
				'cols'		=> 27,
			)
		),
		'hidden' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'	=> array(
				'type'	=> 'check',
			)
		),
		'block_layout' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_contentelement.block_layout',
			'config'	=> array(
				'type' => 'select',
				'items' => array(
					array('-- Label --', 0),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'tx_flex_datastructure' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_contentelement.tx_flex_datastructure',
			'config'	=> array(
				'type' => 'select',
				'items' => array(
					array('-- Label --', 0),
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => 'required'
			),
		),
		'tx_flex_value' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_contentelement.tx_flex_value',
			'config'	=> array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
	),
);
## KICKSTARTER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the kickstarter



?>