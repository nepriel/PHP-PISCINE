<?PHP

class Color
{
    public static $verbose = False;
	public $red = 0;
	public $green = 0;
	public $blue = 0;

    public function __construct( array $kwarg)
    {
        if ($kwarg['rgb'] !== NULL)
        {
            $rgb = array();
            $test = intval($kwarg['rgb']); 
            $rgb['red'] = ($test & (255 << 16)) >> 16;
            $rgb['green'] = ($test & (255 << 8)) >> 8;
            $rgb['blue'] = $test &  255;

            $this->red = $rgb['red'];
            $this->green = $rgb['green'];
            $this->blue = $rgb['blue'];
        }
        else if ($kwarg['green'] !== NULL && $kwarg['blue'] !== NULL  && $kwarg['green'] !== NULL)
        {
            $this->red = $kwarg['red'];
            $this->green = $kwarg['green'];
            $this->blue = $kwarg['blue'];
        }
        if ($this->red < 0)
			$this->red = 0;
		if ($this->green < 0)
			$this->green = 0;
		if ($this->blue < 0)
			$this->blue = 0;
		if ($this->red > 255)
			$this->red = 255;
		if ($this->green > 255)
			$this->green = 255;
		if ($this->blue > 255)
            $this->blue = 255;
        if (self::$verbose === True)
            print ('Color( red: ' . str_pad(round($this->red), 3, " ", STR_PAD_LEFT) . ', green: ' . str_pad(round($this->green), 3, " ", STR_PAD_LEFT) . ', blue: ' . str_pad(round($this->blue), 3, " ", STR_PAD_LEFT) . ' ) constructed.' . PHP_EOL);
    }

    function __toString()
    {
        return ('Color( red: ' . str_pad(round($this->red), 3, " ", STR_PAD_LEFT) . ', green: ' . str_pad(round($this->green), 3, " ", STR_PAD_LEFT) . ', blue: ' . str_pad(round($this->blue), 3, " ", STR_PAD_LEFT) . ' )');
    }

    function add ( $instance_color)
	{
		return (new Color( array( 'red' => $instance_color->red + $this->red, 'green' => $instance_color->green + $this->green, 'blue' => $instance_color->blue + $this->blue )));
    }
    
    function sub( $instance_color)
	{
		return (new Color( array( 'red' => $this->red - $instance_color->red, 'green' => $this->green - $instance_color->green, 'blue' => $this->blue - $instance_color->blue)));
	}

    function mult($factor)
    {
        $r = $factor * $this->red;
        $g = $factor * $this->green;
        $b = $factor * $this->blue;
        return (new Color( array( 'red' => $r, 'green' => $g, 'blue' => $b)));
    }
    
    function __destruct()
    {
        if (self::$verbose === True)
            print ('Color( red: ' . str_pad(round($this->red), 3, " ", STR_PAD_LEFT) . ', green: ' . str_pad(round($this->green), 3, " ", STR_PAD_LEFT) . ', blue: ' . str_pad(round($this->blue), 3, " ", STR_PAD_LEFT) . ' ) destructed.' . PHP_EOL);
    }

    static function doc()
	{
        if (file_exists('Color.doc.txt'))
            return (file_get_contents('Color.doc.txt'));
        else
            return ("Error, file doesn't exist\n");
	}
}

?>