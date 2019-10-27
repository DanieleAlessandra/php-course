<?php

namespace Bookstore\Tests\Domain;


use Bookstore\Domain\Customer;
use Bookstore\Domain\Customer\Basic;
use PHPUnit\Framework\TestCase;

class BasicTest extends TestCase {
	/**
	 * @var Customer
	 */
	private $customer;

	/**
	 * Questa viene eseguita prima di tutti i test
	 */
	public function setUp() {
		$this->customer = new Basic(
			1, 'han', 'solo', 'han@solo.com'
		);
	}

	public function testAmountToBorrow() {
		$this->assertSame(
			3,
			$this->customer->getAmountToBorrow(),
			'Basic customer should borrow up to 3 books.'
		);
	}

	public function testIsExemptOfTaxes() {
		$this->assertFalse(
			$this->customer->isExtentOfTaxes(),
			'Basic customer should be exempt of taxes.'
		);
	}

	public function testGetMonthlyFee() {
		$this->assertEquals(
			5,
			$this->customer->getMonthlyFee(),
			'Basic customer should pay 5 a month.'
		);
	}

	/**
	 * @test-no
	 * Questo test fallirà
	 */
	public function fallimento() {
		$this->assertSame(
			4,
			$this->customer->getAmountToBorrow(),
			'Basic customer should borrow up to 4 books.'
		);
	}
}
