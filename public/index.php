<?php

	define( 'APP_PATH', __DIR__ . '/../' );
	require_once( __DIR__ . '/../vendor/autoload.php' );

	Bolt\Application::getInstance()
		->setConfig( __DIR__ . '/../application/config/config.php' )
		// ->setAuthProvider( Example\Component\Auth::getInstance() )
		->run();