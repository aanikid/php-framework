<?php

namespace App\Framework;

class QueryBuilder
{

    private $from;
    private $order = [];
    private $limit;
    private $offset;
    private $where;
    private $fields = ['*'];
    private $params = [];

    public function from(string $table, string $alias = null): self
    {
        $this->from = null !== $alias ? $table . " " . $alias : $table;
        return $this;
    }

    public function orderBy(string $column, string $order): self
    {
        $order = strtoupper($order);
        if (!in_array($order, ['ASC', 'DESC'])) {
            $this->order[] = $column;
        } else {
            $this->order[] = $column . " " . $order;
        }
        return $this;
    }

    public function limit(int $limit): self
    {
        $this->limit = $limit;
        return $this;
    }

    public function offset(int $offset): self
    {
        $this->offset = $offset;
        return $this;
    }

    public function page(int $page): self
    {
        return $this->offset(($page - 1) * $this->limit);
    }

    public function where(string $where): self
    {
        $this->where = $where;
        return $this;
    }

    public function setParams(string $key, $value): self
    {
        $this->params[$key] = $value;
        return $this;
    }

    public function select(...$field): self
    {
        if(is_array($field[0])) {
            $this->fields = $field[0];
        }
        else if ($this->fields === ['*']) {
            $this->fields = $field;
        }else{
            $this->fields = array_merge($this->fields, $field);
        }

        return $this;
    }

    public function toSql(): string
    {
        $fields = implode(', ', $this->fields);
        $sql = "SELECT $fields FROM {$this->from}";

        if (!empty($this->where)) {
            $sql .= " WHERE " . $this->where;
        }
        if (!empty($this->order)) {
            $sql .= " ORDER BY " . implode(", ", $this->order);
        }
        if ($this->limit > 0) {
            $sql .= " LIMIT " . $this->limit;
        }
        if (null !== $this->offset) {
            $sql .= " OFFSET " . $this->offset;
        }
        return $sql;
    }
    public function fetch(\PDO $pdo, $object): ?array
    {
        $stmt = $pdo->prepare($this->toSql());
        $stmt->execute($this->params);
        $result = $stmt->fetch(\PDO::FETCH_CLASS, $object);
        if (false === $result) {
            return null;
        }
        return $result;
    }

}