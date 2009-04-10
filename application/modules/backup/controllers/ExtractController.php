<?php

/**
 * Backup_MakeController
 *
 * @author Taryk DarkStyler
 */
class Backup_ExtractController extends AuthControllerAction {

    public function indexAction() {
        $cnf = Zend_Registry::get('cnf');
        $this->initCSS();
        $model = new BackupModel();
        $this->view->backups=$model->listBackups();
        $this->view->formaction=$cnf->url->fullurl."backup/extract/processed/";
    }

    public function processedAction() {
        $cnf = Zend_Registry::get('cnf');
        $backup=$this->_request->getPost('s_backups');
        if (isset($backup)) {
            $backup=array_flip($backup);
            $backup=$backup['on'];
            $file=realpath($cnf->path->backups.$backup);
            $cmd="tar jxf $file --overwrite -C ".realpath($cnf->path->root."../")."/";
            system($cmd);


            $this->sendMessage("site files has been updated from archive '$file'<br/>$cmd", "backup", $cnf->url->fullurl."backup/extract/");
        }
    }

}
