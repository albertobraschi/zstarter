<?php

/**
 * Adminstruct_DeleteController
 *
 * @author Taryk DarkStyler
 */
class Adminstruct_DeleteController extends AuthControllerAction {

    public function indexAction() {
        $this->view->css2=true;

        $model = new AdminstructModel();
        if ( ($id = $this->_request->getParam('id')) != NULL ) {
            if ($model->deleteModule($id)) {
                $out="element deleted successfully";
            } else {
                $out="error";
            }
        } elseif ($this->_request->getParam('submit_form_delete')!=NULL) {
            //$ids=$this->_request->getParam('ids');
            $cks=$this->_request->getParam('cks');
            $out="";
            foreach ($cks as $item_id => $state) {
                if ($state=="on") {
                    if($model->delItem($item_id)) {
                        $out.="element '$item_id' deleted successfully<br/>";
                    } else {
                        $out.="error in deleting '$item_id'<br/>";
                    }
                }
            }
        } else {
            $out="no selected row";
        }
        $this->sendMessage($out, "delete", $cnf->url->fullurl."adminstruct/");
    }

}
