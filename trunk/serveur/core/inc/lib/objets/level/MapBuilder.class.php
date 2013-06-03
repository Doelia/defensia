<?php

class MapBuilder
{
	public static function build($jsonString)
	{
		$map = array();
		Logger::logJson("MapBuilder.build() : parsing json string");

		$json = json_decode($jsonString, TRUE);
		$json = $json["map"];

		$sockets = $json["sockets"];
		$center = $json["centre"];
		$paths = $json["routes"];
		
		for ($i = 0; $i < count($sockets); $i++)
		{
			$x = $sockets[$i]["x"];
			$y = $sockets[$i]["y"];
				
			$map[$y][$x] = new TowerSocketCase($x, $y);
		}

		for ($i = 0; $i < count($center); $i++)
		{
			$x = $center[$i]["x"];
			$y = $center[$i]["y"];
				
			$map[$y][$x] = new CenterCase($x, $y, count($center));
		}
		
		CenterCase::setLife(count($center) * 10);

		for ($i = 0; $i < count($paths); $i++)
		{
			$x = $paths[$i]["x"];
			$y = $paths[$i]["y"];
			$direction = $paths[$i]["direction"];
				
			$map[$y][$x] = new PathCase($x, $y, $direction);
		}
		
		return $map;
	}
}