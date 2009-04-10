<?php

class PgGalleries_EditController extends AuthControllerAction {

    public function indexAction() {
        $cnf = Zend_Registry::get('cnf');
        $model = new PgGalleriesModel();
        $id = $this->_request->getParam('id');
        if (isset($id)) {
            $this->view->item=$model->getItem($id);
            $this->view->form_action="{$cnf->url->fullurl}PgGalleries/edit/update/";
            











$this->view->options_DefaultPhotoID=$model->getOptions_DefaultPhotoID();






        } else {
            //$this->view->error="no item selected";
            $this->sendMessage("no item selected", "edit", $cnf->url->fullurl."PgGalleries/");
        }
    }

    public function updateAction() {
        $cnf = Zend_Registry::get('cnf');
        $model = new PgGalleriesModel();

        $data = array(  );

        if ($this->_request->isPost() && $this->_request->getPost('f_update_submit')) {
            			$data['ID']=$this->_request->getPost('s_ID');
			$data['Name']=$this->_request->getPost('s_Name');
			$data['Alias']=$this->_request->getPost('s_Alias');
			$data['Date_creation']=$this->_request->getPost('s_Date_creation');
			$hour = $this->_request->getPost('s_h_hour');
			$min = $this->_request->getPost('s_m_min');
			$sec = $this->_request->getPost('s_s_sec');
			$mon = $this->_request->getPost('s_m_mon');
			$day = $this->_request->getPost('s_d_day');
			$year = $this->_request->getPost('s_y_year');
			$data['$']=mktime($hour,$min,$sec,$mon,$day,$year);			$data['Description']=$this->_request->getPost('s_Description');
			$data['DefaultPhotoID']=$this->_request->getPost('s_DefaultPhotoID');
			$data['Raiting']=$this->_request->getPost('s_Raiting');
			$data['Hidden']=($this->_request->getPost('s_Hidden')=='on')?'1':'0';

            $model->update($data);
            $this->sendMessage("element '{$data['ID']}' has been updated successfully", "edit", $cnf->url->fullurl."PgGalleries/");
        }
    }
}
