<?php

use Vikekh\Filmtipset\AbstractData;

class AbstractDataTest extends \PHPUnit_Framework_TestCase {
	public function testExplode() {
		$expected = array('foo', 'bar');
		$this->assertSame($expected, AbstractData::explode('foo,bar'));
		$this->assertSame($expected, AbstractData::explode('foo, bar'));
		$this->assertSame($expected, AbstractData::explode('foo , bar'));
	}
}
