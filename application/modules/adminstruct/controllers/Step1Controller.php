<?php

/**
 * Adminstruct_IndexController
 *
 * @author Taryk DarkStyler
 */
class Adminstruct_Step1Controller extends AuthControllerAction {

    public function indexAction() {
        $this->initCSS();
        $model = new AdminstructModel();
        $this->view->site_structure = $model->getSiteStructure();
        $this->view->tables=$model->getTables();
        if (!empty($this->_session->mode_action)) {
            $this->view->message=$this->_session->message;
            unset($this->_session->mode_action);
            unset($this->_session->message);
        }
    }

    public function addAction() {
        $this->view->css2=true;
        $this->view->controller=$this->_request->controller;
        $this->view->action=$this->_request->action;
    }

    public function insertAction() {
        $model = new AdminstructModel();
        $this->view->name=$this->_request->getParam("f_name");
    }

    public function editAction() {
        $model = new AdminstructModel();
        $this->view->item=$model->getItem($this->_request->getParam('id'));
        $this->view->css2=true;
        $this->view->controller=$this->_request->controller;
        $this->view->action=$this->_request->action;
    }

    public function deleteAction() {
        
    }

    public function step2Action() {
        $model = new AdminstructModel();
        $tablename=$this->_request->getParam('table');
        $this->view->columns=$model->getColumns($tablename);
        $this->view->tablename=$tablename;
    }


    public function getTypeSpecify($typeid) {
        $model = new AdminstructModel();
        //$model->
    }

    public function step3Action() {
        $model = new AdminstructModel();

        $cnf = Zend_Registry::get('cnf');

        $controller=$this->_request->controller;
        $action=$this->_request->action;

        $this->view->head_script2="<script language='javascript' src='".$cnf->url->base."public/design/js/$controller/$action.js' type='text/javascript'></script>";

        $this->view->columns=$model->getColumns($this->_request->getParam('tablename'));
        $this->view->f_step2=$this->_request->getParam('f_step2');
        //if ($this->_request->getParam('f_step2')) {
        $types=$this->_request->getParam('type');
        $this->view->types=$types;
        $this->view->adminvalidators=$model->getAdminValiadtors();

        $model2 = new AdminColsTypesModel();

        $class_rules=$initial_val=false;
        foreach ($types as $row => $type) {
            $type_name=$model2->getName($type);

            // upper case all words
            $type_name=ucwords($type_name[0]['TypeName']);
            // removing spaces
            $type_name=preg_replace("/\ /","",$type_name);
            //print $type_name;

            eval("\$class_rules[\$row]=\$this->view->${type_name}();");
            eval("\$initial_val[\$row]=\$this->view->${type_name}Init();");
        }
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

    public function step4Action() {
        $model = new AdminstructModel();
        
        $cb_view=$this->_request->getParam('cb_view');
        for ($i=0;$i<count($cb_view);$i++) {
            
        }

        $file_controller=fopen("${modulename}Controller.php","w") or die ("Failed on create ${modulename}Controller.php");
        fwrite($file_controller,$model->getTemplateController($modulename));
        fclose($file_controller);
        //$file_model=fopen("${modulename}Model.php","w");
        //$file_view=fopen("index.tpl","w");
        //$file_edit=fopen("edit.tpl","w");
    }

}
