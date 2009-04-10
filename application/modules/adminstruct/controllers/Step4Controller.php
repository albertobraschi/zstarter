<?php

/**
 * Adminstruct_IndexController
 *
 * @author Taryk DarkStyler
 */
class Adminstruct_Step4Controller extends AuthControllerAction {

    private $modulename;
    private $tablename;
    private $model;

    public function indexAction() {
        $cnf = Zend_Registry::get('cnf');
        $re="";

        if (isset($this->_session->s3data)) {
            $this->modulename = $this->_session->modulename;
            $this->tablename  = $this->_session->s3data['tablename'];
            $s3data = $this->_session->s3data;
            unset($this->_session->modulename);
            unset($this->_session->s3data);
            unset($s3data['tablename']);
            $nodb=true;
            $re="re";
        } else {
            $this->modulename = $this->classname($this->_request->getParam('tablename'));
            $this->tablename  = $this->_request->getParam('tablename');
            $s3data = $this->getData();
            $nodb=false;
        }
        $this->view->step3_data=$s3data;

        $this->model = new Step4Model($this->modulename, $this->tablename, $s3data);

        ############ Controllers
        $this->makeFile(Step4Model::GEN_CONTROLLER, Step4Model::A_INDEX)
             ->makeFile(Step4Model::GEN_CONTROLLER, Step4Model::A_ADD)
             ->makeFile(Step4Model::GEN_CONTROLLER, Step4Model::A_EDIT)
             ->makeFile(Step4Model::GEN_CONTROLLER, Step4Model::A_DELETE);

        ############ Models
        $this->makeFile(Step4Model::GEN_MODEL);

        ############ Views
        $this->makeFile(Step4Model::GEN_VIEW, Step4Model::A_INDEX)
             ->makeFile(Step4Model::GEN_VIEW, Step4Model::A_ADD)
             ->makeFile(Step4Model::GEN_VIEW, Step4Model::A_EDIT)
             ->makeFile(Step4Model::GEN_VIEW, Step4Model::A_DELETE);

        ############ Config
        $this->makeFile(Step4Model::GEN_CONFIG);

        if (!$nodb) {
            $this->addMenuItemIndex();
            $this->addMenuItemAdd();
            $this->addMenuItemEdit();
            $this->addMenuItemDelete();
        }

        //var_dump($s3data);

        $this->sendMessage("Module '<a href='{$cnf->url->fullurl}{$this->modulename}/'>{$this->modulename}</a>' has been {$re}generated successfully.", "add", $cnf->url->fullurl."adminstruct/");

    }

    private function getVarsTable() {
        $cnf = Zend_Registry::get('cnf');
        $table = array();

        $row_types=$this->_request->getParam('row_type');

        foreach ($row_types as $generator_name) {

            require_once($cnf->path->generators.$generator_name.".php");

            eval("\$gen = new $generator_name(); \$gen_cnf = $generator_name::\$cnf;");

            $table[$generator_name]["index"]=0;

            foreach($gen_cnf["post"] as $param) {
                $table[$generator_name][$param]=$this->_request->getParam($param);
            }
            unset($gen);
        }
        return $table;
    }

    private function getData() {
        $cnf = Zend_Registry::get('cnf');
        $step3_data = array();

        $row_types=$this->_request->getParam('row_type');

        $table = $this->getVarsTable($row_types);

        $fieldname=$this->_request->getParam('fieldname');

        for ($i=0;$i<count($row_types); $i++) {

            $generator_name=$row_types[$i];

            $input = array(
                "FieldName" => $fieldname[$i],
                "FieldType" => $generator_name
            );
            
            $input_add = array();

            require_once($cnf->path->generators.$generator_name.".php");
            eval("\$gen = new $generator_name(); \$gen_cnf = $generator_name::\$cnf;");

            $ind=$table[$generator_name]["index"];
            $input_add=array();
            foreach($gen_cnf["post"] as $param) {
                $input_add[$param]=$table[$generator_name][$param][$ind];
            }
            $table[$generator_name]["index"]++;

            $input = array_merge($input,$input_add);
            $step3_data[$i] = $input;
            unset($gen);
        }
        return $step3_data;
    }

