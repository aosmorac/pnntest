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
    
    public function exportAllAction(){
        $filename = 'UMAIC-Prueba.csv';
        $info = new Data();
        $resultset = $info->getInformacionCargada();
        
        $columnHeaders = Array(
                                      'ID'
                                    , 'Proyecto Codigo'
                                    , 'Proyecto Nombre'
                                    , 'Proyecto Descripcion'
                                    , 'Proyecto Inicio'
                                    , 'Proyecto Fin'
                                    , 'Proyecto Estado'
                                    , 'Organizacion Sigla'
                                    , 'Organizacion Nombre'
                                    , 'Organizacion Tipo'
                                    , 'Presupuesto Monto'
                                    , 'Presupuesto Tema'
                                    , 'Beneficiarios Total'
                                    , 'Beneficiarios Hombre'
                                    , 'Beneficiarios Mujeres'
                                    , 'Departamento'
                                    , 'Decha de Carga'
                                    , 'Fuente de carga'
        );
        
        $view = new ViewModel();
        $view->setTemplate('download/download-csv')
             ->setVariable('results', $resultset)
             ->setTerminal(true);

        if (!empty($columnHeaders)) {
            $view->setVariable(

                'columnHeaders', $columnHeaders
            );
        }

        $output = $this->getServiceLocator()
                       ->get('viewrenderer')
                       ->render($view);

        $response = $this->getResponse();

        $headers = $response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'text/csv')
                ->addHeaderLine(

                    'Content-Disposition', 
                    sprintf("attachment; filename=\"%s\"", $filename)
                )
                ->addHeaderLine('Accept-Ranges', 'bytes')
                ->addHeaderLine('Content-Length', strlen($output));

        $response->setContent($output);

        return $response;
    }
    
}
