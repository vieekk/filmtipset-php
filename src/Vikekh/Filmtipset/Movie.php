<?php

namespace Vikekh\Filmtipset;

use Vikekh\Filmtipset\AbstractData;

class Movie extends AbstractData {
	protected function parse(\stdClass $movie) {
		$properties = array('alt_title', 'country', 'id', 'image', 'imdb',
			'length', 'name', 'orgname', 'url', 'year');
		$movie = self::addProperties($movie, $properties);
		
		$this->alternativeTitles = self::explode($movie->alt_title);
		$this->countries = self::explode($movie->country);
		$this->filmtipsetId = intval($movie->id);
		$this->filmtipsetUrl = $movie->url;
		$this->imageUrl = $movie->image;
		$this->imdbId = intval($movie->imdb);
		$this->runtime = intval($movie->length);
		$this->title = $movie->orgname;
		$this->year = $movie->year;
		
		if ($this->title != $movie->name)
			$this->swedishTitle = $movie->name;
		
		if ($movie->imdb != '')
			$this->imdbUrl = 'http://www.imdb.com/title/tt' . $movie->imdb;
		
		// TODO: parse directors
	}
}
