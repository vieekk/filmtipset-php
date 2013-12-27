<?php

namespace Vikekh\\Filmtipset\\AbstractData;

abstract class AbstractData {
	private $_data;
	
	public function __construct(stdClass $object) {
		$this->parse($object);
		$this->removeEmpties();
		ksort($this->_data);
	}
	
	public static function addProperties(stdClass $object, array $properties) {
		foreach ($properties as $property) {
			if (!isset($object->{$property}))
				$object->{$property} = null;
		}
		
		return $object;
	}
	
	public static function explode($value) {
		return explode('|', str_replace(array(', ', ','), '|', $value));
	}
	
	public function __get($name) {
		if (array_key_exists($name, $this->_data))
			return $this->_data[$name];
		else
			return null;
	}

	abstract protected function parse(stdClass $object);
	
	private function removeEmpties() {
		foreach ($this->_data as $key => $value) {
			if ($value == '' || $value == '' || (is_array($value)
					&& implode('', $value) == ''))
				unset($this->_data[$key]);
		}
	}
	
	public function __set($name, $value) {
		$this->_data[$name] = $value;
	}
}
