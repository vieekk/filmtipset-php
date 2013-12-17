<?php

require 'AbstractItem.php';
require 'Movie.php';

class Filmtipset {
	private $_data;
	private $_rawData;
	private $_url = 'http://www.filmtipset.se/api/api.cgi';
	
	public function __construct($accessKey, $userKey) {
		$urlData = array(
			'accesskey'  => $accessKey,
			'userkey'    => $userKey,
			//'usernr'     => $userNumber,
			'returntype' => 'json'
		);
		$this->_url = $this->getUrl($urlData, true);
	}
	
	public function getData() {
		return $this->_data;
	}
	
	public function getUrl($urlData, $first = false) {
		$url = $this->_url;
		$url .= $first ? '?' : '&';
		return $url . http_build_query($urlData);
	}
	
	public function limit($n) {
		if ($this->_data == null) return;
		$this->_data = array_slice($this->_data, 0, $n);
		return $this;
	}
	
	public function movies(array $movies = null) {
		if ($movies != null)
			$queryData = array('id' => implode($movies, ','));
		else
			$queryData = null;
		
		$this->query('movie', $queryData);
		return $this;
	}
	
	public static function printArray(array $array) {
		echo '<pre>';
		print_r($array);
		echo '</pre>';
	}
	
	public function printData() {
		if (is_array($this->_data)) self::printArray($this->_data);
		return $this;
	}
	
	public function printRawData() {
		if (is_array($this->_rawData)) self::printArray($this->_rawData);
		return $this;
	}
	
	public function query($action, $urlData) {
		if ($urlData == null) {
			// TODO: use previous data for new query
			return;
		}
		
		$urlData = array_merge(array('action' => $action), $urlData);
		$url = $this->getUrl($urlData);
		$json = file_get_contents($url);
		$this->_rawData = json_decode(utf8_decode($json));
		
		foreach ($this->_rawData[0]->data[0]->hits as $value) {
			if (isset($value->movie)) {
				$this->_data[] = new Movie($value->movie);
			}
		}
	}
	
	public function search($search) {
		$queryData = array('id' => $search);
		$this->query('search', $queryData);
		return $this;
	}
}
