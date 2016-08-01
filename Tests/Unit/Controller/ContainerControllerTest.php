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
 * Test case for class Qinx\Qxwork\Controller\ContainerController.
 *
 * @author Christian Pschorr <qinx.me>
 */
class ContainerControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \Qinx\Qxwork\Controller\ContainerController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('Qinx\\Qxwork\\Controller\\ContainerController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllContainersFromRepositoryAndAssignsThemToView()
	{

		$allContainers = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$containerRepository = $this->getMock('Qinx\\Qxwork\\Domain\\Repository\\ContainerRepository', array('findAll'), array(), '', FALSE);
		$containerRepository->expects($this->once())->method('findAll')->will($this->returnValue($allContainers));
		$this->inject($this->subject, 'containerRepository', $containerRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('containers', $allContainers);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenContainerToView()
	{
		$container = new \Qinx\Qxwork\Domain\Model\Container();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('container', $container);

		$this->subject->showAction($container);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenContainerToContainerRepository()
	{
		$container = new \Qinx\Qxwork\Domain\Model\Container();

		$containerRepository = $this->getMock('Qinx\\Qxwork\\Domain\\Repository\\ContainerRepository', array('add'), array(), '', FALSE);
		$containerRepository->expects($this->once())->method('add')->with($container);
		$this->inject($this->subject, 'containerRepository', $containerRepository);

		$this->subject->createAction($container);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenContainerToView()
	{
		$container = new \Qinx\Qxwork\Domain\Model\Container();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('container', $container);

		$this->subject->editAction($container);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenContainerInContainerRepository()
	{
		$container = new \Qinx\Qxwork\Domain\Model\Container();

		$containerRepository = $this->getMock('Qinx\\Qxwork\\Domain\\Repository\\ContainerRepository', array('update'), array(), '', FALSE);
		$containerRepository->expects($this->once())->method('update')->with($container);
		$this->inject($this->subject, 'containerRepository', $containerRepository);

		$this->subject->updateAction($container);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenContainerFromContainerRepository()
	{
		$container = new \Qinx\Qxwork\Domain\Model\Container();

		$containerRepository = $this->getMock('Qinx\\Qxwork\\Domain\\Repository\\ContainerRepository', array('remove'), array(), '', FALSE);
		$containerRepository->expects($this->once())->method('remove')->with($container);
		$this->inject($this->subject, 'containerRepository', $containerRepository);

		$this->subject->deleteAction($container);
	}
}
