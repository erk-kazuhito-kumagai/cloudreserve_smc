<?php
class ExaminationController extends ControllerBase
{
    public function indexAction()
    {
        //$this->securityPlugin->generateToken();
    }
    
    public function saveAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
        
           $examinationId = $this->request->getPost('examinationId', array('trim'));
           $examination   = NULL;

           if($examinationId) {
               $examination = Examination::findFirst($examinationId);
           }
           if(!$examination) {
               $examination = new Examination();
           }
           $examination->setParam($_POST);
           $data = array();
           

           if($examination->save()) {
           		$data[] = $examination->toArray();
               Utils::sendJson($data, Consts::JSON_SUCCESS);
               exit;
           }
           print_r($examination->getMessages());
           exit;
           throw new BusinessException('', ErrorCode::VALIDATION);
        }
        exit;
    }
    
    public function deleteAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
        
           $examinationId = $this->request->getPost('examinationId', array('trim'));
           $examination   = NULL;
           
           if($examinationId) {
               $examination = Examination::findFirst($examinationId);
               if($examination && $examination->delete()) {
               }
           }
        }
        Utils::sendJson(array(), Consts::JSON_SUCCESS);
        exit;
    }
    
    public function listAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
            $examinations = Examination::find(
            array(
                 'conditions' => "status = :status:",
                 'bind' => array('status' => Consts::ACTIVE),
                 'order' => 'seq asc'
                 )
            );
            $data = array();
            foreach($examinations as $examination) {
                $data[] = $examination->toArray();
            }

            Utils::sendJson($data, Consts::JSON_SUCCESS);
           
        }
        exit;
    }
    
    public function detailAction()
    {
        if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
            $examinationId = $this->request->getPost('examinationId', array('trim'));
			$examination   = NULL;

			if($examinationId) {
			   $examination = Examination::findFirst($examinationId);
			} else {
				$examination = new Examination();
			}
            $data = array();
            $data[] = $examination->toArray();

            Utils::sendJson($data, Consts::JSON_SUCCESS);
           
        }
        exit;
    }
    
    public function listitemsAction()
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
    
    public function saveimageAction() {
    	$examinationId = $this->request->getPost('examinationId', array('trim'));
    	$imageNum = $this->request->getPost('imageNum', array('trim'));
    	$config = $this->di->get("commonconfig");
    	$imageDir = $config->application->imageDir;
		$examination   = NULL;

		if($examinationId) {
		   $examination = Examination::findFirst($examinationId);
		   
		   ///$examination->{{"item".$imageNum."Image"}} = file_get_contents($_FILES['file']['tmp_name']);
		   move_uploaded_file($_FILES['file']['tmp_name'], $imageDir .'/'.  $examinationId . '_'. $imageNum);
		   
		   $dat = pathinfo($_FILES["file"]["name"]);
		   $extension = $dat['extension'];
		   
		   if ( $extension == "jpg" || $extension == "jpeg" ) $mime = "image/jpeg";
		    else if( $extension == "gif" ) $mime = "image/gif";
		    else if ( $extension == "png" ) $mime = "image/png";
		    
		    $examination->item1Mime = $mime;
		   
		   $examination->save();
		} else {
			exit;
		}
    print_r($_POST);
    print_r($_FILES);
        exit;
    }
    
    public function imageAction() {
    	$examinationId = $this->dispatcher->getParam(0);
    	$imageNum = $this->dispatcher->getParam(1);
		$examination   = NULL;
		$config = $this->di->get("commonconfig");
		$imageDir = $config->application->imageDir;

		if($examinationId) {
		   $examination = Examination::findFirst($examinationId);
		   header( "Content-Type: ". $examination->item1Mime );
		   echo file_get_contents($imageDir .'/'.  $examinationId . '_'. $imageNum);
		   
		} else {
			exit;
		}
        exit;
    }
    
    
    public function validateAction() {
    	if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
    		$examinationId = $this->request->getPost('examinationId', array('trim'));
    	    $itemNum = $this->request->getPost('itemNum', array('trim'));
    	    $validates = $this->request->getPost('validate');
    	    
    		$examinatValidations = ExaminationValidation::find(
            array(
                 'conditions' => "examinationId = :examinationId: and itemNum = :itemNum:",
                 'bind' => array('examinationId' => $examinationId, 'itemNum' => $itemNum)
                 )
            );

            $examinatValidations->delete();
            
            if($validates && is_array($validates)) {
                foreach($validates as $validate) {
                    $examinatValidation = new ExaminationValidation();
                    $examinatValidation->examinationId = $examinationId;
                    $examinatValidation->itemNum = $itemNum;
                    $examinatValidation->type = $validate;
                    $examinatValidation->etc1 = $this->request->getPost('etc1' . $validate, array('trim'));
                    $examinatValidation->etc2 = $this->request->getPost('etc2' . $validate, array('trim'));
                    $examinatValidation->save();
                }
               
            }
            
    		$data = array();
    	    Utils::sendJson($data, Consts::JSON_SUCCESS);
    	}
    	
        exit;
    }
    
    public function getvalidateAction() {
    	if ($this->securityPlugin->checkToken() && $this->request->isPost()) {
    		$examinationId = $this->request->getPost('examinationId', array('trim'));
    	    $itemNum = $this->request->getPost('itemNum', array('trim'));
    	    
    		$examinatValidations = ExaminationValidation::find(
            array(
                 'conditions' => "examinationId = :examinationId: and itemNum = :itemNum:",
                 'bind' => array('examinationId' => $examinationId, 'itemNum' => $itemNum)
                 )
            );

            
            
    		$data = array();
    		
    		foreach($examinatValidations as $examinatValidation) {
                $data[] = $examinatValidations->toArray();
            }

    	    Utils::sendJson($data, Consts::JSON_SUCCESS);
    	}
    	
        exit;
    }
}
