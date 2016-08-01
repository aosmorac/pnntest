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

Al ingresar por un explorador Web la aplicacion abrira la accion index del controlador Index del modulo App.

