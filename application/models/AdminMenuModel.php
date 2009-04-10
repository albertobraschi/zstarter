<?php

class AdminMenuModel {

    public function addMenuItem($data) {

        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);

        $db->insert("admin_menu",$data);

        $db->query("SELECT @next_path:=`Path`+1 FROM `admin_menu_tree_mp` WHERE LENGTH(`Path`)=1 ORDER BY `Path` DESC LIMIT 1");
        $db->query("SELECT @last_ins_id:=`ID` FROM `admin_menu` ORDER BY `ID` DESC LIMIT 1");

        $db->insert("admin_menu_tree_mp", array(
            "ID"    => new Zend_Db_Expr("@last_ins_id"),
            "Path"  => new Zend_Db_Expr("@next_path")
        ));

        switch ($data['Controller']) {
            case "edit":
            case "delete":
                $db->insert("admin_urls", array(
                    "Name"          => strtolower($data['Module']."_".$data['Controller']),
                    "Controller"    => strtolower($data['Controller']),
                    "Action"        => "index",
                    "Menu_id"       => new Zend_Db_Expr("@last_ins_id"),
                    "URL_regexp"    => "([0-9]+)\/?",
                    "URL_vars"      => "id,1"
                ));
                break;
            case "index":
                $db->insert("admin_users_acl", array(
                    "Allow"       => "1",
                    "TypeID"      => "2",
                    "Module"      => $data["Module"],
                    "Controller"  => NULL,
                    "Action"      => NULL,
                    "Enabled"     => "1"
                ));
                break;
        }
    }

}