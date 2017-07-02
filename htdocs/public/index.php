<?php
date_default_timezone_set('Asia/Tokyo');


use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Logger\Adapter\File as LoggerAdapter;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Mvc\Router;




error_reporting(E_ALL|E_STRICT);
mb_language("Japanese");
mb_internal_encoding("UTF-8");

class MyException extends Exception
{
	public function __construct($errno, $errstr, $errfile, $errline)
	{
		// エラー番号とエラーレベルのマッピング
		$errlev = array(
			E_USER_ERROR   => 'FATAL',
			E_ERROR        => 'FATAL',
			E_USER_WARNING => 'WARNING',
			E_WARNING      => 'WARNING',
			E_USER_NOTICE  => 'NOTICE',
			E_NOTICE       => 'NOTICE',
			E_STRICT       => 'E_STRICT'
		);
	
		$add_msg= (string)$errno;
		if (isset($errlev[$errno])) {
			$add_msg = $errlev[$errno] . ' : ';
		}
		parent::__construct($add_msg . $errstr, $errno);
		$this->file = $errfile;
		$this->line = $errline;
	}
}

function errorHandler($errno, $errstr, $errfile, $errline)
{
	throw new MyException($errno, $errstr, $errfile, $errline);
}
//set_error_handler('errorHandler');

