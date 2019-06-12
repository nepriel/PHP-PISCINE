<?PHP

class NightsWatch
{
    private $the_wall;

    function recruit($new_member)
    {
        if ($new_member instanceof IFighter)
        {
            $this->the_wall[] = $new_member;
        }
    }
    function fight()
    {
        foreach($this->the_wall as $fighter)
        {
            $fighter->fight();
        }
    }
}
?>