<?php

class Checkbox extends GeneratorPluginAbstract {

    function __construct() {
        Checkbox::$cnf = array(
            "name" => "Checkbox",
            "post" => array()
        );
    }

    public function toSelect($item) {
        $cnf = Zend_Registry::get('cnf');
        $alias = $cnf->generators->table_alias;
        return array(
            "select"    => array(
                   "value" => "IF($alias.{$item['FieldName']}=0,'no','yes')",
                   "alias" => "{$item['FieldName']}"
            )
        );
    }

    public function toViewEdit($item) {
        $html="<input type='checkbox' name='s_{$item['FieldName']}' {\$value}>";
        return $html;
    }

}