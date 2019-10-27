<?php

namespace Bookstore\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase {
	protected function mock( string $className ) {
		if ( strpos( $className, '\\' ) !== 0 ) {
			$className = '\\' . $className;
		}
		if ( ! class_exists( $className ) ) {
			$className = '\Bookstore\\' . trim( $className, '\\' );
			if ( ! class_exists( $className ) ) {
				throw new InvalidArgumentException(
					"Class $className not found."
				);
			}
		}

		return $this->getMockBuilder( $className )
		            ->disableOriginalConstructor()
		            ->getMock();
	}
}
