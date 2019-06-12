<?php

Class Tyrion extends Lannister
{
	public function with($chosen_one)
	{
		if (get_parent_class($chosen_one) !== 'Lannister')
		{
			return ("Let's do this.");
		}
		return ("Not even if I'm drunk !");
	}
}

?>