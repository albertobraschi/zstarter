<?php

require 'Zend/Loader.php';

class Kernel {

    public static function run($config,$helpers) {

        try {

            Zend_Loader::registerAutoload();

            $cnf = new Zend_Config($config);

            Zend_Registry::set('cnf', $cnf);
            
            self::setDbAdapter();

            if (file_exists($cnf->path->system.'routes.php')) {
                include_once($cnf->path->system.'routes.php');
            }

            $auth = Zend_Auth::getInstance();

            //$acl="";

            if (file_exists($cnf->path->system.'acl.php')) {
                include_once($cnf->path->system.'acl.php');
            }

            //$acl = new AuthAcl();

            $request = new Zend_Controller_Request_Http();

            $front = Zend_Controller_Front::getInstance();

            $front->registerPlugin(new AuthControllerPlugin($auth, $acl));

            $front->addModuleDirectory($cnf->path->modules);

            $front->setBaseUrl($cnf->url->base)
                  ->throwexceptions(true)
                  ->setRouter($router)
                  ->setRequest($request)
                  ->setDefaultModule("default")
                  ->setDefaultControllerName("index");

            Zend_Layout::startMvc(array(
                'layoutPath' => $cnf->path->layouts,
                'layout' => 'index',
            ));
 
            $layout = Zend_Layout::getMvcInstance();

	        $view = $layout->getView();

            $layout->setViewSuffix('phtml');

            $layout->setView($view);

            //$view->setBasePath($cnf->path->views);

            // Helpers connecting
            foreach ($helpers as $name => $path) {
                $view->addHelperPath($path, $name);
            }

            $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
            $viewRenderer->setView($view)
                         ->setViewSuffix('tpl');

            Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
            
            if (file_exists($cnf->path->system.'main_index.php')) {
                include_once($cnf->path->system.'main_index.php');
            }

            //Zend_Controller_Front::run($cnf->path->controllers);
            //Zend_Controller_Front::dispatch();
            $front->dispatch();

        } 

        catch (Exception $e) {
            Error::catchException($e);
        }

    }

    public static function setDbAdapter() {

        $cnf = Zend_Registry::get('cnf');

        $db = Zend_Db::factory($cnf->db);

        Zend_Db_Table_Abstract::setDefaultAdapter($db);

        Zend_Registry::set('db', $db);

    }

}
