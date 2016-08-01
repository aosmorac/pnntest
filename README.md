Prueba UMAIC
=======================

Aplicación Web responsive para nutrifami.

Una vez descargados los archivos se debe configurar el servidor virtual.


Descargar Aplicación
--------------------
El repositorio es totalmente publico, pueden ingresar a https://github.com/aosmorac/umaic-test

Para tener la aplicación en su quipo debera clonar el repositorio de la siguiente manera:

    git clone https://github.com/aosmorac/umaic-test.git


VirtualHost
--------------
 A continuación un ejemplo de la configuración del host virtual, en windows.
 
    Listen 85
    NameVirtualHost *:85
    <VirtualHost *:85>
    Alias /UmaicTest "C:\umaic-test\public"
    DocumentRoot "C:\umaic-test\public"
      <Directory "C:\umaic-test\public">
       AllowOverride All
       Allow from all
      </Directory>
    </VirtualHost>


Caracterizticas tecnicas
------------------------

 1. Zend Framework
 2. jquery


Distribución de Archivos
------------------------

    /
    /public
    /public/js/                                        ->  Todos los archivos javascript
    /public/lib                                        ->  Todas las Librerias
    /public/css/                                       ->  Todos los archivos de las hojas de estilo
    /module/                                           ->  Modulos de la aplicacion
    /module/Application/view/layout/                   ->  Plantillas HTML de la aplicacion

Al ingresar por un explorador Web la aplicacion abrira la accion index del controlador Index del modulo Application.

Actualmente la aplicación esta apuntando a una base de datos de prueba. Si se quiere realizar el cambio se debe editar el archivo /config/autoload/global.php y cambiar las lineas de configuración:

    return array(
        'db' => array(
            'driver' => 'Pdo',
            'dsn'            => 'mysql:dbname=SU-BASE-DE-DATOS;host=SU-HOST',
            'username'       => 'SU-USUARIO',
            'password'       => 'SU-PASSWORD',
            'driver_options' => array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
            ),
        ),
        'service_manager' => array(
            'factories' => array(
                'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            ),
        ),
    );

El backup de la base de datos lo puede encontrar en la carpeta assets o lo puede ver en https://github.com/aosmorac/umaic-test/blob/master/assets/bd.sql

El modelo de la base de datos tambien se encuentra en la carpeta assets o en la url https://github.com/aosmorac/umaic-test/blob/master/assets/ModeloBD.pdf

Y por ultimo, el archivo csv que use para realizar la carga masiva tambien esta en la carpeta assets o en la URL https://github.com/aosmorac/umaic-test/blob/master/assets/UMAIC_proyectos_prueba_tecnica.csv


Cabe mensionar que este es un ejercicio cuyo desarrollo se realizo de una forma rapida por lo cual carece de validaciones, cargadores y cuenta con pocos comentarios.
