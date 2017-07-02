<?php
if(isset($_SERVER['Y-ENVIROMENT'])) {
    switch($_SERVER['Y-ENVIROMENT']) {
        case 'PRODUCTION1':
            return include __DIR__ . '/config_production1.php';
            break;
        case 'PRODUCTION2':
            return include __DIR__ . '/config_production2.php';
            break;
        case 'PRODUCTION_STAGE':
            return include __DIR__ . '/config_production_stage.php';
            break;
        case 'DEVELOPMENT':
            return include __DIR__ . '/config_development.php';
            break;
        case 'DEVELOPMENT_STAGE':
            return include __DIR__ . '/config_development_stage.php';
            break;
        case 'DEMO':
            return include __DIR__ . '/config_demo.php';
            break;
    }

} else {
    return include __DIR__ . '/config_development.php';
}