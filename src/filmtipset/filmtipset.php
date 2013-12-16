<?php

class Filmtipset {
	private $_url = 'http://www.filmtipset.se/api/api.cgi';
	private $_data;
	
	public function __construct($access_key, $user_key) {
		$url_data = array(
			'accesskey'  => $access_key,
			'userkey'    => $user_key,
			//'usernr'     => $user_number,
			'returntype' => 'json'
		);
		$this->_url = $this->get_url($url_data, true);
	}
	
	public function get_data() {
		return $this->_data;
	}
	
	public function get_url($url_data, $first = false) {
		$url = $this->_url;
		$url .= $first ? '?' : '&';
		return $url . http_build_query($url_data);
	}
	
	public function print_data() {
		echo '<pre>';
		print_r($this->get_data());
		echo '</pre>';
	}
	
	public function query($action, $url_data) {
		$url_data = array_merge(array('action' => $action), $url_data);
		$url = $this->get_url($url_data);
		$this->_data = file_get_contents($url);
		//$this->_data = json_decode($json);
	}
	
	public function search($keywords) {
		$query_data = array('id' => $keywords);
		$this->query('search', $query_data);
		return $this;
	}
}
