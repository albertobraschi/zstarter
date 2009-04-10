<?php

class PgGalleriesModel {

    public function getTableView() {
        $cnf = Zend_Registry::get('cnf');
        $alias = $cnf->generators->table_alias;
        $db = Zend_Db::factory($cnf->db);
        $select=$db->query("
            SELECT
            				tn.ID AS ID,
				tn.Name AS Name,
				tn.Alias AS Alias,
				FROM_UNIXTIME(tn.Date_creation, '%Y.%m.%d %H:%i') AS Date_creation,
				FROM_UNIXTIME(tn.Date_modification, '%Y.%m.%d %H:%i') AS Date_modification,
				tn.Description AS Description,
				j.Description AS DefaultPhotoID,
				tn.Raiting AS Raiting,
				IF(tn.Hidden=0,'no','yes') AS Hidden
            FROM pg_galleries AS $alias
            			LEFT JOIN pg_photos AS j ON (tn.DefaultPhotoID=j.ID)

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
				tn.Name AS Name,
				tn.Alias AS Alias,
				FROM_UNIXTIME(tn.Date_creation, '%Y.%m.%d %H:%i') AS Date_creation,
				FROM_UNIXTIME(tn.Date_modification, '%Y.%m.%d %H:%i') AS Date_modification,
				tn.Description AS Description,
				j.Description AS DefaultPhotoID,
				tn.Raiting AS Raiting,
				IF(tn.Hidden=0,'no','yes') AS Hidden
            FROM pg_galleries AS $alias
            			LEFT JOIN pg_photos AS j ON (tn.DefaultPhotoID=j.ID)

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
        return ($db->delete("pg_galleries","ID='$id'")>0)?true:false;
    }

    












            public function getOptions_DefaultPhotoID() {
                $cnf = Zend_Registry::get('cnf');
                $db = Zend_Db::factory($cnf->db);
                $select=$db->query("SELECT `ID`, `Description` FROM `pg_photos` ORDER BY `ID` ASC");
                $res = $select->fetchAll();
                return $res;
            }
        







    public function insert($data) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $db->insert("pg_galleries",$data);
    }

    public function update($data) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $db->update("pg_galleries",$data, "ID={$data['ID']}");
    }
}