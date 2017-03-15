<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Data;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        
    }
    
    public function updateAction()
    {
    	header('Access-Control-Allow-Origin: *');
    	$params = $this->params()->fromQuery();
    	$data = 'Fecha: '.$params['fecha'].' -- Texto: '.$params['texto'].' -- Departamento: '.$params['departamento'].' -- Municipio: '.$params['municipio'].'';
    	echo $data;
    }
}
