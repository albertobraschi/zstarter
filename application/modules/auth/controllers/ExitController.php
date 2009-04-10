<?php

class Auth_exitController extends AuthControllerAction {

    public function indexAction() {

        Zend_Auth::getInstance()->clearIdentity();

        $this->_redirect("/");

    }

}