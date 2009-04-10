<?php

class List_from_database extends GeneratorPluginAbstract {

    function __construct() {
        List_from_database::$cnf = array(
            "name" => "List from database",
            "post" => array()
        );
    }

}