<?php

class BackupModel {

    public function makeBackupName() {
        $res="backup_taryk_".date("Y_m_d__H_i_s");
        return $res;
    }

    public function makeBackup($filename, $files) {
        $cnf = Zend_Registry::get('cnf');
        //array_walk($files, 'addslashes');
        $afname=realpath($cnf->path->backups)."/$filename.tar.bz2";
        $adname="";
        foreach($files as $file) {
            $adname.="\"".$cnf->path->root."../$file\" ";
        }
        //$files=implode(" ", $files);
        $tar = "tar jcf $afname $adname";
        system($tar);
        //$bz2 = "bzip2 -9 $afname";
        //system($bz2);
        return $filename.".tar.bz2";
        //return $tar;
    }

    public function listBackups() {
        $cnf = Zend_Registry::get('cnf');
        $h=opendir($cnf->path->backups);
        $res=array();
        while (($file = readdir($h)) !== false) {
            if ($file == "." or $file == "..") continue;
            array_push($res,array(
                "filename" => $file,
                "filesize" => round(filesize($cnf->path->backups.$file)/(1024*1024),2))
            );
        }
        return $res;
    }

    public function makeMysqlDumpName() {
        $res="mysql_dump_taryk_".date("Y_m_d__H_i_s");
        return $res;
    }

    public function getRootDir() {
        $cnf = Zend_Registry::get('cnf');
        $h=opendir($cnf->path->root."../");
        $res_f=array();
        $res_d=array();
        while (($file = readdir($h)) !== false) {
            if ($file == "..") continue;
            $fullpath=$cnf->path->root."../".$file;
            $checked=preg_match("/backup|libs|(\.|\~)$/i",$file)? "" : "checked";
            if (is_dir($fullpath)) {
                $res=&$res_d;
                $file.="/";
            } else $res=&$res_f;
            $size=explode("\t",exec("du -hs ".$fullpath));
            array_push($res,array(
                "filename" => $file,
                //"filesize" => round(filesize($fullpath)/1024,2))
                "filesize" => $size[0],
                "checked" => $checked
            ));
        }
        sort($res_d);
        sort($res_f);
        return array_merge($res_d,$res_f);
    }

    function makeMySQLdump($dumpname) {
        $cnf = Zend_Registry::get('cnf');
        $cmd="mysqldump -u taryk --password=taryk --disable-keys=FALSE --lock-all-tables=FALSE --lock-tables=FALSE taryk > ".$cnf->path->dumps.$dumpname;
        system($cmd);
        return $cmd;
    }
}