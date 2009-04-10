<?php

/**
 * Файл формирования маршрутов. Происходит инициализация объекта маршрутизации и задание правил маршрутизации
 * 
 * @author Александр Махомет aka San для http://zendframework.ru
 */

$router = new Zend_Controller_Router_Rewrite();

/*$router->addRoute('articles',
	new Zend_Controller_Router_Route(
		'articles/:articleId',
		array(
			'module' => 'default',
			'controller' => 'articles',
			'action' => 'view'
		)
	)
);

$router->addRoute('pages',
	new Zend_Controller_Router_Route(
		'pages/:pageId',
		array(
			'module' => 'default',
			'controller' => 'index',
			'action' => 'page'
		)
	)
);


$router->addRoute('blog',
	new Zend_Controller_Router_Route(
		'blog/:postId.html',
		array(
			'module' => 'default',
			'controller' => 'blog',
			'action' => 'post'
		)
	)
);*/

/*$router->addRoute('blog_2',
	new Zend_Controller_Router_Route_Regex(
		'blog/(\d+).html(\?{0,1})',
		array(
			'module' => 'default',
			'controller' => 'blog',
			'action' => 'post'
		),
		array(
			'postId'=>1
		)
	)
);*/

/*$router->addRoute('blog_2',
	new Zend_Controller_Router_Route_Regex(
		'blog\/(\d+).html(\&(\w+)\=(\w+))?(\&(\w+)\=(\d+))?',
		array(
			'module' => 'default',
			'controller' => 'blog',
			'action' => 'post'
		),
		array(
			'postId'=>1,
			'var1'=>3,
			'val1'=>4,
			'var2'=>6,
			'val2'=>7
		)
	)
);*/

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
