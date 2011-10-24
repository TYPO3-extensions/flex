<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Flex',
	array(
		'Standard' => 'index',
	),
	array(
		'Standard' => '',
	),
	'CType'
);




?>