<?php

class Model {

    public function getTableView() {
        $cnf = Zend_Registry::get('cnf');
        $alias = $cnf->generators->table_alias;
        $db = Zend_Db::factory($cnf->db);
        $select=$db->query("
            SELECT
            
            FROM  AS $alias
            
            ORDER BY $alias.ID ASC
        ");
        $res = $select->fetchAll();
        return $res;
    }

    public function getItem($id) {
        $cnf = Zend_Registry::get('cnf');
        $alias = $cnf->generators->table_alias;
        $db = Zend_Db::factory($cnf->db);
        $select=$db->query("
            SELECT
            
            FROM  AS $alias
            
            WHERE tn.ID='$id'
            ORDER BY tn.ID ASC
            LIMIT 1
        ");
        $res = $select->fetchAll();
        $res=$res[0];
        return $res;
    }

    public function delItem($id) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        return ($db->delete("","ID='$id'")>0)?true:false;
    }

    

    public function insert($data) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $db->insert("",$data);
    }

    public function update($data) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $db->update("",$data, "ID={$data['ID']}");
    }
}