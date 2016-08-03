<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Qinx.' . $_EXTKEY,
	'Pi1',
	array(
		'Board' => 'index, list, show, new, create, edit, update, delete',
		'Card' => 'handle, list, show, new, create, edit, update, delete',
		'Container' => 'list, show, new, create, edit, update, delete',
	),

	// non-cacheable actions
	array(
		'Board' => 'create, update, delete',
		'Card' => 'handle, create, update, delete',
		'Container' => 'create, update, delete',
	)
);
