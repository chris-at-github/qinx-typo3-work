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
class ContainerRepository extends ApplicationRepository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = array(
		'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);

	/**
	 * Find all container uids from a collection of cards
	 *
	 * @param array $cards
	 * @return array
	 */
	protected function findUidByCard($cards) {
		$query = parent::createQuery();
		$in = [];
		$uid = [];

		// we working only with a Traversable items
		if($cards instanceof \Qinx\Qxwork\Domain\Model\Card) {
			$card = clone $cards;
			$cards = [];

			$cards[] = $card;
		}

		foreach($cards as $card) {
			if($card instanceof \Qinx\Qxwork\Domain\Model\Card) {
				$in[] = (int) $card->getUid();

			} else {
				$in[] = (int) $card;
			}
		}

		foreach($GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'tx_qxwork_card_container_mm.uid_foreign AS uid',
			'tx_qxwork_card_container_mm',
			'tx_qxwork_card_container_mm.uid_local IN (' . implode(',', $in) . ')'
		) as $row) {
			$uid[] = (int) $row['uid'];
		}

		return $uid;
	}

	/**
	 * Query builder for container models for find and findAll method
	 *
	 * @param array $options
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryInterface
	 */
	public function createQuery($options = []) {
		$query = parent::createQuery();
		$matches = [];

		if(isset($options['board']) === true) {
			if($options['board'] instanceof \Qinx\Qxwork\Domain\Model\Board) {
				$options['board'] = $options['board']->getUid();
			}

			$matches[] = $query->equals('board', $options['board']);
		}

		if(isset($options['card']) === true) {
			$or = [];

			foreach($this->findUidByCard($options['card']) as $uid) {
				$or[] = $query->equals('uid', $uid);
			}

			if(empty($or) === false) {
				$matches[] = $query->logicalAnd($query->logicalOr($or));
			}
		}

		if(empty($matches) === false) {
			$query->matching($query->logicalAnd($matches));
		}

		return $query;
	}

	/**
	 * @param array $options
	 * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findAll($options = []) {
		$query = $this->createQuery($options);

		return $query->execute();
	}

	/**
	 * @param array $options
	 * @return null|\Qinx\Qxwork\Domain\Model\Container
	 */
	public function find($options = []) {
		return $this->createQuery($options)->execute()->getFirst();
	}
}