#!/usr/bin/php
<?PHP
function ft_split($str)
{
	$tab = explode(" ", $str);
	sort($tab);
	$yo = array();
	foreach ($tab as $elem)
	{
		if (!empty($elem))
			$yo[] = $elem;
	}
	unset($tab);
	return ($yo);
}

$i = 0;
$stack = array();
foreach($argv as $yolo)
{
	if ($i != 0)
		$stack = array_merge($stack, ft_split($yolo));
	$i++;
}
sort($stack);
foreach($stack as $elem)
{
	echo $elem."\n";
}
?>
