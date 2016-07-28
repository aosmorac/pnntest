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
    
    public function __construct()
    {
        $this->infocargaTable = new InfocargaTable();
    }
    
    public function saveFile($file, $fuente){
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
                    $row[] = $fuente;
                    $item = array_combine($headers, $row);
                    $this->infocargaTable->saveRow($item);
                }
            }
            fclose($handle);
        } else {
            throw new Exception($file.' doesn`t exist or is not readable.');
        }
        print_r($rows);
    }
}

?>