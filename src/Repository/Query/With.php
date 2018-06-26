<?php namespace Chbakouras\CrudApiGenerator\Repository\Query;


class With
{
    private $withs;

    /**
     * With constructor.
     * @param array|string $withs
     */
    public function __construct($withs)
    {
        $this->withs = $withs;
    }

    /**
     * @return array|string
     */
    public function getWiths()
    {
        return $this->withs;
    }

    /**
     * @param array|string $withs
     */
    public function setWiths($withs)
    {
        $this->withs = $withs;
    }
}
