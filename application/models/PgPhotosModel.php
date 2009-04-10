<?php

class PgPhotosModel {

    public function getTableView() {
        $cnf = Zend_Registry::get('cnf');
        $alias = $cnf->generators->table_alias;
        $db = Zend_Db::factory($cnf->db);
        $select=$db->query("
            SELECT
            				tn.ID AS ID,
				tn.Filename AS Filename,
				tn.Description AS Description,
				FROM_UNIXTIME(tn.Date_creation, '%Y.%m.%d %H:%i') AS Date_creation,
				FROM_UNIXTIME(tn.Date_modification, '%Y.%m.%d %H:%i') AS Date_modification,
				tn.Raiting AS Raiting,
				j.Description AS Gallery_id,
				IF(tn.Hidden=0,'no','yes') AS Hidden,
				IF(tn.Comments=0,'no','yes') AS Comments,
				IF(tn.Tags=0,'no','yes') AS Tags
            FROM pg_photos AS $alias
            			LEFT JOIN pg_galleries AS j ON (tn.Gallery_id=j.ID)

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
            				tn.ID AS ID,
				tn.Filename AS Filename,
				tn.Description AS Description,
				FROM_UNIXTIME(tn.Date_creation, '%Y.%m.%d %H:%i') AS Date_creation,
				FROM_UNIXTIME(tn.Date_modification, '%Y.%m.%d %H:%i') AS Date_modification,
				tn.Raiting AS Raiting,
				j.Description AS Gallery_id,
				IF(tn.Hidden=0,'no','yes') AS Hidden,
				IF(tn.Comments=0,'no','yes') AS Comments,
				IF(tn.Tags=0,'no','yes') AS Tags
            FROM pg_photos AS $alias
            			LEFT JOIN pg_galleries AS j ON (tn.Gallery_id=j.ID)

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
        return ($db->delete("pg_photos","ID='$id'")>0)?true:false;
    }

    












            public function getOptions_Gallery_id() {
                $cnf = Zend_Registry::get('cnf');
                $db = Zend_Db::factory($cnf->db);
                $select=$db->query("SELECT `ID`, `Description` FROM `pg_galleries` ORDER BY `ID` ASC");
                $res = $select->fetchAll();
                return $res;
            }
        









    public function insert($data) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $db->insert("pg_photos",$data);
    }

    public function update($data) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $db->update("pg_photos",$data, "ID={$data['ID']}");
    }
}