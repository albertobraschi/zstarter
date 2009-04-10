<?php

class AdminColsTypesModel extends Zend_Db_Table_Abstract 
{
    protected $_name = 'admin_cols_types';

    public function getName($id) {
        $select = $this->select()
                       ->from(
                            array("act"=>$this->_name),
                            array("TypeName")
                        )
                       ->where("ID = ?",$id)
                       ->limit(1);
        $res=$this->fetchAll($select);
        return $res->toArray();
    }

}
