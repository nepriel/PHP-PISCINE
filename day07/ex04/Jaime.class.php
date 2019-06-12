<?php

Class Jaime extends Lannister
{
	public function with($chosen_one)
	{
		if (get_parent_class($chosen_one) !== 'Lannister')
		{
			return ("Let's do this.");
		}
		elseif (get_class($chosen_one) === "Cersei")
		{
			return ("With pleasure, but only in a tower in Winterfell, then.");
		}
		else
		{
			return ("Not even if I'm drunk !");
		}
	}
}

?>