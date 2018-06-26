<?php namespace Chbakouras\CrudApiGenerator\Repository\Query;


class Where
{
    private $column;
    private $operation;
    private $value;

    /**
     * Where constructor.
     * @param string $column
     * @param string $operation
     * @param string $value
     */
    public function __construct($column, $operation, $value)
    {
        $this->column = $column;
        $this->operation = $operation;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getColumn(): string
    {
        return $this->column;
    }

    /**
     * @param string $column
     */
    public function setColumn(string $column)
    {
        $this->column = $column;
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @param string $operation
     */
    public function setOperation(string $operation)
    {
        $this->operation = $operation;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value)
    {
        $this->value = $value;
    }
}
