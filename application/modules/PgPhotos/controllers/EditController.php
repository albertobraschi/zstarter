<?php

class PgPhotos_EditController extends AuthControllerAction {

    public function indexAction() {
        $cnf = Zend_Registry::get('cnf');
        $model = new PgPhotosModel();
        $id = $this->_request->getParam('id');
        if (isset($id)) {
            $this->view->item=$model->getItem($id);
            $this->view->form_action="{$cnf->url->fullurl}PgPhotos/edit/update/";
            











$this->view->options_Gallery_id=$model->getOptions_Gallery_id();








        } else {
            //$this->view->error="no item selected";
            $this->sendMessage("no item selected", "edit", $cnf->url->fullurl."PgPhotos/");
        }
    }

    public function updateAction() {
        $cnf = Zend_Registry::get('cnf');
        $model = new PgPhotosModel();

        $data = array(  );

        if ($this->_request->isPost() && $this->_request->getPost('f_update_submit')) {
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

            $model->update($data);
            $this->sendMessage("element '{$data['ID']}' has been updated successfully", "edit", $cnf->url->fullurl."PgPhotos/");
        }
    }
}
