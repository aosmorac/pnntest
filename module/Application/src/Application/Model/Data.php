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
namespace Application\Model;

use Application\Model\Tables\InfocargaTable;
use Application\Model\Tables\BeneficiariosTable;
use Application\Model\Tables\GeodepartamentosTable;
use Application\Model\Tables\GeodepartamentosproyectoTable;
use Application\Model\Tables\OrganizacionTable;
use Application\Model\Tables\PresupuestoTable;
use Application\Model\Tables\ProyectoTable;

/**********************************************************
* MODELO Data
* =======================================================
*
* ATRIBUTOS
*
*
* METODOS
*
**********************************************************/
class Data
{
    protected $infocargaTable;
    protected $beneficiariosTable;
    protected $geodepartamentosTable;
    protected $geodepartamentosproyectoTable;
    protected $organizacionTable;
    protected $presupuestoTable;
    protected $proyectoTable;
    
    public function __construct()
    {
        $this->infocargaTable = new InfocargaTable();
        $this->beneficiariosTable = new BeneficiariosTable();
        $this->geodepartamentosTable = new GeodepartamentosTable();
        $this->geodepartamentosproyectoTable = new GeodepartamentosproyectoTable();
        $this->organizacionTable = new OrganizacionTable();
        $this->presupuestoTable = new PresupuestoTable();
        $this->proyectoTable = new ProyectoTable();
    }
    
    public function saveFile($file, $fuente){
        setlocale(LC_ALL, 'en_US.UTF-8');
        $rows = array();
        $headers = array();
        if(file_exists($file) && is_readable($file)){
            $handle = fopen($file, 'r');
            while (!feof($handle) ) {
                $row = fgetcsv($handle, 10240);
                if(empty($headers)){
                    $headers = $row;
                }
                else if(is_array($row)){
                    $headers = array(
                                    'inf_car_proyectoCodigo'
                                    , 'inf_car_proyectoNombre'
                                    , 'inf_car_proyectoDescipcion'
                                    , 'inf_car_proyectoInicio'
                                    , 'inf_car_proyectoFin'
                                    , 'inf_car_proyectoEstado'
                                    , 'inf_car_organizacionSigla'
                                    , 'inf_car_organizacionNombre'
                                    , 'inf_car_organizacionTipo'
                                    , 'inf_car_presupuestoMonto'
                                    , 'inf_car_presupuestoTema'
                                    , 'inf_car_beneficiariosTotal'
                                    , 'inf_car_beneficiariosHombres'
                                    , 'inf_car_beneficiariosMujeres'
                                    , 'inf_car_departamento'
                                    , 'inf_car_fuente'
                                );
                    $row[] = utf8_decode($fuente);
                    $row = array_map("utf8_encode", $row );
                    $item = array_combine($headers, $row);
                    //$rows[] = $item;
                    $this->infocargaTable->saveRow($item);
                    $orgId = $this->saveOrganizacion($item); 
                    $proId = $this->saveProyecto($item, $orgId);
                    $this->savePresupuesto($item, $proId);
                    $this->saveBeneficiarios($item, $proId);
                    $this->setDepartamentos($proId, $item['inf_car_proyectoCodigo'], $item['inf_car_departamento']);
                    
                    echo $orgId.' - '.$proId.'<br>';
                }
            }
            fclose($handle);
        } else {
            throw new Exception($file.' doesn`t exist or is not readable.');
        }
        //print_r($rows);
    }
    
    public function saveOrganizacion ($dataFile) {
        $data = Array();
        $data['org_sigla'] = $dataFile['inf_car_organizacionSigla'];
        $data['org_nombre'] = $dataFile['inf_car_organizacionNombre'];
        $data['org_tipo'] = $dataFile['inf_car_organizacionTipo'];
        return $this->organizacionTable->saveRow($data);
    }
    
    public function saveProyecto ($dataFile, $org_id) {
        $data = Array();
        $data['org_id'] = $org_id;
        $data['pro_codigo'] = $dataFile['inf_car_proyectoCodigo'];
        $data['pro_nombre'] = $dataFile['inf_car_proyectoNombre'];
        $data['pro_descripcion'] = $dataFile['inf_car_proyectoDescipcion'];
        $data['pro_inicio'] = $dataFile['inf_car_proyectoInicio'];
        $data['pro_fin'] = $dataFile['inf_car_proyectoFin'];
        $data['pro_estado'] = $dataFile['inf_car_proyectoEstado'];
        $data['pro_departamento'] = $dataFile['inf_car_departamento'];
        return $this->proyectoTable->saveRow($data);
    }
    
    public function savePresupuesto ($dataFile, $pro_id) {
        $data = Array();
        $data['pro_id'] = $pro_id;
        $data['pre_monto'] = $dataFile['inf_car_presupuestoMonto'];
        $data['pre_tema'] = $dataFile['inf_car_presupuestoTema'];
        return $this->presupuestoTable->saveRow($data);
    }
    
    public function saveBeneficiarios ($dataFile, $pro_id) {
        $data = Array();
        $data['pro_id'] = $pro_id;
        $data['ben_total'] = $dataFile['inf_car_beneficiariosTotal'];
        $data['ben_hombres'] = $dataFile['inf_car_beneficiariosHombres'];
        $data['ben_mujeres'] = $dataFile['inf_car_beneficiariosMujeres'];
        return $this->beneficiariosTable->saveRow($data);
    }
    
    public function setDepartamentos ($pro_id, $pro_codigo, $pro_departamentos) {
        $departamentos = explode('-', $pro_departamentos);
        if (!$departamentos || !isset($departamentos[0])) {
            $departamentos = Array(trim($pro_departamentos));
        }
        foreach ($departamentos as $departamento) {
            $dane = $this->geodepartamentosTable->getDane(trim($departamento));
            $data = Array();
            $data['dep_dane'] = $dane;
            $data['pro_id'] = $pro_id;
            $data['pro_codigo'] = $pro_codigo;
            $this->geodepartamentosproyectoTable->saveRow($data);
        }
            
    }
    
    public function getInformacionCargada(){
        return $this->infocargaTable->fetchAll();
    }
    
}

?>