<?php

use Phalcon\Events\Event,
	Phalcon\Mvc\User\Plugin,
	Phalcon\Mvc\Dispatcher,
	Phalcon\Acl;

/**
 * Security
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class Security extends Plugin
{

	public function __construct($dependencyInjector)
	{
		$this->_dependencyInjector = $dependencyInjector;
	}

	public function getAcl()
	{
//		if (!isset($this->persistent->acl)) {

			$acl = new Phalcon\Acl\Adapter\Memory();

			$acl->setDefaultAction(Phalcon\Acl::DENY);

			//Register roles
			$roles = array(
			    'admin'   => new Phalcon\Acl\Role('Admin'),
				'guests'   => new Phalcon\Acl\Role('Guests')
			);
			foreach ($roles as $role) {
				$acl->addRole($role);
			}

			//Private area resources
			$adminResources = array(
			);
			foreach ($adminResources as $resource => $actions) {
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}

			//Public area resources
			$publicResources = array(
				'index'     => array('index'),
				'record'    => array('index'),
				'checkup' => array('index'),
				'examinationcategory'    => array('index'),
				'examinationitem'    => array('index'),
				'examination'    => array('index'),
			);

			foreach ($publicResources as $resource => $actions) {
				$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
			}

			//Grant access to public areas to both users and guests
			foreach ($roles as $role) {
				foreach ($publicResources as $resource => $actions) {
					$acl->allow($role->getName(), $resource, '*');
				}
			}


			//The acl is stored in session, APC would be useful here too
			$this->persistent->acl = $acl;
//		}

		return $this->persistent->acl;
	}

	/**
	 * This action is executed before execute any action in the application
	 */
	public function beforeDispatch(Event $event, Dispatcher $dispatcher)
	{
		$role = 'Guests';

		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();

		$acl = $this->getAcl();

		$allowed = $acl->isAllowed($role, $controller, $action);

		if ($allowed != Acl::ALLOW) {
		
			$this->flash->error("You don't have access to this module");
			$dispatcher->forward(
				array(
					'controller' => 'index',
					'action' => 'index'
				)
				
			);
			return false;
		}
		
		//$loginUser = new Operator();
        //$loginUser->operatorId = 0;
        //$loginUser->nickname = 'ƒƒOƒCƒ“‚µ‚Ä‚¢‚Ü‚¹‚ñ';
        //$loginUser->account  = Consts::NOLOGINED_USER_ID;
        //$this->di->set('loginUser'  , $loginUser);
	}
	
	    /*
     *
     *
     *
     */
    public function checkToken()
    {
        $authentication = $this->session->get($this->router->getModuleName());
        if(is_array($authentication)) {
            if(isset($authentication['tokenKey']) && isset($authentication['token']) && $authentication['tokenKey'] && $authentication['token']) {
                $token = $this->request->get($authentication['tokenKey']);
                if($token == $authentication['token']) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Generates a pseudo random token key and value to be used as input's name in a CSRF check
     *
     *
     */
    public function generateToken()
    {
        $authentication = $this->session->get($this->router->getModuleName());
        
        if(!is_array($authentication)) {
            $authentication = array();
        }

        $authentication['tokenKey'] = $this->security->getTokenKey();
        $authentication['token']    = $this->security->getToken();
        $this->session->set($this->router->getModuleName(), $authentication);
        return true;
    }

    /**
     * Get token key to be used as input's name in a CSRF check
     *
     *
     * @return string
     */
    public function getTokenKey()
    {
        $authentication = $this->session->get($this->router->getModuleName());

        if(!is_array($authentication)) {
            $authentication = array();
        }
        if(!isset($authentication['tokenKey']) || !isset($authentication['token'])) {
            $authentication['tokenKey'] = $this->security->getTokenKey();
            $authentication['token']    = $this->security->getToken();
            $this->session->set($this->router->getModuleName(), $authentication);
        }

        return $authentication['tokenKey'];
    }

    /**
     * Get token value to be used as input's value in a CSRF check
     *
     *
     * @return string
     */
    public function getToken()
    {
        $authentication = $this->session->get($this->router->getModuleName());

        if(!is_array($authentication)) {
            $authentication = array();
        }

        if(!isset($authentication['tokenKey']) || !isset($authentication['token'])) {
            $authentication['tokenKey'] = $this->security->getTokenKey();
            $authentication['token']    = $this->security->getToken();
            $this->session->set($this->router->getModuleName(), $authentication);
        }

        return $authentication['token'];

    }

    /**
     * Get token value to be used as input's value in a CSRF check
     *
     *
     * @return string
     */
    public function getAuthentication()
    {
        $authentication = $this->session->get($this->router->getModuleName());
        if(!is_array($authentication)) {
            $authentication = array();
            $authentication['id'] = '';
            $authentication['email'] = '';

        }

        return $authentication;

    }

}
