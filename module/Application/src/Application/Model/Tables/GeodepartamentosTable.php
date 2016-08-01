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
namespace Application\Model\Tables;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Select;
use Zend\Debug\Debug;
use Zend\Db\Sql\Expression;

class GeodepartamentosTable extends AbstractTableGateway
{
    protected $table = 'geo_departamentos';
    
    public function __construct()
    {
    	//$this->adapter = $adapter;
    	//$this->initialize();
    
    	$this->featureSet = new Feature\FeatureSet();
    	$this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
    	$this->initialize();
    }
    
    
    public function fetchAll()
    {
    	return $resultSet->toArray();
    }
    
    public function getDane ($nombre) {
        $data = Array('dep_nombre'=>$nombre);
        if ( $resultSet = $this->select($data) ) {
            if ($resultRow = $resultSet->current()){
        	return $resultRow['dep_dane'];
            }else {
                return 0;
            }
        }else {
            return 0;
        }
    }
    
    public function saveRow($data){
        if ( $this->insert($data) ) {
            return $this->lastInsertValue;
        }else {
            return false;
        }
    }

}
?>