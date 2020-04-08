<?php
//header('charset=utf-8');
//
$config['sistema'] = 'wConvertirTexto';
$config['en_desarrollo'] = 1;

$protocolo = 'http';

if (! empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] != 'off')) $protocolo = 'https';

$config['url_base'] = $protocolo . "://" . 
$_SERVER["HTTP_HOST"] . dirname($_SERVER["SCRIPT_NAME"]) . "/";

unset($protocolo);
//
include 'app/lib/class/texto_numero.class.php';
include 'app/controladores/convertir.php';
include 'app/vistas/main.phtml';