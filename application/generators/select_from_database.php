<?php

class Select_from_database extends GeneratorPluginAbstract {

    function __construct() {
        Select_from_database::$cnf = array(
            "name"      => "Select from database",
            "post"      => array('s_tables', 's_tables_id', 's_tables_description'),
        );
    }

    public function toStep3($view) {

        $jquery = $view->jQuery();
        $jquery->enable(); // enable jQuery Core Library

        // get current jQuery handler based on noConflict settings
        $jqHandler = ZendX_JQuery_View_Helper_JQuery::getJQueryHandler();

        //$function = '("#s_tables").click(function() '
        //          . '{ alert("noConflict Mode Save Helper!"); }'
        //          . ')';
        $function = "
            $(\"#s_tables\").change(function() {
                $(\"#s_tables_id\").load(
                    'http://taryk/admin/adminstruct/step3/getdesc/',
                    {
                        tablename: $(\"#s_tables\").get(0).options[$(\"#s_tables\").get(0).selectedIndex].value,
                        notemplate: 'yes',
                        stype: 'ID'
                    }
                );
                $(\"#s_tables_description\").load(
                    'http://taryk/admin/adminstruct/step3/getdesc/',
                    {
                        tablename: $(\"#s_tables\").get(0).options[$(\"#s_tables\").get(0).selectedIndex].value,
                        notemplate: 'yes',
                        stype: 'Description'
                    }
                );
            })
        ";
        $jquery->addOnload($jqHandler . $function);
        $list = $this->getList();

        // list: tables
        $out="<fieldset><legend>Connect a table:</legend>
                <table border='0' cellspacing='0' cellspadding='0'>
                <tr>
                    <td>Table:</td>
                    <td>
                        <select name='s_tables[]' id='s_tables'>
                            <option selected='selected'>Select...</option>";
        foreach ($list as $item) {
            $out.="<option value='".$item['Tables_in_taryk']."'>".$item['Tables_in_taryk']."</option>";
        }
        $out.="</select></td></tr>";

        // list: ID
        $out.="<tr><td>ID:</td><td><select name='s_tables_id[]' id='s_tables_id'><option>Select...</option></select></td></tr>";

        // list: Description
        $out.="<tr><td>Description:</td><td><select name='s_tables_description[]' id='s_tables_description'><option>Select...</option></select></td></tr>
            </table>
        </fieldset>";

        return $out;
    }

    private function getList() {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $select=$db->query("SHOW TABLES");
        $res = $select->fetchAll();
        unset($cnf);
        return $res;
    }

    public function toSelect($item) {
        $cnf = Zend_Registry::get('cnf');
        $alias = $cnf->generators->table_alias;
        return array(
            "join"      => "LEFT JOIN {$item["s_tables"]} AS j ON ($alias.{$item["FieldName"]}=j.{$item["s_tables_id"]})",
            "select"    => array (
                    "value" => "j.{$item["s_tables_description"]}",
                    "alias" => "{$item['FieldName']}"
            )
        );
    }

    public function toViewEdit($item) {
        //$cnf = Zend_Registry::get('cnf');
        //$db = Zend_Db::factory($cnf->db);
        //$select=$db->query("SELECT `{$item['s_tables_id']}`, `{$item['s_tables_description']}` FROM `{$item["s_tables"]}` ORDER BY `ID` ASC");
        //$res = $select->fetchAll();
        $html="
            <select name='s_{$item['FieldName']}'>
            <?php foreach(\$this->options_{$item['FieldName']} as \$option): ?>
                <option value='<?php print \$option['{$item['s_tables_id']}']; ?>'><?php print \$option['{$item['s_tables_description']}']; ?></option>
            <?php endforeach; ?>
            </select>";
        return $html;
    }


    public function toModel($item) {
        return "
            public function getOptions_{$item['FieldName']}() {
                \$cnf = Zend_Registry::get('cnf');
                \$db = Zend_Db::factory(\$cnf->db);
                \$select=\$db->query(\"SELECT `{$item['s_tables_id']}`, `{$item['s_tables_description']}` FROM `{$item["s_tables"]}` ORDER BY `ID` ASC\");
                \$res = \$select->fetchAll();
                return \$res;
            }
        ";
    }

    public function toController($item) {
        return "\$this->view->options_{$item['FieldName']}=\$model->getOptions_{$item['FieldName']}();";
    }
}