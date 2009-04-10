<?php

class AuthControllerAction extends Zend_Controller_Action {

    protected $_aclHelper;
    protected $_user;
    protected $_session;

    public function init() {
        $session = new Zend_Session_Namespace("Zend_Auth");
        $this->_user = $session->storage;
        $this->_session = $session->storage;
        if ( !$this->getRequest()->isXMLHttpRequest() ) {
            $this->initView();
            $this->view->user=$this->_user;
        }

        //
        // message on page
        //
        if (!empty($this->_session->mode_action)) {
            $this->view->message=$this->_session->message;
            unset($this->_session->mode_action);
            unset($this->_session->message);
        }
    }

    protected function initCSS() {
        $cnf = Zend_Registry::get('cnf');

        $module = $this->getRequest()->getModuleName();
        $controller = $this->getRequest()->getControllerName();
        $action = $this->getRequest()->getActionName();

        $this->view->head_link2=(string)$this->view->headLink()->appendStylesheet($cnf->url->fullurl."public/design/css/$module/$action.css");
    }

    protected function initJS() {
        $cnf = Zend_Registry::get('cnf');

        $module = $this->getRequest()->getModuleName();
        $controller = $this->getRequest()->getControllerName();
        $action = $this->getRequest()->getActionName();

        $this->view->head_script2="<script language='javascript' src='".$cnf->url->fullurl."public/design/js/$module/$action.js' type='text/javascript'></script>";
    }

    protected function sendMessage($message, $action, $target) {
        $this->_session->mode_action=$action;
        $this->_session->message=$message;
        $this->_redirect($target);
    }

}