<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_flex_domain_model_template'] = array(
	'ctrl' => $TCA['tx_flex_domain_model_template']['ctrl'],
	'interface' => array(
		'showRecordFieldList'	=> 'title,datastructure,template_file,icon,class,layout',
	),
	'types' => array(
		'1' => array('showitem'	=> 'title,datastructure,template_file,icon,class,layout'),
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
		'datastructure' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_template.datastructure',
			'config'	=> array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim,required'
			),
		),
		'template_file' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_template.template_file',
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
		'class' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_template.class',
			'config'	=> array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'layout' => array(
			'exclude'	=> 1,
			'label'		=> 'LLL:EXT:flex/Resources/Private/Language/locallang_db.xml:tx_flex_domain_model_template.layout',
			'config'	=> array(
				'type' => 'select',
				'foreign_table' => 'tx_flex_domain_model_layout',
				'foreign_field' => 'template',
				'size' => 10,
				'autoSizeMax' => 30,
				'minitems' => 0,
				'maxitems' => 999,
				'renderMode' => 'checkbox',
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table'=>'tx_flex_domain_model_layout',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
	),
);
## KICKSTARTER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the kickstarter

$TCA['tx_flex_domain_model_template']['interface'] = array('showRecordFieldList' => 'title,datastructure,template_file,class,layout');
$TCA['tx_flex_domain_model_template']['types'][1] = array('showitem' => 'title,datastructure,template_file,class,layout');

$TCA['tx_flex_domain_model_template']['columns']['template_file']['config'] = array(
	'type' => 'group',
	'internal_type' => 'file',
	'allowed' => 'htm,html',
	'disable_controls' => 'upload',
	'size' => 3
);

$TCA['tx_flex_domain_model_template']['columns']['datastructure']['config'] = array(
	'type' => 'group',
	'internal_type' => 'file',
	'allowed' => 'xml',
	'disable_controls' => 'upload',
	'size' => 3
);

$TCA['tx_flex_domain_model_template']['columns']['layout']['config'] = array(
	'type' => 'select',
	'foreign_table' => 'tx_flex_domain_model_layout',
	'foreign_table_where' => 'ORDER BY tx_flex_domain_model_layout.title',
	'size' => 10,
	'autoSizeMax' => 30,
	'minitems' => 0,
	'renderMode' => 'checkbox',
	'maxitems' => 999,
	'suppress_icons' => 1
);

$TCA['tx_flex_domain_model_template']['columns']['icon']['config'] = array(
	'type' => 'group',
	'internal_type' => 'file',
	'allowed' => 'gif,jpg,png',
	'size' => 3
);

?>