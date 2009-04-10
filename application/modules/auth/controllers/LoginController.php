<?php

class Auth_loginController extends AuthControllerAction {

    public function indexAction() {

        if($this->_request->isPost()) {
            $auth = new LoginModel();
            $auth_res=$auth->login($this->_request->getParam('username'), $this->_request->getParam('password'));
            $this->view->yesno=$auth_res?"yes":"no";
            $this->_redirect("/");
            //$authNamespace = new Zend_Session_Namespace('Zend_Auth');

            //$this->view->username=$authNamespace->user;
        }

    }

}