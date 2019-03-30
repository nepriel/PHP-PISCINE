<?PHP

function auth($login, $passwd)
{
	$modif = FALSE;
	$hash = hash('whirlpool', $passwd);
	$get_content = file_get_contents("../private/passwd");
	$extracted = unserialize($get_content);
	foreach ($extracted as $elem)
	{
		if ($elem['login'] === $login && $elem['passwd'] === $hash)
			$modif = TRUE;
	}
	if ($modif == FALSE)
		return (FALSE);
	else
		return (TRUE);
}

?>
