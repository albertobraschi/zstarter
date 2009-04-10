<?php
# global script

$view->head_title=$view->headTitle('Taryk Blog');

$view->head_script=$view->headScript();

$db = Zend_Db::factory($cnf->db);
$select=$db->query("
    SELECT
        sm.ID AS ID,
        sm.Name AS Name,
        sm.Description AS Description,
        sm.Module AS Module,
        sm.Controller AS Controller,
        IF(sm.Module='default',
            CONCAT(sm.Controller,'/'),
            IF (sm.Controller='index',CONCAT(sm.Module,'/'),CONCAT(sm.Module,'/',sm.Controller,'/'))
        ) AS Link
    FROM
        admin_menu sm
    WHERE
        sm.Hidden=0
    Order
        by ID
");

$main_menu2 = $select->fetchAll();
$main_menu=array();

$session = new Zend_Session_Namespace("Zend_Auth");

if ($session->storage) {
    $select = $db->query("select User_type from admin_users_types where ID=".$session->storage->TypeID);
    $res=$select->fetchAll();
    $user=$res[0]['User_type'];
} else $user="guest";

foreach ($main_menu2 as $item) {
    if ($acl->isAllowed($user, $item['Module'], $item['Controller'])) {
        array_push($main_menu,$item);
    }
}

$view->top="<h2>taryk.info | administration</h2>";

$view->bottom="(c) 2009 taryk.info. All rights reserved.";

$view->baseUrl=$cnf->url->base;

$view->fullurl=$cnf->url->fullurl;

$view->mainmenu=$main_menu;



//$view->layout()->setLayout();