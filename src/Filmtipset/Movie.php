<?php

class Movie extends AbstractItem {
	protected function parse(stdClass $movie) {
		$this->filmtipsetId = $movie->id;
		$this->title = $movie->orgname;
		$this->year = $movie->year;
		
		if ($this->title != $movie->name)
			$this->swedishTitle = $movie->name;
	}
}
