<?php namespace Chbakouras\CrudApiGenerator\Repository\Query;


class WhereGroup
{
    const AND = "AND";
    const OR = "OR";

    private $wheres;
    private $operator;

    /**
     * WhereGroup constructor.
     * @param $wheres
     * @param $operator
     */
    public function __construct(array $wheres, $operator)
    {
        $this->wheres = $wheres;
        $this->operator = $operator;
    }

    /**
     * @return array
     */
    public function getWheres(): array
    {
        return $this->wheres;
    }

    /**
     * @param array $wheres
     */
    public function setWheres(array $wheres)
    {
        $this->wheres = $wheres;
    }

    /**
     * @return mixed
     */
    public function getOperator()
    {
        return $this->operator ? $this->operator : self::OR;
    }

    /**
     * @param mixed $operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }
}
