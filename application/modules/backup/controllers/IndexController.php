<?php

/**
 * Backup_IndexController
 *
 * @author Taryk DarkStyler
 */
class Backup_IndexController extends AuthControllerAction {

    public function indexAction() {
        $cnf = Zend_Registry::get('cnf');
        $this->initCSS();
        $this->view->formaction=$cnf->url->fullurl."backup/make/";
        $model = new BackupModel();
        $this->view->backupname=$model->makeBackupName();
        $this->view->mysqldump=$model->makeMysqlDumpName();
        $this->view->files=$model->getRootDir();
    }

}
