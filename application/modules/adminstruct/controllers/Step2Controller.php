<?php

/**
 * Adminstruct_IndexController
 *
 * @author Taryk DarkStyler
 */
class Adminstruct_Step2Controller extends AuthControllerAction {

    public function indexAction() {
        $this->initCSS();
        $model = new AdminstructModel();
        $tablename=$this->_request->getParam('table');
        if (isset($tablename)) {
            $this->view->columns=$model->getColumns($tablename);
            $this->view->tablename=$tablename;
        } else {
            $this->sendMessage("pleace, select a table", "nocheck", $cnf->url->fullurl."adminstruct/step1/");
        }
    }

}
