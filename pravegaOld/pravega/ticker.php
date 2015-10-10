<?php
$xml = simplexml_load_file('news.xml');
$path = "/news_items/news";
$result = $xml->xpath($path);
						
for ($i=0; $i < sizeof($result); $i++)
	{
		if ($i != 0)
			echo '<div name="news" class="ticker ticker_bottom">';
		else echo '<div name="news" class="ticker ticker_visible">';
		//echo $result[$i];
		$xml = simplexml_load_file('link.xml');
		$path = "/link_items/link";
		$result = $xml->xpath($path);
		echo '<a href="';
		echo $result[$i];
		echo '"><b>';
		$xml = simplexml_load_file('news.xml');
		$path = "/news_items/news";
		$result = $xml->xpath($path);
		echo $result[$i];
		echo '</b></a>';
		echo '</div>';
	}
	?>
