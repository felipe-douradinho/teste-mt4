<?php

namespace Golden\Database\Syntax;

use Golden\Database\Manipulation\QueryException;

/**
 * Class Column.
 */
class Column implements QueryPartInterface
{
    const ALL = '*';

    /**
     * @var Table
     */
    protected $table;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $alias;

    /**
     * @param string $name
     * @param string $table
     * @param string $alias
     */
    public function __construct($name, $table, $alias = '')
    {
        $this->setName($name);
        $this->setTable($table);
        $this->setAlias($alias);
    }

    /**
     * @return string
     */
    public function partName()
    {
        return 'COLUMN';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = (string) $name;

        return $this;
    }

    /**
     * @return Table
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     *
     * @return $this
     */
    public function setTable($table)
    {
        $newTable = array($table);
        $this->table = SyntaxFactory::createTable($newTable);

        return $this;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param null|string $alias
     *
     * @return $this
     *
     * @throws QueryException
     */
    public function setAlias($alias)
    {
        if (0 == \strlen($alias)) {
            $this->alias = null;

            return $this;
        }

        if ($this->isAll()) {
            throw new QueryException("Can't use alias because column name is ALL (*)");
        }

        $this->alias = (string) $alias;

        return $this;
    }

    /**
     * Check whether column name is '*' or not.
     *
     * @return bool
     */
    public function isAll()
    {
        return $this->getName() == self::ALL;
    }
}
