<?php

class Textarea extends GeneratorPluginAbstract {

    function __construct() {
        Textarea::$cnf = array(
            "name" => "Textarea",
            "post" => array()
        );
    }

    public function toViewEdit($item) {
        $html="<textarea name='s_{$item['FieldName']}'>{\$value}</textarea>";
        return $html;
    }

}

