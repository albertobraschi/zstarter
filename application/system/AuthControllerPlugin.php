<?php

class AuthControllerPlugin extends Zend_Controller_Plugin_Abstract {

    private $_auth;
    private $_acl;

    protected $_noAuth = array(
        "module"     => "auth",
        "controller" => "index",
        "action"     => "index"
    );

    protected $_noAcl = array(
        "module"     => "default",
        "controller" => "error",
        "action"     => "error"
    );

    public function __construct($auth, $acl) {
        $this->_auth=$auth;
        $this->_acl=$acl;
    }

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        if ($this->_auth->hasIdentity()) {
            $cnf = Zend_Registry::get('cnf');
            $db = Zend_Db::factory($cnf->db);
            $select = $db->query("
                SELECT
                    ut.User_type AS UserType
                FROM
                    admin_users_types ut
                WHERE
                    ID=".$this->_auth->getIdentity()->TypeID);
            $tp = $select->fetchAll();
            $role = $tp[0]['UserType'];
        } else {
            $role = "guest";
        }

        $module = $request->module;
        $controller = $request->controller;
        $action = $request->action;
        $resource = $request->module;

        //print "<pre>";var_dump($request);

        if ($this->_acl->has($resource)) {
            $resource=null;
        }

        if (!$this->_acl->isAllowed($role, $module, $controller, $action)) {
            list($module, $controller, $action) = (!$this->_auth->hasIdentity()) ? array_values($this->_noAuth):array_values($this->_noAcl);
        }

        $request->setModuleName($module);
        $request->setControllerName($controller);
        $request->setActionName($action);
    }
}