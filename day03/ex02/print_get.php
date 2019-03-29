<?PHP

foreach ($_GET as $elem)
{
	echo array_search($elem, $_GET).": ".$elem."\n";
}

?>
