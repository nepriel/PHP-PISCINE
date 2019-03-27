#!/usr/bin/php
<?PHP

date_default_timezone_set ("Europe/Paris");

function get_month($str)
{
	if (preg_match("/^[Jj]anvier$/", $str))
		return (1);
	else if (preg_match("/^[Ff][ée]vrier$/", $str))
		return (2);
	else if (preg_match("/^[Mm]ars$/", $str))
		return (3);
	else if (preg_match("/^[Aa]vril$/", $str))
		return (4);
	else if (preg_match("/^[Mm]ai$/", $str))
		return (5);
	else if (preg_match("/^[Jj]uin$/", $str))
		return (6);
	else if (preg_match("/^[Jj]uillet$/", $str))
		return (7);
	else if (preg_match("/^[Aa]o[ûu]t$/", $str))
		return (8);
	else if (preg_match("/^[Ss]eptembre$/", $str))
		return (9);
	else if (preg_match("/^[Oo]ctobre$/", $str))
		return (10);
	else if (preg_match("/^[Nn]ovembre$/", $str))
		return (11);
	else if (preg_match("/^[Dd][ée]cembre$/", $str))
		return (12);
	else
		return (0);
}

if ($argc == 2)
{
	$tab = explode(" ", $argv[1]);
	if (count($tab) != 5)
	{
		echo "Wrong Format\n";
		return (0);
	}
	else
	{
		$test = array("$tab[0]");
		$useless = preg_grep("/^([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche)$/", $test);
		if ($useless == NULL)
		{
			echo "Wrong Format\n";
			return (0);
		}
		$test = array("$tab[1]");
		$day = preg_grep("/^(1\d|\d|2\d|3[01])$/", $test);
		if ($day == NULL)
		{
			echo "Wrong Format\n";
			return (0);
		}
		$test = array("$tab[2]");
		$month = preg_grep("/^([Jj]anvier|[Ff][ée]vrier|[Mm]ars|[Aa]vril|[Mm]ai|[Jj]uin|[Jj]uillet|[Aa]o[ûu]t|[Ss]eptembre|[Oo]ctobre|[Nn]ovembre|[Dd][ée]cembre)$/", $test);
		if ($month == NULL)
		{
			echo "Wrong Format\n";
			return (0);
		}
		$year = $tab[3];
		if (!(intval($year) >= 1970 && intval($year) <= 9999))
		{
			echo "Wrong Format\n";
			return (0);
		}
		$test = array("$tab[3]");
		$year = preg_grep("/^\d{4}$/", $test);
		if ($year == NULL)
		{
			echo "Wrong Format\n";
			return (0);
		}
		$hms = explode(":", $tab[4]);
		if(count($hms) != 3)
		{
			echo "Wrong Format\n";
			return (0);
		}
		if (!((intval($hms[0]) >= 0 && intval($hms[0]) <= 23) && (intval($hms[1]) >= 0 && intval($hms[1]) <= 59) && (intval($hms[2]) >= 0 && intval($hms[2] <= 59))))
		{
			echo "Wrong Format\n";
			return (0);
		}
		$test = array("$tab[4]");
		$teston = preg_grep("/^\d{2}:\d{2}:\d{2}$/", $test);
		if ($teston == NULL)
		{
			echo "Wrong Format\n";
			return (0);
		}
		$nmonth = get_month($month[0]);
		$retour = mktime(intval($hms[0]), intval($hms[1]), intval($hms[2]), $nmonth, intval($day[0]), intval($year[0]));
		echo $retour."\n";
	}
}

?>
