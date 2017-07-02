<?php

class CommonController extends ControllerBase
{
    public function zipAction()
    {
        $data = array('success'=>true, 'data' => array(), 'message' => '', 'count' => 0);
        $request = $this->request;
        $zipcode = $request->getPost('zipcode', array('trim'));
        $zips     = Zip::get($zipcode);
        $i = 0;
        if($zips) {
            foreach($zips as $zip) {
                $data['data'][] = array('state' => $zip->state, 'city' => $zip->city, 'town' => $zip->town);
                $i++;
            }
        }
        if(!$i) {
            $data['success'] = false;
            $data['message'] = '住所が見つかりませんでした。';
        }
        
        $data['count'] = $i;
        header('Content-type: application/json; charset=utf-8"');
        echo json_encode($data);
       
        exit;
    }
    
    public function successAction()
    {
        
        $this->initializeLabels();
        $this->initializeFormMessage();
        
        $data = $this->formTranslate->get('common');

        $this->view->message    = $data[0];
        $this->view->back_title = $data[1];
        $this->view->back       = $data[2];

        $param  = $this->dispatcher->getParam(0);
        if($param) {
            $data = $this->formTranslate->get($param);

            if($data) {
                $this->view->message    = $data[0];
                $this->view->back_title = $data[1];
                $this->view->back       = $data[2];
            }
        }
    }
}

