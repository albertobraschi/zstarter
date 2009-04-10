<?php

$root=dirname(__FILE__);
$root .= '/../../';

$baseUrl = "/admin/";

$config = array (

    'db'    => array (
        'adapter'   => 'PDO_MYSQL',
        'params'    => array( 
            'host'          => 'localhost',
            'username'      => 'root',
            'password'      => '',
            'dbname'        => 'taryk',
            'driver_options'=> array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'),
            'profiler'      => false,
        ),
    ),

    'url'   => array (
         'base'         => $baseUrl,
         'fullurl'      => "http://{$_SERVER['SERVER_NAME']}$baseUrl",
         'public'       => $baseUrl . 'public',
         'img'          => $baseUrl . 'img',
         'css'          => $baseUrl . 'css',
     ),

    'path'  => array (
        'root'         => $root,
        'backups'      => $root . "../_backups/",
        'dumps'        => $root . "../_dumps/",
        'libs'         => $root . '../libs/',
        'application'  => $root . 'application/',
        'modules'      => $root . 'application/modules/',
        'generators'   => $root . 'application/generators/',
        'gen_tpl'      => $root . 'application/gen_templates/',
        'models'       => $root . 'application/models/',
        'controllers'  => $root . 'application/controllers/',
        'views'        => $root . 'application/views/',
        'layouts'      => $root . 'application/layouts/',
        'system'       => $root . 'application/system/',
        'settings'     => $root . 'application/settings/',
        'helpers'      => $root . 'application/helpers/',
        'css'          => $root . 'public/design/css/',
        'js'           => $root . 'public/design/js/',
        'img'          => $root . 'public/design/img/',
     ),
    'common' => array (
         'charset'      => 'utf-8',
     ),
    'generators' => array (
        'table_alias' => 'tn'
    ),
    'debug' => array (
         'on'           => true,
     ),
);

date_default_timezone_set("Europe/Kiev");

// HELPERS
$helpers = array (
    'ZendX_JQuery_View_Helper'  =>  $config['path']['libs'].'ZendX/JQuery/View/Helper/',
);