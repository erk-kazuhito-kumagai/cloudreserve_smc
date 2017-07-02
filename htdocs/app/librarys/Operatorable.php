<?php
use \Phalcon\Mvc\Model\Behavior;
use \Phalcon\Mvc\Model\BehaviorInterface;

class Operatorable extends Behavior implements BehaviorInterface
{

    public function notify($eventType, \Phalcon\Mvc\ModelInterface $model)
    //public function notify($eventType, $model)
    {
        $di = \Phalcon\DI\FactoryDefault::getDefault();
        $loginUser = NULL;
        
        if($di->has('loginUser')) {
            $loginUser = $di->getShared('loginUser');
        } else {
            $loginUser = new LoginUser();
        }

        switch($eventType) {
            case '':
                break;
            case '';
                break;
        }
        $data = $this->getOptions($eventType);
       
        if($data) {
            foreach ((array)$data['field'] as $property) {
                if($loginUser->id) {
                    $model->$property = $loginUser->id;
                } else {
                    $model->$property = Consts::NOLOGINED_USER_ID;
                }
            }
        }
    }

}