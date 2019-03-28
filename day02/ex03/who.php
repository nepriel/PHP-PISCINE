#!/usr/bin/php
<?php
date_default_timezone_set('Europe/paris');

$final = array();
$usr = get_current_user();
$file = file_get_contents("/var/run/utmpx");
$sub = substr($file, 1256);
$typedef = 'a256user/a4id/a32line/ipid/itype/I2time/a256host/i16pad';
while ($sub != NULL)
{

	$array = unpack($typedef, $sub);
	if (strcmp(trim($array[user]), $usr) == 0 && $array[type] == 7)
	{
		$date = date("M j H:i ", $array["time1"]);
		$term = trim($array[line])."  ";
		$user = trim($array[user])." ";
		$final = array_merge($final, array($user.$term.$date));
	}
	$sub = substr($sub, 628);;
}
sort($final);
foreach ($final as $elem)
{
	echo $elem;
	echo "\n";
}
?>
