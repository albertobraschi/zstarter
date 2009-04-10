<?php

/**
 * Backup_MakeController
 *
 * @author Taryk DarkStyler
 */
class Backup_MakeController extends AuthControllerAction {

    public function indexAction() {
        $cnf = Zend_Registry::get('cnf');
        $this->initCSS();
        $model = new BackupModel();
        $f = $this->_request->getPost('f_backup_submit');
        if (!empty($f)) {
            $mysqldump=$this->_request->getPost('s_mysql_backup');
            if (isset($mysqldump)) {
                $dumpname=$this->_request->getPost('s_mysql_dump_name');
                $model->makeMySQLdump($dumpname)."<br/><br/>";
            }
            $files=array_keys($this->_request->getPost('s_files'));
            $var.=$model->makeBackup($this->_request->getPost('s_backupname'),$files);
            $this->sendMessage("site backuped successfully: $var", "backup", $cnf->url->fullurl."backup/");
        } else {
            $this->sendMessage("filename required", "backup", $cnf->url->fullurl."backup/");
        }
    }

}
