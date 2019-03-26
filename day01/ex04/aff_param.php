#!/usr/bin/php
<?PHP

$i = 0;

foreach($argv as $yolo)
{
	if ($i != 0)
		echo $yolo."\n";
	$i = $i + 1;
}
?>
