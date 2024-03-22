<?php

namespace Model;

class Ingredient extends BaseModel
{
    protected $tablename = 'ingredients';

    public function getIdByName($name)
    {
        $query = "SELECT id FROM $this->tablename WHERE ingredient='$name'";
        $result = \Classes\DbConnection::executeMysqlQuery($query);

        if (mysqli_num_rows($result) == 0) {
            return false;
        }
        return mysqli_fetch_column($result);
    }

    public function getBuyOptions()
    {
        $ingredient2amount = new Ingredient2amount();
        return $ingredient2amount->loadByColumnValue('ingredient_id', $this->getId());
    }
}