<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Qinx.' . $_EXTKEY,
	'Pi1',
	array(
		'Dashboard' => 'index',
		'Board' => 'list, show, new, create, edit, update, delete',
		'Card' => 'list, show, new, create, edit, update, delete',
		'Container' => 'list, show, new, create, edit, update, delete',
	),

	// non-cacheable actions
	array(
		'Dashboard' => '',
		'Board' => 'create, update, delete',
		'Card' => 'create, update, delete',
		'Container' => 'create, update, delete',
	)
);
