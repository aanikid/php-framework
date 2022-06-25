<?php

namespace App\Models\Manager;

use App\Exception\PropertyNotFoundException;
use App\Models\BDD;
use App\Models\Entities\User;
use PDO;

abstract class BaseManager
{
    private $table;
    private $object;
    protected PDO $bdd;

    public function __construct($table, $object)
    {
        $this->table = $table;
        $this->object = $object;
        $this->bdd = BDD::getInstance();
    }

    public function getById($id): bool|array
    {
        $req = $this->bdd->prepare("SELECT * FROM" . ' ' . $this->table . ' ' . "WHERE id =?");
        $req->execute(array($id));
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $this->object);
        return $req->fetch();
    }

    public function getAll()
    {
        $req = $this->bdd->prepare("SELECT * FROM" . ' ' .  $this->table);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_CLASSTYPE | PDO::FETCH_PROPS_LATE, $this->object);
    }


    public function create($obj, $params)
    {
        $paramsKeys = implode(', ', array_keys($params));
        $paramsValues = array_values($params);
        foreach ($paramsValues as $key => $v)
        {
            $paramsValues[$key] = "'". $v . "'";
        }
        $paramsValues = implode(', ', $paramsValues);

        $sql = "INSERT INTO " . $this->table . "(" . $paramsKeys . ") VALUES (" . $paramsValues . ")";
        $req = $this->bdd->prepare($sql);
        $req->execute();
    }

    /**
     * @throws PropertyNotFoundException
     */
    public function update($obj, $param)
    {
        $sql = "UPDATE " . $this->table . " SET ";
        foreach ($param as $paramName) {
            $sql = $sql . $paramName . " = ?, ";
        }
        $sql = $sql . " WHERE id = ? ";
        $req = $this->bdd->prepare($sql);

        $param[] = 'id';
        $boundParam = array();
        foreach ($param as $paramName) {
            if (property_exists($obj, $paramName)) {
                $boundParam[$paramName] = $obj->$paramName;
            } else {
                throw new PropertyNotFoundException($this->object, $paramName);
            }
        }

        $req->execute($boundParam);
    }

    /**
     * @throws PropertyNotFoundException
     */
    public function delete($obj): bool
    {
        if (property_exists($obj, "id")) {
            $req = $this->bdd->prepare("DELETE FROM" . $this->table . " WHERE id=?");
            return $req->execute(array($obj->id));
        } else {
            throw new PropertyNotFoundException($this->object, "id");
        }
    }
}