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
    	$request = $this->getRequest();
    	$data = 'Fecha: '.$request['fecha'].' -- Texto: '.$request['texto'].' -- Departamento: '.$request['departamento'].' -- Municipio: '.$request['municipio'].'';
    	echo $data;
    }
}
