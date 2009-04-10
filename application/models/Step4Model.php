<?php

class Step4Model {

    private $moduleName;
    private $tableName;
    private $vars;
    private $code;

    const GEN_CONTROLLER=1;
    const GEN_MODEL=2;
    const GEN_VIEW=3;
    const GEN_CONFIG=4;

    const A_INDEX=1;
    const A_EDIT=2;
    const A_DELETE=3;
    const A_ADD=4;

    public function Step4Model($mn, $tn, $input_vars) {
        $this->moduleName=$mn;
        $this->tableName=$tn;
        $this->vars=$input_vars;
    }

    public function moduleName() {
        $moduleName=$this->moduleName;
        $moduleName=preg_replace("/\_/", " ",$moduleName);
        $moduleName=ucwords($moduleName);
        $moduleName=preg_replace("/\ /", "",$moduleName);
        return $moduleName;
    }

    public function getPrefix($gen_action) {
        switch ($gen_action) {
            case Step4Model::A_INDEX:
                $res = "index";
            break;
            case Step4Model::A_ADD:
                $res ="add";
            break;
            case Step4Model::A_EDIT:
                $res ="edit";
            break;
            case Step4Model::A_DELETE:
                $res = "delete";
            break;
            default:
                $res = "index";
            break;
        }
        return $res;
    }

    public function getSuffix($gen_type) {
        switch($gen_type) {
            case Step4Model::GEN_CONTROLLER:
                $res="controller";
            break;
            case Step4Model::GEN_VIEW:
                $res="view";
            break;
            case Step4Model::GEN_MODEL:
                $res="model";
            break;
            case Step4Model::GEN_CONFIG:
                $res="config";
            break;
        }
        return $res;
    }

    #########################################################################
    # 
    # View Controller
    # indexController
    # 
    #########################################################################
    public function getTemplate($gen_type, $gen_action = NULL) {
        $cnf = Zend_Registry::get('cnf');

        $cont=$this->getPrefix($gen_action);

        switch($gen_type) {
            case Step4Model::GEN_CONTROLLER:
                $gen_template=ucfirst($cont)."Controller.php.gen";
                $this->code=file_get_contents($cnf->path->gen_tpl.$gen_template);
                $gen_code=$this->genController($gen_action);
            break;
            case Step4Model::GEN_VIEW:
                $gen_template="{$cont}_index.tpl.gen";
                $this->code=file_get_contents($cnf->path->gen_tpl.$gen_template);
                $novalue = ($cont=="add")?true:false;
                $gen_code=$this->genView($novalue);
            break;
            case Step4Model::GEN_MODEL:
                $gen_template="Model.php.gen";
                $this->code=file_get_contents($cnf->path->gen_tpl.$gen_template);
                $gen_code=$this->genModel();
            break;
            default:
                $gen_code="";
            break;
        }


        return $gen_code;

    }

    #########################################################################
    #
    # Generate Model
    #
    #########################################################################

    private function genModel() {

        $cnf = Zend_Registry::get('cnf');
        $moduleName=$this->moduleName;
        $tableName=$this->tableName;
        $alias = $cnf->generators->table_alias;
        
        $moduleName=preg_replace("/\_/", " ", $moduleName);
        $moduleName=ucwords($moduleName);
        $moduleName=preg_replace("/\ /", "", $moduleName);
        
        $vars = $this->vars;
        
        $select_e="";
        $select_v="";
        $join="";
        $opt_funcs="";
        foreach($vars as $item) {
            $generator_name = $item["FieldType"];
            require_once($cnf->path->generators.$generator_name.".php");
            eval("\$gen = new $generator_name();");
            //$gen_cnf = $gen->config();

            $res=$gen->toSelect($item);
            $opt_funcs.=$gen->toModel($item)."\n\n";
            foreach ($res as $type => $code) {
                switch ($type) {
                    case 'select':
                        // $select_e.="\t\t\t\t".$this->makeConcat($gen->getEditRow($item,$code['value']))." AS {$code['alias']},\n";
                        $select_v.="\t\t\t\t{$code['value']} AS {$code['alias']},\n";
                        break;
                    case 'join':
                        $join.="\t\t\t$code\n";
                        break;
                }
            }
            unset($gen);
        }

        $select_e=rtrim($select_e,"\n,");
        $select_e=rtrim($select_e,"\n,");
        $select_v=rtrim($select_v,"\n,");
        $select_v=rtrim($select_v,"\n,");

        $where="WHERE $alias.ID='\$id'";
        $order="ORDER BY $alias.ID ASC";

        $gen_model=str_replace('${moduleName}',$moduleName,$this->code);
        $gen_model=str_replace('${select_e}',$select_v,$gen_model);
        $gen_model=str_replace('${select_v}',$select_v,$gen_model);
        $gen_model=str_replace('${tableName}',$tableName,$gen_model);
        $gen_model=str_replace('${join}',$join,$gen_model);
        $gen_model=str_replace('${where}',$where,$gen_model);
        $gen_model=str_replace('${order}',$order,$gen_model);
        $gen_model=str_replace('{$options}',$opt_funcs,$gen_model);
        //$gen_model=str_replace('${item}', $this->arrayToString($item), $gen_model);

        return $gen_model;
    
    }

