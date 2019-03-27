#!/usr/bin/php
<?PHP

if ($argc >= 2 && $argv[1] != NULL && argv[2] != NULL)
{
	$str = $argv[1];
	unset($argv[0]);
	unset($argv[1]);
	$i = 0;
	$j = 0;
	$stack = array();
	foreach($argv as $elem)
	{	
		$tmp = explode(":", $elem);
		$stack = array_merge($stack, $tmp);
		if (strpos($stack[($i * 2)], $str) !== FALSE)
		{
			$j++;
			$good_index = ($i * 2) + 1;
		}
		$i++;
	}
	if ($j != 0)
		echo $stack[$good_index]."\n";
}

?>
