<?php

$acl = new Zend_Acl();

$cnf = Zend_Registry::get('cnf');
$db = Zend_Db::factory($cnf->db);

// ------------------------------------------------------------------------------------------
// Roles
// ------------------------------------------------------------------------------------------

$select = $db->query("
    SELECT
        ut.User_type AS UserType,
        IF(ut.Parent=0,NULL,(SELECT ut_s.User_type FROM admin_users_types ut_s WHERE ut_s.ID=ut.Parent)) AS Parent
    FROM
        admin_users_types ut
");

$roles = $select->fetchAll();

foreach ($roles as $role) {
    $acl->addRole(new Zend_Acl_Role($role["UserType"]), $role["Parent"]);
}

// ------------------------------------------------------------------------------------------
// Resources
// ------------------------------------------------------------------------------------------

$select2 = $db->query("
    SELECT
        am.Module AS Resource
    FROM
        admin_menu am
    GROUP BY
        am.Module
");

$resources = $select2->fetchAll();

//$resources=array_unique($resources);

//var_dump($resources);

foreach($resources as $resource) {
    $acl->add(new Zend_Acl_Resource($resource["Resource"]));
}

// ------------------------------------------------------------------------------------------
// Acl
// ------------------------------------------------------------------------------------------

$select3 = $db->query("
    SELECT
        acl.Allow AS Allow,
        ut.User_type AS UserType,
        acl.Module AS Module,
        acl.Controller AS Controller,
        acl.Action AS Action
    FROM
        admin_users_acl acl
    LEFT JOIN admin_users_types ut ON acl.TypeID=ut.ID
    WHERE
        acl.Enabled=1
");

$rights = $select3->fetchAll();

foreach($rights as $right) {
    if ($right["Allow"]=="1") {
        $acl->allow($right["UserType"],$right["Module"],$right["Controller"],$right["Action"]);
    } else {
        $acl->deny($right["UserType"],$right["Module"],$right["Controller"],$right["Action"]);
    }
}

