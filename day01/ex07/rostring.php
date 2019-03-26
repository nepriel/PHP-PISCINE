#!/usr/bin/php
<?PHP

function ft_split($str)
{
	$tab = explode(" ", $str);
	$yo = array();
	foreach ($tab as $elem)
	{
		if (!empty($elem))
			$yo[] = $elem;
	}
	unset($tab);
	return ($yo);
}

$tab = ft_split($argv[1]);

$i = 0;
foreach($tab as $test)
{
	if ($i == 0)
		$newtab = array($test);
	$i = $i + 1;
}

if ($i > 1)
{
	$tab = array_splice($tab, 1, $i);
	$tab = array_merge($tab, $newtab);
	$j = 0;
	foreach($tab as $yolo)
	{
		$j++;
		if($j == $i)
			echo $yolo."\n";
		else
			echo $yolo." ";
	}
}
else
{
	echo trim($argv[1])."\n";
}
?>
