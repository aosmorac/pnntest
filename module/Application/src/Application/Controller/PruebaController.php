<?php
/* * ********************************************************
 * CLIENTE: PNN
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
    public function indexAction()
    {
    	$request = $this->getRequest();
    	$data = 'Fecha: '.$request['fecha'].' -- Texto: '.$request['texto'].' -- Departamento: '.$request['departamento'].' -- Municipio: '.$request['municipio'].'';
        echo $data;
    }
    
}
