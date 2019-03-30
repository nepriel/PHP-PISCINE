<?PHP
$po_submit = $_POST['submit'];
$newpass = $_POST['newpw'];
$oldpass = $_POST['oldpw'];

if ($po_submit === "OK")
{
	if ($newpass === "")
		echo "ERROR\n";
	else
	{
		$modif = FALSE;
		$po_hash = hash('whirlpool', $newpass);
		$hashold = hash('whirlpool', $oldpass); 
		$storage = file_get_contents("../private/passwd");
		$extracted = unserialize($storage);
		$i = 0;
		foreach ($extracted as $elem)
		{
			if ($elem['login'] === $_POST['login'] && $hashold === $elem['passwd'])
			{
				$extracted[$i]['passwd'] = $po_hash;
				$modif = TRUE;
			}
			$i++;
		}
		if ($modif == TRUE)
		{
			$putback = serialize($extracted);
			file_put_contents("../private/passwd", $putback);
			echo "OK\n";
		}
		else
			echo "ERROR\n";
	}
}
?>
