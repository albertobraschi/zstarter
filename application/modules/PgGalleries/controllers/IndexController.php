<?php

class PgGalleries_IndexController extends AuthControllerAction {

    public function indexAction() {
        $this->initCSS();
        $cnf = Zend_Registry::get('cnf');
        $model = new PgGalleriesModel();
        $this->view->table_view = $model->getTableView();
        $this->view->form_action=$cnf->url->fullurl.$this->getRequest()->getModuleName()."/delete/";
    }
}
