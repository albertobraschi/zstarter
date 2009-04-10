<?php

class PgPhotos_IndexController extends AuthControllerAction {

    public function indexAction() {
        $this->initCSS();
        $cnf = Zend_Registry::get('cnf');
        $model = new PgPhotosModel();
        $this->view->table_view = $model->getTableView();
        $this->view->form_action=$cnf->url->fullurl.$this->getRequest()->getModuleName()."/delete/";
    }
}
