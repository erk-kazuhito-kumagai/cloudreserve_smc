<?php

use Phalcon\Mvc\Controller;
use Phalcon\Tag;

class ControllerBase extends Controller
{
    protected function initialize()
    {
        Phalcon\Tag::setTitle('ERKENNT | ');

        $this->url = new Phalcon\Mvc\Url();
        if($this->config->application->js) {
            $this->view->js = 'js/' . $this->dispatcher->getControllerName() . '_' . $this->dispatcher->getActionName() . '.js';
             $this->view->css = 'css/' . $this->dispatcher->getControllerName() . '_' . $this->dispatcher->getActionName() . '.css';
        } else {
            $this->view->js = '';
        }
        
        $this->initializeLabels();

        Phalcon\Tag::appendTitle($this->translate->_('title'));
        $this->view->setTemplateAfter('main');
        //$this->view->cache(true);
    }

    protected function forward($uri){
    	$uriParts = explode('/', $uri);
    	if(!isset($uriParts[1])) {
    	    $uriParts[1] = 'index';
    	}
    	
    	if($this->config->application->js) {
    	    $this->view->js = 'js/' . $uriParts[0] . '_' . $uriParts[1] . '.js';
    	    $this->view->css = 'css/' . $uriParts[0] . '_' . $uriParts[1] . '.css';
    	} else {
    	    $this->view->js = '';
    	}
    	
    	$this->initializeLabels($uriParts[0], $uriParts[1]);
        if(count($uriParts) == 2) { 
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0], 
    			'action' => $uriParts[1]
    		)
    	);
    	} else {
    	
    	$temp = $uriParts;
    	$params = array();
        unset($temp[0]);
        unset($temp[1]);
        foreach($temp as $val) {
            $params[] = $val;
        }
    	return $this->dispatcher->forward(
    		array(
    			'controller' => $uriParts[0], 
    			'action' => $uriParts[1],
    			'params' => $params
    		)
    	);
    	}
    }
    
    protected function initializeLabels($controller = NULL, $action = NULL) {
        if(!$controller) {
            $controller = $this->dispatcher->getControllerName();
        }
        
        if(!$action) {
            $action = $this->dispatcher->getActionName();
        }
        
        $this->translate = Utils::getTranslate($this->config->application->labelTransDir, $controller , $action, $this->global->language);
        $data = $this->translate->getLists();

        foreach($data as $key => $value) {
            $this->view->{"label_" . $key} = $value;
        }
    }
    
    protected function initializeFormMessage() {
        require ($this->config->application->transDir . "forms/" . $this->global->language . '/' . $this->dispatcher->getControllerName() . '/' . $this->dispatcher->getActionName() . '.php');
        $this->formTranslate =  new CustomTranslate(array(
           "content" => $formMessages
       ));
    }
    
    protected function trim($data) {
        if(is_array($data)) {
            foreach($data as $key => $value) {
                $data[$key] = trim($value);
            }
        }
        return $data;
    }
    
    protected function setView($data) {
        if(is_array($data)) {
            foreach($data as $key => $value) {
                $this->view->{$key} = $value;
            }
        }
    }
}
