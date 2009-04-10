<?php

class Primary extends GeneratorPluginAbstract {

    function __construct() {
        Primary::$cnf = array(
            "name" => "Primary",
            "post" => array()
        );
    }

    public function toSelect($item) {
        $cnf = Zend_Registry::get('cnf');
        $alias = $cnf->generators->table_alias;
        return array(
            "select"    => array(
                    "value" => "$alias.{$item['FieldName']}",
                    "alias" => "{$item['FieldName']}"
            )
        );
    }

    public function toViewEdit($item) {
        $html="{\$value}<input type='hidden' name='s_{$item['FieldName']}' value='{\$value}'>";
        return $html;
    }

}