<?php

class Movie extends AbstractItem {
	protected function parse(stdClass $movie) {
		$this->title = $movie->name;
	}
}
