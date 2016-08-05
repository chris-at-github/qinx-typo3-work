<?php
namespace Qinx\Qxwork\Domain\Repository;


	/***************************************************************
	 *
	 *  Copyright notice
	 *
	 *  (c) 2016 Christian Pschorr <qinx.me>
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
 * The repository for Containers
 */
class ApplicationRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * Returns an enableFields SQL statement for the specified table
	 *
	 * @param string $tableName  name of the database table
	 * @return string enableFields SQL statement
	 */
	protected function enableFields($tableName) {
		if (TYPO3_MODE === 'FE') {
			// Use enableFields in frontend mode
			$enableFields = $GLOBALS['TSFE']->sys_page->enableFields($tableName);
		} else {
			// Use enableFields in backend mode
			$enableFields = \TYPO3\CMS\Backend\Utility\BackendUtility::deleteClause($tableName);
			$enableFields .= \TYPO3\CMS\Backend\Utility\BackendUtility::BEenableFields($tableName);
		}

		return $enableFields;
	}

	/**
	 * Escapes a string for use in a database query
	 * Note that this function does not add single quotes around the string (see fullQuoteStr())
	 *
	 * @param string $string string that should be escaped
	 * @param string $tableName name of the database table can be omitted without consequences
	 * @return string escaped string
	 */
	protected function quoteStr($string, $tableName = '') {
		return $GLOBALS['TYPO3_DB']->quoteStr($string, $tableName);
	}

	/**
	 * Returns an SQL statement that checks for one or multiple storage PIDs
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query query object
	 * @param string $tableName  name of database table
	 * @return string storage pid SQL statement
	 */
	protected function storagePidStatement(\TYPO3\CMS\Extbase\Persistence\QueryInterface $query, $tableName = '') {
		// Get allowed storage pids
		$storagePids = $query->getQuerySettings()->getStoragePageIds();

		// Sanitize them (just to be sure)
		$storagePids = array_map('intval', $storagePids);

		// Generate SQL
		$tableField = ($tableName) ? $tableName . '.pid' : 'pid';
		return " AND $tableField IN (" . implode(', ', $storagePids) . ') ';
	}

	/**
	 * Debug an extbase query result. Before debugging the query you must execute it. ($query->execute())
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult
	 * @return void
	 */
	public function debugQuery(\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult) {
		$GLOBALS['TYPO3_DB']->debugOuput = 2;
		$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = true;
		$queryResult->toArray();
		\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);

		$GLOBALS['TYPO3_DB']->store_lastBuiltQuery = false;
		$GLOBALS['TYPO3_DB']->explainOutput = false;
		$GLOBALS['TYPO3_DB']->debugOuput = false;
	}

	/**
	 * Find all foreign UIDs from a mm relation. The direction in extbase is not bidirectional.
	 *
	 * You can configure an bidirectional relation about tca configuration
	 * @see http://lbrmedia.net/codebase/Eintrag/extbase-bidirektionale-mm-relation/
	 *
	 * @param array $foreign
	 * @param string $table
	 * @return array
	 */
	protected function findUidByForeign($foreign, $table) {
		$in = [];
		$uid = [];

		// we working only with a Traversable items
		if($foreign instanceof \TYPO3\CMS\Extbase\DomainObject\AbstractEntity) {
			$entity = clone $foreign;
			$foreign = [$entity];
		}

		foreach($foreign as $key) {
			if($key instanceof \TYPO3\CMS\Extbase\DomainObject\AbstractEntity) {
				$in[] = (int) $key->getUid();
			} else {
				$in[] = (int) $key;
			}
		}

		foreach($GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			$table . '.uid_foreign AS uid',
			$table,
			$table . '.uid_local IN (' . implode(',', $in) . ')'
		) as $row) {
			$uid[] = (int) $row['uid'];
		}

		return $uid;
	}
}