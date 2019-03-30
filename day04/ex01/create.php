<?php

$log = $_POST['login'];
$po_pass = $_POST['passwd'];
$po_submit = $_POST['submit'];

if ($log != "" && $po_pass != "")
{
	if ($po_submit == "OK")
	{
		$hash_po = hash('whirlpool', $po_pass);
		if (file_exists("../private") == FALSE)
		{
			mkdir("../private", 0777, true);
		}
		if (file_exists("../private/passwd") == FALSE)
		{
			$array = array(array('login'=>$log, 'passwd'=>$hash_po));
			$storage = serialize($array);
			file_put_contents("../private/passwd", $storage);
			echo "OK";
		}
		else
		{
			$exist = FALSE;
			$array = file_get_contents("../private/passwd");
			$extracted = unserialize($array);
			foreach ($extracted as $elem) 
			{
				if ($extracted['login'] == $log)
				{
					$exist = TRUE;
				}
			}
			if ($exist == FALSE)
			{
				$extracted[] = array('login'=>$log, 'passwd'=>$hash_po);
				$putback = serialize($extracted);
				file_put_contents("../private/passwd", $putback);
				echo "OK";
			}
			else
			{
				echo "ERROR";
			}
		}
	}
	else
	{
		echo "ERROR";
	}
}
else{
	echo "ERROR";
}
?>
