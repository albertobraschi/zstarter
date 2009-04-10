<?php

/**
 * Adminstruct_IndexController
 *
 * @author Taryk DarkStyler
 */
class Adminstruct_Step3Controller extends AuthControllerAction {

    public function indexAction() {
        $model = new AdminstructModel();

        $cnf = Zend_Registry::get('cnf');
        $module=$this->_request->module;
        $controller=$this->_request->controller;
        $action=$this->_request->action;

//        $this->view->module=$module;
//        $this->view->controller=$controller;
//        $this->view->action=$action;
        
        $this->view->head_script2="<script language='javascript' src='".$cnf->url->fullurl."public/design/js/$module/$controller/$action.js' type='text/javascript'></script>";

        $this->view->tablename=$this->_request->getParam('tablename');
        $this->view->columns=$model->getColumns($this->_request->getParam('tablename'));
        $this->view->f_step2=$this->_request->getParam('f_step2');
        //if ($this->_request->getParam('f_step2')) {
        $types=$this->_request->getParam('type');
        $this->view->adminvalidators=$model->getAdminValiadtors();

        $model2 = new AdminColsTypesModel();

        $class_rules=$initial_val=false;
        foreach ($types as $row => $type) {
            $type_name=$model2->getName($type);
            $generator_name=strtolower($type_name[0]['TypeName']);
            $generator_name=preg_replace("/\ /","_",$generator_name);

            require_once($cnf->path->generators.$generator_name.".php");

            eval("\$gen = new $generator_name(); \$gen_cnf = $generator_name::\$cnf;");

            $class_rules[$row] = "";
            $initial_val[$row] = $gen->toStep3($this->view);
            $types[$row]=$generator_name;
            unset($gen);
        }
        $this->view->types=$types;
        $this->view->class_rules=$class_rules;
        $this->view->initial_val=$initial_val;
    }

    public function ajaxtestAction() {
        $this->view->text="hello, from ajax";
        $this->view->notemplate=$this->_request->getParam('notemplate');
    }

    public function getdescAction() {
        $model = new AdminstructModel();
        $this->view->options = $model->getColumns($this->_request->getParam('tablename'));
        $this->view->notemplate = $this->_request->getParam('notemplate');
        $this->view->stype = $this->_request->getParam('stype');
    }

}
