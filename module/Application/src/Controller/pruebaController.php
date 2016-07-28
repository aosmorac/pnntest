<?php
/* * ********************************************************
 * CLIENTE: UMAIC
 * ========================================================
 *
 * @copyright Abel Oswaldo Moreno Acevedo 2016
 * @updated
 * @version 1
 * @author {Abel Oswaldo Moreno Acevedo} <{moreno.abel@gmail.com}>
 * ******************************************************** */


namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Debug\Debug;
use Application\Model\Data;

class PruebaController extends AbstractActionController
{
    public function dashboardAction()
    {
        return new ViewModel();
    }
    
    public function dataAction()
    {
        return new ViewModel();
    }
    
    public function updateFileFormAction()
    {
        return new ViewModel();
    }
    
    public function getDataFileAction()
    {
        $request = $this->getRequest(); 
        $file = $request->getFiles()->toArray();
        $data = new Data(); 
        $data->saveFile($file['mcFile']['tmp_name'], 'ARCHIVO');
        return new ViewModel();
    }
    
}
