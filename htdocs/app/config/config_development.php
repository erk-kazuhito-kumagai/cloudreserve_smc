<?php
return new \Phalcon\Config(array(
    'application' => array(
        'appDir'         => __DIR__ . '/../',
        'modelsDir'      => __DIR__ . '/../models/',
        'partialsDir'    =>          '../../../partials/',
        'libraryDir'    => __DIR__ . '/../librarys/',
        'imageDir'    => __DIR__ . '/../../images/',
        'cacheDir'          => __DIR__ . '/../../cache/',
        'url'            => 'http://localhost',
        
        'frontedModule'    => 'fronted',
        'frontedUrlPrefix' => '/cloudreserve',
        
        'adminModule'    => 'admin',
        'adminUrlPrefix' => '/cloudreserve/admin',
        
        'vendorModule'    => 'vendor',
        'vendorUrlPrefix' => '/vendor',
        
        'homeModule'    => 'home',
        'homeUrlPrefix' => '/home'
        
    ),
    'database' => array(
        'host'           => 'localhost',
        'userName'       => 'root',
        'password'       => '',
        'databaseName'   => 'test',
        'charset'        => 'utf8',
        'prefix'         => 's_',
    ),
    'mail' => array(
        'from'           => 'nexsuss.com',
        'template'       => __DIR__ . '/../mail/'
    ),
    'logfile' => array(
        'db'             => __DIR__ . '/../logs/db.log',
        'error'          => __DIR__ . '/../logs/error.log'
    )
));