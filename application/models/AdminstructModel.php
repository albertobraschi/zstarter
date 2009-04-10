<?php

class AdminstructModel extends Zend_Db_Table_Abstract 
{
    protected $_name = 'site_menu';

    public function getSiteStructure() {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $select=$db->query("
            SELECT
                sm.ID AS ID,
                sm_t.Path AS Path,
                sm.Name AS Name,
                sm.Description AS Description,
                sm.Alias AS Alias,
                FROM_UNIXTIME(sm.Date_creation,'%Y.%m.%d %H:%i') AS Date_c,
                FROM_UNIXTIME(sm.Date_modification,'%Y.%m.%d %H:%i') AS Date_m,
                if(sm.Content_id=0,'No',sm.Content_id) AS Content,
                sm.Template AS Template,
                sm.Controller AS Controller,
                if(sm.Hidden=0,'No','Yes') AS Hidden,
                sm.Regen AS Regen
            FROM
                admin_menu sm,
                admin_menu_tree_mp sm_t
            WHERE
                sm.ID=sm_t.ID
            ORDER
                BY sm_t.Path ASC
        ");
        $res = $select->fetchAll();
        return $res;
    }

    public function getModules() {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $select=$db->query("
            SELECT
                sm.ID AS ID,
                sm_t.Path AS Path,
                sm.Name AS Name,
                sm.Description AS Description,
                sm.Alias AS Alias,
                FROM_UNIXTIME(sm.Date_creation,'%Y.%m.%d %H:%i') AS Date_c,
                FROM_UNIXTIME(sm.Date_modification,'%Y.%m.%d %H:%i') AS Date_m,
                if(sm.Hidden=0,'No','Yes') AS Hidden,
                sm.Regen AS Regen
            FROM
                admin_menu sm,
                admin_menu_tree_mp sm_t
            WHERE
                sm.ID=sm_t.ID AND
                sm.Controller='index'
            ORDER
                BY sm_t.Path ASC
        ");
        $res = $select->fetchAll();
        return $res;
    }

    public function getItem($id) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $select=$db->query("
            SELECT
                sm.ID AS ID,
                sm_t.Path AS Path,
                sm.Name AS Name,
                sm.Description AS Description,
                sm.Alias AS Alias,
                FROM_UNIXTIME(sm.Date_creation,'%Y.%m.%d %H:%i') AS Date_c,
                FROM_UNIXTIME(sm.Date_modification,'%Y.%m.%d %H:%i') AS Date_m,
                if(sm.Content_id=0,'No',sm.Content_id) AS Content,
                sm.Template AS Template,
                sm.Controller AS Controller,
                if(sm.Hidden=0,'No','Yes') AS Hidden
            FROM
                admin_menu sm,
                admin_menu_tree_mp sm_t
            WHERE   
                sm.ID=sm_t.ID AND
                sm.ID='$id'
            ORDER
                BY sm_t.Path ASC
            LIMIT 1
        ");
        $res = $select->fetchAll();
        return $res;
    }

    public function update($data) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $db->update("admin_menu",$data,"ID='{$data['ID']}'");
    }

    public function insert($data) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $db->insert("admin_menu",$data);
    }

    public function getTables() {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $select=$db->query("SHOW TABLES");
        $res = $select->fetchAll();
        return $res;
    }

    public function getColumns($tablename) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $types=$this->getColsTypes();
        $select=$db->query("SHOW COLUMNS FROM `$tablename`");
        $res = $select->fetchAll();
        foreach ($res as &$r) {
            preg_match('/^([a-z]+)\ *\(?([0-9]+)?\)?\ *([a-z]*)?$/',$r['Type'], $t);
            $r['Type']=$t[1];
            $r['Length']=$t[2];
            $r['Signed']=$t[3];
            $r['Types']=$types;
            $r['Null']=($r['Null']=='YES'?true:false);
            $r['Key']=($r['Key']=='PRI'?true:false);
            $r['Default']=($r['Default']!="NULL"?$r['Default']:false);
        }
        return $res;
    }

    public function getColsTypes() {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $select = $db->query("
            SELECT
                act.`ID` AS 'ID',
                act.`TypeName` AS 'TypeName',
                acr.`RegExp` AS 'RegExp'
            FROM
                `admin_cols_types` act,
                `admin_cols_regexp` acr
            WHERE
                acr.`ColsType_id` = act.`ID` AND
                act.`Enabled` = 1 AND
                acr.`Enabled` = 1
        ");
        $res = $select->fetchAll();
        return $res;
    }

    public function getAdminValiadtors() {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $select = $db->query("SELECT `ID`, `ValidatorName`, `RegExp` FROM `admin_validators` WHERE `Enabled`=1");
        $res = $select->fetchAll();
        return $res;
    }

    public function deleteModule($id) {
        if (isset($id)) {
            $module=$this->deleteModuleRow($id);
            return $this->deleteModuleFiles($module);
        } else return false;
    }

    private function deleteModuleFiles($module) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);

        $module_path=$cnf->path->modules.$module;

        if (is_dir($module_path)) {
            $this->RmDirR($module_path);
            $module_file=preg_replace("/\_/", " ", $module);
            $module_file=ucwords($module_file);
            $module_file=preg_replace("/\ /", "", $module_file);
            $module_file=$cnf->path->models."{$module_file}Model.php";
            if (file_exists($module_file)) {
                if (unlink($module_file)) {
                      return true;
                }
            } else {
                return $module_file;
            }
        } else {
            return false;
        }
    }

    private function deleteModuleRow($id) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $select = $db->query("SELECT `Module` FROM `admin_menu` WHERE `ID`='$id'");
        $module=$select->fetchAll();
        $module=$module[0]['Module'];
        if (!empty($module)) {
            $db->query("DELETE FROM `admin_urls` WHERE `Menu_id` IN (SELECT `ID` FROM `admin_menu` WHERE `Module`='$module')");
            $db->query("DELETE FROM `admin_menu_tree_mp` WHERE `ID` IN (SELECT `ID` FROM `admin_menu` WHERE `Module`='$module')");
            $db->query("DELETE FROM `admin_menu` WHERE `Module`='$module'");
            $db->query("DELETE FROM `admin_users_acl` WHERE `Module`='$module'");
        }
        return $module;
    }

    private function RmDirR($path) {
        $handle = opendir($path);
        while(false !== ($file = readdir($handle))) {
            if ($file != '.' and $file != "..") {
                $fullpath = $path.'/'.$file;
                if (is_dir($fullpath)) {
                    $this->RmDirR($fullpath);
                } else {
                    @unlink($fullpath) or die("permissions denine on delete: ".$path."<br/>");
                }
            }
        }
        closedir($handle);
        @rmdir($path) or die("permissions denine on delete: ".$path."<br/>");
    }

    public function delItem($id) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        if (is_int($id)) {
            $db->query("DELETE FROM `admin_menu` WHERE `ID`='$id'");
            $db->query("DELETE FROM `admin_menu_tree_mp` WHERE `ID`='$id'");
            $db->query("DELETE FROM `admin_urls` WHERE `Menu_id`='$id'");
            return true;
        } else return false;
    }

    public function getModuleName($id) {
        if (!empty($id)) {
            $cnf = Zend_Registry::get('cnf');
            $db = Zend_Db::factory($cnf->db);
            $select=$db->query("SELECT `Module` FROM `admin_menu` WHERE `ID`='$id' LIMIT 1");
            $res = $select->fetchAll();
            return $res[0]['Module'];
        } else return "default";
    }
}