try {
    
    $commonConfig = include __DIR__ . '/../app/config/config.php';

    /**
     * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
     */
    $di = new FactoryDefault();

    /**
     * Registering a router
     */
$router = $di->getShared('router');

    $router->removeExtraSlashes(true);

    $router->setDefaultModule($commonConfig->application->frontedModule);

    $router->add($commonConfig->application->frontedModule. '/:controller', [
        'module'     => $commonConfig->application->frontedModule,
        'controller' => 1,
        'action'     => 'index'
    ]);

    $router->add($commonConfig->application->frontedModule . '/:controller/:action', [
        'module'     => $commonConfig->application->frontedModule,
        'controller' => 1,
        'action'     => 2
    ]);

    $router->add($commonConfig->application->frontedModule . '/:controller/:action/:params', [
        'module'     => $commonConfig->application->frontedModule,
        'controller' => 1,
        'action'     => 2,
        'params'     => 3
    ]);

    $router->handle();




    /**
     * Start the session the first time some component request the session service
     */
    $di['session'] = function () {
        $session = new \Phalcon\Session\Adapter\Files();
        $session->start();

        return $session;
    };
    
    $di['dispatcher'] = function() {
       $dispatcher = new \Phalcon\Mvc\Dispatcher();
        return $dispatcher;
    };

    
    
    $router   = $di->getShared('router');
    $router->handle();
    
    $dispatcher = $di->getShared('dispatcher');

    $dispatcher->setModuleName($router->getModuleName());
    $dispatcher->setControllerName($router->getControllerName());
    $dispatcher->setActionName($router->getActionName());
    $dispatcher->setParams($router->getParams());
    
    $commonconfig = include __DIR__ . '/../app/config/config.php';

    $loader = new \Phalcon\Loader();
    $loader->registerDirs(
        array(
            $commonconfig->application->modelsDir,
            $commonconfig->application->libraryDir
        )
    );
    $loader->register();


    /**
     * If the configuration specify the use of metadata adapter use it or use memory otherwise
     */
    //$di->set('modelsMetadata', function () {
    //    return new MetaDataAdapter();
    //});

    $params =  $router->getParams();
    $vendorKey = '';
    $moduleName = $router->getModuleName();
        
    $config = include $commonConfig->application->appDir . $moduleName . '/config/config.php';

    $di->set('config', $config);
    $di->set('commonconfig', $commonconfig);
    
    $response = $di->getShared('response');
    
    $di->set('systemdb', function () use ($config, $commonConfig, $di) {
        $dbAdapter   =  new DbAdapter(array(
                'host'       => $commonConfig->database->host,
                'username'   => $commonConfig->database->userName,
                'password'   => $commonConfig->database->password,
                'dbname'     => $commonConfig->database->databaseName,
                'charset'    => $commonConfig->database->charset,
                "options" => [ PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING ]
        ));
        return $dbAdapter;
    });
    
    $di->set('db', function () use ($config, $commonConfig, $vendorKey, $di) {
        $databaseName = $commonConfig->database->databaseName;
        if($vendorKey) {
            $databaseName = $commonConfig->database->prefix . $vendorKey;
        }
        $dbAdapter   =  new DbAdapter(array(
                'host'       => $commonConfig->database->host,
                'username'   => $commonConfig->database->userName,
                'password'   => $commonConfig->database->password,
                'dbname'     => $databaseName,
                'charset'    => $commonConfig->database->charset
        ));
        $eventsManager = $di->getShared('eventsManager');

        $logger = new LoggerAdapter(str_replace('.log', Utils::getDateTime()->format('Ymd'). '.log', $config->logfile->db));
        
        $eventsManager->attach('db', function($event, $dbAdapter) use($logger) {
            if ($event->getType() == 'beforeQuery') {
                $sqlVariables = $dbAdapter->getSQLVariables();
                if($sqlVariables) {
                    $logger->log($dbAdapter->getSQLStatement(). ' ' . join(', ', $sqlVariables), \Phalcon\Logger::INFO);
                } else {
                    $logger->log($dbAdapter->getSQLStatement(), \Phalcon\Logger::INFO);
                }
            }
        });
        
        $dbAdapter->setEventsManager($eventsManager);
        return $dbAdapter;
    });

    $request = $di->getShared('request');
    $cl = new stdClass();
    $cl->vendorKey = $vendorKey;
    $cl->language = 'ja';
    $temp = array();
    if(preg_match('/([a-zA-Z]+)/', $request->getBestLanguage(), $temp)) {
        $cl->language = $temp[0];
    }
    $di->setShared('global', $cl);

    $loader->registerDirs(
        array(
            $config->application->controllersDir,
            $commonconfig->application->modelsDir,
            $config->application->pluginsDir,
            $commonconfig->application->libraryDir
        )
    );
    $loader->register();

    /**
     * The URL component is used to generate all kind of urls in the
     application
    */
    $url = $di->getShared('url');
    
    $url->setBaseUri($config->application->baseUri);

    $di->set('view', function () use ($commonconfig, $config) {

        $view = new View();
		$view->setPartialsDir($commonconfig->application->partialsDir);
        $view->setViewsDir($config->application->viewsDir);
        

        $view->registerEngines(array(
            '.volt' => function ($view, $di) use ($commonconfig) {

                $volt = new VoltEngine($view, $di);

                $volt->setOptions(array(
                    'compiledPath' => $commonconfig->application->cacheDir,
                    'compiledSeparator' => '_'
                ));

                return $volt;
            },
            '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
        ));

        return $view;
    }, true);
    

    $eventsManager = $di->getShared('eventsManager');
    $logger = new LoggerAdapter(str_replace('.log', Utils::getDateTime()->format('Ymd'). '.log', $config->logfile->error));


    $security = new Security($di);
    $di->setShared('securityPlugin', $security);




    /**
     * We listen for events in the dispatcher using the Security plugin
     */
    $eventsManager->attach('dispatch', $security);
    $dispatcher->setEventsManager($eventsManager);

    //Start the view
    $view = $di->getShared('view');


    
    $view->securityPlugin = $security;


    $controller = $dispatcher->dispatch();
    $response->sendHeaders();
    $controller->view->start();
    $controller->view->render($dispatcher->getControllerName(), $dispatcher->getActionName(), $dispatcher->getParams());
    $controller->view->finish();
    
    echo  str_replace('&nbsp;', '&emsp;', $view->getContent());

} catch (Phalcon\Exception $e) {
    echo $e->getMessage();
    print "OK 1";
    exit;
} catch (PDOException $e) {
 print "OK2 ";
    echo $e->getMessage();
    exit;
} catch (\Exception $e) {
 print "OK3 ";
    echo $e->getMessage();
    exit;
}
