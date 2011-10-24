<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_flex_domain_model_template'] = array(
	'ctrl' => $TCA['tx_flex_domain_model_template']['ctrl'],
	'interface' => array(
		'showRecordFieldList'	=> 'title,xml,be_xml,template,icon',
	),
	'types' => array(
		'1' => array('showitem'	=> 'title,xml,be_xml,template,icon'),
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
				'foreign_table' => 'tx_flex_domain_model_template',
				'foreign_table_where' => 'AND tx_flex_domain_model_template.uid=###REC_FIELD_l18n_parent### AND tx_flex_domain_model_template.sys_language_uid IN (-1,0)',
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
		'title' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_template.title',
			'config'	=> array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'xml' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_template.xml',
			'config'	=> array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim,required'
			),
		),
		'be_xml' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_template.be_xml',
			'config'	=> array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			),
		),
		'template' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_template.template',
			'config'	=> array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'icon' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_template.icon',
			'config'	=> array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	),
);
## KICKSTARTER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the kickstarter
$TCA['tx_flex_domain_model_template']['columns']['template']['config'] = array(
	'type' => 'group',
	'internal_type' => 'file',
	'allowed' => 'htm,html',
	'disable_controls' => 'upload',
	'size' => 3
);

$TCA['tx_flex_domain_model_template']['columns']['xml']['config'] = array(
	'type' => 'group',
	'internal_type' => 'file',
	'allowed' => 'xml',
	'disable_controls' => 'upload',
	'size' => 3
);

$TCA['tx_flex_domain_model_template']['columns']['icon']['config'] = array(
	'type' => 'group',
	'internal_type' => 'file',
	'allowed' => 'gif,jpg,png',
	'size' => 3
);


?>