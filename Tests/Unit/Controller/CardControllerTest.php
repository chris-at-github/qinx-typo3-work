<?php
namespace Qinx\Qxwork\Tests\Unit\Controller;
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
 * Test case for class Qinx\Qxwork\Controller\CardController.
 *
 * @author Christian Pschorr <qinx.me>
 */
class CardControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \Qinx\Qxwork\Controller\CardController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('Qinx\\Qxwork\\Controller\\CardController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllCardsFromRepositoryAndAssignsThemToView()
	{

		$allCards = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$cardRepository = $this->getMock('Qinx\\Qxwork\\Domain\\Repository\\CardRepository', array('findAll'), array(), '', FALSE);
		$cardRepository->expects($this->once())->method('findAll')->will($this->returnValue($allCards));
		$this->inject($this->subject, 'cardRepository', $cardRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('cards', $allCards);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenCardToView()
	{
		$card = new \Qinx\Qxwork\Domain\Model\Card();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('card', $card);

		$this->subject->showAction($card);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenCardToCardRepository()
	{
		$card = new \Qinx\Qxwork\Domain\Model\Card();

		$cardRepository = $this->getMock('Qinx\\Qxwork\\Domain\\Repository\\CardRepository', array('add'), array(), '', FALSE);
		$cardRepository->expects($this->once())->method('add')->with($card);
		$this->inject($this->subject, 'cardRepository', $cardRepository);

		$this->subject->createAction($card);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenCardToView()
	{
		$card = new \Qinx\Qxwork\Domain\Model\Card();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('card', $card);

		$this->subject->editAction($card);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenCardInCardRepository()
	{
		$card = new \Qinx\Qxwork\Domain\Model\Card();

		$cardRepository = $this->getMock('Qinx\\Qxwork\\Domain\\Repository\\CardRepository', array('update'), array(), '', FALSE);
		$cardRepository->expects($this->once())->method('update')->with($card);
		$this->inject($this->subject, 'cardRepository', $cardRepository);

		$this->subject->updateAction($card);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenCardFromCardRepository()
	{
		$card = new \Qinx\Qxwork\Domain\Model\Card();

		$cardRepository = $this->getMock('Qinx\\Qxwork\\Domain\\Repository\\CardRepository', array('remove'), array(), '', FALSE);
		$cardRepository->expects($this->once())->method('remove')->with($card);
		$this->inject($this->subject, 'cardRepository', $cardRepository);

		$this->subject->deleteAction($card);
	}
}
