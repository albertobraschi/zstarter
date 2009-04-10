<?php

/**
 * Adminstruct_ModulesController
 *
 * @author Taryk DarkStyler
 */
class Adminstruct_ModulesController extends AuthControllerAction {

    public function indexAction() {
        $cnf = Zend_Registry::get('cnf');
        $this->initCSS();
        $model = new AdminstructModel();
        $this->view->modules = $model->getModules();
        $this->view->form_action=$cnf->url->fullurl.$this->getRequest()->getModuleName()."/delete/";
        $this->view->editurl=$cnf->url->fullurl.$this->getRequest()->getModuleName()."/edit/";
        $this->view->regenurl=$cnf->url->fullurl.$this->getRequest()->getModuleName()."/regen/";
        $this->view->deleteurl=$cnf->url->fullurl.$this->getRequest()->getModuleName()."/delete/";
        $this->view->addurl=$cnf->url->fullurl.$this->getRequest()->getModuleName()."/step1/";
    }

}
