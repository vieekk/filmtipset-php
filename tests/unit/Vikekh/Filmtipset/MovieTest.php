<?php

use Vikekh\Filmtipset\AbstractData;
use Vikekh\Filmtipset\Movie;

class MovieTest extends \PHPUnit_Framework_TestCase {
	protected $movie;
	
	protected function setUp() {
		$std = new \stdClass;
		$std->orgname = 'Rosemary\'s Baby';
		$this->movie = new Movie($std);
	}

	public function testTitle() {
		$this->assertSame('Rosemary\'s Baby', $this->movie->title);
	}
}
