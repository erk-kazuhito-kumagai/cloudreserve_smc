<?php
class ExaminationcategoryController extends ControllerBase
{
    public function indexAction()
    {

    }
    
    public function saveAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
        
           $examinationCategoryId = $this->request->getPost('examinationCategoryId', array('trim'));
           $examinationCategory   = NULL;

           if($examinationCategoryId) {
               $examinationCategory = ExaminationCategory::findFirst($examinationCategoryId);
           }
           if(!$examinationCategory) {
               $examinationCategory = new ExaminationCategory();
           }
           $examinationCategory->setParam($_POST);
           $data = array();
           

           if($examinationCategory->save()) {
           		$data[] = $examinationCategory->toArray();
               Utils::sendJson($data, Consts::JSON_SUCCESS);
               exit;
           }
           print_r($examinationCategory->getMessages());
           exit;
           throw new BusinessException('', ErrorCode::VALIDATION);
        }
        exit;
    }
    
    public function deleteAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
        
           $examinationCategoryId = $this->request->getPost('examinationCategoryId', array('trim'));
           $examinationCategory   = NULL;
           
           if($examinationCategoryId) {
               $examinationCategory = ExaminationCategory::findFirst($examinationCategoryId);
               if($examinationCategory && $examinationCategory->delete()) {
               }
           }
        }
        Utils::sendJson(array(), Consts::JSON_SUCCESS);
        exit;
    }
    
    public function listAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
        
            $examinationCategorys = ExaminationCategory::find(
            array(
                 'conditions' => "status = :status:",
                 'bind' => array('status' => Consts::ACTIVE),
                 'order' => 'seq asc'
                 )
            );
            $data = array();
            foreach($examinationCategorys as $examinationCategory) {
                $data[] = $examinationCategory->toArray();
            }
            Utils::sendJson($data, Consts::JSON_SUCCESS);
           
        }
        exit;
    }
    
    public function detailAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
            $examinationCategoryId = $this->request->getPost('examinationCategoryId', array('trim'));
			$examinationCategory   = NULL;

			if($examinationCategoryId) {
			   $examinationCategory = ExaminationCategory::findFirst($examinationCategoryId);
			} else {
				$examinationCategory = new ExaminationCategory();
			}
            $data = array();
            $data[] = $examinationCategory->toArray();

            Utils::sendJson($data, Consts::JSON_SUCCESS);
           
        }
        exit;
    }
    
    public function sampleAction()
    {
    }
}
