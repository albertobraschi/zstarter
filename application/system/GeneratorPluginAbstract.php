<?php

abstract class GeneratorPluginAbstract {

    public static $cnf;

    public function toStep3($view) {
        return "";
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
        $html="<input type='text' name='s_{$item['FieldName']}' value='{\$value}'>";
        return $html;
    }

    public function toModel($item) {
        return "";
    }

    public function toController($item) {
        return "";
    }
}