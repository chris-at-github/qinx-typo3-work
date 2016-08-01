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
 * Card
 */
class Card extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

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
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Qinx\Qxwork\Domain\Model\Board>
     */
    protected $board = null;
    
    /**
     * container
     * 
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Qinx\Qxwork\Domain\Model\Container>
     * @lazy
     */
    protected $container = null;
    
    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }
    
    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     * 
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->board = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->container = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
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
     * Adds a Board
     * 
     * @param \Qinx\Qxwork\Domain\Model\Board $board
     * @return void
     */
    public function addBoard(\Qinx\Qxwork\Domain\Model\Board $board)
    {
        $this->board->attach($board);
    }
    
    /**
     * Removes a Board
     * 
     * @param \Qinx\Qxwork\Domain\Model\Board $boardToRemove The Board to be removed
     * @return void
     */
    public function removeBoard(\Qinx\Qxwork\Domain\Model\Board $boardToRemove)
    {
        $this->board->detach($boardToRemove);
    }
    
    /**
     * Returns the board
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Qinx\Qxwork\Domain\Model\Board> $board
     */
    public function getBoard()
    {
        return $this->board;
    }
    
    /**
     * Sets the board
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Qinx\Qxwork\Domain\Model\Board> $board
     * @return void
     */
    public function setBoard(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $board)
    {
        $this->board = $board;
    }
    
    /**
     * Adds a Container
     * 
     * @param \Qinx\Qxwork\Domain\Model\Container $container
     * @return void
     */
    public function addContainer(\Qinx\Qxwork\Domain\Model\Container $container)
    {
        $this->container->attach($container);
    }
    
    /**
     * Removes a Container
     * 
     * @param \Qinx\Qxwork\Domain\Model\Container $containerToRemove The Container to be removed
     * @return void
     */
    public function removeContainer(\Qinx\Qxwork\Domain\Model\Container $containerToRemove)
    {
        $this->container->detach($containerToRemove);
    }
    
    /**
     * Returns the container
     * 
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Qinx\Qxwork\Domain\Model\Container> $container
     */
    public function getContainer()
    {
        return $this->container;
    }
    
    /**
     * Sets the container
     * 
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Qinx\Qxwork\Domain\Model\Container> $container
     * @return void
     */
    public function setContainer(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $container)
    {
        $this->container = $container;
    }

}