<?php

namespace Model;

use Classes\DbConnection;

class BaseModel
{
    protected $tablename = false;
    public $data = [];

    public function __call($name, $arguments)
    {
        $name = strtolower($name);
        $arguments = implode($arguments);
        if (substr($name, 0, 3) == "get") {
            $name = str_replace("get", "", $name);
            if (isset($this->data[$name])) {
                return $this->data[$name];
            }
            return;
        }
        if (substr($name, 0, 3) == "set") {
            $name = str_replace("set", "", $name);
            $this->data[$name] = $arguments;
        }
    }

    public function getTableName()
    {
        if ($this->tablename !== false) {
            return $this->tablename;
        }
    }

    public function getColumnNameArray()
    {
        $query = "SHOW COLUMNS FROM " . $this->getTableName();
        $result = DbConnection::executeMySQLQuery($query);
        if (mysqli_num_rows($result) == 0) {
            return;
        }
        $dataArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $returnarray = [];
        foreach ($dataArray as $data) {
            $returnarray[] = $data["Field"];
        }
        return $returnarray;
    }

    public function load($id)
    {
        $query = "SELECT * FROM " . $this->getTableName() . " WHERE id=$id;";
        $result = DbConnection::executeMySQLQuery($query);
        if (mysqli_num_rows($result) == 0) {
            return false;
        }
        $dataArray = mysqli_fetch_assoc($result);
        foreach ($dataArray as $key => $value) {
            $setString = "set" . $key;
            $this->$setString($value);
        }
    }

    public function loadAll()
    {
        $query = "SELECT * FROM " . $this->getTableName();
        $result = DbConnection::executeMySQLQuery($query);
        if (mysqli_num_rows($result) == 0) {
            return false;
        }
        $dataArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $return = [];

        foreach ($dataArray as $row) {
            $unit = new $this;
            $unit->assign($row);
            $return[] = $unit;
        }
        return $return;
    }

    public function assign($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $setString = "set" . $key;
                $this->$setString($value);
            }
        }
    }

    public function save()
    {
        if (isset($this->data["id"])) {
            $query = "SELECT id FROM " . $this->getTableName() . " WHERE id=" . $this->getId();
            $result = DbConnection::executeMySQLQuery($query);
            $result = mysqli_fetch_assoc($result);
        }
        if (isset($result["id"]) && $this->getId() == $result["id"]) {
            $this->update();
        } else {
            $this->insert();
            $this->setId($this->getLastInsertId());
        }
    }

    public function delete($id = false)
    {
        if ($id === false) {
            $id = $this->getId();
        }
        $query = "DELETE FROM " . $this->getTableName() . " WHERE id='$id'";
        DbConnection::executeMysqlQuery($query);
    }

    public function loadByColumnValue($column, $value)
    {
        $query = "SELECT * FROM " . $this->getTableName() . " WHERE $column='$value';";
        $result = DbConnection::executeMySQLQuery($query);
        if (mysqli_num_rows($result) == 0) {
            return false;
        }
        $dataArray = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $return = [];

        foreach ($dataArray as $row) {
            $unit = new $this;
            $unit->assign($row);
            $return[] = $unit;
        }
        return $return;
    }

    public function getIdByColumnValue($column, $value)
    {
        $query = "SELECT id FROM $this->tablename WHERE $column='$value'";
        $result = \Classes\DbConnection::executeMysqlQuery($query);

        if (mysqli_num_rows($result) == 0) {
            return false;
        }
        return mysqli_fetch_column($result);
    }

    protected function insert()
    {
        $querybegin = "INSERT INTO " . $this->getTableName() . " (";
        $queryend = ") VALUES ( ";
        foreach ($this->data as $key => $data) {
            $querybegin .= $key . ",";
            $queryend .= "'" . $data . "',";
        }
        $query = substr($querybegin, 0, -1) . substr($queryend, 0, -1) . ")";
        DbConnection::executeMysqlQuery($query);
    }

    protected function update()
    {
        $querybegin = "UPDATE " . $this->getTableName() . " ";
        $querymid = "SET ";
        $queryend = "WHERE id = " . $this->getId();
        foreach ($this->data as $key => $data) {
            $querymid .= "" . $key . "='" . $data . "',";
        }
        $query = $querybegin . substr($querymid, 0, -1) . $queryend;
        DbConnection::executeMySQLQuery($query);
    }

    protected function getLastInsertId()
    {
        $query = 'SELECT LAST_INSERT_ID();';
        $result = DbConnection::executeMysqlQuery($query);

        if (mysqli_num_rows($result) == 0) {
            return false;
        }
        return mysqli_fetch_column($result);
    }
}