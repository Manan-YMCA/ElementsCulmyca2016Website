<?php
	/*$xml = simplexml_load_file('prize_events.xml');
	$path = "/event_data/event[name='Battle of Bands']";
	$result = $xml->xpath($path);
	$temp = $result[0];
	unset($temp[0]);
	echo $xml->asxml('prize_events.xml');*/
	
	function fix_case($string)
	{	
		$words = explode(" ", $string);
		for ($i=0; $i < sizeof($words); $i++)
		{
			if (strtolower($words[$i]) != "of")
			{
				if (strtolower($words[$i]) != "the" || $i == 0)
				{
					$words[$i] = ucfirst($words[$i]);
				}
			}
		}
		
		return implode(" ", $words);
	}
?>