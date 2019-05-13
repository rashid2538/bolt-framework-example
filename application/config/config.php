<?php

	return [
		'db' => [
			'host' => 'localhost',
			'user' => 'admin',
			'password' => '123456',
			'database' => 'ind_startup',
			'prefix' => 'bo_'
		], 'defaults' => [
			'controller' => 'home',
			'action' => 'main',
			'appNamespace' => 'Example\\',
			'errorController' => 'error',
			'viewPath' => __DIR__ . '/../../application/view/',
			'loginPath' => 'account/main'
		], 'plugins' => [ 'BoltPlugin\\PHPTAL\\Renderer' ],
		'view' => [
			'extension' => 'html'
		]
	];