<?php

class AdminUrlsModel extends Zend_Db_Table_Abstract
{

    protected $_name = 'admin_urls';

    public addItem($data) {
        $this->insert($data);
    }

}