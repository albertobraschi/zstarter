<?php

/**
 * Adminstruct_IndexController
 *
 * @author Taryk DarkStyler
 */
class Adminstruct_IndexController extends AuthControllerAction {

    public function indexAction() {
        $cnf = Zend_Registry::get('cnf');
        $this->initCSS();
        $model = new AdminstructModel();
        $this->view->site_structure = $model->getSiteStructure();
        $this->view->form_action=$cnf->url->fullurl.$this->getRequest()->getModuleName()."/delete/";
        $this->view->regenurl=$cnf->url->fullurl.$this->getRequest()->getModuleName()."/regen/";
    }

}
