Prueba UMAIC
=======================

Aplicación Web responsive para nutrifami.

Una vez descargados los archivos se debe configurar el servidor virtual.


VirtualHost
--------------
 A continuación un ejemplo de la configuración del host virtual, en windows.
 
    Listen 85
    NameVirtualHost *:85
    <VirtualHost *:85>
    Alias /UmaicTest "C:\umaic\public"
    DocumentRoot "C:\umaic\public"
      <Directory "C:\umaic\public">
       AllowOverride All
       Allow from all
      </Directory>
    </VirtualHost>


Caracterizticas tecnicas
------------------------

 1. Zend Framework
 2. bootstrap
 3. jquery, angularjs


Distribución de Archivos
------------------------

    /
    /public
    /public/js/                                        ->  Todos los archivos javascript
    /public/lib                                        ->  Todas las Librerias
    /public/css/                                       ->  Todos los archivos de las hojas de estilo
    /module/                                           ->  Modulos de la aplicacion
    /module/Application/view/layout/                   ->  Plantillas HTML de la aplicacion

Al ingresar por un explorador Web la aplicacion abrira la accion index del controlador Index del modulo App.

