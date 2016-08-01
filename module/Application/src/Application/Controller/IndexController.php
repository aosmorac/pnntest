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
        $info = new Data();
        $informacion = $info->getInformacionCargada();
        
        $pxoTemp = array();
        $pxtTemp = array();
        $perxoTemp = array();
        $depxMTemp = array();
        foreach ( $informacion as $i ) {
            
            if (!isset($pxoTemp[$i["inf_car_organizacionNombre"]])) {
                $pxoTemp[$i["inf_car_organizacionNombre"]] = Array( $i["inf_car_organizacionNombre"], 0 );
            }
            $pxoTemp[$i["inf_car_organizacionNombre"]][1] += $i["inf_car_presupuestoMonto"];
            
            if (!isset($pxtTemp[$i["inf_car_presupuestoTema"]])) {
                $pxtTemp[$i["inf_car_presupuestoTema"]] = Array( $i["inf_car_presupuestoTema"], 0 );
            }
            $pxtTemp[$i["inf_car_presupuestoTema"]][1] += $i["inf_car_presupuestoMonto"];
            
            $departamentos = explode('-', $i["inf_car_departamento"]);
            if (!$departamentos || !isset($departamentos[0])) {
                $departamentos = Array(trim($pro_departamentos));
            }
            foreach ($departamentos as $d) {
                if ( !isset($depxMTemp[$d]) ) {
                    $depxMTemp[$d] = Array("dep" => $d, "orgs" => Array());
                }
                $depxMTemp[$d]["orgs"][$i["inf_car_organizacionNombre"]] = $i["inf_car_organizacionNombre"];
            }
            
        }
        
        $presupuestoXorganizacion = Array();
        $presupuestoXorganizacion[] = Array('Organizacion', 'Presupuesto');
        foreach ($pxoTemp as $t) {
            $presupuestoXorganizacion[] = $t;
        }
        //\Zend\Debug\Debug::dump($presupuestoXorganizacion); 
        
        $presupuestoXtema = Array();
        $presupuestoXtema[] = Array('Tema', 'Presupuesto');
        foreach ($pxtTemp as $t) {
            $presupuestoXtema[] = $t;
        }
        //\Zend\Debug\Debug::dump($presupuestoXtema); 
        
        $departamentosXorg = Array();
        $dxo = Array();
        $departamentosXorg[] = Array('Departamento', 'Organizaciones');
        foreach ( $depxMTemp as $d ) {
            $orgs = implode(' - ', $d["orgs"]);
            $departamentosXorg[] = Array($d['dep'].', Colombia', $orgs);
        }
        //\Zend\Debug\Debug::dump($departamentosXorg); 
        
        //print_r($informacion);
        $data = Array(
                    'presupuestoXorganizacion' => json_encode($presupuestoXorganizacion)
                    , 'presupuestoXtema' => json_encode($presupuestoXtema)
                    , 'departamentosXorg' => json_encode($departamentosXorg)
                    , 'test'=>'Prueba'
                );
        return $data;
    }
}
