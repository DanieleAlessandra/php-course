<?php

namespace Bookstore\Controllers;

use Bookstore\Core\Request;
use Bookstore\Exceptions\NotFoundException;
use Bookstore\Utils\DependencyInjector;

abstract class AbstractController {
	protected $request;
	protected $db;
	protected $config;
	protected $view;
	protected $log;
	protected $customerId;
	protected $di;

	public function __construct(DependencyInjector $di, Request $request) {
		$this->request = $request;
		$this->di = $di;

		try {
			$this->db = $di->get( 'PDO' );
			$this->log = $di->get('Logger');
			$this->view = $di->get('Twig\Environment');
			$this->config = $di->get('Utils\Config');
		} catch ( NotFoundException $e ) {
			die($e);
		}
	}

	public function setCustomerId(int $customerId) {
		$this->customerId = $customerId;
	}

	protected function render(string $template, array $params): string {
		return $this->view->loadTemplate($template)->render($params);
	}
}
