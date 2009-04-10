<?php

class Image extends GeneratorPluginAbstract {

    function __construct() {
        Image::$cnf = array(
            "name" => "Image",
            "post" => array()
        );
    }

}