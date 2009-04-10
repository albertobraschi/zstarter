<?php

class LoginModel {

    public function login($username, $password) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);

        $authAdapter = new Zend_Auth_Adapter_DbTable(
            $db,
            'admin_users',
            'Username',
            'Password'
        );

        $authAdapter
            ->setIdentity($username)
            ->setCredential($password);

        $auth = Zend_Auth::getInstance();


        $resultAuth = $auth->authenticate($authAdapter);

        if($resultAuth->isValid()) {
            $data = $authAdapter->getResultRowObject(null, 'password');
            $auth->getStorage()->write($data);
            $result=$data;
        } else {
            $result=false;
        }

        return $result;

    }

}