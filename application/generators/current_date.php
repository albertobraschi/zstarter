<?php

class Current_date extends GeneratorPluginAbstract {

    function __construct() {
        Current_date::$cnf = array(
            "name" => "Current Date",
            "post" => array("d_current_date_template")
        );
    }

    public function toStep3($view) {
        return "<input type='text' name='d_current_date_template[]' value='%Y.%m.%d %H:%i' />";
    }

    public function toSelect($item) {
        $cnf = Zend_Registry::get('cnf');
        $alias = $cnf->generators->table_alias;
        return array(
            "select"    => array(
                        "value" => "FROM_UNIXTIME($alias.{$item['FieldName']}, '{$item['d_current_date_template']}')",
                        "alias" => $item['FieldName']
            )
        );
    }
    
    public function toViewEdit($item) {
        $html="<input type='text' name='s_{$item['FieldName']}' value='{\$value}'>";
        return $html;
    }

}