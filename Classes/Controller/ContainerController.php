<?php
namespace Qinx\Qxwork\Controller;


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
 * ContainerController
 */
class ContainerController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * containerRepository
     * 
     * @var \Qinx\Qxwork\Domain\Repository\ContainerRepository
     * @inject
     */
    protected $containerRepository = NULL;
    
    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $containers = $this->containerRepository->findAll();
        $this->view->assign('containers', $containers);
    }
    
    /**
     * action show
     * 
     * @param \Qinx\Qxwork\Domain\Model\Container $container
     * @return void
     */
    public function showAction(\Qinx\Qxwork\Domain\Model\Container $container)
    {
        $this->view->assign('container', $container);
    }
    
    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
        
    }
    
    /**
     * action create
     * 
     * @param \Qinx\Qxwork\Domain\Model\Container $newContainer
     * @return void
     */
    public function createAction(\Qinx\Qxwork\Domain\Model\Container $newContainer)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->containerRepository->add($newContainer);
        $this->redirect('list');
    }
    
    /**
     * action edit
     * 
     * @param \Qinx\Qxwork\Domain\Model\Container $container
     * @ignorevalidation $container
     * @return void
     */
    public function editAction(\Qinx\Qxwork\Domain\Model\Container $container)
    {
        $this->view->assign('container', $container);
    }
    
    /**
     * action update
     * 
     * @param \Qinx\Qxwork\Domain\Model\Container $container
     * @return void
     */
    public function updateAction(\Qinx\Qxwork\Domain\Model\Container $container)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->containerRepository->update($container);
        $this->redirect('list');
    }
    
    /**
     * action delete
     * 
     * @param \Qinx\Qxwork\Domain\Model\Container $container
     * @return void
     */
    public function deleteAction(\Qinx\Qxwork\Domain\Model\Container $container)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
        $this->containerRepository->remove($container);
        $this->redirect('list');
    }

}