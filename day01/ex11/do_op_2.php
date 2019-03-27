#!/usr/bin/php
<?PHP
if ($argc != 2)
	echo "Incorrect Parameters\n";
else
{
	$ope = sscanf($argv[1], "%d %c %d %s");
	if (is_numeric($ope[0]) && $ope[1] && is_numeric($ope[2]) && !$ope[3])
	{
		if($ope[1] == '*')
			$result = $ope[0] * $ope[2];
		if($ope[1] == '-')
			$result = $ope[0] - $ope[2];
		if($ope[1] == '/')
			$result = $ope[0] / $ope[2];
		if($ope[1] == '%')
			$result = $ope[0] % $ope[2];
		if($ope[1] == '+')
			$result = $ope[0] + $ope[2];
		echo $result;
		echo "\n";
	}
	else
		echo "Syntax Error\n";
}
?>
