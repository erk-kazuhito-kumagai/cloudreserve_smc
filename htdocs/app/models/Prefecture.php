<?php
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
class Prefecture extends Phalcon\Mvc\Model
{
     
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $seq;

    /**
     *
     * @var string
     */
    public $name;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'seq' => 'seq', 
            'name' => 'name'
        );
    }
    

    public function getSource()
    {
        return 'm_pref';
    }
    
    
    public function initialize()
    {
        $this->setConnectionService('systemdb');
    }
}