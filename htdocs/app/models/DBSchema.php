<?php

use \Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;


class DBSchema extends ModelBase
{

     public function initialize()
    {
        $di = $this->getDI();
        $config = $di->get("commonconfig");
        $di->set('tempdb', function () use ($config) {
            $dbAdapter = new DbAdapter(array(
            'host'     => $config->database->host,
            'username' => $config->database->userName,
            'password' => $config->database->password,
            'dbname'   => 'information_schema',
            'charset'  => 'utf8'
            ));  
            return $dbAdapter;
        });
        $this->setConnectionService('tempdb');
    }

    public function getSource()
    {
        return 'SCHEMATA';
    }
    
    public static function getDBName($vendorKey) {
        if($vendorKey) {
            $di = Phalcon\DI::getDefault();
            $config = $di->get('commonconfig');
            $dbSchema     =   DBSchema::findFirst(
                array(
                    'conditions' => "SCHEMA_NAME = ?1",
                    'bind'       => array(1 => $config->database->prefix . $vendorKey)
                ));
            return $dbSchema;
        }
    }
    
}