<?php

/**
 * Adminstruct_IndexController
 *
 * @author Taryk DarkStyler
 */
class Adminstruct_EditController extends AuthControllerAction {

    public function indexAction() {
        $cnf = Zend_Registry::get('cnf');
        $model = new AdminstructModel();
        $id = $this->_request->getParam('id');
        if (isset($id)) {
            $this->view->form_action="{$cnf->url->fullurl}/adminstruct/edit/update/";
            $this->view->item=$model->getItem($id);
        } else {
            //$this->view->error="no item selected";
            $this->sendMessage("no item selected", "edit", $cnf->url->fullurl."adminstruct/");
        }
    }

    public function updateAction() {
        $cnf = Zend_Registry::get('cnf');
        $model = new AdminstructModel();

        if ($this->_request->isPost() && $this->_request->getPost('f_update_submit')) {
            $data = array(
                "ID"                => $this->_request->getPost("s_ID"),
                "Name"              => $this->_request->getPost("s_Name"),
                "Description"       => $this->_request->getPost("s_Description"),
                "Alias"             => $this->_request->getPost("s_Alias"),
                "Date_creation"     => $this->_request->getPost("s_Date_creation"),
                "Date_modification" => $this->_request->getPost("s_Date_modification"),
                "Content_id"        => $this->_request->getPost("s_Content"),
                "Template"          => $this->_request->getPost("s_Template"),
                "Controller"        => $this->_request->getPost("s_Controller"),
                "Hidden"            => $this->_request->getPost("s_Hidden")
            );
            $model->update($data);
            $this->sendMessage("element '{$data['ID']}' has been updated successfully", "edit", $cnf->url->fullurl."adminstruct/");
        }
    }
}
