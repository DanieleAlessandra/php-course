<?php

namespace Bookstore\Tests\Domain\Customer;

use Bookstore\Domain\Customer\Basic;
use Bookstore\Domain\Customer\CustomerFactory;
use PHPUnit\Framework\TestCase;

class CustomerFactoryTest extends TestCase {
	public function testFactoryBasic() {
		$customer = CustomerFactory::factory(
			'basic', 1, 'han', 'solo', 'han@solo.com'
		);
		$this->assertInstanceOf(
			Basic::class,
			$customer,
			'basic should create a Customer\Basic object.'
		);
	}

	/**
	 * @expectedException \InvalidArgumentException
	 * @expectedExceptionMessage Wrong type.
	 */
	public function testCreatingWrongTypeOfCustomer() {
		$customer = CustomerFactory::factory(
			'deluxe', 1, 'han', 'solo', 'han@solo.com'
		);
	}


}
