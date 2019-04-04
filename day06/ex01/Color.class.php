<?php
class Color
{
	public $red = 255;
    public $green = 255;
    public $blue = 255;
	public static $verbose = False;

	private static $constitutive_keys = array('red', 'green', 'blue');
	private static $rgb_key = array('rgb');
	private static $doc_file = 'Color.doc.txt';

	public static function doc()
	{
		if(!($doc_str = file_get_contents(self::$doc_file)))
			echo self::$doc_file.' was not found or unreadable.'.PHP_EOL;
		return ($doc_str.PHP_EOL);
	}

	public static function intToHexColor($n)
	{
		return("#".substr("000000".dechex($n),-6));
	}
	
	public function __construct(array $rgb)
    {
		if (array_keys($rgb) == self::$constitutive_keys)
		{
			foreach($rgb as $color_name => $color_val)
			{
				if ($color_val >= 0 && $color_val < 256)
				$this->$color_name = floor($color_val);
			}
		}
		else if (array_keys($rgb) == self::$rgb_key)
		{
			list($this->red, $this->green, $this->blue) = sscanf($this->intToHexColor($rgb['rgb']), "#%02x%02x%02x");
			floor($this->red);
			floor($this->green);
			floor($this->blue);
		}
		$this->check_constitutives();
		if (self::$verbose)
			print($this->info().' constructed.'.PHP_EOL);
	}

	public function __destruct()
	{
		if (self::$verbose)
			print($this->info().' destructed.'.PHP_EOL);
	}

	public function __toString()
	{
		return($this->info());
	}
	
	public function info()
	{
		$info = sprintf('Color( red: %3d, green: %3d, blue: %3d )', $this->red, $this->green, $this->blue);
		return ($info);
	}

	public function check_constitutive(&$constitutive)
	{
		if ($constitutive < 0)
			$constitutive = 0;
		else if ($constitutive > 255)
			$constitutive = 255;
	}

	private function check_constitutives()
	{
		$this->check_constitutive($this->red);
		$this->check_constitutive($this->blue);
		$this->check_constitutive($this->green);
	}

	public function add(Color $col)
	{
		return (new Color (array(	'red' => $col->red + $this->red,
									'green' => $col->green + $this->green,
									'blue' => $col->blue + $this->blue)));
	}
	
	public function sub(Color $col)
	{
		return (new Color (array(	'red' => $col->red - $this->red,
									'green' => $col->green - $this->green,
									'blue' => $col->blue - $this->blue)));
	}
	
	public function mult($coef)
	{
		return (new Color (array(	'red' => $this->red * $coef,
									'green' => $this->green * $coef,
									'blue' => $this->blue * $coef)));
		
	}
}