<?php
//require_once 'Color.class.php';

class Vertex
{
	private $_x = 0;
	private $_y = 0;
	private $_z = 0;
	private $_w = 1.0;
	private $_color = null;
	private static $doc_file = 'Vertex.doc.txt';

	public static $verbose = false;

	function __construct(array $params)
	{
		foreach ($params as $k => $v)
		{
			if ($k == 'color')
				$has_color = true;
			$k = '_'.$k;
			$this->$k = $v;
		}
		if (!$has_color)
		{
			$this->_color = new Color (array ('red' => 255, 'green' => 255, 'blue' => 255));
		}
		if (self::$verbose)
			print($this->info().' constructed'.PHP_EOL);
	}

	function __destruct()
	{
		if (self::$verbose)
			print($this->info().' destructed'.PHP_EOL);
	}

	function __toString()
	{
		return($this->info());
	}

	function getX()
	{
		return ($this->_x);	
	}

	function getY()
	{
		return ($this->_y);	
	}

	function getZ()
	{
		return ($this->_z);	
	}

	function getW()
	{
		return ($this->_w);	
	}

	function getColor()
	{
		return ($this->_color);	
	}

	function setX($val)
	{
		$this->_x = $val;
	}

	function setY($val)
	{

		$this->_y = $val;
	}

	function setZ($val)
	{

		$this->_z = $val;
	}

	function setW($val)
	{
		$this->_w = $val;

	}

	function setColor(Color $col)
	{
		$this->_color = $col;

	}

	function info()
	{
		$x = number_format((float)$this->_x, 2, '.', '');
		$y = number_format((float)$this->_y, 2, '.', '');
		$z = number_format((float)$this->_z, 2, '.', '');
		$w = number_format((float)$this->_w, 2, '.', '');
		$info = 'Vertex( x: '.$x.', y: '.$y.', z:'.$z.', w:'.$w;
				if (!is_null($this->_color) && self::$verbose)
				$info .= ', '.$this->_color->info();
				$info .= ' )';
		return ($info);
	}

	static function doc()
	{
		if(!($doc_str = file_get_contents(self::$doc_file)))
			echo self::$doc_file.' ERROR --> file not found or unreadable'.PHP_EOL;
		return ($doc_str);
	}
}

?>
