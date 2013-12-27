<?php

using Vikekh\Filmtipset\AbstractData;

class AbstractDataTest extends PHPUnit_Framework_TestCase {
	public function testFoo() {
		$this->assertEquals(array('foo', 'bar'), AbstractData::explode('foo,bar'));
	}
}
