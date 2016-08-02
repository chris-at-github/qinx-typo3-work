<?php
namespace Qinx\Qxwork\Domain\Model;


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
 * Container
 */
class Container extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

	/**
	 * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
	 * @inject
	 */
	protected $objectManager;

    /**
     * title
     * 
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';
    
    /**
     * board
     * 
     * @var \Qinx\Qxwork\Domain\Model\Board
     */
    protected $board = null;
    
    /**
     * Returns the title
     * 
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Sets the title
     * 
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Returns the board
     * 
     * @return \Qinx\Qxwork\Domain\Model\Board $board
     */
    public function getBoard()
    {
        return $this->board;
    }
    
    /**
     * Sets the board
     * 
     * @param \Qinx\Qxwork\Domain\Model\Board $board
     * @return void
     */
    public function setBoard(\Qinx\Qxwork\Domain\Model\Board $board)
    {
        $this->board = $board;
    }

	/**
	 * Returns all cards that assigned to this container
	 *
	 * @return null|array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function getCards() {
		return $this->objectManager->get('Qinx\Qxwork\Domain\Repository\CardRepository')->findAll([
			'container' => $this
		]);
	}
}