    #########################################################################
    #
    # Generate Controller
    #
    #########################################################################

    private function genController($gen_action) {
        $cnf = Zend_Registry::get('cnf');
        $moduleName=$this->moduleName;
        $moduleName=preg_replace("/\_/", " ", $moduleName);
        $moduleName=ucwords($moduleName);
        $moduleName=preg_replace("/\ /", "", $moduleName);

        $gen_controller=str_replace('${moduleName}',$moduleName,$this->code);

        $opt_funcs="";
        $data_posts="";
        foreach($this->vars as $item) {

            $generator_name = $item["FieldType"];
            require_once($cnf->path->generators.$generator_name.".php");
            eval("\$gen = new $generator_name(); \$gen_cnf = $generator_name::\$cnf;");

            $opt_funcs.=$gen->toController($item)."\n\n";

            switch ($gen_action) {
                case Step4Model::A_INDEX:
                    
                break;
                case Step4Model::A_ADD:
                case Step4Model::A_EDIT:
                    //$data_posts.="\t\t\t\$data['{$item["FieldName"]}']=";
                    if ($item["FieldType"]=="checkbox") {
                       $data_posts.="\t\t\t\$data['{$item["FieldName"]}']=(\$this->_request->getPost('s_{$item["FieldName"]}')=='on')?'1':'0';\n";
                    } else {
                        if (isset($gen_cnf['post_addedit'])) {
                            foreach ($gen_cnf['post_addedit'] as $item) {
                                $data_posts.="\t\t\t\${$item} = \$this->_request->getPost('s_{$item["FieldName"]}_{$item}');\n";
                            }
                            foreach ($gen_cnf['post_addedit'] as &$item) { $item='$'.$item; }
                            $gen_cnf['union']=str_replace("<vars>",implode(",",$gen_cnf['post_addedit']),$gen_cnf['union']);
                            $data_posts.="\t\t\t\$data['{$item["FieldName"]}']=".$gen_cnf['union'].";";
                        } else {
                            $data_posts.="\t\t\t\$data['{$item["FieldName"]}']=\$this->_request->getPost('s_{$item["FieldName"]}');\n";
                        }
                    }
                break;
                case Step4Model::A_DELETE:
                    
                break;
                default:
                    
                break;
            }

        }

        $gen_controller=str_replace('{$opt_funcs}',$opt_funcs,$gen_controller);
        $gen_controller=str_replace('{$data_posts}',$data_posts,$gen_controller);
        return $gen_controller;
    }

    #########################################################################
    #
    # Generate View
    # 
    #########################################################################

    private function genView($novalue = false) {
        $cnf = Zend_Registry::get('cnf');

        $moduleName=$this->moduleName;
        $moduleName=preg_replace("/\_/", " ", $moduleName);
        $moduleName=ucwords($moduleName);
        $moduleName=preg_replace("/\ /", "", $moduleName);
        $gen_view=str_replace('${moduleName}',$moduleName,$this->code);

        $fields="";
        $vars=$this->vars;
        foreach($vars as $item) {

            $generator_name = $item["FieldType"];

            require_once($cnf->path->generators.$generator_name.".php");

            eval("\$gen = new $generator_name();");

            $res=$gen->toSelect($item);

            $f=$gen->toViewEdit($item);
            $replace=$novalue?"":"<?php print \$item['{$item['FieldName']}'] ?>";
            $f=str_replace('{$value}',$replace,$f);
            unset($gen);
            if ($novalue && $item['FieldName']=='ID') continue;
            $fields.="<tr><td class=\"meta\">{$item['FieldName']}</td><td>$f</td></tr>\n";
        }

        $gen_view=str_replace('{$fields}',$fields,$gen_view);

        return $gen_view;
    }

    private function arrayToString($arr) {
        $res="";
        foreach ($arr as $key => $value) {
            $res.=" '$key' => '$value', ";
        }
    }

    private function makeConcat($input) {
        if (eregi("\|\|",$input)) {
            $a=explode("||",$input);
            $a[0]=addslashes($a[0]);
            $a[2]=addslashes($a[2]);
            $res="CONCAT('{$a[0]}',{$a[1]},'{$a[2]}')";
        } else {
            $input=addslashes($input);
            $res="'$input'";
        }
        return $res;
    }
}
