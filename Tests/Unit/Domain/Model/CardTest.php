<?php

namespace Qinx\Qxwork\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Christian Pschorr <qinx.me>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \Qinx\Qxwork\Domain\Model\Card.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Christian Pschorr <qinx.me>
 */
class CardTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Qinx\Qxwork\Domain\Model\Card
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Qinx\Qxwork\Domain\Model\Card();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle()
	{
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBoardReturnsInitialValueForBoard()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getBoard()
		);
	}

	/**
	 * @test
	 */
	public function setBoardForObjectStorageContainingBoardSetsBoard()
	{
		$board = new \Qinx\Qxwork\Domain\Model\Board();
		$objectStorageHoldingExactlyOneBoard = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneBoard->attach($board);
		$this->subject->setBoard($objectStorageHoldingExactlyOneBoard);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneBoard,
			'board',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addBoardToObjectStorageHoldingBoard()
	{
		$board = new \Qinx\Qxwork\Domain\Model\Board();
		$boardObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$boardObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($board));
		$this->inject($this->subject, 'board', $boardObjectStorageMock);

		$this->subject->addBoard($board);
	}

	/**
	 * @test
	 */
	public function removeBoardFromObjectStorageHoldingBoard()
	{
		$board = new \Qinx\Qxwork\Domain\Model\Board();
		$boardObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$boardObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($board));
		$this->inject($this->subject, 'board', $boardObjectStorageMock);

		$this->subject->removeBoard($board);

	}

	/**
	 * @test
	 */
	public function getContainerReturnsInitialValueForContainer()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getContainer()
		);
	}

	/**
	 * @test
	 */
	public function setContainerForObjectStorageContainingContainerSetsContainer()
	{
		$container = new \Qinx\Qxwork\Domain\Model\Container();
		$objectStorageHoldingExactlyOneContainer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneContainer->attach($container);
		$this->subject->setContainer($objectStorageHoldingExactlyOneContainer);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneContainer,
			'container',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addContainerToObjectStorageHoldingContainer()
	{
		$container = new \Qinx\Qxwork\Domain\Model\Container();
		$containerObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$containerObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($container));
		$this->inject($this->subject, 'container', $containerObjectStorageMock);

		$this->subject->addContainer($container);
	}

	/**
	 * @test
	 */
	public function removeContainerFromObjectStorageHoldingContainer()
	{
		$container = new \Qinx\Qxwork\Domain\Model\Container();
		$containerObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$containerObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($container));
		$this->inject($this->subject, 'container', $containerObjectStorageMock);

		$this->subject->removeContainer($container);

	}
}
