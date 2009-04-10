<?php

/**
 * Adminstruct_RegenController
 *
 * @author Taryk DarkStyler
 */
class Adminstruct_RegenController extends AuthControllerAction {

    public function indexAction() {
        $cnf = Zend_Registry::get('cnf');
        $module_id = $this->_request->getParam("id");
        $model=new AdminstructModel();
        $module=$model->getModuleName($module_id);
        $this->_session->s3data = require($cnf->path->modules."$module/config.php");
        $this->_session->modulename=$module;
        $this->_redirect($cnf->url->fullurl."adminstruct/step4/");
    }

}