    private function makeFile($gen_type, $gen_action = NULL) {
        $cnf = Zend_Registry::get('cnf');
        $action=$this->model->getPrefix($gen_action);
        $type=$this->model->getSuffix($gen_type);
        $dirname=$cnf->path->modules.$this->modulename."/{$type}s/";

        $template=$this->model->getTemplate($gen_type, $gen_action);

        switch ($gen_type) {
            case Step4Model::GEN_CONTROLLER:
                $filename=$cnf->path->modules.$this->modulename."/controllers/".ucfirst($action)."Controller.php";
            break;
            case Step4Model::GEN_MODEL:
                $filename=$cnf->path->models.$this->modulename."Model.php";
            break;
            case Step4Model::GEN_VIEW:
                $dirname.="/scripts/{$action}/";
                $filename=$cnf->path->modules.$this->modulename."/views/scripts/{$action}/index.tpl";
            break;
            case Step4Model::GEN_CONFIG:
                $filename=$cnf->path->modules.$this->modulename."/config.php";
            break;
        }
        if (!is_dir($dirname)) {
            mkdir($dirname,0777,true);
        }
        if ($gen_type!=Step4Model::GEN_CONFIG) {
            $file=fopen($filename,"w+") or die ("Failed on create $filename");
            fwrite($file,$template);
            fclose($file);
        } else {
            $c = new Zend_Config($this->view->step3_data, true);
            $c->tablename=$this->tablename;
            $config = new Zend_Config_Writer_Array(array(
                'config' => $c,
                'filename' => $filename
            ));
            $config->write();
        }
        return $this;
    }

    private function classname($str) {
        $str=preg_replace("/\_/", " ",$str);
        $str=ucwords($str);
        $str=preg_replace("/\ /", "",$str);
        return $str;
    }

    private function addMenuItemIndex() {
        $insert_data = array(
            "Name"              => $this->modulename,
            "Description"       => $this->modulename,
            "Alias"             => strtolower($this->modulename),
            "Date_creation"     => new Zend_Db_Expr("UNIX_TIMESTAMP(CURRENT_TIMESTAMP())"),
            "Date_modification" => new Zend_Db_Expr("UNIX_TIMESTAMP(CURRENT_TIMESTAMP())"),
            "Content_id"        => "0",
            "Template"          => "index",
            "Module"            => $this->modulename,
            "Controller"        => "index",
            "Hidden"            => 0,
        );

        $model2 = new AdminMenuModel();
        $model2->addMenuItem($insert_data);
        unset($model2);
    }

    private function addMenuItemAdd() {
        $insert_data = array(
            "Name"              => "{$this->modulename} Add",
            "Description"       => "{$this->modulename} Add Item",
            "Alias"             => "add",
            "Date_creation"     => new Zend_Db_Expr("UNIX_TIMESTAMP(CURRENT_TIMESTAMP())"),
            "Date_modification" => new Zend_Db_Expr("UNIX_TIMESTAMP(CURRENT_TIMESTAMP())"),
            "Content_id"        => "0",
            "Template"          => "index",
            "Module"            => $this->modulename,
            "Controller"        => "add",
            "Hidden"            => 0,
        );

        $model2 = new AdminMenuModel();
        $model2->addMenuItem($insert_data);
        unset($model2);
    }

    private function addMenuItemEdit() {
        $insert_data = array(
            "Name"              => "{$this->modulename} Edit",
            "Description"       => "{$this->modulename} Edit Item",
            "Alias"             => "edit",
            "Date_creation"     => new Zend_Db_Expr("UNIX_TIMESTAMP(CURRENT_TIMESTAMP())"),
            "Date_modification" => new Zend_Db_Expr("UNIX_TIMESTAMP(CURRENT_TIMESTAMP())"),
            "Content_id"        => "0",
            "Template"          => "index",
            "Module"            => $this->modulename,
            "Controller"        => "edit",
            "Hidden"            => 0,
        );

        $model2 = new AdminMenuModel();
        $model2->addMenuItem($insert_data);
        unset($model2);
    }

    private function addMenuItemDelete() {
        $insert_data = array(
            "Name"              => "{$this->modulename} Delete",
            "Description"       => "{$this->modulename} Delete Item",
            "Alias"             => "delete",
            "Date_creation"     => new Zend_Db_Expr("UNIX_TIMESTAMP(CURRENT_TIMESTAMP())"),
            "Date_modification" => new Zend_Db_Expr("UNIX_TIMESTAMP(CURRENT_TIMESTAMP())"),
            "Content_id"        => "0",
            "Template"          => "index",
            "Module"            => $this->modulename,
            "Controller"        => "delete",
            "Hidden"            => 0,
        );

        $model2 = new AdminMenuModel();
        $model2->addMenuItem($insert_data);
        unset($model2);
    }

}
