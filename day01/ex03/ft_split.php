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
?>
