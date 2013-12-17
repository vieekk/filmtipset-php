<?php

abstract class AbstractItem {
	private $_data;
	
	public function __construct(stdClass $object) {
		$this->parse($object);
	}
	
	public function __get($name) {
		if (array_key_exists($name, $this->_data))
			return $this->_data[$name];
		else
			return null;
	}

	abstract protected function parse(stdClass $object);
	
	public function __set($name, $value) {
		$this->_data[$name] = $value;
	}
}
