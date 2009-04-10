<?php

$router = new Zend_Controller_Router_Rewrite();

//$router->removeDefaultRoutes();

$cnf = Zend_Registry::get('cnf');
$db = Zend_Db::factory($cnf->db);

$select = $db->query("
	select
		su.Name AS Name,
		sm.Controller AS Controller,
		CONCAT(sm.Module,'\\/',sm.Controller,'\\/?',su.URL_regexp) AS URL_regexp,
		su.URL_vars AS URL_vars,
		su.Action AS Action,
		sm.Module AS Module
	from
		admin_menu sm,
		admin_urls su
	where
		sm.ID=su.Menu_id
		and sm.Hidden=0
");
$menu = $select->fetchAll();

for ($i=0; $i<count($menu); $i++) {
    $vars=array();
	$d=explode(",",$menu[$i]['URL_vars']);
	for ($j=0;$j<count($d);$j+=2) {
		$vars[$d[$j]]=(int)$d[$j+1];
	}
	$router->addRoute($menu[$i]['Name'],
		new Zend_Controller_Router_Route_Regex(
			"^".$menu[$i]['URL_regexp']."$",
			array(
				'module' => $menu[$i]['Module'],
				'controller' => $menu[$i]['Controller'],
				'action' => $menu[$i]['Action']
			),
			$vars
		)
	);
}
