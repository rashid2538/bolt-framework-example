<?php

	namespace Example\Controller;

	use Bolt\Controller;

	abstract class Base extends Controller {

		protected $_assets = [
			'css' => [
				'lib/bootstrap/css/bootstrap.min',
				'lib/font-awesome/css/font-awesome.min',
			], 'js' => [
				'lib/jquery/jquery.min',
				'lib/popper/popper.min',
				'lib/bootstrap/js/bootstrap.min'
			]
		];

		protected $_layout = 'layouts/default';
	}