<?php

require 'AbstractItem.php';
require 'Movie.php';

class Filmtipset {
	private $_url = 'http://www.filmtipset.se/api/api.cgi';
	private $_data;
	private $_result;
	
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
	
	public function getResult() {
		return $this->_result;
	}
	
	public function getUrl($urlData, $first = false) {
		$url = $this->_url;
		$url .= $first ? '?' : '&';
		return $url . http_build_query($urlData);
	}
	
	public function printData() {
		echo '<pre>';
		print_r($this->getData());
		echo '</pre>';
	}
	
	public function printResult() {
		echo '<pre>';
		print_r($this->getResult());
		echo '</pre>';
	}
	
	public function query($action, $urlData) {
		$urlData = array_merge(array('action' => $action), $urlData);
		$url = $this->getUrl($urlData);
		$json = file_get_contents($url);
		$data = json_decode(utf8_decode($json));
		$this->_data = $data[0]->data[0]->hits;
		
		foreach ($this->_data as $value) {
			if (isset($value->movie)) {
				$this->_result[] = new Movie($value->movie);
			}
		}
	}
	
	public function search($keywords) {
		$queryData = array('id' => $keywords);
		$this->query('search', $queryData);
		return $this;
	}
}
