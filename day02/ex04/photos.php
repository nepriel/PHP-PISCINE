#!/usr/bin/php
<?PHP
if ($argc == 2)
{
	$c = curl_init($argv[1]);
	curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
	$array = curl_exec($c);
	curl_close($c);
	$tmp = array();
	$imgs = array();

	preg_match_all("/<img[^s]+src\s*=\".[^\"]+/", $array, $tmp);
	foreach ($tmp[0] as $elem)
	{
		$elem = preg_replace("/<img[^s]+src\s*=\"/", "", $elem);
		if (preg_match("/^\//", $elem))
			$elem = $argv[1].$elem;
		array_push($imgs, $elem);
	}
	$stack = explode("/", $argv[1]);
	$name_ofdir = $stack[2];
	$name_ofdir = dirname(__FILE__)."/".$name_ofdir;
	mkdir($name_ofdir);
	foreach ($imgs as $swag)
	{
		$fd = curl_init($swag);
		curl_setopt($fd, CURLOPT_RETURNTRANSFER, 1);
		$str = curl_exec($fd);
		$stack = explode("/", $swag);
		$name_ofile = $stack[count($stack) - 1];
		file_put_contents($name_ofdir."/".$name_ofile, $str);
		curl_close($fd);
	}
}
?>
