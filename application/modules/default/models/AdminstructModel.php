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
                if(sm.Hidden=0,'No','Yes') AS Hidden
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

    public function remItem($id) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $select = $db->query("DELETE FROM admin_menu, admin_menu_tree_mp WHERE ID='$id'");
        
    }

    public function updateItem($vars = array()) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $update='';
        foreach($vars as $key => $value) {
            $update+=((length($update)>0)?",":"")+"\`$key\`=\'$value\'";
        }
        $db->query("UPDATE admin_menu SET $update WHERE `ID`='$id");
    }

    public function addItem($vars = array()) {
        $cnf = Zend_Registry::get('cnf');
        $db = Zend_Db::factory($cnf->db);
        $cols="";
        $values="";
        foreach($vars as $key => $value) {
            $coma=(length($cols)>0)?",":"";
            $cols+=$coma+"`$key\`";
            $values+=$coma+"\'$value\'";
        }
        $db->query("INSERT admin_menu ($cols) VALUES ($values)");
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
        $select = $db->query("SELECT `ID`, `TypeName` FROM `admin_cols_types` WHERE `Enabled`=1");
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

    public function getTemplateController($moduleName) {
        $php_controller="
class ${moduleName}Controller extends Zend_Controller_Action {

    public function indexAction() {
        \$model = new ${moduleName}Model();
        \$this->view->site_structure = \$model->getSiteStructure();
        \$this->view->css2=true;
        \$this->view->controller=\$this->_request->controller;
        \$this->view->action=\$this->_request->action;
    }

    public function addAction() {
        \$this->view->css2=true;
        \$this->view->controller=\$this->_request->controller;
        \$this->view->action=\$this->_request->action;
    }

    public function insertAction() {
        \$model = new ${moduleName}Model();
        \$this->view->name=\$this->_request->getParam('f_name');
    }

    public function editAction() {
        \$model = new ${moduleName}Model();
        \$this->view->item=\$model->getItem(\$this->_request->getParam('id'));
        \$this->view->css2=true;
        \$this->view->controller=\$this->_request->controller;
        \$this->view->action=\$this->_request->action;
    }

    public function deleteAction() {
        
    }

}";
        return $php_controller;
    }

    public function getTemplateModel($moduleName) {
        $php_model="
class ${moduleName}Model extends Zend_Db_Table_Abstract 
{
    protected \$_name = 'site_menu';

    public funcion 

}";
        return $php_model;
    }
    
    public function getTemplateView($moduleName) {
        $php_view="
<h3>AdminStrunct</h3>

<table border=\"0\" cellspacing=\"0\" cellspadding=\"0\">
<thead>
<tr>
<?php foreach (\$this->site_structure[0] as \$key => \$value): ?>
<th><?php echo \$key; ?></th>
<?php endforeach; ?>
<th>&nbsp;</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php foreach (\$this->site_structure as \$item): ?>
<tr>
<td><?php echo \$item[\"ID\"]; ?></td>
<td><?php echo \$item[\"Path\"]; ?></td>
<td><?php echo \$item[\"Name\"]; ?></td>
<td><?php echo \$item[\"Description\"]; ?></td>
<td><?php echo \$item[\"Alias\"]; ?></td>
<td><?php echo \$item[\"Date_c\"]; ?>&nbsp;</td>
<td><?php echo \$item[\"Date_m\"]; ?>&nbsp;</td>
<td><?php echo \$item[\"Content\"]; ?></td>
<td><?php echo \$item[\"Template\"]; ?></td>
<td><?php echo \$item[\"Controller\"]; ?></td>
<td><?php echo \$item[\"Hidden\"]; ?></td>
<td>[&nbsp;<a href=\"edit/<?php echo \$item[\"ID\"]; ?>\"/>EDIT</a>&nbsp;]</td>
<td>[&nbsp;<a href=\"delete/<?php echo \$item[\"ID\"]; ?>\"/>DELETE</a>&nbsp;]</td>
</tr>
<?php endforeach; ?>
</tbody>
</table><br/><br/>
";
        return $php_view;
    }

    public function getTemplateEdit($moduleName) {
        $php_edit="
<?php \$item=\$this->item[0]; ?>
<h3>Edit item \"<?php print \$item[\'Name\'] ?>\"</h3>
<form action=\"<?php print \"../\".\$this->controller.\"/update/\"; ?>\" method=\"post\">
<table border=\"0\" cellspacing=\"0\" cellspading=\"0\">
<tr><td class=\"meta\">ID</td><td><input type=\"hidden\" name=\"f_id\" value=\"<?php print \$item[\'ID\']; ?>\"/><?php print \$item[\'ID\']; ?></td></tr>
<tr><td class=\"meta\">Path</td><td><input name=\"f_path\" value=\"<?php print \$item[\'Path\'] ?>\"/></td></tr>
<tr><td class=\"meta\">Name</td><td><input name=\"f_name\" value=\"<?php print \$item[\'Name\'] ?>\"/></td></tr>
<tr><td class=\"meta\">Description</td><td><input name=\"f_description\" value=\"<?php print \$item[\'Description\'] ?>\"/></td></tr>
<tr><td class=\"meta\">Alias</td><td><input name=\"f_alias\" value=\"<?php print \$item[\'Alias\'] ?>\"/></td></tr>
<tr><td class=\"meta\">Date creation</td><td><input name=\"f_date_c\" value=\"<?php print \$item[\'Date_c\'] ?>\"/></td></tr>
<tr><td class=\"meta\">Date modification</td><td><input name=\"f_date_m\" value=\"<?php print \$item[\'Date_m\'] ?>\"/></td></tr>
<tr><td class=\"meta\">Content</td><td><input name=\"f_content\" value=\"<?php print \$item[\'Content\'] ?>\"/></td></tr>
<tr><td class=\"meta\">Template</td><td><input name=\"f_template\" value=\"<?php print \$item[\'Template\'] ?>\"/></td></tr>
<tr><td class=\"meta\">Controller</td><td><input name=\"f_controller\" value=\"<?php print \$item[\'Controller\'] ?>\"/></td></tr>
<tr><td class=\"meta\">Hidden</td><td><input name=\"f_hidden\" value=\"<?php print \$item[\'Hidden\'] ?>\"/></td></tr>
<tr><td></td><td><br/><input type=\"submit\" name=\"f_save\" value=\"Save\"/><input type=\"button\" name=\"f_delete\" value=\"Delete\"/></td></tr>
</form>
</table>
";
        return $php_edit;
    }

}
