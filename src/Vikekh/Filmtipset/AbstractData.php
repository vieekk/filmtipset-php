<?php

namespace Vikekh\Filmtipset;

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
		$array = explode('|', str_replace(array(', ', ','), '|', $value));
		
		foreach ($array as $key => $value)
			$array[$key] = trim($value);
		
		return $array;
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
