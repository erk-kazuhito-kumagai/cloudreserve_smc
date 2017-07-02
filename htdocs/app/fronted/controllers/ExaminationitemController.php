<?php
class ExaminationitemController extends ControllerBase
{
    public function indexAction()
    {
        //$this->securityPlugin->generateToken();
    }
    
    public function saveAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
        
           $examinationItemId = $this->request->getPost('examinationItemId', array('trim'));
           $examinationItem   = NULL;

           if($examinationItemId) {
               $examinationItem = ExaminationItem::findFirst($examinationItemId);
           }
           if(!$examinationItem) {
               $examinationItem = new ExaminationItem();
           }
           $examinationItem->setParam($_POST);
           $data = array();
           

           if($examinationItem->save()) {
           		$data[] = $examinationItem->toArray();
               Utils::sendJson($data, Consts::JSON_SUCCESS);
               exit;
           }
           print_r($examinationItem->getMessages());
           exit;
           throw new BusinessException('', ErrorCode::VALIDATION);
        }
        exit;
    }
    
    public function deleteAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
        
           $examinationItemId = $this->request->getPost('examinationItemId', array('trim'));
           $examinationItem   = NULL;
           
           if($examinationItemId) {
               $examinationItem = ExaminationItem::findFirst($examinationItemId);
               if($examinationItem && $examinationItem->delete()) {
               }
           }
        }
        Utils::sendJson(array(), Consts::JSON_SUCCESS);
        exit;
    }
    
    
    public function detailAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
            $examinationItemId = $this->request->getPost('examinationItemId', array('trim'));
			$examinationItem   = NULL;
//print_r($_POST);
			if($examinationItemId) {
			   $examinationItem = ExaminationItem::findFirst($examinationItemId);
			} else {
				$examinationItem = new ExaminationItem();
			}
            $data = array();
            $data[] = $examinationItem->toArray();

            Utils::sendJson($data, Consts::JSON_SUCCESS);
           
        }
        exit;
    }
    
    public function listAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
        	$examinationId = $this->request->getPost('examinationId', array('trim'));
        	$itemNum = $this->request->getPost('itemNum', array('trim')); 
            $examinationItems = ExaminationItem::find(
            array(
                 'conditions' => "status = :status: and examinationId = :examinationId: and itemNum = :itemNum: ",
                 'bind' => array('status' => Consts::ACTIVE, 'examinationId' => $examinationId , 'itemNum' => $itemNum),
                 'order' => 'seq asc'
                 )
            );
            $data = array();
            foreach($examinationItems as $examinationItem) {
                $data[] = $examinationItem->toArray();
            }
            Utils::sendJson($data, Consts::JSON_SUCCESS);
           
        }
        exit;
    }
}
