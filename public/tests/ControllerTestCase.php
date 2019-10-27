<?php

namespace Bookstore\Tests;

use Bookstore\Utils\DependencyInjector;
use Bookstore\Core\Config;
use Monolog\Logger;
use Twig\Environment;
use PDO;
use Twig\Template;

abstract class ControllerTestCase extends AbstractTestCase {
	protected $di;

	public function setUp() {
		$this->di = new DependencyInjector();
		$this->di->set( 'PDO', $this->mock( PDO::class ) );
		$this->di->set( 'Utils\Config', $this->mock( Config::class ) );
		$this->di->set(
			'Twig\Environment',
			$this->mock( Environment::class )
		);
		$this->di->set( 'Logger', $this->mock( Logger::class ) );
	}

    protected function mockTemplate(
        string $templateName,
        array $params,
        $response
    ) {
        $template = $this->mock(Template::class);
        $template
            ->expects($this->once())
            ->method('render')
            ->with($params)
            ->will($this->returnValue($response));
        $this->di->get('Twig_Environment')
            ->expects($this->once())
            ->method('loadTemplate')
            ->with($templateName)
            ->will($this->returnValue($template));
    }
}
