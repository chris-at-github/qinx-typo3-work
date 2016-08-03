<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Qinx.' . $_EXTKEY,
	'Pi1',
	array(
		'Board' => 'index',
		'Card' => 'handle, save',
		'Container' => '',
	),

	// non-cacheable actions
	array(
		'Board' => '',
		'Card' => 'handle, save',
		'Container' => '',
	)
);
