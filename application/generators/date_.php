<?php

class Date_ extends GeneratorPluginAbstract {

    function __construct() {
        Date_::$cnf = array(
            "name" => "Date",
            "post" => array("d_date_template"),
            "post_addedit" => array("hour","min","sec","mon","day","year"),
            "union" => "mktime(<vars>)"
        );
    }

    public function toStep3($view) {
        return "<input type='text' name='d_date_template[]' value='%Y.%m.%d %H:%i' />";
    }

    public function toSelect($item) {
        $cnf = Zend_Registry::get('cnf');
        $alias = $cnf->generators->table_alias;
        return array(
            "select"    => array(
                    "value" => "FROM_UNIXTIME($alias.{$item['FieldName']}, '{$item['d_date_template']}')",
                    "alias" => $item['FieldName']
            )
        );
    }

    public function toViewEdit($item) {
        //$cnf = Zend_Registry::get('cnf');
        $res=$this->genOptions("s_{$item['FieldName']}_year",range(2000, date("Y",time())),date("Y",time())).".";
        $res.=$this->genOptions("s_{$item['FieldName']}_mon",range(1, 12),date("n",time())).".";
        $res.=$this->genOptions("s_{$item['FieldName']}_day",range(1, 31),date("j",time()))." // ";
        $res.=$this->genOptions("s_{$item['FieldName']}_hour",range(0, 23),date("H",time())).":";
        $res.=$this->genOptions("s_{$item['FieldName']}_min",range(0, 59),date("i",time())).":";
        $res.=$this->genOptions("s_{$item['FieldName']}_sec",range(0, 59),date("s",time()));
        return $res; 
    }

    private function genOptions($name, $range, $selected) {
        $res="<select name='{$name}[]'>\n";
        foreach ($range as $item) {
            $res.="<option value='$item' ".(($item==$selected)?"selected":"").">".sprintf("%02d",$item)."</option>\n";
        }
        $res.="</select>";
        return $res;
    }

}