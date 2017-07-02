<?php

return new \Phalcon\Config(array(
    'application' => array(
        'js'             => true,
        'appDir'         => __DIR__ . '/../',
        'controllersDir' => __DIR__ . '/../controllers/',
        'viewsDir'       => __DIR__ . '/../views/',
        'labelTransDir'  => __DIR__ . '/../labels/',
        'transDir'       => __DIR__ . '/../messages/',
        'pluginsDir'     => __DIR__ . '/../plugins/',
        'baseUri'        => '/',
        'codePreFix'     => 'codePreFix'
    ),

    'logfile' => array(
        'db'             => __DIR__ . '/../../../logs/fronted_db.log',
        'error'          => __DIR__ . '/../../../logs/fronted_error.log'
    ),
    'paging' => 10
));