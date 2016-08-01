<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Qinx Work');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_qxwork_domain_model_project', 'EXT:qxwork/Resources/Private/Language/locallang_csh_tx_qxwork_domain_model_project.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_qxwork_domain_model_project');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_qxwork_domain_model_board', 'EXT:qxwork/Resources/Private/Language/locallang_csh_tx_qxwork_domain_model_board.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_qxwork_domain_model_board');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_qxwork_domain_model_card', 'EXT:qxwork/Resources/Private/Language/locallang_csh_tx_qxwork_domain_model_card.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_qxwork_domain_model_card');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_qxwork_domain_model_container', 'EXT:qxwork/Resources/Private/Language/locallang_csh_tx_qxwork_domain_model_container.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_qxwork_domain_model_container');
