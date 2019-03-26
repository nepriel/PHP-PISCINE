<?PHP
function ft_is_sort($tab)
{
	$sorted = $tab;
	sort($sorted);
	$i = 0;
	foreach($tab as $elem)
	{
		if ($tab[$i] != $sorted[$i])
			return (0);
		$i++;
	}
	return (1);
}
?>
