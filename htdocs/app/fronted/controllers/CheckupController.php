<?php
class CheckupController extends ControllerBase
{
    public function indexAction()
    {

    }
    
    public function saveAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
        
           $checkupId = $this->request->getPost('checkupId', array('trim'));
           $checkup   = NULL;

           if($checkupId) {
               $chckup = Checkup::findFirst($checkupId);
           }
           if(!$checkup) {
               $checkup = new Checkup();
           }
           $checkup->setParam($_POST);
           $data = array();
           

           if($checkup->save()) {
           		$data[] = $checkup->toArray();
               Utils::sendJson($data, Consts::JSON_SUCCESS);
               exit;
           }
           print_r($checkup->getMessages());
           exit;
           throw new BusinessException('', ErrorCode::VALIDATION);
        }
        exit;
    }
    
    public function deleteAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
        
           $checkupId = $this->request->getPost('checkupId', array('trim'));
           $checkup   = NULL;
           
           if($checkupId) {
               $checkup = Checkup::findFirst($checkupId);
               if($checkup && $checkup->delete()) {
               }
           }
        }
        Utils::sendJson(array(), Consts::JSON_SUCCESS);
        exit;
    }
    
    public function listAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
        
            $checkups = Checkup::find(
            array(
                 'conditions' => "status = :status:",
                 'bind' => array('status' => Consts::ACTIVE),
                 'order' => 'seq asc'
                 )
            );
            $data = array();
            foreach($checkups as $checkup) {
                $data[] = $checkup->toArray();
            }
            Utils::sendJson($data, Consts::JSON_SUCCESS);
           
        }
        exit;
    }
    
    public function detailAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
            $checkupId = $this->request->getPost('checkupId', array('trim'));
			$checkup   = NULL;

			if($checkupId) {
			   $checkup = Checkup::findFirst($checkupId);
			} else {
				$checkup = new Checkup();
			}
            $data = array();
            $data[] = $checkup->toArray();

            Utils::sendJson($data, Consts::JSON_SUCCESS);
           
        }
        exit;
    }
    
}
