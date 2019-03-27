#!/usr/bin/php
<?PHP
if ($argc == 4)
{
	$a = trim($argv[1]);
	$b = trim($argv[3]);
	$oper = trim($argv[2]);
	if ($oper == "+")
		$res = $a + $b;
	else if ($oper == "-")
		$res = $a - $b;
	else if ($oper == "*")
		$res = $a * $b;
	else if ($oper == "/")
		$res = $a / $b;
	else if ($oper == "%")
		$res = $a % $b;
	echo $res."\n";
}
else
{
	echo "Incorrect Parameters\n";
}
?>
