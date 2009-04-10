<?php

class PgPhotos_AddController extends AuthControllerAction {

    public function indexAction() {
        $cnf = Zend_Registry::get('cnf');
        $model = new PgPhotosModel();
        $this->view->form_action="{$cnf->url->fullurl}PgPhotos/edit/insert/";
        











$this->view->options_Gallery_id=$model->getOptions_Gallery_id();








    }

    public function insertAction() {
        $cnf = Zend_Registry::get('cnf');
        $model = new PgPhotosModel();
        $data = array(  );

        if ($this->_request->isPost() && $this->_request->getPost('f_insert_submit')) {
            			$data['ID']=$this->_request->getPost('s_ID');
			$data['Filename']=$this->_request->getPost('s_Filename');
			$data['Description']=$this->_request->getPost('s_Description');
			$data['Date_creation']=$this->_request->getPost('s_Date_creation');
			$data['Date_modification']=$this->_request->getPost('s_Date_modification');
			$data['Raiting']=$this->_request->getPost('s_Raiting');
			$data['Gallery_id']=$this->_request->getPost('s_Gallery_id');
			$data['Hidden']=($this->_request->getPost('s_Hidden')=='on')?'1':'0';
			$data['Comments']=($this->_request->getPost('s_Comments')=='on')?'1':'0';
			$data['Tags']=($this->_request->getPost('s_Tags')=='on')?'1':'0';

            //array_shift($data);
            $model->insert($data);
            $this->sendMessage("element has been added successfully", "add", $cnf->url->fullurl."PgPhotos/");
        }

    }
}
