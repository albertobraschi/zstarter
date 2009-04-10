<?php

class GeneratorsModel {

    $generators = array();

    function listGenerators() {
        $cnf = Zend_Registry::get('cnf');
        //$db = Zend_Db::factory($cnf->db);
        
        $g = opendir($cnf->path->generators);
        while (false !== ($file = readdir($g))) { 
            array_push($this->generators,$file);
        }

        return $this->generators;
    }
 
}