#!/usr/bin/php
<?PHP
while (1)
{
	echo "Entrez un nombre: ";
	$ligne=trim(fgets(STDIN));
	if (feof(STDIN))
	{
		echo "\n";
		exit;
	}
	if (!is_numeric($ligne))
		echo "'".$ligne."'"." n'est pas un chiffre\n";
	else
	{
		if ($ligne % 2 == 0)
			echo "Le chiffre $ligne est Pair\n";
		else
			echo "Le chiffre $ligne est Impair\n";
	}
}
?>
