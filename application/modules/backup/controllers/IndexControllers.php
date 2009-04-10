<?php

/**
 * Backup_IndexController
 *
 * @author Taryk DarkStyler
 */
class Backup_IndexController extends AuthControllerAction {

    public function indexAction() {
        $cnf = Zend_Registry::get('cnf');
        $this->initCSS();
    }

}
